<?php
    // Importar la conexión
    require '../POLLUELOS/includes/config/database.php';
    $db = conectarDB();

    $errores = [];
    $nombre = '';
    $apellido = '';
    $email = '';
    $pass = '';
    $Cpass = '';


    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){



        $nombre = mysqli_real_escape_string( $db, $_POST['name'] );
        $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
        $email = mysqli_real_escape_string($db, $_POST['correo']);
        $pass = mysqli_real_escape_string($db, $_POST['contrasena']);
        $Cpass = mysqli_real_escape_string($db, $_POST['Ccontrasena']);

        if(!$nombre){
            $errores[] = "Debes añadir un nombre";
        }
        if(!$apellido){
            $errores[] = "Debes añadir un apellido";
        }       
        if(!$email){
            $errores[] = "Debes añadir un email";
         }
        if(!$pass){
        $errores[] = "Debes añadir una contraseña";
        }
        if($Cpass != $pass){
            $errores[] = "Las contraseñas no coinciden";
        } else{
            $passwordHash = password_hash($pass, PASSWORD_DEFAULT);
            $rol = 2;
        }      
        
    
        if(empty($errores)){

            $query = "INSERT INTO usuarios (Rol, Nombre, Apellido, Email, Contraseña) VALUES ($rol, '{$nombre}', '{$apellido}', '{$email}', '{$passwordHash}')";


            $resultado = mysqli_query($db, $query);

             if($resultado){
                        header("Location: /POLLUELOS/index.php");
                } else{
                    echo "noo";
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
    <title>Registro</title>
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



    <main class ="background-registro seccion">
        
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                     <?php echo $error;?>
            </div>
         <?php endforeach; ?>

        <form  method="POST" class ="registro-form">
            <fieldset class = "ok">

            <h1>Registro</h1>

            <input type="text" placeholder="Tu Nombre" name = "name" id="name"
            value = "<?php echo $nombre; ?>">

            <input type="text" placeholder="Tu Apellido" name = "apellido" id="apellido"
            value = "<?php echo $apellido; ?>"> 

            <input type="email" placeholder="Correo Electrónico" name = "correo" id="correo"
            value = "<?php echo $email; ?>"> 

            <input type="password" placeholder="Contraseña" name = "contrasena" id="contrasena"
            value = "<?php echo $pass; ?>"> 

            <input type="password" placeholder="Confirmar Contraseña" name = "Ccontrasena" id="Ccontrasena"
            value = "<?php echo $Cpass; ?>">     
            
            <input type="submit" value = "Registrarme" class = "boton-amarillo">

            </fieldset>

        </form>

    </main>




    <script src="build/js/app.js"></script>
</body>