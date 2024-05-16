<?php 
include 'components2/connection.php';
session_start();

$warning_msg = []; 

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("location: login.php");
}

if (isset($_POST['place_order'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $address = $_POST['flat'].','.$_POST['street'].','.$_POST['city'].','.$_POST['region'].','.$_POST['pincode'];
    $address_type = $_POST['address_type'];
    $method = $_POST['method'];

   
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $address_type = filter_var($address_type, FILTER_SANITIZE_STRING);
    $method = filter_var($method, FILTER_SANITIZE_STRING);

 $varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
 $varify_cart->execute([$user_id]);
 $show_receipt = false; 

 if ($show_receipt && $varify_cart->rowCount() > 0) {

     $receipt_content = "
         <h1>Receipt</h1>
         <p>Order Details:</p>
         <ul>
             <li>Name: $name</li>
             <li>Number: $number</li>
             <li>Email: $email</li>
             <li>Address: $address</li>
             <li>Payment Method: $method</li>
             <li>Items:</li>
         </ul>
         <table>
             <tr>
                 <th>Product</th>
                 <th>Price</th>
                 <th>Quantity</th>
                 <th>Total</th>
             </tr>
             <!-- Add rows for each item here -->
         </table>";
 

     echo $receipt_content;
     
     while($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)){
         $get_product = $conn->prepare("SELECT * FROM `products` WHERE id= ? LIMIT 1");
         $get_product->execute([$f_cart['product_id']]);
         $fetch_p = $get_product->fetch(PDO::FETCH_ASSOC);
         if ($fetch_p) {
             $receipt_content .= "
                 <tr>
                     <td>{$fetch_p['name']}</td>
                     <td>₱{$fetch_p['price']}</td>
                     <td>{$f_cart['qty']}</td>
                     <td>₱" . ($f_cart['qty'] * $fetch_p['price']) . "</td>
                 </tr>";
         }
     }
     $receipt_content .= "
         </table>";

     
     echo $receipt_content;
    }

    if ($varify_cart->rowCount() > 0) {
       
        while($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)){
     
            $get_product = $conn->prepare("SELECT * FROM `products` WHERE id= ? LIMIT 1");
            $get_product->execute([$f_cart['product_id']]);
            $fetch_p = $get_product->fetch(PDO::FETCH_ASSOC);
            if ($fetch_p) {
               
                $insert_order = $conn->prepare("INSERT INTO `orders` (id, user_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $fetch_p['id'], $fetch_p['price'], $f_cart['qty']]);
               
                header('location: order.php');
            }
        }
        // Delete items from cart after placing order
        $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart_id->execute([$user_id]);
        header('location:order.php');
    } else {
        $warning_msg[] = 'Your Cart Is Empty';
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
    <title>Green Coffee - Checkout Page</title>
</head>
<body>
    <?php include 'components2/header.php' ?>  
    <div class="main">
     <div class="banner">
        <h1>Checkout</h1>
     </div>
     <div class="title2">
        <a href="home.php">Home</a><span>/ Checkout</span>
     </div>
     <section class="checkout">
       <div class="title">
        <img src="img/download.png" class="logo">
        <h1>Checkout Summary</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, corrupti.</p>
        <div class="summary">
            <h3>My Bag</h3>
            <div class="box-container">
                <?php 
                $grand_total = 0;
                if (isset($_GET['get_id'])) {
                    $select_get = $conn->prepare("SELECT * FROM `products` WHERE id=?");
                    $select_get->execute([$_GET['get_id']]);
                    while($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                        $sub_total = $fetch_get['price'];
                        $grand_total+=$sub_total;
                ?>
                <div class="flex">
                    <img src="image/<?=$fetch_get['image']; ?>" class="image">
                    <div>
                        <h3 class="name"><?= $fetch_get['name']; ?></h3>
                        <p class="price">₱<?= $fetch_get['price']; ?>/-</p>
                    </div>
                </div>
                <?php 
                        }
                    }else{
                        $select_cart= $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
                        $select_cart->execute([$user_id]);
                        if ($select_cart->rowCount() > 0) {
                            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                                $select_products=$conn->prepare("SELECT * FROM `products` WHERE id=?");
                                $select_products->execute([$fetch_cart['product_id']]);
                                $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC); 
                                $sub_total = ($fetch_cart['qty'] * $fetch_product['price']);
                                $grand_total    += $sub_total;
                                ?>
                                <div class="flex">
                                    <img src="image/<?= $fetch_product['image'];  ?>">
                                    <h3 class="name"><?= $fetch_product['name']; ?></h3>
                                    <p class="price"><?= $fetch_product['price']; ?> X <?=$fetch_cart['qty']; ?></p>
                                </div>
                                <?php 
                                            }
                                        }else{
                                            echo '<p class="empty">Your Cart Is Empty</p>';
                                        }
                                    }
                                ?>
                            </div>
                            <div class="grand-total"><span>Total Amount Payable: </span>₱<?= $grand_total ?>/-</div>
                            
                        </div>
                        <div class="row">
                            <form method="post">
                                <h3>Billing Details</h3>
                                <div class="flex">
                                    <div class="box">
                                        <div class="input-field">
                                            <p>Your Name <span>*</span></p>
                                            <input type="text" name="name" required maxlength="99" placeholder="Enter Your Name..." class="input">
                                        </div>
                                        <div class="input-field">
                                            <p>Your Number <span>*</span></p>
                                            <input type="text" name="number" required maxlength="99" placeholder="Enter Your Number..." class="input">
                                        </div>
                                        <div class="input-field">
                                            <p>Your Email <span>*</span></p>
                                            <input type="text" name="email" required maxlength="99" placeholder="Enter Your Email..." class="input">
                                        </div>
                                        <div class="input-field">
                                            <p>Payment Method <span>*</span></p>
                                            <select name="method" class="input">
                                                <option value="cash on delivery">Cash On Delivery</option>
                                                <option value="gcash">Gcash</option>
                                                <option value="credit or debit card">Credit Or Debit Card</option>
                                            </select>
                                        </div>
                                        <div class="input-field">
                                            <p>Address Type <span>*</span></p>
                                            <select name="address_type" class="input">
                                                <option value="home">Home</option>
                                                <option value="office">Office</option>
                                            </select>
                                        </div>
                                        <div class="input-field">
                                            <p>Address Line 01 <span>*</span></p>
                                            <input type="text" name="flat" required maxlength="99" placeholder="E.G Flat & Building Number..." class="input">
                                        </div>   
                                        <div class="input-field">
                                            <p>Address Line 02 <span>*</span></p>
                                            <input type="text" name="street" required maxlength="99" placeholder="E.G Street Name..." class="input">
                                        </div> 
                                        <div class="input-field">
                                            <p>City Name <span>*</span></p>
                                            <input type="text" name="city" required maxlength="99" placeholder="Enter Your City Name..." class="input">
                                        </div> 
                                        <div class="input-field">
                                            <p>Region <span>*</span></p>
                                            <input type="text" name="region" required maxlength="99" placeholder="Enter Your Region..." class="input">
                                        </div> 
                                        <div class="input-field">
                                            <p>Pin Code <span>*</span></p>
                                            <input type="text" name="pincode" required maxlength="99" placeholder="Enter Pincode..." class="input">
                                        </div> 
                                        <button type="submit" name="place_order" class="btn" onclick="window.print()">Place Order</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
     
         <?php include 'components2/footer.php' ?> 
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script> 
    <script>
     
window.addEventListener('load', function() {
    var boxes = document.querySelectorAll('.products .box-container .box');
    var maxWidth = 0;
    var maxHeight = 0;

  
    boxes.forEach(function(box) {
        var img = box.querySelector('.img');
        var width = img.offsetWidth;
        var height = img.offsetHeight;

        maxWidth = Math.max(maxWidth, width);
        maxHeight = Math.max(maxHeight, height);
    });

   
    boxes.forEach(function(box) {
        var img = box.querySelector('.img');
        img.style.width = maxWidth + 'px';
        img.style.height = maxHeight + 'px';
    });
});

    </script>

<script>

    window.addEventListener('load', function() {
        if (window.location.href.includes('order.php')) {
        
            window.print();
        }
    });
</script>
    <?php include 'components2/alert.php' ?>   
</body>
</html>