<?php

$host = "localhost"; // servidor MySQL
$username = "root"; // usuario de MySQL
$password = ""; // contraseña de MySQL
$dbname = "parcialbiblioteca"; // nombre de la base de datos

// conectar a la base de datos
$conn = mysqli_connect($host, $username, $password, $dbname);

// verificar si la conexión es exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}



?>