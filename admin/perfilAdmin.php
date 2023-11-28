<?php

    require '../includes/funciones.php';

    $auth = estaAutenticado();

    if(!$auth){
        header('Location: ./../../POLLUELOS/index.php');
    }
    

    incluirTemplate('header');

?>
    <div class="perfil-Usuario">

    <aside class="opciones-usuario">
               
                    <div class="Usuario">
                        <h2>Perfil Administrador</h2>

                        <p> Bienvenido </p>
                    </div>
        

            <div class="contenedor-opciones">

                
                    <div class="opcion1 aqui">
                         <a href="perfilAdmin.php">
                            <h4>Cuenta</h4>
                         </a>
                    </div>
  
                    <div class="opcion1 ">
                        <a href="productos.php"><h4>Productos</h4></a>
                    </div>                    
                    
                    <div class="opcion1">
                        <a href="combos.php"><h4>Combos</h4></a>
                    </div>

                    <div class="opcion1">
                        <a href="usuarios.php"><h4>Usuarios</h4></a>
                    </div>                    
                    
                    <div class="opcion1">
                        <a href="pedidos.php"><h4>Pedidos</h4></a>
                    </div>                    
                    
                    <div class="opcion1">
                        <a href="ventas.php"><h4>Ventas</h4></a>
                    </div>

                    
 
            </div>
    </aside>

    <main class="utilidades-usuario">

        <img src="../src/img/usuario.png" alt="">

        <div class= "u-usuario">
                    <div class="opcion2">
                     <a href="../metodoP.php"><h4>Correo electronico</h4></a>
                    </div>

                    <div class="opcion2">
                     <a href="../metodoP.php"><h4>Cambiar Contraseña</h4></a>
                    </div>

                    <div class="opcion2">
                     <a href="../cerrar-sesion.php"><h4>Cerrar Sesión</h4></a>
                    </div>
        </div>

    </main>

    </div>




    <script src="../build/js/app.js"></script>
</body>