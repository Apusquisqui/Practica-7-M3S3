<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['eliminar']) && $_POST['eliminar'] === 'true') {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Preparar la consulta SQL para eliminar la cuenta
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            session_destroy(); // Destruir la sesión después de eliminar la cuenta
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No user logged in']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
