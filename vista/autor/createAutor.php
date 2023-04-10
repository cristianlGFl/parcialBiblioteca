<?php
include '../../controlador/autor/create.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Crear autor</h2>
                    <p>Complete este formulario y envíelo para agregar el registro del autor a la base de datos.</p>
                    <form action="../../controlador/autor/create.php" method="post">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input type="text" name="nombre_autor"
                                class="form-control <?php echo (!empty($nombre_autor_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $nombre_autor; ?>">
                            <span class="invalid-feedback">
                                <?php echo $nombre_autor_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Nacionalidad</label>
                            <textarea name="nacionalidad"
                                class="form-control <?php echo (!empty($nacionalidad_err)) ? 'is-invalid' : ''; ?>"><?php echo $nacionalidad; ?></textarea>
                            <span class="invalid-feedback">
                                <?php echo $nacionalidad_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Cedula</label>
                            <input type="number" name="cedula"
                                class="form-control <?php echo (!empty($cedula_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $cedula; ?>">
                            <span class="invalid-feedback">
                                <?php echo $cedula_err; ?>
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