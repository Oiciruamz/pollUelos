<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Polluelos</title>
</head>

<body>

    <header class = "header">
        <div class = "contenido-header">

            <div class = "mobile-menu">
                <img src="src/img/barras.svg" alt="" class="icono-barras">
            </div>
    
            <nav class = "navegacion">
                <a href="index.php">Inicio</a>
                <a href="menuP.php">Menú</a>
                <a href="contacto.php">Contacto</a>
                <a href="nosotros.php">Nosotros</a>
            </nav>
    
    
            <div class="iconos">
                <a href="#">
                    <img src="src/img/carro.png" alt="" class = "icono">
                </a>
                <a href="login.php">
                    <img src="src/img/usuario.png" alt="" class = "icono">
                </a>
            </div>
    

        </div>
    </header>

    <div class = "banner"></div>

    <div class="centrado ">
        <nav class="selecion">
            <a href="menuP.php" class = "rojo">Productos</a>
            <a href="menuC.php">Combos</a>
        </nav>
    </div>


    <div class="contenedor-anuncios">

            <div class="anuncio">
                <picture>
                    <img loading = "lazy" src="src/img/polloPlato.png" alt="anuncio" loading="lazy">
                </picture>
                <div class="contenido-anuncio">
                    <p class="precio">$140</p>
                    <h3>Un pollo asado</h3>
                    <p>Delicioso Pollo Asado</p>
    
                        
                    <a href="anuncio.php" class="boton-carrito">
                        <img src="src/img/alcarrito.svg"  alt="">
                    </a>
                </div>
            </div>

            <div class="anuncio">
                <picture>
                    <img loading = "lazy" src="src/img/medioPollo.png" alt="anuncio" loading="lazy">
                </picture>
                <div class="contenido-anuncio">
                    <p class="precio">$100</p>
                    <h3>Medio Pollo</h3>
                    <p>Medio Pollo Asado para Compartir</p>

                    <a href="" class="boton-carrito">
                        <img src="src/img/alcarrito.svg"  alt="">
                    </a>
                </div>
            </div>

    </div>
    

    <script src="build/js/app.js"></script>
</body>