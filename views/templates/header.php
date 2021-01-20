    <header>
        <div class="img-title">
            <img src="../img/notes-logo.png" alt="notes-logo" id="notes-logo">
            <div class="home-title">
            <a href="home.php">
            <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === 1) { ?>
                <h1>Music Store - Admin</h1>
                <?php } else {?>
                <h1>Music Store</h1>
                <?php } ?>
            </a>
            </div>
        </div>
        <div class="header-icons">
            <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === 1) { ?>
            <i class="fas fa-plus-square fa-2x" id="admin-add-btn"></i>
            <?php } ?>
            <?php if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] === 0) { ?>
            <a href="purchase.php">
            <i class="fas fa-shopping-cart fa-2x h-icon" id="shopping-cart-btn"></i>
            </a>
            <?php } ?>
            <?php if((!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] === 0) && (isset($_SESSION['userId']) && $_SESSION['userId'] != 0)) { ?>
            <a href="profile.php">
                <i class="far fa-user fa-2x h-icon" id="profile-btn"></i>
            </a>
            <?php } ?>
            <?php if(isset($_SESSION['userId'])) { ?>
            <i class="fas fa-sign-out-alt fa-2x h-icon" id="sign-out-btn"></i>
            <?php } else { ?>
            <i class="fas fa-sign-in-alt fa-2x h-icon" id="sign-in-btn"></i>
            <?php } ?>

        </div>
    </header>