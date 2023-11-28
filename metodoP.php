<?php
    // Importar la conexión
    require 'includes/funciones.php';
    session_start();

    require '../POLLUELOS/includes/config/database.php';
    $db = conectarDB();

    $idUsuario = $_SESSION['idUsuario'] ?? '';

    $errores = [];
    $email = '';
    $pass = '';
  


    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
        $numero = mysqli_real_escape_string($db, $_POST['tarjeta']);
        $fecha = mysqli_real_escape_string($db, $_POST['fecha']);
        $cvv = mysqli_real_escape_string($db, $_POST['cvv']);
      
        
        if (!$idUsuario) {
            $errores[] = "No se puede obtener el Usuario de la sesión";
        }      
        if(!$nombre){
            $errores[] = "Debes añadir un nombre";
         }
        if(!$numero){
        $errores[] = "Debes añadir una número de tarjeta";
        }
        if(!$fecha){
            $errores[] = "Debes añadir una fecha";
            }       
         if(!$cvv){
                $errores[] = "Debes añadir los digitos CVV";
            }
        
    
        if(empty($errores)){
            $query = "INSERT INTO tarjeta (Usuario, Nombre_Titular,
            Numero_Tarjeta, Fecha_Vencimiento, CVV)
             VALUES ('{$idUsuario}','{$nombre}', '{$numero}', '{$fecha}', {$cvv});";
            $resultado = mysqli_query($db, $query);
            
             if($resultado){
                        header("Location: /POLLUELOS/index.php");
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

        <form  method="POST"  class = "registro-form">
            <fieldset class = "ok">

            <h1>Infromación de Pago</h1>

            <div class = "iconosPago">
                <img src="src/img/294654_visa_icon.png" alt="">
                <img src="src/img/1156750_finance_mastercard_payment_icon.svg" alt="">
                <img src="src/img/american-express.png" alt="">
            </div>
           

            <input type="text" placeholder="Nombre del Titular" name = "nombre" id="nombre"
            value = "<?php echo $nombre; ?>">

            <input type="text" placeholder="Número de tarjeta" name = "tarjeta" id="tarjeta"
            value = "<?php echo $numero; ?>">            

            <input type="month" placeholder="Fecha de Vencimiento (MM/YY)" name = "fecha" id="fecha"
            value = "<?php echo $fecha; ?>" maxlength="5"/>  

            <input type="text" placeholder="CVV" name = "cvv" id="cvv"
            value = "<?php echo $cvv; ?>" maxlength="4">
            
            <input type="submit" value = "Agregar Tarjeta" class = "boton-amarillo">

            </fieldset>

        </form>

    </main>




    <script src="build/js/app.js"></script>
</body>