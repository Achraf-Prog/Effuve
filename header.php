<link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Tangerine">
<header class="header">
    <div class="header-1">
    <div class="flex">
        <div class="share"> </div>
         
         </div>
    </div>
    <div class="header-2" style="margin-bottom: 20px;">
        <div class="flex">
        <a href="home.php"><img src="images/Black___White_Minimalist_Business_Logo-removebg-preview.png" alt="Logo" style="height: 80px; width: 200px;"></a>
        <nav class="navbar">
            <a href="home.php" style="font-size: 18px;">Accueil</a>
            <a href="about.php" style="font-size: 18px;">A propos</a>
            <a href="shop.php" style="font-size: 18px;">Produit</a>
            <a href="contact.php" style="font-size: 18px;">Contact</a>
            <a href="orders.php" style="font-size: 18px;">Commande</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <a id="user-btn" class="fas fa-user"></a>
            <?php $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id' ") or die ('erreur');
            $cart_rows_number = mysqli_num_rows($select_cart_number);
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span></a>
        </div>
        <div class="user-box">
            <p>Utilisateur: <span><?php echo $_SESSION['user_name']?></span></p>
            <p>Email: <span><?php echo $_SESSION['user_email']?></span></p>
            <a href="logout.php" class="delete-btn">Déconnecter</a>
        </div>
        </div>
        </div>
</header>