<?php
    require 'includes/funciones.php';

    require 'includes/config/database.php';
    $db = conectarDB();

    $query = "SELECT * FROM producto";

    $resultadoConsulta = mysqli_query($db, $query);




 

 


    incluirTemplate('header');
?>

    <div class=" cart-page">

        <table>

            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>      
            </tr>

            <tr>
                <td>
                    <div class="cart-info">
                        <img src="src/img/medioPollo.png"/>
                        <div>
                            <p>Pollo asado</p>
                            <small>Price: $50.00</small> <br>
                            <a href="">Borrar</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"/></td>
                <td>$50.00</td>
            </tr>
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="src/img/medioPollo.png"/>
                        <div>
                            <p>Pollo asado</p>
                            <small>Price: $50.00</small> <br>
                            <a href="">Borrar</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"/></td>
                <td>$50.00</td>
            </tr>
        </table>


        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$200.00</td>
                </tr>                
                <tr>
                    <td>Impuesto</td>
                    <td>$20.00</td>
                </tr>                
                <tr>
                    <td>Total</td>
                    <td>$220.00</td>
                </tr>
                <tr  rowspan="2">
                    <td colspan="2">
                        <div class="input-carrito">
                        <input type="submit" value="Proceder con el Pago" class="input">
                        </div>
                     </td>
                </tr>
                    
            </table>
        </div>

    </div>




    
 <script src="build/js/app.js"></script>
</body>