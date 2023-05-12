<?php
// Este archivo recibe datos de formulario para hacer algo con ellos
session_start(); 
$nombre = $_SESSION['nombre'];
if (!$nombre){
    header("Location: ./index.php");
}


include './basededatos.php';
$bd = new basededatos;

if (isset($_POST['addswitch'])){ // Crear un nuevo switch
    $nombre = $_POST['nombre'];
    $puertos = intval($_POST['puertos']);
    $bd->creaSwitches($nombre, $puertos);
    return header('Location: ./app.php');
}

if (isset($_POST['modificarpuerto'])){
    $descripcion = $_POST['descripcion'];
    $cod = $_POST['cod'];
    $bd->modificaPuerto($cod, $descripcion);
    return header("Location: ./app?cod=$cod");
}
?>