<?php 
function conexionSQL(){
    $pdo = new PDO("mysql:host=localhost;dbname=solucionprueba", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $pdo;

}

?>