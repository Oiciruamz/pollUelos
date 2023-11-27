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
            <a href="menuP.php">Productos</a>
            <a href="menuC.php" class = "rojo">Combos</a>
        </nav>
    </div>


    <div class="contenedor-anuncios">

        <div class="anuncio">
            <picture>
                <img loading = "lazy" src="src/img/combo1.svg" alt="anuncio" loading="lazy">
            </picture>
            <div class="contenido-anuncio">
                <p class="precio">$230</p>
                <h3>Combo 1</h3>
                <p>Contiene: Un pollo asado, tortillas, Coca cola 2.5 L</p>

                    
                <a href="anuncio.php" class="boton-carrito">
                    <img src="src/img/alcarrito.svg"  alt="">
                </a>
            </div>
        </div>
        
        <div class="anuncio">
            <picture>
                <img loading = "lazy" src="src/img/combo2.svg" alt="anuncio" loading="lazy">
            </picture>
            <div class="contenido-anuncio">
                <p class="precio">$170</p>
                <h3>Combo 2</h3>
                <p>Contiene: Medio pollo asado, tortillas, Coca cola 1.5L <br> salsas</p>
                  
                <a href="anuncio.php" class="boton-carrito">
                    <img src="src/img/alcarrito.svg"  alt="">
                </a>
            </div>
        </div>

</div>
    

    <script src="build/js/app.js"></script>
</body>