<?php
session_start();

include 'db.php';


try {
    if (isset($_POST['roomtypes'], $_POST['roomprice'], $_POST['roomavl'])) {


      $avl = ($_POST['roomavl'] === 0) ? "NO":"YES";
        $sqlresults = "INSERT INTO rooms (room_type, price_per_night, availability,avl) VALUES (:room_type, :price_per_night, :availability, :avl)";
        $stmt = $conn->prepare($sqlresults);

        $stmt->bindParam(':room_type', $_POST['roomtypes'], PDO::PARAM_STR);
        $stmt->bindParam(':price_per_night', $_POST['roomprice'], PDO::PARAM_STR);
        $stmt->bindParam(':availability', $_POST['roomavl'], PDO::PARAM_INT);
        $stmt->bindParam(':avl', $avl, PDO::PARAM_STR);


        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Room details added successfully!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to add room details.'
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


