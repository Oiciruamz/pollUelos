<?php

    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: ./../../POLLUELOS/index.php');
    }

    require '../../includes/config/database.php';

    $id = $_GET['id'];

    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: ../productos.php');
    }

    $db = conectarDB();

    $consulta = "SELECT * FROM producto WHERE idProductos = {$id}";
    $resultado = mysqli_query($db, $consulta);
    $producto = mysqli_fetch_assoc($resultado);

    $errores = [];
    $nombre = $producto['Nombre'];
    $descripcion = $producto['Descripción'];
    $precio = $producto['Precio'];
    $existencia = $producto['Existencia'];
    $imagenProducto = $producto['Imagen'];
    

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $nombre = mysqli_real_escape_string($db, $_POST['name']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $existencia = mysqli_real_escape_string($db, $_POST['existencia']);
        $imagen = $_FILES['imagen'];

        
        if(!$nombre){
            $errores[] = "Debes añadir un nombre al producto";
        }
        if(!$descripcion){
            $errores[] = "Debes añadir una descripcion al producto";
        }
        if(!$precio){
            $errores[] = "Debes añadir un precio al producto";
        }
        if(!$existencia){
            $errores[] = "Debes añadir la cantidad de productos existentes";
        }
        if(!$imagen['name']){
            $errores[] = "Debes añadir una imagen al producto";
        }

        

        if(empty($errores)){

            $carpetaImagenes = '../../imagenesProductos/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            if($imagen['name']){

                unlink($carpetaImagenes . $producto['imagen']);

                $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";

                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
             } else{
                $nombreImagen = $producto['imagen'];
            }

            $query = "UPDATE producto SET Nombre = '{$nombre}',  Descripción = '{$descripcion}',
             Precio = '{$precio}', Existencia =  {$existencia}, Imagen = '{$nombreImagen}' WHERE idProductos = {$id}";

        
        
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /POLLUELOS/admin/productos.php');
            }
        }

    }
    incluirTemplate('header');  
?>
    <main class ="background-registro seccion">
        
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                     <?php echo $error;?>
            </div>
         <?php endforeach; ?>

        <form  method="POST" class ="registro-form" enctype="multipart/form-data">

            <fieldset class = "ok">

            <h1>PRODUCTO</h1>

            <input type="text" placeholder="Nombre del Producto" name = "name" id="name" value = "<?php echo $nombre; ?>">

            <input type="text" placeholder="Descripción" name = "descripcion" id="descripcion"
            value = "<?php echo $descripcion; ?>"> 

            <input type="file" id ="imagen" accept="image/jpeg, image/png" name="imagen">
            <img src="../../imagenesProductos/<?php echo $imagenProducto ?>" class = "imagen-small"/>

            <input type="number" placeholder="Precio" name = "precio" id="precio"
            value = "<?php echo $precio; ?>"> 

            <input type="number" placeholder="Existencia" name = "existencia" id="existencia"
            value = "<?php echo $existencia; ?>"> 

            <input type="submit" value = "AGREGAR" class = "boton-amarillo">

            </fieldset>

        </form>

    </main>






    <script src="../../build/js/app.js"></script>
</body>
</body>