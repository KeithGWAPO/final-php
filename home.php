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
    <title>Green Coffee - Home Page</title>
</head>
<body>
    <?php include 'components2/header.php' ?>  
    <div class="main">
        <section class="home-section">
            <div class="slider">
                <div class="slider__slider slide1">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Discover the Serenity of Green Tea</h1>
                        <p>Nature's Perfect Brew</p>
                        <a href="view_products.php" class="btn">Shop Now</a>   
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!-- slide end -->
                <div class="slider__slider slide2">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Elevate Your Wellness</h1>
                        <p>Premium Green Tea Blends</p>
                        <a href="view_products.php" class="btn">Shop Now</a>   
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!-- slide end -->
                <div class="slider__slider slide3">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Experience the Pure Essence of Green Tea</h1>
                        <p>Freshness in Every Sip</p>
                        <a href="view_products.php" class="btn">Shop Now</a>   
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!-- slide end -->
                <div class="slider__slider slide4">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Revitalize Your Day</h1>
                        <p> the Finest Green Tea Selections</p>
                        <a href="view_products.php" class="btn">Shop Now</a>   
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!-- slide end -->
                <div class="slider__slider slide1">
                    <div class="overlay"></div>
                    <div class="slide-detail">
                        <h1>Unveil the Secrets of Green Tea</h1>
                        <p>Health, Flavor, and Tradition</p>
                        <a href="view_products.php" class="btn">Shop Now</a>   
                    </div>
                    <div class="hero-dec-top"></div>
                    <div class="hero-dec-bottom"></div>
                </div>
                <!-- slide end -->
            <div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
            <div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>
            </div>
        </section>
         <!-- home slider end -->
         <section class="thumb">
            <div class="box-container">
                <div class="box">
                    <img src="img/thumb2.jpg">
                    <h3>Green Coffee</h3>
                    <p>Discover the health benefits and mild, fresh flavor of our premium Green Coffee, made from unroasted beans rich in antioxidants.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="box">
                    <img src="img/thumb0.jpg">
                    <h3>Green Ice Coffee</h3>
                    <p>Refresh yourself with our invigorating Green Ice Coffee, blending the subtle taste of green coffee beans with a cool, crisp chill</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="box">
                    <img src="img/thumb1.jpg">
                    <h3>Bread</h3>
                    <p>Enjoy the warm, homemade goodness of our Artisan Bread, crafted with the finest ingredients for a perfect blend of crusty exterior and soft interior.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="box">
                    <img src="img/thumb.jpg">
                    <h3>Beans</h3>
                    <p>Elevate your dishes with our Gourmet Beans, offering rich, hearty flavors and essential nutrients for a versatile culinary addition.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
            </div>
         </section>
         <section class="container">
            <div class="box-container">
                <div class="box">
                    <img src="img/about-us.jpg">
                </div>
                <div class="box">
                    <img src="img/download.png">
                    <span>Healthy Tea</span>
                    <h1>Save Up To 50% Off</h1>
                    <p>Discover the wellness benefits of our premium Healthy</p>
                    <p>Tea collection, now up to 50% off, and enjoy</p>
                    <p>antioxidant-rich blends perfect for supporting your</p>
                    <p>health and relaxation needs.</p>
                </div>
            </div>
         </section>
         <section class="shop">
            <div class="tittle">
                <img src="img/download.png">
                <h1>Trending Products</h1>
            </div>
            <div class="row">
                <img src="img/about.jpg">
                <div class="row-detail">
                    <img src="img/basil.jpg">
                    <div class="top-footer">
                        <h1>A Cup Of Green Tea Makes You Healthy</h1>
                    </div>
                </div>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="img/card.jpg">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
                <div class="box">
                    <img src="img/card0.jpg">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
                <div class="box">
                    <img src="img/card1.jpg">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
                <div class="box">
                    <img src="img/card2.jpg">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
                <div class="box">
                    <img src="img/10.jpg">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
                <div class="box">
                    <img src="img/6.webp">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
            </div>
         </section>
         <section class="shop-category">
            <div class="box-container">
                <div class="box">
                    <img src="img/6.jpg">
                    <div class="detail">
                        <span>BIG OFFERS</span>
                        <h1>Extra 15% Off</h1>
                        <a href="view_products.php" class="btn">Shop Now</a>
                    </div>
                </div>
                <div class="box">
                    <img src="img/7.jpg">
                    <div class="detail">
                        <span>New In Taste</span>
                        <h1>Coffee House</h1>
                        <a href="view_products.php" class="btn">Shop Now</a>
                    </div>
                </div>
            </div>
         </section>
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
         <section class="brand">
            <div class="box-container">
                <div class="box">
                    <img src="img/brand (1).jpg">
                </div>
                <div class="box">
                    <img src="img/brand (2).jpg">
                </div>
                <div class="box">
                    <img src="img/brand (3).jpg">
                </div>
                <div class="box">
                    <img src="img/brand (4).jpg">
                </div>
                <div class="box">
                    <img src="img/brand (5).jpg">
                </div>
            </div>
         </section>
         <?php include 'components2/footer.php' ?> 
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script> 
    <?php include 'components2/alert.php' ?>   
</body>
</html>