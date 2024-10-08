<?php
include 'database.php';

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $stmt = $conn->prepare("SELECT id_usuario, nombre_usuario, email_usuario FROM usuarios WHERE nombre_usuario LIKE ? OR email_usuario LIKE ?");
    $likeQuery = "%$query%";
    $stmt->bind_param("ss", $likeQuery, $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mostrar resultados como sugerencias
    while ($row = $result->fetch_assoc()) {
        echo "<div class='user-suggestion' data-id='" . $row['id_usuario'] . "'>" . $row['nombre_usuario'] . " (" . $row['email_usuario'] . ")</div>";
    }
}
?>
