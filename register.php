<?php
include 'config.php';

if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
   $user_type = $_POST['user_type'];

   // Vérification de l'email
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $message[] = "L'email n'est pas valide.";
   } else {
      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die ('erreur');

      if(mysqli_num_rows($select_users) > 0){
         $message[] = 'utilisateur existe déjà';
      } else { 
         if($pass != $cpass){
            $message[] = 'erreur de mot de passe';
         } else {
            mysqli_query($conn, "INSERT INTO `users` (name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die ('erreur');
            $message[] = 'Inscription réussie';
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <?php
   if(isset($message)){
      foreach($message as $msg){
         echo  '
         <div class="message">
            <span>'.$msg.'</span>
            <i class="fas fa_times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
   ?>

   <div class="form-container">
      <form action="" method="post">
         <h3>inscrivez-vous</h3>
         <input type="text" name="name" placeholder="entrer ton nom" required class="box">
         <input type="email" name="email" placeholder="entrer ton email" required class="box">
         <input type="password" name="password" placeholder="entrer ton mot de passe" required class="box">
         <input type="password" name="cpassword" placeholder="rerentrer ton mot de passe" required class="box">
         <select name="user_type" class="box" hidden>
            <option value="user">utilisateur</option>
            <option value="admin">administrateur</option>
         </select>
         <input type="submit" name="submit" value="s'inscrire" class="btn">
         <p>Avez-vous déjà un compte? <a href="login.php">Se connecter</a></p>
      </form>
   </div>

</body>
</html>
