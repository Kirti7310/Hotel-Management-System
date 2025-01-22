<?php
session_start();

include 'db.php';

if (
    isset($_POST['email']) &&
    isset($_POST['name']) &&
    isset($_POST['phone']) &&
    isset($_POST['gender']) &&
    isset($_POST['role']) &&
    isset($_POST['password']) &&
    isset($_POST['confirm-password'])
) {
    if ($_POST['password'] === $_POST['confirm-password']) {

      $digits = '/[0-9]/';
      $alphabets = '/[A-Z]/';
      $salphabets = '/[a-z]/';


      if(preg_match($digits,$_POST['password']))

      {
        if(preg_match($alphabets,$_POST['password']))

        {

          if(preg_match($salphabets,$_POST['password']))

          {

        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sqlinsertuser = 'INSERT INTO users (username, password, role, full_name, gender, phone) 
                  VALUES (:email, :password, :role, :full_name, :gender, :phone)';
        
        $sqlresults  = $conn->prepare($sqlinsertuser);

        $sqlresults->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
        $sqlresults->bindParam(':password',$hashedPassword,PDO::PARAM_STR);
        $sqlresults->bindParam(':role',$_POST['role'],PDO::PARAM_STR);
        $sqlresults->bindParam(':full_name',$_POST['name'],PDO::PARAM_STR);
        $sqlresults->bindParam(':gender',$_POST['gender'],PDO::PARAM_STR);
        $sqlresults->bindParam(':phone',$_POST['phone'],PDO::PARAM_INT);
   

        $sqlresults->execute();

        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        header("Location:index.php");
        exit();

          }

          $_SESSION['error'] = "Password Should Contain atleast 1 small Alphabet";
          header('Location:register.php');
          exit();


        }

        $_SESSION['error'] = "Password Should Contain atleast 1 Capital Alphabet";
        header('Location:register.php');
        exit();

      }
      else
      {
        $_SESSION['error'] = "Password Should Contain atleast 1 digit";
        header('Location:register.php');
        exit();
      }
      
      } else {

        $_SESSION['error'] = "Password & Confirm Password  Dosen't Match!";
        header('Location:register.php');
        exit();
       
    }
}
else
{
  $_SESSION['error'] = "Please fill in all the required fields!";
    header('Location: register.php');
    exit();
}
?>
