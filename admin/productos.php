<?php

  
    require '../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: ./../../POLLUELOS/index.php');
    }


    // Importar la conexión
    require '../includes/config/database.php';
    $db = conectarDB();


    
    $query = "SELECT * FROM producto";

    
    // Consultar la BD

    $resultadoConsulta = mysqli_query($db, $query);


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){

            $query = "SELECT Imagen FROM producto WHERE idProductos = {$id}";

            $resultado = mysqli_query($db, $query);
            $producto = mysqli_fetch_assoc($resultado);
            
            unlink('../imagenesProductos/'.$producto['Imagen']);

            $query = "DELETE FROM producto WHERE idProductos = {$id}";

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

                        <p> Bienvenido </p>
                    </div>
        

            <div class="contenedor-opciones">

                
                    <div class="opcion1">
                         <a href="perfilAdmin.php">
                            <h4>Cuenta</h4>
                         </a>
                    </div>

                    <div class="opcion1 aqui">
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

    <main class="productos">


        <a href="CRUD/crearProductos.php" class = "crear"> Producto Nuevo </a>

        <table class="productos-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th class ="borrar">Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!--Mostrar los Resultados -->
            <?php while($producto = mysqli_fetch_assoc($resultadoConsulta)):?>
                <tr>
                    <td><?php echo $producto['idProductos']; ?></td>
                    <td><?php echo $producto['Nombre']; ?></td>
                    <td class ="borrar" >
                        <div>
                        <img src="../imagenesProductos/<?php echo $producto['Imagen']; ?>" alt="idk" class = "imagen-tabla">
                        </div>
                    </td>
                    <td> $<?php echo $producto['Precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $producto['idProductos']; ?>" /> 
                            <input type="submit" class ="eliminar" value="Eliminar">
                        </form>
                    
                        <a href= "../admin/CRUD/actualizarProducto.php?id=<?php echo $producto['idProductos']; ?>" class="boton">
                       
                       Actualizar </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>

        </table>



    </main>

    </div>




    <script src="../build/js/app.js"></script>
</body>