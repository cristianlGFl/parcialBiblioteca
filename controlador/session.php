<?php
require '../modelo/configConexion.php';
$username = $_POST['username'];
$password = $_POST['password'];


// buscar el usuario en la base de datos
$sql = "SELECT * FROM usuarios WHERE email='$username'";
$resultado = mysqli_query($conn, $sql);


// verificar si el usuario existe y la contraseña es correcta
if (mysqli_num_rows($resultado) == 1) {
    $fila = mysqli_fetch_assoc($resultado);
    $ps = $fila['contrasena'];

    if ($password ==$ps ) {
        // inicio de sesión exitoso
        session_start();
        $_SESSION['nombre_usuario'] = $username;
        header("Location: ../vista/home.php"); // redirigir a la página de bienvenida
    } else {
        session_start();
        $_SESSION['nombre_usuario'] = $username;
        header("Location: index.php");
    }
} else {
    echo "Usuario no encontrado";
}


?>