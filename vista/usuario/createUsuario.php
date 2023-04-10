<?php
include '../../controlador/usuario/create.php';
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
                    <h2 class="mt-5">Crear usuario</h2>
                    <p>Complete este formulario y envíelo para agregar el registro del empleado a la base de datos.</p>
                    <form action="../../controlador/usuario/create.php" method="post">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input type="text" name="nombre_usuario"
                                class="form-control <?php echo (!empty($nombre_usuario_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $nombre_usuario; ?>">
                            <span class="invalid-feedback">
                                <?php echo $nombre_usuario_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <textarea name="email"
                                class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"><?php echo $email; ?></textarea>
                            <span class="invalid-feedback">
                                <?php echo $email_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" name="contrasena"
                                class="form-control <?php echo (!empty($contrasena_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $contrasena; ?>">
                            <span class="invalid-feedback">
                                <?php echo $contrasena_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Tipo</label>
                            <select name="tipo" 
                                class="form-control <?php echo (!empty($tipo_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $tipo; ?>">
                                <option value="administrador">Administrador</option>
                                <option value="empleado" selected>Empleado</option>
                            </select>
                            
                            <span class="invalid-feedback">
                                <?php echo $tipo_err; ?>
                            </span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="../vista/bienvenido.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>