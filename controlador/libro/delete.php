<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "../../modelo/configConexion.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM libros WHERE id_libro = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: ../../vista/bienvenidoLibro.php");
            exit();
        } else{
            echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
        }
    }
     
    
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
       
        exit();
    }
}
