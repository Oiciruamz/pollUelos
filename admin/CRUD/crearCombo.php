<?php

    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: ../../../POLLUELOS/index.php');
    }

    require '../../includes/config/database.php';

    $db = conectarDB();


    $productos = "SELECT * FROM producto";
    $consulta = mysqli_query($db, $productos);



    $errores = [];
    $nombre = '';
    $descripcion = '';
    $precio = '';
    $existencia = '';
    

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $nombre = mysqli_real_escape_string($db, $_POST['name']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $existencia = mysqli_real_escape_string($db, $_POST['existencia']);
        $imagen = $_FILES['imagen'];
        $productos = isset($_POST['productos-combo']) ? $_POST['productos-combo'] : [];
  

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
        if(empty($productos)){
            $errores[] = "No hay productos en el Combo";
        }

   

        if(empty($errores)){

            $carpetaImagenes = '../../imagenesCombos/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";

            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            $queryCombo = "INSERT INTO combos (Nombre, Descripción, Precio, Existencia, Imagen)
            VALUES ('{$nombre}', '{$descripcion}', {$precio}, {$existencia}, '{$nombreImagen}')";

            $resultadoCombo = mysqli_query($db, $queryCombo);
            if ($resultadoCombo) {

                $ultimoIDCombo = mysqli_insert_id($db);
    
                foreach ($productos as $idProducto) {
                    $queryRelacion = "INSERT INTO rel_combos_productos (ComboId, ProductosId)
                                      VALUES ({$ultimoIDCombo}, {$idProducto})";
        
                    mysqli_query($db, $queryRelacion);
                }
        

            if($resultadoCombo){
                header('Location: /POLLUELOS/admin/combos.php');
            }
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

            <h1>COMBO</h1>

            <input type="text" placeholder="Nombre del Combo" name = "name" id="name" value = "<?php echo $nombre; ?>">

            <input type="text" placeholder="Descripción" name = "descripcion" id="descripcion"
            value = "<?php echo $descripcion; ?>"> 

            <input type="file" id ="imagen" accept="image/jpeg, image/png" name="imagen">

            <input type="number" placeholder="Precio" name = "precio" id="precio"
            value = "<?php echo $precio; ?>"> 

            <input type="number" placeholder="Existencia" name = "existencia" id="existencia"
            value = "<?php echo $existencia; ?>"> 

            
                <h3>Productos en el Combo</h3>
            <div class = "Combo-crear">
                <?php while($producto = mysqli_fetch_assoc($consulta)) : ?>
                <legend><?php echo $producto['Nombre'];?>
                <input type="checkbox" value="<?php echo$producto['idProductos']?>" name="productos-combo[]" >
                </legend>
                <?php endwhile; ?>
            </div>

            <input type="submit" value = "AGREGAR" class = "boton-amarillo">

            </fieldset>

        </form>

    </main>






    <script src="../../build/js/app.js"></script>
</body>