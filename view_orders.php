<?php 
include 'components2/connection.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if (isset($_POST['logout'])) {
    session_destroy();
    header("location: login.php");
}

// Check if cancel button is pressed
if (isset($_POST['cancel'])) {
    // Ensure that order ID is provided
    if(isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
        // Prepare and execute query to update the status of the order to "cancelled"
        $update_order_status = $conn->prepare("UPDATE `orders` SET status = 'cancelled' WHERE id = ? AND user_id = ?");
        $update_order_status->execute([$order_id, $user_id]);
        // Optionally, you can add some success message here
    } else {
        // Optionally, handle the case where the order ID is not provided
    }
}

?>  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Green Coffee - Order Details Page</title>
    <style type="text/css">
        <?php include 'style.css'; ?>  
        .title {
            text-align: center; /* Center-align the title */
        }
    </style>
</head>
<body>
    <?php include 'components2/header.php' ?>  

    <div class="main">
        <div class="banner">
            <h1>Order Details</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home</a><span>/  Order Details</span>
        </div>
        <?php
        // Select all orders for the logged-in user
        $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
        $select_orders->execute([$user_id]);
        
        if ($select_orders->rowCount() > 0) {
            ?>
            <section class="order-detail">
                <div class="box-container">
                    <div class="title">
                        <img src="img/download.png" class="logo">
                        <h1>Order Detail</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, ipsam.</p>
                    </div>   
                </div> 
                <div class="box-container">
                    <?php 
                    $grand_total = 0;
                    while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
                        $select_product = $conn->prepare("SELECT * FROM `products` WHERE id=? LIMIT 1");
                        $select_product->execute([$fetch_order['product_id']]);
                        
                        if ($select_product->rowCount() > 0){
                            $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
                            $sub_total = ($fetch_order['price'] * $fetch_order['qty']);
                            $grand_total += $sub_total;
                            ?>
                            <div class="box">
                                <div class="col">
                                    <p class="title"><i class="bi bi-calendar-fill"></i><?= $fetch_order['date']; ?></p>
                                    <img src="image/<?= $fetch_product['image']; ?>" class="image">
                                    <p class="price"><?= $fetch_product['price']; ?> X <?= $fetch_order['qty']; ?></p>
                                    <h3 class="name"><?= $fetch_product['name']; ?></h3>
                                    <p class="grand-total">Total Amount Payable : <span>₱<?= $grand_total; ?></span></p>
                                </div>
                                <div class="col">
                                    <p class="title">Billing Address</p>
                                    <p class="user"><i class="bi bi-person-bounding-box"></i><?= $fetch_order['name']; ?></p>
                                    <p class="user"><i class="bi bi-phone"></i><?= $fetch_order['number']; ?></p>
                                    <p class="user"><i class="bi bi-envelope"></i><?= $fetch_order['email']; ?></p>
                                    <p class="user"><i class="bi bi-pin-map-fill"></i><?= $fetch_order['address']; ?></p>
                                    <p class="title">Status</p>
                                    <p class="status" style="color:<?php if($fetch_order['status']=='delivered'){echo 'green';}elseif($fetch_order['status']=='cancelled'){echo 'red';}else{echo 'orange';}?>"><?= $fetch_order['status']; ?></p>
                                    <?php if ($fetch_order['status'] == 'cancelled') {?>
                                        <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">Order Again</a>
                                    <?php } else {?>
                                        <form method="post">
                                        <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
    <button type="submit" name="cancel" class="btn" onclick="return confirm('Do You Want To Cancel This Order?')">Cancel Order</button>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php 
                        } else {
                            echo '<p class="empty">Product Not Found</p>';
                        }
                    }
                    ?>
                </div>
            </section>
        <?php
        } else {
            echo '<p class="empty">No Orders Found</p>';
        }
        ?>
        <?php include 'components2/footer.php' ?> 
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script> 
    <script>
        // Dili nako nga code
        window.addEventListener('load', function() {
            var boxes = document.querySelectorAll('.products .box-container .box');
            var maxWidth = 0;
            var maxHeight = 0;

            // Kini makuha ang pinakadako nga sukad sa mga larawan
            boxes.forEach(function(box) {
                var img = box.querySelector('.img');
                var width = img.offsetWidth;
                var height = img.offsetHeight;

                maxWidth = Math.max(maxWidth, width);
                maxHeight = Math.max(maxHeight, height);
            });

            // Kini ipahibalo niini ang sukad sa tanang mga larawan
            boxes.forEach(function(box) {
                var img = box.querySelector('.img');
                img.style.width = maxWidth + 'px';
                img.style.height = maxHeight + 'px';
            });
        });
    </script>
    <?php include 'components2/alert.php' ?>   
    
</body>
</html>
