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
    <title>Green Coffee - About Us Page</title>
</head>
<body>
    <?php include 'components2/header.php' ?>  
    <div class="main">
        <div class="banner">
            <h1>About Us</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home</a><span>/ About</span>
        </div>
        <div class="about-category">
             <div class="box"> 
                 <img src="img/3.webp">
                 <div class="detail">
                    <span>Coffee</span>
                    <h1>Lemon Green</h1>
                    <a href="view_products.php" class="btn">Shop Now</a>
                 </div>   
             </div> 
             <div class="box"> 
                 <img src="img/2.webp">
                 <div class="detail">
                    <span>Coffee</span>
                    <h1>Lemon Green</h1>
                    <a href="view_products.php" class="btn">Shop Now</a>
                 </div>   
             </div> 
             <div class="box"> 
                 <img src="img/about.png">
                 <div class="detail">
                    <span>Coffee</span>
                    <h1>Lemon Teaname</h1>
                    <a href="view_products.php" class="btn">Shop Now</a>
                 </div>   
             </div> 
             <div class="box"> 
                 <img src="img/1.webp">
                 <div class="detail">
                    <span>Coffee</span>
                    <h1>Lemon Green</h1>
                    <a href="view_products.php" class="btn">Shop Now</a>
                 </div>   
             </div>   
        </div>
        <section class="services"> 
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>Why Choose Us</h1>
                <p>Experience unparalleled quality and service tailored to your needs, ensuring satisfaction at every step of your journey with us.</p>
            </div>
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
         <div class="about">
            <div class="row">
                <div class="img-box">
                    <img src="img/3.png">
                </div>
                <div class="detail">
                    <h1>Visit Our Beautiful Showroom!</h1>
                    <p>Our showroom is an expression of what we love doing: being creative with floral and plant
                        arrangements.
                        Whether you are looking for a florist for your perfect wedding, or just want to uplift
                        any room
                        with
                        some one of a kind living decor, Blossom with Love can help.
                    </p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
            </div>
         </div>
        <div class="testimonial-container">
            <div class="title">
                <img src="img/download.png" class="logo">
                <h1>What People Say About Us</h1>
                <p>Discover why our customers rave about us – real testimonials, real satisfaction, and real experiences that speak volumes about our commitment to excellence.</p>
                </div>
                <div class="container">
                    <div class="testimonial-item active">
                        <img src="img/01.jpg">
                        <h1>Emily</h1>
                        <p>I've been a loyal customer of Green Tea for years now, and I can't speak highly enough about their exceptional service and top-notch products. Every order is promptly delivered, and the quality of their items surpasses expectations every time. Whether it's their extensive tea selection or their delicious gourmet beans, I always know I'm getting the best when I shop here.</p>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/02.jpg">
                        <h1>Michael</h1>
                        <p>As a tea enthusiast, I'm always on the lookout for unique blends and superior quality, and I found just that at Green Tea. Their Healthy Tea collection is a game-changer, offering a variety of flavors that cater to my every mood. Plus, their customer service is fantastic – they're always ready to answer my questions and offer recommendations. I've recommended this shop to all my tea-loving friends!.</p>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/03.jpg">
                        <h1>Sophia</h1>
                        <p>I stumbled upon Green Tea during a search for affordable yet high-quality green coffee, and I'm so glad I did. Not only did I find exactly what I was looking for, but the prices were unbeatable, especially with their ongoing discounts. The green ice coffee was a delightful surprise – refreshing and delicious, perfect for those hot summer days. I'll definitely be coming back for more, and I highly recommend this shop to anyone looking for great deals without compromising on taste.</p>
                    </div>
                    <div class="left-arrow" onclick="nextSlide()"><i class="bx bxs-left-arrow-alt"></i></div>
                    <div class="right-arrow" onclick="prevSlide()"><i class="bx bxs-right-arrow-alt"></i></div>
                </div>
        </div>
         <?php include 'components2/footer.php' ?> 
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <script>
    const header = document.querySelector('header');
function fixedNavbar(){
    header.classList.toggle('scroll', window.pageYOffset > 0)
}
fixedNavbar();
window.addEventListener('scroll', fixedNavbar);

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

menu.addEventListener('click', function(){
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');
})
userBtn.addEventListener('click', function(){
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
})
/*-------testimonial slider-----*/
let slides = document.querySelectorAll('.testimonial-item');
let index = 0;

function nextSlide(){
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
}

function prevSlide(){
    slides[index].classList.remove('active');
    index = (index - 1 + slides.length) % slides.length;
    slides[index].classList.add('active');
}

   </script>
    <?php include 'components2/alert.php' ?>   
</body>
</html>