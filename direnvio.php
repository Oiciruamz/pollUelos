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

        $calle = mysqli_real_escape_string($db, $_POST['calle']);
        $numCasa = mysqli_real_escape_string($db, $_POST['numCasa']);
        $colonia = mysqli_real_escape_string($db, $_POST['colonia']);
        $cp = mysqli_real_escape_string($db, $_POST['cp']);
        $senas = mysqli_real_escape_string($db, $_POST['senas']);
      
   
        if(!$calle){
            $errores[] = "Debes añadir una calle";
         }
        if(!$numCasa){
        $errores[] = "Debes añadir un número de casa";
        }           
        if(!$colonia){
             $errores[] = "Debes añadir una colonia";
        }        
        if (!$idUsuario) {
            $errores[] = "No se puede obtener el Usuario de la sesión";
        }      
        if(!$cp){
            $errores[] = "Debes añadir un código postal";
        }     
        
        if(!$senas){
            $errores[] = "Debes añadir al  una seña particular";
            }       

        
    
        if(empty($errores)){
            $query = "INSERT INTO dirección (IDUSER, Calle, Número_de_Casa, Colonia, Código_Postal, Señas_Particulares) VALUES ({$idUsuario}, '{$calle}', '{$numCasa}', '{$colonia}', '{$cp}', '{$senas}');";
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                header("Location: /POLLUELOS/metodoP.php");
        }
    }
}
   
 incluirTemplate('header', $inicio = true);
?>



    <main class ="background-registro seccion">
        
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                     <?php echo $error;?>
            </div>
         <?php endforeach; ?>

        <form  method="POST"  class = "registro-form">
            <fieldset class = "ok">

            <h1>Direccion de Envío</h1>

            <input type="text" placeholder="Calle" name = "calle" id="calle"
            value = "<?php echo $calle; ?>">

            <input type="text" placeholder="Número de Casa" name = "numCasa" id="numCasa"
            value = "<?php echo $numCasa; ?>">

            <input type="text" placeholder="Colonia" name = "colonia" id="colonia"
            value = "<?php echo $colonia; ?>">            

            <input type="text" placeholder="Código Postal" name = "cp" id="cp"
            value = "<?php echo $cp; ?>">  

            <input type="text" placeholder="Señas Particulares del Domicilio" name = "senas" id="senas"
            value = "<?php echo $senas; ?>">
            
            <input type="submit" value = "Agregar Dirección" class = "boton-amarillo">

            </fieldset>

        </form>

    </main>




    <script src="build/js/app.js"></script>
</body>