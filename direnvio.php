<?php
    // Importar la conexión
    require '../POLLUELOS/includes/config/database.php';
    $db = conectarDB();

    $errores = [];
    $email = '';
    $pass = '';
  


    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $email = mysqli_real_escape_string($db, $_POST['correo']);
        $pass = mysqli_real_escape_string($db, $_POST['contrasena']);
      
   
        if(!$email){
            $errores[] = "Debes añadir un email";
         }
        if(!$pass){
        $errores[] = "Debes añadir una contraseña";
        }

        
    
        if(empty($errores)){
            exit;
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
    <title>Direccion de Envío</title>
</head>

<body>

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
                <a href="login.php">
                    <img src="src/img/usuario.png" alt="" class = "icono">
                </a>
            </div>
    

        </div>
    </header>



    <main class ="background-registro seccion">
        
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                     <?php echo $error;?>
            </div>
         <?php endforeach; ?>

        <form  method="POST"  class = "registro-form">
            <fieldset class = "ok">

            <h1>Direccion de Envío</h1>

            <input type="text" placeholder="Calle" name = "calle" id="calle"
            value = "<?php echo $nombre; ?>">

            <input type="text" placeholder="Número de Casa" name = "numCasa" id="numCasa"
            value = "<?php echo $nombre; ?>">

            <input type="text" placeholder="Colonia" name = "colonia" id="colonia"
            value = "<?php echo $nombre; ?>">            

            <input type="text" placeholder="Código Postal" name = "cp" id="cp"
            value = "<?php echo $nombre; ?>">  

            <input type="text" placeholder="Señas Particulares del Domicilio" name = "senas" id="senas"
            value = "<?php echo $nombre; ?>">
            
            <input type="submit" value = "Agregar Dirección" class = "boton-amarillo">

            </fieldset>

        </form>

    </main>




    <script src="build/js/app.js"></script>
</body>