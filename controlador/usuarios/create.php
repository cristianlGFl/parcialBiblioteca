<?php
// Include config file
require_once "../../modelo/configConexion.php";
$nombre_autor = $nacionalidad = $cedula = "";
$nombre_autor_err = $nacionalidad_err = $cedula_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_nombre_autor = trim($_POST["nombre_autor"]);
    if (empty($input_nombre_autor)) {
        $nombre_autor_err = "Digitar nombre de autor";
    } elseif (!filter_var($input_nombre_autor, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombre_autor_err = "Validar nombre digitado";
    } else {
        $nombre_autor = $input_nombre_autor;
    }

    // Validate address
    $input_nacionalidad = trim($_POST["nacionalidad"]);
    if (empty($input_nacionalidad)) {
        $nacionalidad_err = "Digitar nacionalidad";
    } else {
        $nacionalidad = $input_nacionalidad;
    }

    // Validate salary
    $input_cedula = trim($_POST["cedula"]);
    if (empty($input_cedula)) {
        $cedula_err = "Digitar la cedula";
    } elseif (!ctype_digit($input_cedula)) {
        $cedula_err = "Valor numerico de la cedula";
    } else {
        $cedula = $input_cedula;
    }

    // Check input errors before inserting in database
    if (empty($nombre_autor_err) && empty($nacionalidad_err) && empty($cedula_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO autor (nombre_autor, nacionalidad, cedula) VALUES (?, ?, ?)";
        global $link;
        global $stmt;
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            // Bind variables to the prepared statement as parameters
             mysqli_stmt_bind_param($stmt, "sss", $param_nombre_autor, $param_nacionalidad, $param_cedula);

            // Set parameters
            $param_nombre_autor = $nombre_autor;
            $param_nacionalidad = $nacionalidad;
            $param_cedula = $cedula;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: ../vista/bienvenido.php");
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