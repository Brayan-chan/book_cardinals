<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $id_libro = $_POST['id_libro'];
    $fecha_devolucion = $_POST['fecha_devolucion'];

    // Iniciar una transacción para respetar ACID
    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO prestamos (id_usuario, id_libro, fecha_devolucion) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $id_usuario, $id_libro, $fecha_devolucion);
        $stmt->execute();

        $conn->commit();
        echo "Préstamo registrado exitosamente.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error al registrar préstamo: " . $e->getMessage();
    }
}
$conn->close();
?>
