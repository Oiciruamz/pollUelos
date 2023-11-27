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
    <title>Método de Pago</title>
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

            <h1>Infromación de Pago</h1>

            <div class = "iconosPago">
                <img src="src/img/294654_visa_icon.png" alt="">
                <img src="src/img/1156750_finance_mastercard_payment_icon.svg" alt="">
                <img src="src/img/american-express.png" alt="">
            </div>
           

            <input type="text" placeholder="Nombre del Titular" name = "numCasa" id="numCasa"
            value = "<?php echo $nombre; ?>">

            <input type="text" placeholder="Número de tarjeta" name = "tarjeta" id="tarjeta"
            value = "<?php echo $nombre; ?>">            

            <input type="text" placeholder="Fecha de Vencimiento (MM/YY)" name = "fecha" id="fecha"
            value = "<?php echo $nombre; ?>" maxlength="5"/>  

            <input type="text" placeholder="CVV" name = "cvv" id="cvv"
            value = "<?php echo $nombre; ?>">
            
            <input type="submit" value = "Agregar Tarjeta" class = "boton-amarillo">

            </fieldset>

        </form>

    </main>




    <script src="build/js/app.js"></script>
</body>