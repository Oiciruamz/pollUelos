<?php
    // Importar la conexión
    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: ../../../POLLUELOS/index.php');
    }

    require '../../includes/config/database.php';
    $db = conectarDB();


    $errores = [];
    $nombre = '';
    $apellido = '';
    $email = '';
    $pass = '';
    $rol = ' ';
    $Cpass = '';


    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){



        $nombre = mysqli_real_escape_string( $db, $_POST['name'] );
        $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
        $email = mysqli_real_escape_string($db, $_POST['correo']);
        $pass = mysqli_real_escape_string($db, $_POST['contrasena']);
        $rol = mysqli_real_escape_string($db, $_POST['rol']);
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
        if(!$rol){
            $errores[] = "Debe añadir un Rol";
        }
        if($Cpass != $pass){
            $errores[] = "Las contraseñas no coinciden";
        } else{
            $passwordHash = password_hash($pass, PASSWORD_DEFAULT);
        }      
        if (empty($errores)) {
            
            $consulta = "SELECT * FROM usuarios WHERE Email = '{$email}'";
            $result = mysqli_query($db, $consulta);
    
            if ($result->num_rows > 0) {
                $errores[] = "Ya existe un usuario registrado con este correo electrónico";
            } else {
               
                $query = "INSERT INTO usuarios (Rol, Nombre, Apellido, Email, Contraseña) VALUES ($rol, '{$nombre}', '{$apellido}', '{$email}', '{$passwordHash}')";
                $resultado = mysqli_query($db, $query);

                header('Location: /POLLUELOS/admin/usuarios.php');
    
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

        <form  method="POST" class ="registro-form">
            <fieldset class = "ok">

            <h1>Registro</h1>

            <input type="text" placeholder="Tu Nombre" name = "name" id="name"
            value = "<?php echo $nombre; ?>">

            <input type="text" placeholder="Tu Apellido" name = "apellido" id="apellido"
            value = "<?php echo $apellido; ?>"> 

            <div class = "forma-login">
                <label for="administrador">Administrador</label>
                <input name = "rol" type="radio" value = "1" id = "administrador" required>

                <label for="cliente">Cliente</label>
                <input name = "rol" type="radio" value = "2" id = "cliente" required>
           </div>
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




    <script src="../../build/js/app.js"></script>
</body>