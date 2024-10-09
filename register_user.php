<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_usuario'];
    $email = $_POST['email_usuario'];

    $query = "INSERT INTO usuarios (nombre_usuario, email) VALUES ('$nombre', '$email')";

    if (mysqli_query($conn, $query)) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error al registrar usuario: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
