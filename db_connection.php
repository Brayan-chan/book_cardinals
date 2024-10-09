<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "libreria_db";

// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $database);

// Revisar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
