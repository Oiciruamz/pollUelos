<?php

    require 'includes/funciones.php';

    require 'includes/config/database.php';
    $db = conectarDB();

    $query = "SELECT * FROM producto";

    $resultadoConsulta = mysqli_query($db, $query);








    incluirTemplate('header');
?>

    <main>

        <div class = "opciones-proceso">

        <fieldset class= "form-direccion">
                <div class="dir-usuario">
                        <label class="proceso-legend" >Seleccione una Tarjeta</label>
                        <select name="Dir-envio" id="Dir-envio">
                            <option value="" disabled selected>-- Seleccione --</option>
                            <option value="1">4123 3940 4901 2909</option>        
                        </select>

                        <div class="input-carrito">
                        <input type="submit" value="Agregar Tarjeta" class="input-direccion">
                        </div>
                </div>

            </fieldset>

            <fieldset class= "form-direccion">
                <div class="dir-usuario">
                        <label class="proceso-legend" >Confirmación de Pedido</label>
                        <div>
                            <li>Pollo asado $230</li>
                            <li>Pollo asado $230</li>
                            <li>Pollo asado $230</li>
                        </div>

                        <p>Total: $230</p>
                        <div class="input-carrito">
                        <input type="submit" value="Confirmo mi Pedido" class="input-direccion">
                        </div>
                </div>
            </fieldset>

        </div>   
        

    </main>



    
 <script src="build/js/app.js"></script>
</body>