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
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Green Coffee - Contact Page</title>
</head>
<body>
    <?php include 'components2/header.php' ?>  
    <div class="main">
     <div class="banner">
        <h1>Contact Us</h1>
     </div>
     <div class="title2">
        <a href="home.php">Home</a><span>/ Contact Us</span>
     </div>
     <section class="services"> 
            <div class="box-container">
                <div class="box">
                    <img src="img/icon2.png">
                    <div class="detail">
                        <h1>Great Savings</h1>
                        <p>Save Big Every Order</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/icon1.png">
                    <div class="detail">
                        <h1>24*7 Support</h1>
                        <p>One-On-One Support</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/icon0.png">
                    <div class="detail">
                        <h1>Gift Vouchers</h1>
                        <p>Vouchers On Every Festivals</p>
                    </div>
                </div>
                <div class="box">
                    <img src="img/icon.png">
                    <div class="detail">
                        <h1>Worldwide Delivery</h1>
                        <p>Dropship Worldwide</p>
                    </div>
                </div>
            </div>
         </section>
         <div class="form-container">
            <form method="post">
                <div class="title">
                    <img src="img/download.png" class="logo">
                    <h1>Leave A Message</h1>
                </div>
                <div class="input-field">
                    <p>Your Name <sup>*</sup></p>
                    <input type="text" name="name">
                </div>
                <div class="input-field">
                    <p>Your Email <sup>*</sup></p>
                    <input type="text" name="email">
                </div>
                <div class="input-field">
                    <p>Your Number <sup>*</sup></p>
                    <input type="text" name="number">
                </div>
                <div class="input-field">
                    <p>Your Message <sup>*</sup></p>
                    <textarea name="message"></textarea>
                </div>
                <button type="submit" name="submit-btn" class="btn">Send Message</button>
            </form>
         </div>
         <div class="address">
            <div class="title">
                    <img src="img/download.png" class="logo">
                    <h1>Contact Detail</h1>
                    <p>Get in touch with us for any inquiries or support; our dedicated team is here to help you with all your needs.</p>
                </div>
                <div class="box-container">
                    <div class="box">
                        <i class="bx bxs-map-pin"></i>
                        <div>
                            <h4>Address</h4>
                            <p>603 Alaba Street North Pob, Medina</p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="bx bxs-phone-call"></i>
                        <div>
                            <h4>Phone Number</h4>
                            <p>09276128186</p>
                        </div>
                    </div>
                    <div class="box">
                        <i class="bx bxs-map-pin"></i>
                        <div>
                            <h4>Email</h4>
                            <p>shervals23@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
         <?php include 'components2/footer.php' ?> 
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script> 
    <?php include 'components2/alert.php' ?>   
</body>
</html>