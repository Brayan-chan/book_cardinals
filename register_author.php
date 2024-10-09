<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_autor = $_POST['nombre_autor'];

    $query = "INSERT INTO autores (nombre_autor) VALUES ('$nombre_autor')";

    if (mysqli_query($conn, $query)) {
        echo "Autor registrado exitosamente.";
    } else {
        echo "Error al registrar autor: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
