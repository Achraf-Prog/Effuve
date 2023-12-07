<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
     };
   if(isset($_POST['add_product'])){
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $description = $_POST['description'];
      $price = $_POST['price'];
      $image = $_FILES['image']['name'];
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = 'upladed_img/' .$image;

      $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('erreur');

      if(mysqli_num_rows($select_product_name) > 0){
         $message[] = 'Nom du produit dèja utiliser';
      }else{
         $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, description, price, image) VALUES('$name','$description','$price','$image')") or die ('erreur');
         if($add_product_query){
            if($image_size > 2000000){
            $message[] = 'Taille d image très grande';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Produit ajouter';
         } 
         }else{
            $message[] = 'Produit n est pas ajouté';
         }

      }
   }

   if(isset($_GET['delete'])){
      $delete_id = $_GET['delete'];
      $delete_image_query = mysqli_query($conn,"SELECT image FROM `products` WHERE id = '$delete_id'") or die ('erreur');
      $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
      unlink('uploaded_img/'.$fetch_delete_image['image']);
      mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id' ") or die('erreur');
      header('location:admin_products.php');
   }
   if(isset($_POST['update_product'])){

      $update_p_id = $_POST['update_p_id'];
      $update_name = $_POST['update_name'];
      $update_description = $_POST['update_description'];
      $update_price = $_POST['update_price'];
      mysqli_query($conn, "UPDATE `products` SET name = '$update_name',description = '$update_description',price = '$update_price' WHERE id ='$update_p_id'") or die ('erreur');

      $update_image = $_FILES['update_image']['name'];
      $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
      $update_image_size = $_FILES['update_image']['size'];
      $update_folder = 'uploaded_img/'.$update_image;
      $update_old_image = $_POST['update_old_image'];

      if(!empty($update_image)){
         if($update_image_size > 2000000){
            $message[] = 'Taille d image très grande';
             }else{ 
               mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id ='$update_p_id'") or die ('erreur'); 
               move_uploaded_file($update_image_tmp_name, $update_folder);
               unlink('uploaded_img/'.$update_old_image);
         }
      }
      header('location:admin_products.php');
   }

     ?>
     <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Produit</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="admin_style.css">

</head>
<body>
   <?php include 'admin_header.php';?>

   <section class = "add-products">
    <h1 class="title">Gestion des produits</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Ajoutez un produit</h3>
        <h2> Nom du produit : </h2> <br>
        <input type="text" name="name" class="box" >
        <h2> Description : </h2> <br>
        <input type="text" name="description" class="box" >
        <h2> Prix : </h2><br>
        <input type="number" min="0" name="price" class="box" >
        <h2> Image : </h2><br>
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
        <input type="submit" value="Ajouter" name="add_product" class="btn">
    </form>

   </section>

   <section class="show-products">
      <div class="box-container">
         <?php
            $select_products = mysqli_query($conn,"SELECT * FROM `products`") or die('erreur');
            if(mysqli_num_rows($select_products) > 0){
              while($fetch_products = mysqli_fetch_assoc($select_products)){
               ?>
               <div class="box">
               <img src="uploaded_img/<?php echo $fetch_products['image']; ?> " alt="">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <div class="description"><?php echo $fetch_products['description']; ?></div>
                  <div class="price"><?php echo $fetch_products['price']; ?>DH</div>
                  <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Modifier</a>
                  <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Vous voulez supprimé ce produit?');">Supprimer</a>
               </div>
         <?php
         }
      }else{
         echo '<p class="empty">aucun produit ajouter</p>';
      }
         ?>
      </div>

   </section>

   <section class="edit-product-form">
   <?php
         if(isset($_GET['update'])){
            $update_id = $_GET['update'];
            $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'" ) or die ('erreur');
            if(mysqli_num_rows($update_query) > 0){
               while($fetch_update = mysqli_fetch_assoc($update_query)){
                  ?>
                  <form action = "" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                    <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                    <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
                    <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Ajoutez le nom du produit">
                    <input type="text" name="update_description" value="<?php echo $fetch_update['description']; ?>" class="box" required placeholder="Ajoutez la description du produit">
                    <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Ajoutez le prix du produit">
                    <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                    <input type="submit" value="Enregistrer" name="update_product" class="btn">
                    <input type="reset" value="Fermer" id="close-update" class="option-btn">
                  </form>
                  <?php
               }
            }
         }else{
           echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
         }
         ?>
   </section>

   <script src="admin_script.js"></script>
   
</body>
</html>
