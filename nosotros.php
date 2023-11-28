<?php 
    require 'includes/funciones.php';
    require '../POLLUELOS/includes/config/database.php';
    $db = conectarDB();

    $errores = [];
    $email = '';
    $pass = '';
  


    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $email = mysqli_real_escape_string($db, $_POST['correo']);
        $pass = mysqli_real_escape_string($db, $_POST['contrasena']);
      
   
        if(!$email){
            $errores[] = "Debes añadir un email";
         }
        if(!$pass){
        $errores[] = "Debes añadir una contraseña";
        }

        
    
        if(empty($errores)){
            exit;
            $query = "INSERT INTO contacto (Nombre, Correo_Electronico, Comentario, Fecha) VALUES ('{$nombre}', '{$email}', '{$mensaje}', '{$fecha}');";
            $resultado = mysqli_query($db, $query);

             if($resultado){
                        header("Location: /POLLUELOS/index.html");
                }
        }
    }

    incluirTemplate('header');
   
?>

<main class="main-nosotros">

    <div class="contenido-nosotros">

        <h1>Sobre Nosotros</h1>

        <div class="texto-nosotros">
            <p>
                Bienvenidos a nuestro restaurante de pollos asados, donde la pasión por la buena comida se une con la tradición de sabores inigualables. 
    
                Nuestra historia se teje con el aroma irresistible de pollos cuidadosamente seleccionados y sazonados con recetas transmitidas de generación en generación. 
    
                Desde nuestro humilde comienzo, nos hemos dedicado a perfeccionar el arte de asar pollos hasta alcanzar la jugosidad y el sabor que nos distinguen. 
                Cada visita a nuestro establecimiento es un viaje a través de una experiencia gastronómica única, donde la calidad, la atención al detalle y el amor por la cocina se combinan para ofrecer momentos inolvidables a todos y cada uno de nuestros comensales. Únete a nosotros para explorar el mundo de los pollos asados como nunca antes lo habías probado.
            </p>

        </div>
        

        <div class="cuadro-rojo">

            <div class="mision">
                <h2>NUESTRA MISIÓN</h2>
                <p>
                    Ser una empresa fortalecida con personal capacitado, comprometido a servir y dar la mejor atención a nuestros clientes.
                </p>
    
            </div>
        </div>
    </div>

    <div class = "nosotros-img">
        <img src="src/img/nosotros.jpg"  class ="servidos">
    </div>

</main>





    <script src="build/js/app.js"></script>
</body>