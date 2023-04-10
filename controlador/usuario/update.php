<?php
// Include config file
require_once "../../modelo/configConexion.php";

// Define variables and initialize with empty values
$nombre_usuario = $email = $contrasena = $tipo = "";
$nombre_usuario_err = $email_err = $contrasena_err = $tipo_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

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
        // Prepare an update statement
        $sql = "UPDATE usuarios SET nombre_usuario=?, email=?, contrasena=?, tipo=? WHERE id_usuario=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss",  $param_nombre_usuario, $param_email, $param_contrasena, $param_tipo, $param_id);

            // Set parameters
            $param_nombre_usuario = $nombre_usuario;
            $param_email = $email;
            $param_contrasena = $contrasena;
            $param_tipo = $tipo;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: ../../vista/bienvenidoUsuario.php");
                exit();
            } else {
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }

    }


} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM usuario WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $nombre_usuario = $row["nombre_usuario"];
                    $email = $row["email"];
                    $contrasena = $row["contrasena"];
                    $contrasena = $row["tipo"];
                } else {
                    echo "aca1  ";
                    // URL doesn't contain valid id. Redirect to error page

                    exit();
                }

            } else {
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }


    } else {

        // URL doesn't contain id parameter. Redirect to error page
        echo "aca2";
        echo $id;
        exit();
    }
}
?>