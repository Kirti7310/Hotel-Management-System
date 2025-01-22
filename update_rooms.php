<?php
session_start();
include 'db.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['room_type']) && !empty($_POST['room_price']) && !empty($_POST['room_id']) && isset($_POST['room_avl'])) {
            
            $room_type = htmlspecialchars($_POST['room_type']);
            $room_price = htmlspecialchars($_POST['room_price']);
            $room_id = (int)$_POST['room_id'];
            $room_avl = (int)$_POST['room_avl'];
            $avl = ($room_avl === 0) ? "NO" : "YES";

            $sql = "UPDATE rooms SET room_type = :room_type, price_per_night = :price_per_night, availability = :availability, avl = :avl WHERE id = :roomid";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':room_type', $room_type, PDO::PARAM_STR);
            $stmt->bindParam(':price_per_night', $room_price, PDO::PARAM_STR);
            $stmt->bindParam(':availability', $room_avl, PDO::PARAM_INT);
            $stmt->bindParam(':avl', $avl, PDO::PARAM_STR);
            $stmt->bindParam(':roomid', $room_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Room details updated successfully!'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to update room details.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid input. All fields are required.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid request method.'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
