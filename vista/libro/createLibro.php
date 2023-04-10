<?php
include '../../controlador/libro/create.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Crear libro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto; 
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Crear libro</h2>
                    <p>Complete este formulario y envíelo para agregar el registro del empleado a la base de datos.</p>
                    <form action="../../controlador/libro/createLibro.php" method="post">
                        <div class="form-group">
                            <label>isbn</label>
                            <input type="text" name="isbn"
                                class="form-control <?php echo (!empty($isbn_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $isbn; ?>">
                            <span class="invalid-feedback">
                                <?php echo $isbn_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Editorial</label>
                            <textarea name="editorial"
                                class="form-control <?php echo (!empty($editorial_err)) ? 'is-invalid' : ''; ?>"><?php echo $editorial; ?></textarea>
                            <span class="invalid-feedback">
                                <?php echo $editorial_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Genero</label>
                            <input type="text" name="genero"
                                class="form-control <?php echo (!empty($genero_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $genero; ?>">
                            <span class="invalid-feedback">
                                <?php echo $genero_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Año de Publicación</label>
                            <input type="date" name="anoPublicacion"
                                class="form-control <?php echo (!empty($anoPublicacion_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $anoPublicacion; ?>">
                            <span class="invalid-feedback">
                                <?php echo $anoPublicacion_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Autor</label>
                            <input type="text" name="autor"
                                class="form-control <?php echo (!empty($autor_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $autor; ?>">
                            <span class="invalid-feedback">
                                <?php echo $autor_err; ?>
                            </span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="../bienvenido.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>