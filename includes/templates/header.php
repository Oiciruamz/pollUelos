
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../pollUelos/build/css/app.css">
    <title>Polluelos</title>
</head>

<body class = "<?php echo $inicio ? 'background' : '';?>" >

    <header class = "header">
        <div class = "contenido-header">

            <div class = "mobile-menu">
                <img src="../../../pollUelos/src/img/barras.svg" alt="" class="icono-barras">
            </div>
    
            <nav class = "navegacion">
                <a href="/POLLUELOS/index.php">Inicio</a>
                <a href="/POLLUELOS/menuP.php">Menú</a>
                <a href="/POLLUELOS/contacto.php">Contacto</a>
                <a href="/POLLUELOS/nosotros.php">Nosotros</a>
            </nav>
    
    
            <div class= "iconos">
                <a href="<?php 
                        if(isset($_SESSION['rol'])){
                            if($_SESSION['rol'] == 2){
                                echo "carrito.php";
                            } elseif($_SESSION['rol'] == 1){
                                echo "admin/perfilAdmin.php";
                            } else {
                                echo "login.php"; 
                            }
                        } else {
                            echo "login.php"; 
                        }
                    ?>">
                    <img src="../../../pollUelos/build/img/carro.png" alt="" class = "icono">
                </a>
                
                <a href="<?php 
                        if(isset($_SESSION['rol'])){
                            if($_SESSION['rol'] == 2){
                                echo "perfilU.php";
                            } elseif($_SESSION['rol'] == 1){
                                echo "admin/perfilAdmin.php";
                            } else {
                                echo "login.php"; 
                            }
                        } else {
                            echo "login.php"; 
                        }
                    ?>">
                    <img src="../../../pollUelos/build/img/usuario.png" alt="" class = "icono">
                </a>
            </div>
    

        </div>
    </header>
