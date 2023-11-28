<?php
    // Importar la conexión
    require 'includes/funciones.php';
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

    incluirTemplate('header', $inicio = true);
?>

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
                    <label for="nombre" class ="etiqueta">Nombre</label>
                    <input type="text" placeholder="Tu Nombre" name = "nombre" id="nombre"
                        value = "<?php echo $nombre; ?>">
                </div>
                
                <div class="campo">
                    <label for="email" class ="etiqueta">E-mail</label>
                    <input type="email" placeholder="Email" name = "email" id="email" value = "<?php echo $email; ?>" >
                </div>

                <label for="mensaje" class ="etiqueta" >Mensaje:</label>
                <textarea id="mensaje" name="mensaje"><?php echo $mensaje ?></textarea>
                
                <div class = "campo">
                    <input type="submit" value="Enviar" class="boton-verde">
                </div>
            </fieldset>

        </form>

    </main>




    <script src="build/js/app.js"></script>
</body>