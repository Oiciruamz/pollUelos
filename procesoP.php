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
                        <label class="proceso-legend" >Seleccione dirección de envío</label>
                        <select name="Dir-envio" id="Dir-envio">
                            <option value="" disabled selected>-- Seleccione --</option>
                            <option value="1">Garza #5609 Valle Verde 2do Sector 64117</option>        
                        </select>

                        <div class="input-carrito">
                        <input type="submit" value="Agregar Direccion" class="input-direccion">
                        </div>
                </div>

            </fieldset>

            <fieldset class= "form-direccion">
                <div class="dir-usuario">
                        <label class="proceso-legend" >Seleccione un Método de Pago</label>
                        <select name="metodo-pago" id="metodo-pago">
                            <option value="" disabled selected>-- Seleccione --</option>
                            <option value="1">Tarjeta de Crédito o Débito</option>        
                            <option value="2">Efectivo</option>        
                        </select>

                        <div class="input-carrito">
                        <input type="submit" value="Continuar Proceso" class="input-direccion">
                        </div>
                </div>
            </fieldset>

        </div>

        
        

    </main>



    
 <script src="build/js/app.js"></script>
</body>