<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];



if(!isset($user_id)){
    header('location:login.php');
     }

     if(isset($_POST['send'])){
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $number = $_POST['number'];
      $msg = mysqli_real_escape_string($conn, $_POST['message']);

      $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number ='$number' AND message = '$msg'") or die ('query failed');

      if(mysqli_num_rows($select_message) > 0){
         $message[] = 'message déja envoyer';
      }else{
         mysqli_query($conn, "INSERT INTO `message` (user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
         $message[] = 'message bien envoyer';
      }
     }
     
     ?>

     <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="style.css">
   <style>
      .contact {
   background-color: #f2f2f2;
   padding: 20px;
   border-radius: 5px;
   margin-bottom: 20px;
}

.contact h3 {
   color: #333;
   font-size: 24px;
   margin-bottom: 10px;
}

.contact input[type="text"],
.contact input[type="email"],
.contact textarea {
   width: 100%;
   padding: 10px;
   border: 1px solid #ccc;
   border-radius: 4px;
   margin-bottom: 10px;
}

.contact .btn {
   background-color: #ff5555;
   color: #fff;
   padding: 10px 20px;
   border: none;
   border-radius: 4px;
   cursor: pointer;
}

.contact .btn:hover {
   background-color: #ff0000;
}

.contact p {
   font-size: 16px;
   color: #666;
   margin-bottom: 20px;
}

.contact a {
   color: #ff5555;
   text-decoration: none;
}

.contact a:hover {
   text-decoration: underline;
}
.contact h2 {
   font-size: 24px;
   margin-bottom: 5px;
}

.contact input[type="text"],
.contact input[type="email"],
.contact textarea {
   font-size: 16px;
   padding: 10px;
   border: 1px solid #ccc;
   border-radius: 4px;
   margin-bottom: 10px;
}
   </style>
</head>
<body>

<?php include 'header.php';?>

<div class="heading">
   <h3>Contactez-nous</h3>
   <p><a href="home.php">Accueil</a> / contact</p>
 </div>

 <section class="contact">
   <form action="" method="post">
      <h3>Disez quelque chose</h3>
      <h2> Nom : <h2>
      <input type="text" name="name" required placeholder="Entrer votre nom"><br>
      <h2>Email : </h2>
      <input type="email" name="email" required placeholder="Entrer votre email" ><br>
      <h2>Numèro : </h2>
      <input type="text" name="number" required placeholder="Entrer votre numèro" ><br>
      <h2>Votre message : </h2>
      <textarea name="message" class="box" placeholder="Entrer votre message" id="" cols="30" rows="10"></textarea>
      <button type="clear" value="envoyez" name="send" class="btn"> Envoyer </button>
   </form>
 </section>

<?php include 'footer.php'; ?>
<script src="script.js"></script>
</body>
</html>