<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vista\css\styleLogin.css">
    <title>Ingreso</title>
</head>

<script src="vista/js/login.js"></script>

<body>

    <!-- LOGIN MODULE -->
    <div class="login">
        <div class="wrap">
            <!-- TOGGLE -->
            <div id="toggle-wrap">
                <div id="toggle-terms">
                    <div id="cross">
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>




            <!-- SLIDER -->
            <div class="content">
                <!-- LOGO -->
                <div class="logo">
                    <a href="#"><img src="http://res.cloudinary.com/dpcloudinary/image/upload/v1506186248/logo.png"
                            alt=""></a>
                </div>
                <!-- SLIDESHOW -->
                <div id="slideshow">
                    <div class="one">
                        <h2><span>Parcial 1</span></h2>
                        <p>Integrantes: Cristian Gomez Florez</p>
                        <p>Camila Espinoza</p>
                        <p>Parcial Biblioteca</p>
                        <p>Programación distribuida y paralela</p>
                    </div>

                </div>
            </div>
            <!-- LOGIN FORM -->
            <div class="user">

                <div class="form-wrap">
                    <!-- TABS -->
                    <div class="tabs">
                        <h3 class="login-tab"><a class="log-in active" href="#login-tab-content"><span>Login<span></a>
                        </h3>
                    </div>
                    <!-- TABS CONTENT -->
                    <div class="tabs-content">
                        <!-- TABS CONTENT LOGIN -->
                        <div id="login-tab-content" class="active">
                            <form action="controlador/session.php" method="POST">
                                <input type="text" name="username" class="input"  autocomplete="off"
                                    placeholder="Correo electronico">
                                <input type="password" name="password" class="input" autocomplete="off"
                                    placeholder="Contraseña">
                                <input type="submit" class="button" value="Login">
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>