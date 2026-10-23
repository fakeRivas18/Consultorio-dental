<?php



$conex = mysqli_connect("localhost", "root", "", "consultorio_dental");

if (!$conex) {
    die("Error al conectar: " . mysqli_connect_error());
}
?>