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
    if (isset($_POST['add_to_wishlist'])) {
        $id = unique_id();
        $product_id = $_POST['product_id'];

        $varify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
        $varify_wishlist->execute([$user_id, $product_id]);

        $cart_num = $conn->prepare("SELECT * FROM `cart` WHERE user_id= ? AND product_id = ?");
        $cart_num->execute([$user_id, $product_id]);

        if ($varify_wishlist->rowCount() > 0) {
            $warning_msg[] = 'Product Already Exist In Your Wishlist';
        }else if ($cart_num->rowCount() > 0) {
            $warning_msg[] = 'Product Already Exist In Your Cart';
        }else{
            $select_price = $conn->prepare("SELECT * FROM `products` WHERE id= ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(id, user_id,product_id,price) VALUES(?,?,?,?)");
            $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);
            $success_msg[] = 'Product Added To Wishlist';
        }
    }

    if (isset($_POST['add_to_cart'])) {
        $id = unique_id();
        $product_id = $_POST['product_id'];
    
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);

        $varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
        $varify_cart->execute([$user_id, $product_id]);
        
        $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id= ?");
        $max_cart_items->execute([$user_id]);
    
        if ($varify_cart->rowCount() > 0) {
            $warning_msg[] = 'Product Already Exist In Your Cart';
        }else if ($max_cart_items->rowCount() > 100) {
            $warning_msg[] = 'Cart Is Full';
        }else{
            $select_price = $conn->prepare("SELECT * FROM `products` WHERE id= ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);
    
            $insert_cart = $conn->prepare("INSERT INTO `cart` (id, user_id,product_id,price,qty) VALUES(?,?,?,?,?)");
            $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
            $success_msg[] = 'Product Added To Cart';
        }
    }

?>  
<style type="text/css">
    <?php include 'style.css'; ?>  
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Green Coffee - Shop Page</title>
</head>
<body>
    <?php include 'components2/header.php' ?>  
    <div class="main">
     <div class="banner">
        <h1>Products</h1>
     </div>
     <div class="title2">
        <a href="home.php">Home</a><span>/ Our Shop</span>
     </div>
     <section class="products">
        <div class="box-container">
            <?php 
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE status = 'active'");
             $select_products->execute();
             if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                   
                   ?>
            <form action="" method="post" class="box">
                <img src="image/<?=$fetch_products['image']; ?>" class="img"> 
                <div class="button">
                    <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                    <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                    <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="bx bxs-show"></a>
                </div>
                <h3 class="name"><?=$fetch_products['name']; ?></h3>
                <input type="hidden" name="product_id" value="<?=$fetch_products['id']; ?>">
                <div class="flex">
                    <p class="price">Price $<?=$fetch_products['price']; ?>/-</p>
                    <input type="number" name="qty" required min="1" value="1" max="99" maxlength="10" class="qty">
                </div>
                <a href="checkout.php?get_id=<?=$fetch_products['id']; ?>" class="btn">Buy</a>
            </form>       
            <?php        
                }
            }else{
                echo ' <p class="empty">No Producst Added Yet</p>';
            }
            ?>
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