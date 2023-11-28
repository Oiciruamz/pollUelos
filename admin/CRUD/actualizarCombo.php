<?php

require '../../includes/funciones.php';
$auth = estaAutenticado();

if(!$auth){
    header('Location: ./../../POLLUELOS/index.php');
}

require '../../includes/config/database.php';

$id = $_GET['id'];

$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../combos.php');
}

$db = conectarDB();

$consulta = "SELECT * FROM combos WHERE idCombos = {$id}";
$resultado = mysqli_query($db, $consulta);
$producto = mysqli_fetch_assoc($resultado);

$productos = "SELECT * FROM producto";
$consult = mysqli_query($db, $productos);

$errores = [];
$nombre = $producto['Nombre'];
$descripcion = $producto['Descripción'];
$precio = $producto['Precio'];
$existencia = $producto['Existencia'];
$imagenProducto = $producto['Imagen'];

$comboProductos = "SELECT * FROM rel_combos_productos WHERE ComboId = {$id}";
$check = mysqli_query($db, $comboProductos);

// Almacenar los resultados del segundo bucle en un array
$productosSeleccionados = [];
while ($combo = mysqli_fetch_assoc($check)) {
    $productosSeleccionados[] = $combo['ProductosId'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = mysqli_real_escape_string($db, $_POST['name']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $existencia = mysqli_real_escape_string($db, $_POST['existencia']);
    $productos = isset($_POST['productos-combo']) ? $_POST['productos-combo'] : [];
    $imagen = $_FILES['imagen'];

    if (!$nombre) {
        $errores[] = "Debes añadir un nombre al producto";
    }
    if (!$descripcion) {
        $errores[] = "Debes añadir una descripción al producto";
    }
    if (!$precio) {
        $errores[] = "Debes añadir un precio al producto";
    }
    if (!$existencia) {
        $errores[] = "Debes añadir la cantidad de productos existentes";
    }
    if (!$imagen['name']) {
        $errores[] = "Debes añadir una imagen al producto";
    }

    if(empty($errores)){

        $carpetaImagenes = '../../imagenesCombos/';

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        $nombreImagen = md5( uniqid(rand(), true) ) . ".jpg";

        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

        $queryCombo = "UPDATE combos SET Nombre = '{$nombre}', Descripción = '{$descripcion}',
        Precio = '{$precio}', Existencia = {$existencia}, Imagen = '{$nombreImagen}' WHERE idCombos = {$id}";

        $resultadoCombo = mysqli_query($db, $queryCombo);

        if ($resultadoCombo) {

            // Eliminar las relaciones antiguas
            $queryEliminarRelaciones = "DELETE FROM rel_combos_productos WHERE ComboId = {$id}";
            mysqli_query($db, $queryEliminarRelaciones);

            // Agregar nuevas relaciones
            foreach ($productos as $idProducto) {
                $queryAgregarRelacion = "INSERT INTO rel_combos_productos (ComboId, ProductosId) VALUES ({$id}, {$idProducto})";
                mysqli_query($db, $queryAgregarRelacion);
            }


        if ($resultado) {
            header('Location: /POLLUELOS/admin/combos.php');
        }
        }
    }
}

incluirTemplate('header');  
?>
    <main class="background-registro seccion">

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="registro-form" enctype="multipart/form-data">

            <fieldset class="ok">

                <h1>PRODUCTO</h1>

                <input type="text" placeholder="Nombre del Producto" name="name" id="name" value="<?php echo $nombre; ?>">

                <input type="text" placeholder="Descripción" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>">

                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
                <img src="../../imagenesCombos/<?php echo $imagenProducto ?>" class="imagen-small" />

                <input type="number" placeholder="Precio" name="precio" id="precio" value="<?php echo $precio; ?>">

                <input type="number" placeholder="Existencia" name="existencia" id="existencia" value="<?php echo $existencia; ?>">

                <h3>Productos en el Combo</h3>
                <div class="Combo-crear">
                    <?php
                    while ($producto = mysqli_fetch_assoc($consult)) :
                        $productoId = $producto['idProductos'];
                        $checked = in_array($productoId, $productosSeleccionados) ? 'checked' : '';
                    ?>
                        <legend><?php echo $producto['Nombre']; ?>
                            <input type="checkbox" value="<?php echo $productoId; ?>" name="productos-combo[]" <?php echo $checked; ?>>
                        </legend>
                    <?php endwhile; ?>
                </div>

                <input type="submit" value="AGREGAR" class="boton-amarillo">

            </fieldset>

        </form>

    </main>

    <script src="../../build/js/app.js"></script>
</body>
