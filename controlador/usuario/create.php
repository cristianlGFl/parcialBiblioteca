<?php
// Include config file
require_once "../../modelo/configConexion.php";
$nombre_usuario = $email = $contrasena =  $tipo = "";
$nombre_usuario_err = $email_err = $contrasena_err = $tipo_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_nombre_usuario = trim($_POST["nombre_usuario"]);
    if (empty($input_nombre_usuario)) {
        $nombre_usuario_err = "Digitar nombre de usuario";
    } elseif (!filter_var($input_nombre_usuario, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombre_usuario_err = "Validar nombre digitado";
    } else {
        $nombre_usuario = $input_nombre_usuario;
    }

    // Validate address
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Digitar email";
    } else {
        $email = $input_email;
    }

    // Validate salary
    $input_contrasena = trim($_POST["contrasena"]);
    if (empty($input_contrasena)) {
        $contrasena_err = "Digitar la contraseña";
    } else {
        $contrasena = $input_contrasena;
    }

    $input_tipo = trim($_POST["tipo"]);
    if (empty($input_tipo)) {
        $tipo_err = "Seleccionar el tipo de usuario";
    } else {
        $tipo = $input_tipo;
    }

    // Check input errors before inserting in database
    if (empty($nombre_usuario_err) && empty($email_err) && empty($contrasena_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO usuarios (nombre_usuario, email, contrasena,tipo) VALUES (?, ?, ?, ?)";
        global $link;
        global $stmt;
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            // Bind variables to the prepared statement as parameters
             mysqli_stmt_bind_param($stmt, "ssss", $param_nombre_usuario, $param_email, $param_contrasena, $param_tipo);

            // Set parameters
            $param_nombre_usuario = $nombre_usuario;
            $param_email = $email;
            $param_contrasena = $contrasena;
            $param_tipo = $tipo;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: ../vista/bienvenidoUsuario.php");
                exit();
            } else {
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
            $stmt->close();
        }

    }
    $conn->close();

    
}
?>