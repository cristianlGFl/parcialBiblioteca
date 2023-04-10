<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsd    livr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Libros</h2>
                        <a href="../vista/libro/createlibro.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar libro</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../modelo/configConexion.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM libros";
                    global $mysqli;
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Isbn</th>";
                                        echo "<th>Editorial</th>";
                                        echo "<th>Genero</th>";
                                        echo "<th>Año de publicación</th>";
                                        echo "<th>Autor</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id_libro'] . "</td>";
                                        echo "<td>" . $row['ISBN'] . "</td>";
                                        echo "<td>" . $row['editorial'] . "</td>";
                                        echo "<td>" . $row['genero'] . "</td>";
                                        echo "<td>" . $row['anoPublicacion'] . "</td>";
                                        echo "<td>" . $row['autor'] . "</td>";
                                        echo "<td>";
                                            
                                            echo '<a href="../vista/libro/updateLibro.php?id='. $row['id_libro'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="../vista/libro/deleteLibro.php?id='. $row['id_libro'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo '<div class="alert alert-danger"><em>No se encontraron registros.</em></div>';
                        }
                    } else{
                        echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
                    }
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>