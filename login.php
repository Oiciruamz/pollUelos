<?php

    require 'includes/funciones.php';


    // Importar la conexión
    require '../POLLUELOS/includes/config/database.php';
    $db = conectarDB();

    $errores = [];
    $rol = '';
    $email = '';
    $pass = '';
  


    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $email = mysqli_real_escape_string($db, $_POST['correo']);
        $pass = mysqli_real_escape_string($db, $_POST['contrasena']);
        $rol = mysqli_real_escape_string($db, $_POST['rol']);
      
   
        if(!$email){
            $errores[] = "Debes añadir un email";
         }
        if(!$pass){
        $errores[] = "Debes añadir una contraseña";
        }

        
        if(empty($errores)){
            //Revisar si el usuario existe.
            $query = "SELECT * FROM usuarios WHERE Email = '{$email}' AND Rol = {$rol}";

            $resultado = mysqli_query($db, $query);
        
            if($resultado->num_rows){
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                
                //Verificar si el password es correcto o no
               // var_dump($usuario['password']);

               $auth = password_verify($pass, $usuario['Contraseña']);
                
                //var_dump($auth);

                if($auth){

                    //Usuario autenticado

                    session_start();

                    //Llenar arreglo

                  $_SESSION['idUsuario'] = $usuario['idUsuarios'];
                  $_SESSION['rol'] = intval($usuario['Rol']);

                   /* echo "<pre>";
                    var_dump($_SESSION);
                    echo "</pre>";  */

                    header('Location: ./index.php');    
                } else{
                    $errores [] = "El password es incorrecto";
                }
    
            } else {
                $errores[] ="El usuario no existe";
            }

        }

    }
    



    incluirTemplate('header', $inicio = true);
   
?>

    <main class ="background-registro seccion">
        
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                     <?php echo $error;?>
            </div>
         <?php endforeach; ?>

        <form  method="POST"  class = "registro-form">
            <fieldset class = "ok">

            <h1>Inicio de Sesión</h1>

           <div class = "forma-login">
                <label for="administrador">Administrador</label>
                <input name = "rol" type="radio" value = "1" id = "administrador" required>

                <label for="cliente">Cliente</label>
                <input name = "rol" type="radio" value = "2" id = "cliente" required>
           </div>

            <input type="email" placeholder="Correo Electrónico" name = "correo" id="correo"
            value = "<?php echo $email; ?>" required> 

            <input type="password" placeholder="Contraseña" name = "contrasena" id="contrasena"
            value = "<?php echo $pass; ?>" required> 

            <a href="registro.php">¿No tienes cuenta? Registrate aquí.</a>

            <input type="submit" value = "Iniciar  Sesión" class = "boton-amarillo">

            </fieldset>

        </form>

    </main>




    <script src="build/js/app.js"></script>
</body>