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
if(isset($_POST['Registro'])){
    $username = $_POST['user'];
    $email = $_POST['email'];
    $contra = $_POST['password'];
    $edad = $_POST['edad'];
    $nomr = $_POST['nomr'];

    $insertarDatos = $conn->query( "INSERT INTO usuarios ( user, edad,  nomr, email, contrasenia ) Values ('$username','$edad','$nomr','$email','$contra')");
    if($insertarDatos == true){
        echo "Datos Insertados Correctamente";
        header("Location: In.html");
    }
    else{
        echo "Error al insertar datos";
    }

}

?>
