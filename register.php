<?php

session_start();

include 'db.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Management System</title>
  <link rel="stylesheet" href="css/style.css">
    <!-- Link to CSS -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Link to jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>

<header class="main-header">
<div><i class="fa-solid fa-store"></i></div>
<nav class="navbar">
  <ul>
  <li><a class="home" href="#home">Home</a></li>
  <li><a href="#register">Register</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>
  </nav>
</header>


<section class="content-main-hero">
  <div id="home" >
    <h2>Welcome To Inventory System</h2>
    <button class="scrollbutton">Explore</button>
  </div>
</section>



<section class="content-main">
  <div id="register" class="content">
    <h3>Register</h3>
    <?php if(isset($_SESSION['error'])): ?>
    <div class="error_message">
      <p><?php echo htmlspecialchars($_SESSION['error']);?></p>
    </div>
    <?php endif;?>
    <form action="register_auth.php" method="POST" class="form-main">
    <label for="username">Username:</label>
      <input id="email" class="input-main" type="email" name="email" placeholder="Enter your Email" required>
      
      <label for="name">Full Name:</label>
      <input id="name" class="input-main" type="text" name="name" placeholder="Enter your full name" required>
      
      <label for="phone">Phone Number:</label>
      <input id="phone" class="input-main" type="text" name="phone" placeholder="Enter your phone number" required>
      
      <label for="gender">Gender:</label>
      <select id="gender" class="input-main" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
      </select>
      
      <label for="role">Role:</label>
      <select id="role" class="input-main" name="role" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>
      
      <label for="password">Password:</label>
      <input id="password" class="input-main" type="password" name="password" placeholder="Enter your password" required>
      
      <label for="confirm-password">Confirm Password:</label>
      <input id="confirm-password" class="input-main" type="password" name="confirm-password" placeholder="Confirm your password" required>
      
      
      <button type="submit">Login</button>
    </form>
    
    <div class="new-options">
      <ul>
        <li>Already A user? <a href="login.php">Login!</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</section>

<section class="content-main">
  <div id="contact" class="content">
    <h3>Contact Us</h3>

    <p>Email: Inventory@InventorySystem.com</p>
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
<script src="css/script.js"></script>


</body>
</html>