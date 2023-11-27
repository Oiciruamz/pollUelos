<?php

    require 'includes/funciones.php';

    require 'includes/config/database.php';
    $db = conectarDB();

    $query = "SELECT * FROM producto";

    $resultadoConsulta = mysqli_query($db, $query);








    incluirTemplate('header');
?>

    <main>

        <div class="confirmado">
            <img src="src/img/verificado.png">

            <p>¡Pedido realizado con éxito en breve recibirás un correo 
                electrónico con el estado de tu pedido!</p>
        </div>


    </main>



    
 <script src="build/js/app.js"></script>
</body>