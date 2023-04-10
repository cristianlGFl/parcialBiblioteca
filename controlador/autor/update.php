<?php
// Include config file
require_once "../../modelo/configConexion.php";

// Define variables and initialize with empty values
$nombre_autor = $nacionalidad = $cedula = "";
$nombre_autor_err = $nacionalidad_err = $cedula_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate name
    $input_nombre_autor = trim($_POST["nombre_autor"]);
    if (empty($input_nombre_autor)) {
        $nombre_autor_err = "Digitar nombre de autor";
    } elseif (!filter_var($input_nombre_autor, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombre_autor_err = "Validar nombre digitado";
    } else {
        $nombre_autor = $input_nombre_autor;
    }

    // Validate address address
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
        // Prepare an update statement
        $sql = "UPDATE autor SET nombre_autor=?, nacionalidad=?, cedula=? WHERE id_autor=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_nombre_autor, $param_nacionalidad, $param_cedula, $param_id);

            // Set parameters
            $param_nombre_autor = $nombre_autor;
            $param_nacionalidad = $nacionalidad;
            $param_cedula = $cedula;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: ../../vista/bienvenido.php");
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
        $sql = "SELECT * FROM autor WHERE id = ?";
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
                    $nombre_autor = $row["nombre_autor"];
                    $nacionalidad = $row["nacionalidad"];
                    $cedula = $row["cedula"];
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