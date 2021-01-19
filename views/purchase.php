<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../js/jquery-3.5.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/functions-general.js"></script>
    <script type="text/javascript" src="../js/purchase.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
    <?php 
        session_start();
        include("header.php");
        if(isset($_GET["action"])){
            if($_GET["action"] == "delete") {
                $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
                $cart_data = json_decode($cookie_data, true);
                foreach($cart_data as $keys => $values) {
                    if($cart_data[$keys]["item_id"] == $_GET["id"]){
                        unset($cart_data[$keys]);
                        $item_data = json_encode($cart_data);
                        setcookie("shopping_cart", $item_data, time() + (86400 * 30));
                        header("location: purchase.php");
                    } 
                }
            } else if($_GET['action'] == "deleteAll") {
                setcookie("shopping_cart", "", time() - 3600);
                header('Location: home.php');
            }
        }
    ?>
    <main>
    <table class="purchase-table" id="music-info-table">
        <thead>
            <tr>
                <th>Album</th>
                <th>Genre</th>
                <th>Composer</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price Pr Item</th>
                <th>Remove Item</th>
            </tr>
        </thead>
        <tbody>
    <?php
    if(isset($_COOKIE["shopping_cart"])){
    $total = 0;
    $cookie_data = stripslashes($_COOKIE["shopping_cart"]);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
        {
    ?>
        
            <tr>
                <td><?php echo $values["item_album"]; ?></td>
                <td><?php echo $values["item_genre"]; ?></td>
                <td><?php echo $values["item_composer"]; ?></td>
                <td><?php echo $values["item_price"]; ?></td>
                <td><?php echo $values["item_quantity"]; ?></td>
                <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                <td id="remove-from-cart"><a href="purchase.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span><i class="far fa-trash-alt"></i></span></a></td>
            </tr>
        <?php
            $total = $total + ($values["item_quantity"] * $values["item_price"]);
        }
        ?>
        </tbody>

        <?php 
        } else {
            echo '<tr>
                    <td>No Item in Cart</td>
                    </tr>';
        }
        ?>
    </table>
    <div class="editUser">
        <div class="form">
            <p>Billing Address</p>
            <input type="text" id="billingAddress" placeholder="Billing Address">
            <p>Billing City</p>
            <input type="text" id="billingCity" placeholder="Billing City">
            <p>Billing State</p>
            <input type="text" id="billingState" placeholder="Billing State">
            <p>Billing Country</p>
            <input type="text" id="billingCountry" placeholder="Billing Country">
            <p>Billing Postal Code</p>
            <input type="text" id="billingPostalCode" placeholder="Postal Code">
            <p>Total Price: <?php echo $total ?></p>
            <input type="hidden" id="finalPrice" value="<?php echo $total ?>">
            <?php if(isset($_SESSION['userId'])) { ?>
            <a href="purchase.php?action=deleteAll"><button class="createInvoice">Purchase</button></a>
            <?php } else { ?>
            <h2>Pleas login to make purchase</h2>
            <?php } ?>
        </div>
    </div>
</main>
</body>
</html>