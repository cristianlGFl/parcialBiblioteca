<?php
// Include config file
require_once "../../modelo/configConexion.php";
$isbn = $editorial = $genero = $anoPublicacion = $autor =  "";
$isbn_err = $editorial_err = $genero_err = $anoPublicacion_err = $autor_err ="";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
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
        // Prepare an insert statement
        $sql = "INSERT INTO libros (ISBN, editorial, genero,anoPublicacion,autor) VALUES (?, ?, ?, ?, ?)";
        global $link;
        global $stmt;
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            // Bind variables to the prepared statement as parameters
             mysqli_stmt_bind_param($stmt, "sssss", $param_isbn,$param_editorial, $param_genero,$param_anoPublicacion, $param_autor);

            // Set parameters
            $param_isbn = $isbn;
            $param_editorial = $editorial;
            $param_genero = $genero;
            $param_anoPublicacion = $anoPublicacion;
            $param_autor = $autor;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: ../vista/bienvenidoLibro.php");
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