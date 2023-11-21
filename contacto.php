<?php
    // Importar la conexión
    require '../POLLUELOS/includes/config/database.php';
    $db = conectarDB();

    $errores = [];
    $nombre = '';
    $email = '';
    $mensaje = '';
    $fecha = '';


    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){



        $nombre = mysqli_real_escape_string( $db, $_POST['nombre'] );
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $mensaje = mysqli_real_escape_string($db, $_POST['mensaje']);
        $fecha = mysqli_real_escape_string($db, date('Y/m/d'));

        if(!$nombre){
            $errores[] = "Debes añadir un nombre";
        }       
        if(!$email){
            $errores[] = "Debes añadir un email";
         }
        if(!$mensaje){
        $errores[] = "Debes añadir un mensaje";
        }       
   
        if(empty($errores)){
            $query = "INSERT INTO contacto (Nombre, Correo_Electronico, Comentario, Fecha) VALUES ('{$nombre}', '{$email}', '{$mensaje}', '{$fecha}');";
            $resultado = mysqli_query($db, $query);

             if($resultado){
                        header("Location: /POLLUELOS/index.html");
                }
        }
    }

   
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Polluelos</title>
</head>

<body class ="background">

    <header class = "header">
        <div class = "contenido-header">

             <div class = "mobile-menu">
                <img src="src/img/barras.svg" alt="" class="icono-barras">
            </div>
    
            <nav class = "navegacion">
                <a href="index.html">Inicio</a>
                <a href="menuP.html">Menú</a>
                <a href="contacto.php">Contacto</a>
                <a href="nosotros.html">Nosotros</a>
            </nav>
    
    
            <div class="iconos">
                <a href="#">
                    <img src="src/img/carro.png" alt="" class = "icono">
                </a>
                <a href="#">
                    <img src="src/img/usuario.png" alt="" class = "icono">
                </a>
            </div>
    

        </div>
    </header>



    <main class = "contenedor seccion">
        
        <h1>Contacto</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                     <?php echo $error;?>
            </div>
         <?php endforeach; ?>

        <form class="formulario" method="POST" >
            <fieldset>
                <h2>Si tienes alguna duda ¡Escríbenos!</h2>

                <div class="campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" placeholder="Tu Nombre" name = "nombre" id="nombre"
                        value = "<?php echo $nombre; ?>">
                </div>
                
                <div class="campo">
                    <label for="email">E-mail</label>
                    <input type="email" placeholder="Email" name = "email" id="email" value = "<?php echo $email; ?>" >
                </div>

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje"><?php echo $mensaje ?></textarea>
                
                <div class = "campo">
                    <input type="submit" value="Enviar" class="boton-verde">
                </div>
            </fieldset>

        </form>

    </main>




    <script src="build/js/app.js"></script>
</body>