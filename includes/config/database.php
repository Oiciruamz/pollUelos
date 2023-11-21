<?php

function conectarDB() : mysqli{

    $db = mysqli_connect('localhost', 'root', 'safonails07', 'POLLUELOS');

    if(!$db){
        echo "Error no se pudo conectar";
        exit;
    } 


    return $db;
}
