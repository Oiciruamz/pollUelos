<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Polluelos</title>
</head>

<body>

    <header class = "header">
        <div class = "contenido-header">

            <div class = "mobile-menu">
                <img src="src/img/barras.svg" alt="" class="icono-barras">
            </div>
    
            <nav class = "navegacion">
                <a href="index.php">Inicio</a>
                <a href="menuP.php">Menú</a>
                <a href="contacto.php">Contacto</a>
                <a href="nosotros.php">Nosotros</a>
            </nav>
    
    
            <div class="iconos">
                <a href="#">
                    <img src="src/img/carro.png" alt="" class = "icono">
                </a>
                <a href="login.php">
                    <img src="src/img/usuario.png" alt="" class = "icono">
                </a>
            </div>

        </div>
    </header>

    <div class="perfil-Usuario">

    <aside class="opciones-usuario">
               
                    <div class="Usuario">
                        <h2>Perfil Usuario</h2>

                        <p>Nombre del Cliente</p>
                    </div>
        

            <div class="contenedor-opciones">

                
                    <div class="opcion1 aqui">
                         <a href="3">
                            <h4>Cuenta</h4>
                         </a>
                    </div>


                    <div class="opcion1">
                        <a href="direnvio.php"><h4>Agregar Dirección de Envío</h4></a>
                    </div>
               

                    <div class="opcion1">
                        <a href="metodoP.php"><h4>Agregar Método de Pago</h4></a>
                    </div>
 
            </div>
    </aside>

    <main class="utilidades-usuario">

        <img src="src/img/usuario.png" alt="">

        <div class= "u-usuario">
                    <div class="opcion2">
                     <a href="metodoP.php"><h4>Correo electronico</h4></a>
                    </div>

                    <div class="opcion2">
                     <a href="metodoP.php"><h4>Cambiar Contraseña</h4></a>
                    </div>

                    <div class="opcion2">
                     <a href="metodoP.php"><h4>Cerrar Sesión</h4></a>
                    </div>
        </div>

    </main>

    </div>




    <script src="build/js/app.js"></script>
</body>