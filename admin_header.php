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

<header class="header">

<div class="flex">
    <a href="admin_page.php" class="logo">Gestion<span>Parfumerie</span></a>
    <nav class="navbar">
        <a href="admin_page.php">Accueil</a>
        <a href="admin_products.php">Produit</a>
        <a href="admin_orders.php">Commande</a>
        <a href="admin_users.php">Utilisateur</a>
        <a href="admin_contacts.php">Contact</a>
</nav>

<div class="icons">
    <div id="menu-btn" class="fas fa-bars"></div>
    <div id="user-btn" class="fas fa-user"></div>
</div>

<div class="account-box">
    <p>Nom : <span><?php echo $_SESSION['admin_name']; ?></span></p>
    <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
    <a href="logout.php" class="delete-btn">Déconnecter</a>
</div>

</div>

</header>