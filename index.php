<?php

session_start();

include 'db.php';
$gallery = []; 

try {
    $sqlresults = "SELECT * FROM gallery";
    $resultgallery = $conn->query($sqlresults);

    if ($resultgallery->rowCount() > 0) {
        while ($row = $resultgallery->fetch(PDO::FETCH_ASSOC)) {
            $gallery[] = $row; 
        }
    }
} catch (PDOException $e) {
    die("Error fetching gallery data: " . $e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Management System</title>
  <link rel="stylesheet" href="css/style.css">
    <!-- Link to CSS -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  

  <!-- Link to jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>

<header class="main-header">
<nav class="navbar">
  <ul>
    <li><a href="#home">Home</a></li>
    <li><a href="#categories">Rooms</a></li>
    <li><a href="#about">About Us</a></li>
    <li><a href="#login">Login</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>
  </nav>
</header>


<section class="content-main-hero">
  <div id="home" >
    <h2>Welcome To Hotel Management System</h2>
    <?php if(isset($_SESSION['name'])):?>
    <p style="color: white; font-size :30px;"><?php echo htmlspecialchars($_SESSION['name']) ; ?></p>
    <?php  endif; ?>
    <button class="scrollbutton">Explore</button>
  </div>
</section>

<section class="content-main">
  <div id="categories" class="content">
    <h3>Search Rooms</h3>
    <div class="image-cont">
      <div class="container">
        <?php foreach($gallery as $images_link):?>
          <img class="images_container" src="<?php echo htmlspecialchars($images_link['g_link']) ?>">
        <?php endforeach;?>
      </div>
    </div>
    <?php if(isset($_SESSION['name'])):?>
    <button class="explore-btn"><a href="rooms.php"> Book Rooms</a></button>
    <?php endif; ?>
  </div>
</section>

<section class="content-main">
  <div id="about" class="content">
    <h3 class="abt">About Us</h3>
    <p>Your trusted partner in revolutionizing hotel management into a seamless, efficient, and guest-focused process. Our cutting-edge Hotel Management System is designed to empower hospitality businesses with the tools they need to optimize operations, enhance guest experiences, and drive growth in a competitive industry.
    </p>
    <h5>Our mission</h5>
    To provide a comprehensive hotel management solution that simplifies daily operations, improves resource utilization, and enhances guest satisfaction, enabling hotels to focus on creating memorable stays for their guests.
  </div>
</section>

<section class="content-main">
  <div id="login" class="content">
    <h3>Login</h3>
    <form action="login_auth.php" method="POST" class="form-main">
      <label for="email">Username:</label>
      <input id="email" class="input-main" type="text" name="email" placeholder="Enter your username" required>
      
      <label for="password">Password:</label>
      <input id="password" class="input-main" type="password" name="password" placeholder="Enter your password" required>
      
      <button type="submit">Login</button>
    </form>
    
    <div class="new-options">
      <ul>
        <li>Not a User? <a href="register.php">Register!</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</section>

<section class="content-main">
  <div id="contact" class="content">
    <h3>Contact Us</h3>

    <p>Email: Hotelmanagementsystem@in.com</p>
  

    <label for="phone">
  <i class="fas fa-phone-alt"><p>+91 9988766765</p></i> 
    </label>

    <div class="social-icons">
      <a href="https://twitter.com" target="_blank">
          <i class="fab fa-twitter"></i> Twitter
      </a>
      <a href="https://facebook.com" target="_blank">
          <i class="fab fa-facebook-f"></i> Facebook
      </a>
      <a href="https://instagram.com" target="_blank">
          <i class="fab fa-instagram"></i> Instagram
      </a>


  </div>
  



  </div>
</section> 

<footer style="background-color: #333; color: #fff; padding: 20px; text-align: center; font-size: 14px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <p>&copy; <?php echo date('Y'); ?> Hotel Management System. All Rights Reserved.</p>

        <div style="margin: 10px 0;">
            <a href="/about-us" style="color: #ddd; text-decoration: none; margin: 0 10px;">About Us</a> |
            <a href="/contact" style="color: #ddd; text-decoration: none; margin: 0 10px;">Contact</a> |
            <a href="/privacy-policy" style="color: #ddd; text-decoration: none; margin: 0 10px;">Privacy Policy</a>
        </div>

      

        <p style="margin-top: 10px;">For technical support, email us at <a href="mailto:support@inventorysystem.com" style="color: #4CAF50; text-decoration: none;">support@hotelsystem.com</a></p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>


</body>
</html>