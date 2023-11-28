<?php

  
    require '../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: ./../../POLLUELOS/index.php');
    }


    // Importar la conexión
    require '../includes/config/database.php';
    $db = conectarDB();


    
    $query = "SELECT * FROM combos";

    
    // Consultar la BD

    $resultadoConsulta = mysqli_query($db, $query);


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            

            $query = "DELETE FROM rel_combos_productos WHERE ComboId = {$id}";
            $resultado = mysqli_query($db, $query);

            $query = "DELETE FROM combos WHERE idCombos = {$id}";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /POLLUELOS/admin/combos.php');
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
                    
                    <div class="opcion1 aqui">
                        <a href="combos.php"><h4>Combos</h4></a>
                    </div>

                    <div class="opcion1 ">
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


        <a href="CRUD/crearCombo.php" class = "crear"> Combo Nuevo </a>

        <table class="productos-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!--Mostrar los Resultados -->
            <?php while($producto = mysqli_fetch_assoc($resultadoConsulta)):?>
                <tr>
                    <td><?php echo $producto['idCombos']; ?></td>
                    <td><?php echo $producto['Nombre']; ?></td>
                    <td class = "borrar">
                    <div>
                        <img src="../imagenesCombos/<?php echo $producto['Imagen']; ?>" alt="idk" class = "imagen-tabla">
                    </div>
                    </td>
                    <td> $<?php echo $producto['Precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $producto['idCombos']; ?>" /> 
                            <input type="submit" class ="eliminar" value="Eliminar">
                        </form>
                    
                        <a href= "../admin/CRUD/actualizarCombo.php?id=<?php echo $producto['idCombos']; ?>" class="boton">
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