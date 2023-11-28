<?php
                require 'includes/funciones.php';
                session_start();

                require 'includes/config/database.php';
                $db = conectarDB();

                $Usuario = $_SESSION['idUsuario'];

                // Consulta para obtener las direcciones
$queryDirecciones = "SELECT * FROM dirección WHERE IDUSER = $Usuario";
$resultadoDirecciones = mysqli_query($db, $queryDirecciones);

$direcciones = array();

while ($direccion = mysqli_fetch_assoc($resultadoDirecciones)) {
    $direcciones[] = $direccion;
}

// Consulta para obtener los números de tarjeta
$queryTarjetas = "SELECT * FROM tarjeta WHERE Usuario = $Usuario";
$resultadoTarjetas = mysqli_query($db, $queryTarjetas);

$tarjetas = array();

while ($tarjeta = mysqli_fetch_assoc($resultadoTarjetas)) {
    $tarjetas[] = $tarjeta;
}

                $queryCarritoCombos = "SELECT cc.Cantidad, c.Nombre, c.Precio
                FROM carrito_combos cc
                INNER JOIN combos c ON cc.Combo = c.idCombos
                WHERE cc.IdUsuario = $Usuario";

            $resultadoCarritoCombos = mysqli_query($db, $queryCarritoCombos);

            $carritoCombos = array();

            while ($carritoCombo = mysqli_fetch_assoc($resultadoCarritoCombos)) {
            $carritoCombos[] = $carritoCombo;
            }

            // Obtener información del carrito de productos
            $queryCarritoProductos = "SELECT cp.Cantidad, p.Nombre, p.Precio
                            FROM carrito_productos cp
                            INNER JOIN producto p ON cp.Producto = p.idProductos
                            WHERE cp.IdUsuario = $Usuario";

            $resultadoCarritoProductos = mysqli_query($db, $queryCarritoProductos);

            $carritoProductos = array();

            while ($carritoProducto = mysqli_fetch_assoc($resultadoCarritoProductos)) {
            $carritoProductos[] = $carritoProducto;
            }
                        
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {

                // Obtener la dirección seleccionada (deberías tener el valor correcto del formulario)
                $direccion = $_POST['Dir_envio'];

                // Obtener información del carrito de combos
                $queryCarritoCombos = "SELECT cc.Cantidad, c.idCombos, c.Precio
                                    FROM carrito_combos cc
                                    INNER JOIN combos c ON cc.Combo = c.idCombos
                                    WHERE cc.IdUsuario = $Usuario";

                $resultadoCarritoCombos = mysqli_query($db, $queryCarritoCombos);

                // Obtener información del carrito de productos
                $queryCarritoProductos = "SELECT cp.Cantidad, p.idProductos, p.Precio
                                        FROM carrito_productos cp
                                        INNER JOIN producto p ON cp.Producto = p.idProductos
                                        WHERE cp.IdUsuario = $Usuario";

                $resultadoCarritoProductos = mysqli_query($db, $queryCarritoProductos);

                $total = 0; // Variable para calcular el total de la venta

                // Insertar en la tabla ventas
                $queryVentas = "INSERT INTO ventas (Usuario_Id, Direccion, Estado_Pedido, Metodo_de_Pago, Fecha)
                                VALUES ($Usuario, $direccion, 1, 1, NOW())";

                $result = mysqli_query($db, $queryVentas);
                
                // Obtener el ID de la venta recién insertada
                $idVenta = mysqli_insert_id($db);

        

                // Insertar en la tabla detalle_venta_combos
                while ($carritoCombo = mysqli_fetch_assoc($resultadoCarritoCombos)) {
                    $total += $carritoCombo['Cantidad'] * $carritoCombo['Precio'];

                    $queryDetalleVentaCombos = "INSERT INTO detalle_venta_combos (Venta, Combo, Cantidad_de_combo, Precio_Unitario)
                                                VALUES ($idVenta, {$carritoCombo['idCombos']}, {$carritoCombo['Cantidad']}, {$carritoCombo['Precio']})";

                    mysqli_query($db, $queryDetalleVentaCombos);
                }

                // Insertar en la tabla detalle_venta_productos
                while ($carritoProducto = mysqli_fetch_assoc($resultadoCarritoProductos)) {
                    $total += $carritoProducto['Cantidad'] * $carritoProducto['Precio'];

                    $queryDetalleVentaProductos = "INSERT INTO detalle_venta_producto (Venta, Producto, Cantidad_de_producto, Precio_Unitario)
                                                VALUES ($idVenta, {$carritoProducto['idProductos']}, {$carritoProducto['Cantidad']}, {$carritoProducto['Precio']})";

                     mysqli_query($db, $queryDetalleVentaProductos);

                     $queryLimpiarCarritoCombos = "DELETE FROM carrito_combos WHERE IdUsuario = $Usuario";
                     echo $queryLimpiarCarritoCombos;

                     $queryLimpiarCarritoProductos = "DELETE FROM carrito_productos WHERE IdUsuario = $Usuario";
                     mysqli_query($db, $queryLimpiarCarritoProductos);
                 
                     // Puedes redirigir a una página de confirmación o realizar otras acciones después de la confirmación
                     header('Location: confirmacion.php');
                     exit();
    
                    }
                }


