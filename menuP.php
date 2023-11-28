<?php
    // Importar la conexión
    require 'includes/config/database.php';
    require 'includes/funciones.php';
    session_start();
   
    $db = conectarDB();

    $Usuario = $_SESSION['idUsuario'];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $Combo = $_POST['idcombo'];

        $consulta = ("SELECT * FROM carrito_productos WHERE idUsuario = $Usuario AND Producto = $Combo");
        $result = mysqli_query($db, $consulta);

        if (mysqli_num_rows($result) > 0) {
            // El idUsuario ya existe en el carrito
            // El idUsuario ya existe en el carrito
            $fila = mysqli_fetch_assoc($result);
            $Cantidad = $fila['Cantidad'];
            $Producto = $fila['Producto'];
            $Cantidad++;
            $query = "UPDATE carrito_productos SET cantidad = $Cantidad WHERE idUsuario = $Usuario AND Producto = $Producto";
            $result = mysqli_query($db, $query);
        } else {
            // El idUsuario no existe en el carrito
            $Combo = $_POST['idcombo'];
            $Cantidad = 1;
            $query = "INSERT INTO carrito_productos (Producto, idUsuario, cantidad) VALUES ($Combo, $Usuario, $Cantidad)";
            $resultado = mysqli_query($db, $query);
        }
        
    }


    // Consultar
    $query = "SELECT * FROM producto";

    // Obtener resultado
    $resultado = mysqli_query($db, $query);

    incluirTemplate('header');
?>

    <div class = "banner"></div>

    <div class="centrado ">
        <nav class="selecion">
            <a href="menuP.php" class = "rojo">Productos</a>
            <a href="menuC.php">Combos</a>
        </nav>
    </div>


    <div class="contenedor-anuncios">

    <?php 

        while($producto = mysqli_fetch_assoc($resultado)) :

    ?>
            <div class="anuncio">
            <form method = "POST">
                <picture>
                    <img loading = "lazy" src="imagenesProductos/<?php echo $producto['Imagen']; ?>" alt="anuncio" loading="lazy" class = "img-small">
                </picture>
                <div class="contenido-anuncio">
                    <p class="precio">$<?php echo $producto['Precio']?></p>
                    <h3><?php echo $producto['Nombre'];?></h3>
                    <p><?php echo $producto['Descripción'];?></p>
    
                        
                    <input type="hidden" name="idcombo" value="<?php echo $producto['idProductos']; ?>">   
                    <button type="submit" class="boton-carrito" name="agregarCarrito">
                        <img src="src/img/alcarrito.svg">
                    </button>
                </div>
            </form>  
            </div>

    <?php endwhile; ?>

    </div>
    

    <script src="build/js/app.js"></script>
</body>