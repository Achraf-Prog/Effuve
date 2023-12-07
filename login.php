<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){
   
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die ('erreur');

   if(mysqli_num_rows($select_users) > 0){
    
        $row = mysqli_fetch_assoc($select_users);
        if($row['user_type'] == 'admin'){

           $_SESSION['admin_name'] = $row['name'];
           $_SESSION['admin_email'] = $row['email'];
           $_SESSION['admin_id'] = $row['id'];
           header('location:admin_page.php');
  
            }elseif($row['user_type'] == 'user'){
  
              $_SESSION['user_name'] = $row['name'];
              $_SESSION['user_email'] = $row['email'];
              $_SESSION['user_id'] = $row['id'];
              header('location:home.php');
           } 
        }else{
            $message[] = 'Email ou mot de passe incorrect';

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="style.css">
   <style>
      .code-container {
   background-color: #f8e5e5;
   padding: 20px;
   border-radius: 5px;
   font-family: monospace;
   white-space: pre-wrap;
   overflow-x: auto;
   line-height: 1.4;
   font-size: 14px;
   color: #333;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.message {
   background-color: #f7caca;
   color: #c5231e;
   padding: 10px;
   margin-bottom: 10px;
   border-radius: 5px;
   box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.message span {
   margin-right: 10px;
}

.message i {
   cursor: pointer;
}

.form-container {
   max-width: 400px;
   margin: 0 auto;
   padding: 20px;
   background-color: #fff;
   border-radius: 5px;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.box {
   width: 100%;
   padding: 10px;
   margin-bottom: 10px;
   border: 1px solid #e84c3d;
   border-radius: 3px;
   font-size: 14px;
   color: #333;
   background-color: #ffe9e8;
}

.box:focus {
   outline: none;
   border-color: #ff726f;
   box-shadow: 0 0 5px rgba(232, 76, 61, 0.5);
   background-color: #fff;
}

.btn {
   width: 100%;
   padding: 10px;
   background-color: #e84c3d;
   color: #fff;
   border: none;
   border-radius: 3px;
   font-size: 14px;
   cursor: pointer;
}

.btn:hover {
   background-color: #ff726f;
}

.btn:active {
   background-color: #c5231e;
}

.btn:focus {
   outline: none;
}

.btn:disabled {
   background-color: #aaa;
   cursor: not-allowed;
}

h3 {
   color: #e84c3d;
   font-size: 24px;
   margin-top: 0;
   margin-bottom: 20px;
}

   </style>
</head>
<body>

   <?php
   if(isset($message)){
      foreach($message as $message){
      echo  '
      <div class="message">
      <span>'.$message.'</span>
      <i class="fas fa_times" onclick="this.parentElement.remove();"></i>
   </div>
   ';
   }
}

   ?>

   <div class="form-container">
      <form action="" method="post">
      <h3>se connecter</h3>
         <input type="email" name="email" placeholder="entrer ton email" required class="box">
         <input type="password" name="password" placeholder="entrer ton mot de passe" required class="box">
<input type="submit" name="submit" value="se connecter" class="btn">
<p>vous n'avez pas un compte? <a href="register.php">inscrivez-vous</a></p>
</form>
</div>

</body>
</html>


