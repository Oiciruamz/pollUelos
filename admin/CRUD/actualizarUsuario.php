<?php
    // Importar la conexión
    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: ../../../POLLUELOS/index.php');
    }

    require '../../includes/config/database.php';
    $id = $_GET['id'];

    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: ../productos.php');
    }

    $db = conectarDB();

    $consulta = "SELECT * FROM usuarios WHERE idUsuarios = {$id}";
    $resultado = mysqli_query($db, $consulta);
    $producto = mysqli_fetch_assoc($resultado);


    $errores = [];
    $nombre = $producto['Nombre'];
    $apellido = $producto['Apellido'];
    $rol = $producto['Rol'];

    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){



        $nombre = mysqli_real_escape_string( $db, $_POST['name'] );
        $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
        $rol = mysqli_real_escape_string($db, $_POST['rol']);


        if(!$nombre){
            $errores[] = "Debes añadir un nombre";
        }
        if(!$apellido){
            $errores[] = "Debes añadir un apellido";
        }       
        if(!$rol){
            $errores[] = "Debes añadir un rol";
         }
   
        if (empty($errores)) {
               
                $query = "UPDATE usuarios SET Rol = {$rol}, Nombre = '{$nombre}', Apellido = '{$apellido}' WHERE idUsuarios = {$id}";        
                $resultado = mysqli_query($db, $query);

                header('Location: /POLLUELOS/admin/usuarios.php');
                
               
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

            <h1>Actualizar Rol</h1>

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
            
            <input type="submit" value = "Actualizar" class = "boton-amarillo">

            </fieldset>

        </form>

    </main>




    <script src="../../build/js/app.js"></script>
</body>