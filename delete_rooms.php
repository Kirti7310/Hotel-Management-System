<?php
session_start();

include 'db.php';


try {
    if (isset($_POST['room_id'])) {


      $roomid = $_POST['room_id'];
      $sqlresults = "DELETE from rooms where id = :roomid";
        $stmt = $conn->prepare($sqlresults);

        $stmt->bindParam(':roomid', $roomid, PDO::PARAM_INT);


        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Room details Deleted successfully!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to Deleted room details.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid input. All fields are required.'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>


