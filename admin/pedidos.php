<?php

  
    require '../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: ./../../POLLUELOS/index.php');
    }


    // Importar la conexión
    require '../includes/config/database.php';
    $db = conectarDB();


    
    $query = "SELECT * FROM ventas";

    
    // Consultar la BD

    $resultadoConsulta = mysqli_query($db, $query);


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            
            $query = "DELETE FROM ventas WHERE idVenta = {$id}";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /POLLUELOS/admin/productos.php');
            }
        }
    }

    incluirTemplate('header');
?>


    <div class="perfil-Usuario">

    <aside class="opciones-usuario">
               
                    <div class="Usuario">
                        <h2>Perfil Administrador</h2>

                        <p>Bienvenido</p>
                    </div>
        

            <div class="contenedor-opciones">

                
                    <div class="opcion1 ">
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

                    <div class="opcion1 ">
                        <a href="usuarios.php"><h4>Usuarios</h4></a>
                    </div>                    
                    
                    <div class="opcion1 aqui">
                        <a href="pedidos.php"><h4>Pedidos</h4></a>
                    </div>                    
                    
                    <div class="opcion1">
                        <a href="ventas.php"><h4>Ventas</h4></a>
                    </div>
                                   
            </div>
    </aside>

    <main class="productos">


        <table class="productos-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Usuario</th>
                    <th>Direccion</th>
                    <th>Estado Pedido</th>
                    <th>Método de Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!--Mostrar los Resultados -->
            <?php while($producto = mysqli_fetch_assoc($resultadoConsulta)):?>
                <tr>
                    <td><?php echo $producto['idVenta']; ?></td>
                    <td><?php echo $producto['Usuario_Id']; ?></td>
                    <td><?php echo $producto['Direccion']; ?></td>
                    <td><?php echo $producto['Estado_Pedido']; ?></td>
                    <td><?php echo $producto['Metodo_de_Pago']; ?></td>
                    <td>
                        <a href="" class="boton"> Actualizar </a>
                        
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>

        </table>



    </main>

    </div>




    <script src="../build/js/app.js"></script>
</body>