<?php
// Establecer conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

$conn = mysqli_connect ($servername, $username, $password, $dbname);
?>

<?php
// Insertar datos en la base de datos
if(isset($_POST['enviar'])){
    $username = $_POST['user'];
    $contra = $_POST['password'];
    
    session_start();

    $sql = "SELECT id, contrasenia FROM usuarios WHERE user = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($contra === $row['contrasenia']) { // Comprobación de texto plano
                echo "Login exitoso";
                $_SESSION['user_id'] = $row['id'];
                header("Location: Perfil.html");
            } else {
                echo "Usuario o contraseña incorrectos";
            }
        } else {
            echo "Usuario no encontrado";
        }
    }

}

?>
