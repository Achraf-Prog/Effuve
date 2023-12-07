<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];



if(!isset($admin_id)){
    header('location:login.php');
     }


     ?>
     <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="admin_style.css">

</head>
<body>
   <?php include 'admin_header.php';?>

   <section class="dashboard">

   <h1 class="title">tableau de bord</h1>

   <div class="box-container">
   <div class="box">
   <?php
   $total_pendings = 0;
   $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'en attente'" ) or die ('erreur');
   if(mysqli_num_rows($select_pending) > 0){ 
   while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
      $total_price = $fetch_pendings['total_price'];
      $total_pendings += $total_price;
   };
};
   
   ?>
   <h3><?php echo $total_pendings; ?> DH</h3>
  <p>Paiement en attente</p>
   </div>
   <div class="box">
   <?php
   $total_completed = 0;
   $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'paiement reçu'" ) or die ('erreur');
   if(mysqli_num_rows($select_completed) > 0){ 
   while($fetch_completed = mysqli_fetch_assoc($select_completed)){
      $total_price = $fetch_completed['total_price'];
      $total_completed += $total_price;
   };
};
   
   ?>
   <h3><?php echo $total_completed; ?> DH</h3>
  <p>Paiement reçu</p>
   </div>
   <div class="box">
      <?php 
       $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die ('erreur');
       $number_of_orders = mysqli_num_rows($select_orders);
      ?>
      <h3><?php echo $number_of_orders; ?></h3>
      <p>Commande reçue</p>
   </div>

   <div class="box">
      <?php 
       $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die ('erreur');
       $number_of_products = mysqli_num_rows($select_products);
      ?>
      <h3><?php echo $number_of_products; ?></h3>
      <p>Produit ajouté</p>
   </div>

   <div class="box">
      <?php 
       $select_users = mysqli_query($conn, "SELECT * FROM `users` where user_type = 'user'") or die ('erreur');
       $number_of_users = mysqli_num_rows($select_users);
      ?>
      <h3><?php echo $number_of_users; ?></h3>
      <p>utilisateurs</p>
   </div>

   <div class="box">
      <?php 
       $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die ('erreur');
       $number_of_messages = mysqli_num_rows($select_messages);
      ?>
      <h3><?php echo $number_of_messages; ?></h3>
      <p>Messages reçue</p>
   </div>
   </div>




   <script src="admin_script.js"></script>
   
</body>
</html>