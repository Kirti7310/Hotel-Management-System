<?php

session_start();
include 'db.php';


$sqluser = "select role from users where username = :email";
$sqlresults = $conn->prepare($sqluser);
$sqlresults->bindParam(':email',$_SESSION['email'],PDO::PARAM_STR);
$sqlresults->execute();



if($sqlresults->rowCount() > 0)
{
  while($row=$sqlresults->fetch(PDO::FETCH_ASSOC))
  {
    if($row['role'] === "user")
    {
      $user = "user";
    }
    else
    {
      $user = "admin";
    }
  }
}

$images =[];
$sqlimg = "select * from slider_img ";
$sqlimg=$conn->query($sqlimg);

if($sqlimg->rowCount()>0)
{
  while($row=$sqlimg->fetch(PDO::FETCH_ASSOC))
  {
      $images [] = $row;
  }
}


$hotelrooms =[];
$sqlimg = "select * from room_types";
$sqlimg=$conn->query($sqlimg);

if($sqlimg->rowCount()>0)
{
  while($row=$sqlimg->fetch(PDO::FETCH_ASSOC))
  {
      $hotelrooms [] = $row;
  }
}


$rooms =[];
$sqlimg = "select * from rooms";
$sqlimg=$conn->query($sqlimg);

if($sqlimg->rowCount()>0)
{
  while($row=$sqlimg->fetch(PDO::FETCH_ASSOC))
  {
      $rooms [] = $row;
  }
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rooms</title>

  <link rel="stylesheet" href="css/style.css">
    <!-- Link to CSS -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Confirm CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">

<!-- jQuery Confirm JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>


<script src="js/script.js"></script>


<script>
$(document).ready(function()
{



  $('a').on('click',function(e)
{
  if(this.hash != '')
  {
    e.preventDefault();
    const hash = this.hash;
    console.log(hash);
    $('html,body').animate(
      {
        scrollTop:$(hash).offset().top-50
      },800);
      
  }
});


$('.scrollbutton').on('click',function(e)
{
  console.log("kirti");
})



$('.scrollbutton').on('click',function(e)
{
  console.log("kirti");
  e.preventDefault();
  $('html,body').animate(
    {
      scrollTop:$('#categories').offset().top-50
    },800
  );
});


$('.home').on("click", function(e) {
  e.preventDefault();  
  window.location.href = 'index.php'; 
});


$('.home-page-class').on('click',function()
{
  window.location.href = 'index.php';
});



$('.addrooms-btn').on('click', function (e) {
    e.preventDefault();


    console.log("kirti");
    let roomtypes = $('.select-rooms').val();
    let roomprice = $('#room_price').val();
    let roomavl = $('#room_avl').val();

    if (!roomtypes || !roomprice || roomavl === null) {
        alert('Please fill in all fields.');
        return;
    }

    $.ajax({
        url: "add_rooms.php",
        method: "POST",
        dataType: "json",
        data: {
            roomtypes: roomtypes,
            roomprice: roomprice,
            roomavl: roomavl
        },
        success: function (response) {
            if (response.status === 'success') {
                $.alert({
                    title: 'Success!',
                    content: "Rooms added successfully!",
                    type: 'green',
                    buttons: {
                        ok: {
                            text: 'OK',
                            btnClass: 'btn-green',
                            action: function () {
                                console.log("Rooms added successfully.");
                                location.reload(); 
                            }
                        }
                    }
                });
            } else {
                $.alert({
                    title: 'Error!',
                    content: response.message,
                    type: 'red',
                    buttons: {
                        ok: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
            }
        },
        error: function () {
            $.alert({
                title: 'Error!',
                content: "An error occurred while processing your request.",
                type: 'red',
                buttons: {
                    ok: {
                        text: 'OK',
                        btnClass: 'btn-red'
                    }
                }
            });
        }
    });
});




$('.rooms-btn-upd').on("click", function (e) {
    e.preventDefault();

    
    const formData = $(this).closest('.room-form').serialize();
      console.log(formData);

    $.ajax({
        url: "update_rooms.php",
        method: "POST", 
        data: formData, 
        dataType: "json",
        success: function (response) {
            if (response.status === 'success') {
                $.alert({
                    title: 'Success!',
                    content: response.message,
                    type: 'green',
                    buttons: {
                        ok: {
                            text: 'OK',
                            btnClass: 'btn-green',
                            action: function () {
                                console.log("Rooms updated successfully.");
                                location.reload();
                            }
                        }
                    }
                });
            } else {
                $.alert({
                    title: 'Error!',
                    content: response.message,
                    type: 'red',
                    buttons: {
                        ok: {
                            text: 'OK',
                            btnClass: 'btn-red'
                        }
                    }
                });
            }
        },
        error: function () {
            $.alert({
                title: 'Error!',
                content: "An error occurred while processing your request.",
                type: 'red',
                buttons: {
                    ok: {
                        text: 'OK',
                        btnClass: 'btn-red'
                    }
                }
            });
        }
    });
});








$('.delete-btn').on("click",function(e)
{

  e.preventDefault();

const formData = $(this).closest('.room-delete-form').serialize();
console.log(formData);


$.ajax({
    url: "delete_rooms.php",
    method: "POST",
    dataType: "json",
    data:formData,
    success: function (response) {
        if (response.status === 'success') {
            $.alert({
                title: 'Success!',
                content: "Rooms Deleted successfully!",
                type: 'green',
                buttons: {
                    ok: {
                        text: 'OK',
                        btnClass: 'btn-green',
                        action: function () {
                            console.log("Rooms Deleted successfully.");
                            location.reload(); 
                        }
                    }
                }
            });
        } else {
            $.alert({
                title: 'Error!',
                content: response.message,
                type: 'red',
                buttons: {
                    ok: {
                        text: 'OK',
                        btnClass: 'btn-red'
                    }
                }
            });
        }
    },
    error: function () {
        $.alert({
            title: 'Error!',
            content: "An error occurred while processing your request.",
            type: 'red',
            buttons: {
                ok: {
                    text: 'OK',
                    btnClass: 'btn-red'
                }
            }
        });
    }

});
}); 




$('.add-btn').on('click',function(e)
{

   e.preventDefault();
  const formData = $(this).closest('.room-form').serialize();
  const typee = 1;
  console.log(formData);
  console.log(typee);

  $.ajax(
    {
      url:'add_cart.php',
      method:'POST',
      dataType:'json',
      data:formData,
      success:function(response)
      {
        console.log(response);
        if(response.status === 'success')
      {
        $.alert(
          {
            title:'Added',
            content:"Room is booked successfully!",
            type:'green',
            buttons:
            {
              ok:
              {
                text: 'OK',
                        btnClass: 'btn-green',
                        action: function () {
                            console.log("Rooms Deleted successfully.");
                            location.reload(); 
                        }
              }
            }
          }
        )
      }
      else
      {
       
            $.alert({
                title: 'Error!',
                content: response.message,
                type: 'red',
                buttons: {
                    ok: {
                        text: 'OK',
                        btnClass: 'btn-red'
                    }
                }
            });
        
      }
      },
      error:function()
      {
        $.alert(
          {
            title:'Error!',
            content:"An error occurred while processing your request.",
            type:'red',
            buttons:{
              ok:{
                text:'OK',
                btnClass:'btn-red'
              }
            }

          }
        )
      }


    });







});

$('.subtract-btn').on('click',function(e)
{

e.preventDefault();
const formData = $(this).closest('.room-form').serialize();
const typee = 2;
console.log(formData);

$.ajax(
 {

   url:'cancel_cart.php',
   method:'POST',
   dataType:'json',
   data:formData,
   success:function(response)
   {
     console.log(response);
     if(response.status === 'success')
   {
     $.alert(
       {
         title:'Cancel',
         content:"Room is cancelled successfully!",
         type:'green',
         buttons:
         {
           ok:
           {
             text: 'OK',
                     btnClass: 'btn-green',
                     action: function () {
                         console.log("Rooms Deleted successfully.");
                         location.reload(); 
                     }
           }
         }
       }
     )
   }
   else
   {
    
         $.alert({
             title: 'Error!',
             content: response.message,
             type: 'red',
             buttons: {
                 ok: {
                     text: 'OK',
                     btnClass: 'btn-red'
                 }
             }
         });
     
   }
   },
   error:function()
   {
     $.alert(
       {
         title:'Error!',
         content:"An error occurred while processing your request.",
         type:'red',
         buttons:{
           ok:{
             text:'OK',
             btnClass:'btn-red'
           }
         }

       }
     )
   }


 });







});


});



</script>


</head>
<body>

<header class="main-header">
<nav class="navbar">
  <ul>
    <li><a href="#home1">Gallery</a></li>
    <li><a href="#rooms">Rooms</a></li>
    <li><a href="#home2">Home</a></li>
  </ul>
  </nav>
</header>

<section>
  <div class="rooms-container" id="home1">
  <?php foreach($images as $img):?>
    <div class="container-r">
      <img class="images"  src="<?php echo htmlspecialchars($img['i_link']) ?>">
      <div class="img-container">
        <p><?php echo htmlspecialchars($img['i_name']); ?></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<div class="info-container" id="rooms">
<?php if(empty($rooms)):?>
<p> Add Room</p>
<?php else:?>
  <p> Rooms</p>
  <?php endif;?>
  <div class="main-info">
    <?php if($user === "admin"):?>

     <?php if(empty($rooms)):?>
    
      <form class="room-form">

      <div class="form-group">
      <label for="room_type">Room Type</label>  
      <select class="select-rooms">
        <option value="" >Choose your Room Type</option>
        <?php foreach($hotelrooms as $hotels):?>
          <option value="<?php echo htmlspecialchars($hotels['room_type']); ?>">
            <?php echo htmlspecialchars($hotels
            ['room_type']);?>
          </option> 
          <?php endforeach;?>
      </select>
      </div>
     

      <div class="form-group">
      <label for="room_price">Room Price</label>  
      <input type="text" name="room_price" id="room_price" required >
      </div>

      <div class="form-group">
  <label for="room_availblity">Room Availability</label>
  <select name="room_avl" id="room_avl" required>
    <option value="1">YES</option>
    <option value="0">NO</option>
  </select>
</div>

      <div class="form-group">
          <button class="addrooms-btn">Submit</button>
        </div>
       
      </form>
      <?php endif;?>


      <?php if(!empty($rooms)): ?>

<?php foreach($rooms as $room):?>
  <form class="room-form" id="update-room-form" method="POST" action="update_rooms.php">

        <div class="form-group">
                <label for="room_type">Room Type</label>
                <select class="update-rooms" name="room_type" required>
                    <option value="">Choose your Room Type</option>
                    <?php foreach ($hotelrooms as $hotels): ?>
                        <option  value="<?php echo htmlspecialchars($hotels['room_type']);  ?>" 
                            <?php echo $room['room_type'] === $hotels['room_type'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($hotels['room_type']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

<input type="hidden" id="room_id_up" name="room_id" value="<?php echo htmlspecialchars($room['id']);?>">


<div class="form-group">
<label for="room_price">Room Price</label>  
<input type="text" name="room_price" id="select-rooms_up_pr" 
                       value="<?php echo htmlspecialchars($room['price_per_night']); ?>" required>
                      </div>

<div class="form-group">
<label for="room_availblity">Room Availability</label>
<select name="room_avl" id="room_avl_up" required>
<option value="1" <?php echo $room['availability'] == 1 ? 'selected' : ''; ?>>YES</option>
        <option value="0" <?php echo $room['availability'] == 0 ? 'selected' : ''; ?>>NO</option>
</select>
</div>



<div class="form-group">
    <button  type="submit" class="rooms-btn-upd" style="background-color :grey;">Update</button>
  </div>
</form>

<form class="room-delete-form" method="POST" action="delete_rooms.php">
    <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room['id']); ?>">
    <button type="submit" class="delete-btn">Delete</button>
</form>


    <?php endforeach;?>

</form>
<div>
<div class="form-group-add">
  <p style="text-align: center;">Add Room </p>
  <form class="room-form">

<div class="form-group">
<label for="room_type">Room Type</label>  
<select class="select-rooms">
  <option value="" >Choose your Room Type</option>
  <?php foreach($hotelrooms as $hotels):?>
    <option value="<?php echo htmlspecialchars($hotels['room_type']); ?>">
      <?php echo htmlspecialchars($hotels
      ['room_type']);?>
    </option> 
    <?php endforeach;?>
</select>
</div>


<div class="form-group">
<label for="room_price">Room Price</label>  
<input type="text" name="room_price" id="room_price" required >
</div>

<div class="form-group">
<label for="room_availblity">Room Availability</label>
<select name="room_avl" id="room_avl" required>
<option value="1">YES</option>
<option value="0">NO</option>
</select>
</div>

<div class="form-group">
    <button class="addrooms-btn">Submit</button>
  </div>
 
</form>
  </div>


</div>
<?php endif;?>

      <?php else: ?>

        <?php foreach($rooms as $room):?>
  <form class="room-form" id="update-room-form" method="POST" action="update_rooms.php">

        <div class="form-group">
                <label for="room_type">Room Type</label>
                <select class="update-rooms" name="room_type" required>
                    <option value="">Choose your Room Type</option>
                    <?php foreach ($hotelrooms as $hotels): ?>
                        <option  value="<?php echo htmlspecialchars($hotels['room_type']);  ?>" 
                            <?php echo $room['room_type'] === $hotels['room_type'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($hotels['room_type']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

<input type="hidden" id="room_id_up" name="room_id" value="<?php echo htmlspecialchars($room['id']);?>">


<div class="form-group">
<label for="room_price">Room Price</label>  
<input type="text" name="room_price" id="select-rooms_up_pr" 
                       value="<?php echo htmlspecialchars($room['price_per_night']); ?>" required>
                      </div>

<div class="form-group">
<label for="room_availblity">Room Availability</label>
<select name="room_avl" id="room_avl_up" required>
<option value="1" <?php echo $room['availability'] == 1 ? 'selected' : ''; ?>>YES</option>
        <option value="0" <?php echo $room['availability'] == 0 ? 'selected' : ''; ?>>NO</option>
</select>
<button class="add-btn"   type="submit" name="add_cart"  style="border : 1px solid black"><i class="fa-solid fa-plus"></i></button>
<button  class="subtract-btn"  type="submit" name="add_cart" style="border : 1px solid black" ><i class="fa-solid fa-minus"></i></button>
</div>
</form>
<?php endforeach;?>
        <?php endif ?>
  </div>
</div>



<div id="home2" class="home2">
  <div class="back-homepage">
    <a href="index.php"><button>Back To homepage</button></a>
  </div>

</div>


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





  
</body>
</html>