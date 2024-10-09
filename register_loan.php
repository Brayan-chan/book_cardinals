<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $id_libro = $_POST['id_libro'];
    $fecha_devolucion = $_POST['fecha_devolucion'];

    $query = "INSERT INTO prestamos (id_usuario, id_libro, fecha_devolucion) VALUES ('$id_usuario', '$id_libro', '$fecha_devolucion')";

    if (mysqli_query($conn, $query)) {
        echo "Préstamo registrado exitosamente.";
    } else {
        echo "Error al registrar préstamo: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
