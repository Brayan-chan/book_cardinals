<?php
include 'database.php';

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $stmt = $conn->prepare("SELECT id_libro, titulo_libro FROM libros WHERE titulo_libro LIKE ?");
    $likeQuery = "%$query%";
    $stmt->bind_param("s", $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mostrar resultados como sugerencias
    while ($row = $result->fetch_assoc()) {
        echo "<div class='book-suggestion' data-id='" . $row['id_libro'] . "'>" . $row['titulo_libro'] . "</div>";
    }
}
?>
