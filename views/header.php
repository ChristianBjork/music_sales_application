    <header>
        <div class="img-title">
            <img src="img/notes-logo.png" alt="notes-logo" id="notes-logo">
            <div class="home-title">
                <h1>Music Store</h1>
            </div>
        </div>
        <div class="header-icons">
            <?php
            if($_SESSION['isAdmin'] === 1) {
            ?>
            <i class="fas fa-plus-square fa-2x" id="admin-add-btn"></i>
            <?php
            }
            ?>
            <i class="fas fa-shopping-cart fa-2x h-icon" id="shopping-cart-btn"></i>
            <i class="far fa-user fa-2x h-icon" id="profile-btn"></i>
            <i class="fas fa-sign-out-alt fa-2x h-icon" id="sign-out-btn"></i>
        </div>
    </header>