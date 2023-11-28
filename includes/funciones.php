<?php

require 'app.php';

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL ."/{$nombre}.php";
}


function estaAutenticado() : bool { 

    session_start();

    $auth = $_SESSION['rol'];

    if($auth == 1 ){
        return true;
    } 
        return false;


}