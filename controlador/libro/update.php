<?php
// Include config file
require_once "../../modelo/configConexion.php";

$isbn = $editorial = $genero = $anoPublicacion = $autor =  "";
$isbn_err = $editorial_err = $genero_err = $anoPublicacion_err = $autor_err ="";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    $input_isbn = trim($_POST["isbn"]);
    if (empty($input_isbn)) {
        $isbn_err = "Digitar isbn";
    } elseif (!filter_var($input_isbn, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $isbn_err = "Validar isbn";
    } else {
        $isbn = $input_isbn;
    }

    // Validate 
    $input_editorial = trim($_POST["editorial"]);
    if (empty($input_editorial)) {
        $editorial_err = "Digitar editorial";
    } else {
        $editorial = $input_editorial;
    }

     // Validate 
     $input_genero = trim($_POST["genero"]);
     if (empty($input_genero)) {
         $genero_err = "Digitar genero";
     } else {
         $genero = $input_genero;
     }

      // Validate 
    $input_anoPublicacion = trim($_POST["anoPublicacion"]);
    if (empty($input_anoPublicacion)) {
        $anoPublicacion_err = "Digitar Año de publicación";
    } else {
        $anoPublicacion = $input_anoPublicacion;
    }

    $input_autor = trim($_POST["autor"]);
    if (empty($input_autor)) {
        $autor_err = "Digitar autor";
    } else {
        $autor = $input_autor;
    }


    // Check input errors before inserting in database
    if (empty($isbn_err) && empty($editorial_err) && empty($genero_err)) {
        // Prepare an update statement
        $sql = "UPDATE libros SET ISBN=?, editorial=?, genero=?, anoPublicacion=?, autor=?  WHERE id_libro=?";
        global $link;
        global $stmt;
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_isbn,$param_editorial, $param_genero,$param_anoPublicacion, $param_autor, $param_id);

            // Set parameters
            $param_isbn = $isbn;
            $param_editorial = $editorial;
            $param_genero = $genero;
            $param_anoPublicacion = $anoPublicacion;
            $param_autor = $autor;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: ../../vista/bienvenidoLibro.php");
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
        $sql = "SELECT * FROM libros WHERE id_libro = ?";
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
                    $isbn = $row["ISBN"];
                    $editorial = $row["editorial"];
                    $genero = $row["genero"];
                    $anoPublicacion = $row["anoPublicacion"];
                    $autor = $row["autor"];
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