incluirTemplate('header');
?>

<main>
    <form method="POST">
        <div class="opciones-proceso">

            <fieldset class="form-direccion">
                <div class="dir-usuario">
                    <label class="proceso-legend">Seleccione una Tarjeta</label>

                    <select name="Tarjeta" id="Tarjeta">
                        <option value="" disabled selected>-- Seleccione --</option>
                        <?php foreach ($tarjetas as $tarjeta) : ?>
                            <option value="<?php echo $tarjeta['idTarjeta']; ?>">
                                <?php echo $tarjeta['Numero_Tarjeta']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <a href="metodoP.php">Agregue una nueva tarjeta</a>
                </div>
            </fieldset>

            <fieldset class="form-direccion">
                <div class="dir-usuario">
                    <label class="proceso-legend">Seleccione una Direccion</label>
                    <select name="Dir_envio" id="Dir_envio">
                        <option value="" disabled selected>-- Seleccione --</option>
                        <?php foreach ($direcciones as $direccion) : ?>
                            <option value = "<?php echo $direccion['idDirección']; ?>" >
                            <?php echo $direccion['Calle']." ".$direccion['Número_de_Casa'].
                            " ".$direccion['Colonia']." ".$direccion['Código_Postal']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <a href="direnvio.php">Agregue una nueva dirección</a>
                </div>
            </fieldset>


            <fieldset class="form-direccion">
                <div class="dir-usuario">
                    <label class="proceso-legend">Confirmación de Pedido</label>
                    <div>
                        <?php
                        // Mostrar productos del carrito
                        foreach ($carritoProductos as $carritoProducto) {
                            echo "<li>{$carritoProducto['Cantidad']} x {$carritoProducto['Nombre']} $" . number_format($carritoProducto['Precio'], 2) . "</li>";
                        }

                        // Mostrar combos del carrito
                        foreach ($carritoCombos as $carritoCombo) {
                            echo "<li>{$carritoCombo['Cantidad']} x {$carritoCombo['Nombre']} $" . number_format($carritoCombo['Precio'], 2) . "</li>";
                        }
                        ?>
                    </div>

                    <p>Total: $<?php
                        $total = 0;

                        // Calcular el total sumando los productos y combos del carrito
                        foreach ($carritoProductos as $carritoProducto) {
                            $total += $carritoProducto['Cantidad'] * $carritoProducto['Precio'];
                        }

                        foreach ($carritoCombos as $carritoCombo) {
                            $total += $carritoCombo['Cantidad'] * $carritoCombo['Precio'];
                        }

                        echo number_format($total, 2);
                        ?></p>

                    <div class="input-carrito">
                        <input type="submit" value="Confirmo mi Pedido" class="input-direccion" name="confirmar">
                    </div>
                </div>
            </fieldset>

        </div>

    </form>
</main>

<script src="build/js/app.js"></script>
</body>
