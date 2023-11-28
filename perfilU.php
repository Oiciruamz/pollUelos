<?php 
    require 'includes/funciones.php';

    session_start();

    $Usuario = $_SESSION['idUsuario'] ?? '';

    require '../POLLUELOS/includes/config/database.php';
    $db = conectarDB();

    $consulta = "SELECT * FROM usuarios WHERE idUsuarios = {$Usuario}";
    $resultado = mysqli_query($db, $consulta);
    $usuario = mysqli_fetch_assoc($resultado);

    incluirTemplate('header');
   
?>

<div class="perfil-Usuario">

    <aside class="opciones-usuario">
               
                    <div class="Usuario">
                        <h2>Perfil Usuario</h2>

                        <p>Hola <?php echo $usuario['Nombre']." ".$usuario['Apellido'];?></p>
                    </div>
        

            <div class="contenedor-opciones">

                
                    <div class="opcion1 aqui">
                         <a href="3">
                            <h4>Cuenta</h4>
                         </a>
                    </div>


                    <div class="opcion1">
                        <a href="direnvio.php"><h4>Agregar Dirección de Envío</h4></a>
                    </div>
               

                    <div class="opcion1">
                        <a href="metodoP.php"><h4>Agregar Método de Pago</h4></a>
                    </div>
 
            </div>
    </aside>

    <main class="utilidades-usuario">

        <img src="src/img/usuario.png" alt="">

        <div class= "u-usuario">
                    <div class="opcion2">
                     <a href="metodoP.php"><h4><?php echo $usuario['Email']?></h4></a>
                    </div>
                    
                    <div class="opcion2">
                     <a href="cerrar-sesion.php"><h4>Cerrar Sesión</h4></a>
                    </div>
        </div>

    </main>

    </div>




    <script src="build/js/app.js"></script>
</body>