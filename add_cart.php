<?php

session_start();;
include 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
  if (!empty($_POST['room_type']) && !empty($_POST['room_price'])  && !empty($_POST['room_id']) && isset($_POST['room_avl'])) {

    $room_type = htmlspecialchars($_POST['room_type']);
    $room_price = htmlspecialchars($_POST['room_price']);
    $room_id = (int)$_POST['room_id'];
    $room_avl = (int)$_POST['room_avl'];
    $avl = ($room_avl === 0) ? "NO" : "YES";

    echo json_encode(
      [
        'status'=>'success',
        'message' => 'Room added succesfully!'
      ]
      );




  }
  else
  {

    echo json_encode(
      [
        'status'=>'error',
        'message' => 'Room not added succesfully!'
      ]
      );

  }


}













?>