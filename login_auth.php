<?php
session_start();

include 'db.php';

if (
    isset($_POST['email']) &&
    isset($_POST['password']) 
) {
    

  

      $sqllogin = 'SELECT * FROM users where username = :email ';
      $sqlresults  = $conn->prepare($sqllogin);
      $sqlresults->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
      $sqlresults->execute();

      if($sqlresults->rowCount() >0)
      {
        while($row = $sqlresults->fetch(PDO::FETCH_ASSOC))
        {
            if(password_verify($_POST['password'],$row['password']))
            {

              $_SESSION['name'] = $row['full_name'];
              $_SESSION['email'] = $row['username'];

              header('Location:index.php');
              exit();
            }
            else
            {
              $_SESSION['error'] = "Password Dosen't Match!";
              header('Location:login.php');
              exit();
            }
      }


    }

       else {


        $_SESSION['error'] = "User Not Found!";
        header('Location:login.php');
        exit();
       
    }
}
else
{

  $_SESSION['error'] = "Please fill in all the required fields!";
    header('Location: login.php');
    exit();
}
?>
