<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre_usuario'];
    $email = $_POST['email'];

    // Iniciar una transacción para respetar ACID
    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombre, $email);
        $stmt->execute();

        // Confirmar la transacción
        $conn->commit();
        echo "Usuario registrado exitosamente.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error al registrar usuario: " . $e->getMessage();
    }
    $stmt->close();
}
$conn->close();
?>
