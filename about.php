<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>A propos</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="style.css">

</head>

<body>
   <?php include 'header.php'; ?>
   <div class="heading">
      <h3>A propos de nous</h3>
      <p><a href="home.php">Accueil</a> / about</p>
   </div>

   <section class="about">
      <div class="flex">
         <div class="image">
            <img src="images/aboutimagee.png" alt="">
         </div>
         <div class="content">
            <h3>Pourquoi nous choisir?</h3>
            <p>Notre boutique est un endroit unique pour les amateurs de parfums de luxe. Nous sommes fiers de proposer une
               sélection exquise de parfums haut de gamme provenant des meilleures marques du monde entier. Nous comprenons
               l'importance de la qualité et de l'exclusivité, c'est pourquoi nous nous efforçons de trouver les parfums les
               plus rares et les plus convoités pour notre clientèle sophistiquée.</p>
            <a href="contact.php" class="btn">Contactez-nous</a>
         </div>
      </div>
   </section>
   <section class="reviews">
      <h1 class="title">Avis des clients</h1>
      <div class="box-container">
         <?php
         // Effectuer la requête pour récupérer les messages des utilisateurs
         $query = "SELECT * FROM message";
         $result = mysqli_query($conn, $query);

         // Parcourir les résultats et afficher les messages
         while ($row = mysqli_fetch_assoc($result)) {
            $message = $row['message'];
            $name = $row['name'];
         ?>
            <div class="box">
               <img src="images/avatar.png" alt="Avatar">
               <p><?php echo $message; ?></p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3><?php echo $name; ?></h3>
            </div>
         <?php
         }

         // Libérer la mémoire associée au résultat
         mysqli_free_result($result);
         ?>
      </div>
   </section>

   <?php include 'footer.php'; ?>
   <script src="script.js"></script>
</body>

</html>