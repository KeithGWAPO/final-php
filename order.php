<?php 
include 'components2/connection.php';
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("location: login.php");
}
   

?>  
<style type="text/css">
    <?php include 'style.css'; ?>  
    .title {
        text-align: center; /* Center-align the title */
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Green Coffee - Order Page</title>
</head>
<body>
    <?php include 'components2/header.php' ?>  
    <div class="main">
     <div class="banner">
        <h1>My Orders</h1>
     </div>
     <div class="title2">
        <a href="home.php">Home</a><span>/ Order</span>
     </div>
     <section class="products">
        <div class="box-container">
          <div class="title">
            <img src="img/download.png" class="logo">
            <h1>My Orders</h1>
            <p>Track your purchases and manage your account effortlessly with our intuitive interface, ensuring seamless access to your order history, shipping details, and more.
</p>
          </div>   
</div> 
          <div class="box-container">
            <?php 
                $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id= ? ORDER BY date DESC");
                $select_orders->execute([$user_id]);
                    if ($select_orders->rowCount()>0) {
                        while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                            $select_products = $conn->prepare("SELECT * FROM  `products` WHERE id=?");
                            $select_products->execute([$fetch_order['product_id']]);
                            if ($select_products->rowCount()>0){
                                while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
           <div class="box" <?php if($fetch_order['status']=='cancel'){echo 'style="border:2px solid red";';} ?>>
    <a href="view_order.php?get_id=<?= $fetch_order['id']; ?>"></a>
    <p class="date"><i class="bi bi-calendar-fill"></i><span><?= $fetch_order['date']; ?></span></p>
    <img src="image/<?= $fetch_product['image']; ?>" class="image">
    <div class="row">
        <h3 class="name"><?= $fetch_product['name']; ?></h3>
        <p class="price">Price : ₱<?= $fetch_order['price']; ?>X <?= $fetch_order['qty']; ?></p>
        <p class="status" style="color:<?php if($fetch_order['status']=='delivered'){echo ' green';}elseif($fetch_order['status']=='delivered'){echo ' red';}else{echo 'orange';}?>"><?=$fetch_order['status']?></p>
        <a href="view_orders.php?product_id=<?= $fetch_product['id']; ?>" class="btn">View Order</a>
    </div>
</div>

            <?php 
                  }
                }
            }
        }else {
            echo '<p class="empty">No Order Takes Placed Yet</p>';
        }
            ?>
            
          </div>
        </div>
        
       
     </section>
     
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
