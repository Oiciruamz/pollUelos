<?php
        require 'includes/funciones.php';

        session_start();

        require 'includes/config/database.php';
        $db = conectarDB();

      

            // Calcular el subtotal para combos en el carrito
            $subtotalCombos = 0;

            if ($resultCombos) {
                while ($filaCombo = mysqli_fetch_assoc($resultCombos)) {
                    // ... (código anterior para mostrar combos)

                    // Calcular y acumular el subtotal
                    $subtotalCombos += $filaCombo['Cantidad'] * $filaCombo['Precio'];
                }
            }

            // Calcular el subtotal total (sumar subtotales de productos y combos)
            $subtotalTotal = $subtotalProductos + $subtotalCombos;


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminarCarrito'])) {
            $idUsuario = $_SESSION['idUsuario'] ?? '';
            $idEliminar = $_POST['idEliminar'];
            $tipoEliminar = $_POST['tipoEliminar'];
        
            // Consulta para eliminar el producto o combo del carrito
            if ($tipoEliminar === 'producto') {
                $consultaEliminar = "DELETE FROM carrito_productos WHERE IdUsuario = $idUsuario AND Producto = $idEliminar";
            } elseif ($tipoEliminar === 'combo') {
                $consultaEliminar = "DELETE FROM carrito_combos WHERE IdUsuario = $idUsuario AND Combo = $idEliminar";
            }
        
            $resultadoEliminar = mysqli_query($db, $consultaEliminar);
        
            // Verifica si la eliminación fue exitosa
            if ($resultadoEliminar) {
                echo "Producto/Combo eliminado del carrito exitosamente.";
                // Puedes redirigir o realizar otras acciones después de la eliminación
            } else {
                echo "Error al intentar eliminar el producto/combo del carrito.";
            }
        }

       
incluirTemplate('header');
?>

<div class="cart-page">
    <table>
        <tr>
            <th>Producto/Combo</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Acciones</th>
        </tr>

        <?php
        // Obtener datos de la tabla carrito_productos
        $idUsuario = $_SESSION['idUsuario'] ?? '';

        // Consulta para productos en el carrito
        $consultaProductos = "SELECT cp.Cantidad, p.idProductos, p.Nombre, p.Precio
                             FROM carrito_productos cp
                             INNER JOIN producto p ON cp.Producto = p.idProductos
                             WHERE cp.IdUsuario = $idUsuario";

        $resultProductos = mysqli_query($db, $consultaProductos);

        $subtotalProductos = 0;

        if ($resultProductos) {
            
            while ($filaProducto = mysqli_fetch_assoc($resultProductos)) {
                $subtotalProductos += $filaProducto['Cantidad'] * $filaProducto['Precio'];
                ?>
                <tr>
                    <td>
                        <div class="cart-info">
                            <p><?php echo $filaProducto['Nombre']; ?></p>
                            <small>Precio: $<?php echo $filaProducto['Precio']; ?></small> <br>
                        </div>
                    </td>
                    <td><input type="number" value="<?php echo $filaProducto['Cantidad']; ?>" /></td>
                    <td>$<?php echo $filaProducto['Cantidad'] * $filaProducto['Precio']; ?></td>
                    <td>
                        
                        <form  method="post">
                            <input type="hidden" name="idEliminar" value="<?php echo $filaProducto['idProductos']; ?>">
                            <input type="hidden" name="tipoEliminar" value="producto">
                            <button type="submit" class="boton-borrar" name="eliminarCarrito">
                                Borrar
                            </button>
                        </form>
                    </td>
                </tr>
            <?php
            }
        }

        // Obtener datos de la tabla carrito_combos
        $consultaCombos = "SELECT cc.Cantidad, c.idCombos, c.Nombre, c.Precio
                          FROM carrito_combos cc
                          INNER JOIN combos c ON cc.Combo = c.idCombos
                          WHERE cc.IdUsuario = $idUsuario";

        $resultCombos = mysqli_query($db, $consultaCombos);
        $subtotalCombos = 0;

        if ($resultCombos) {
            while ($filaCombo = mysqli_fetch_assoc($resultCombos)) {
                $subtotalCombos += $filaCombo['Cantidad'] * $filaCombo['Precio'];
                ?>
                <tr>
                    <td>
                        <div class="cart-info">
                            <p><?php echo $filaCombo['Nombre']; ?></p>
                            <small>Precio: $<?php echo $filaCombo['Precio']; ?></small> <br>
                        </div>
                    </td>
                    <td><input type="number" value="<?php echo $filaCombo['Cantidad']; ?>" /></td>
                    <td>$<?php echo $filaCombo['Cantidad'] * $filaCombo['Precio']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="idEliminar" value="<?php echo $filaCombo['idCombos']; ?>">
                            <input type="hidden" name="tipoEliminar" value="combo">
                            <button type="submit" class="boton-borrar" name="eliminarCarrito">
                                Borrar
                            </button>
                        </form>
                    </td>
                </tr>
            <?php
            }
        }
        ?>
    </table>

       
    <div class="total-price">
        <?php   $subtotalTotal = $subtotalProductos + $subtotalCombos;        ?>
         <table>
            <tr>
                <td>Subtotal Productos</td>
                <td>$<?php echo number_format($subtotalProductos, 2); ?></td>
            </tr>
            <tr>
                <td>Subtotal Combos</td>
                <td>$<?php echo number_format($subtotalCombos, 2); ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td>$<?php echo number_format($subtotalTotal, 2); ?></td>
            </tr>
        </table>
        <form action="confirmar.php" method="post" class="ancho"> 
            <div class="input-carrito">
                <input type="submit" value="Proceder con el Pago" class="input">
            </div>
        </form>
    </div>
</div>

<script src="build/js/app.js"></script>
</body>