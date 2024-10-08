<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo_libro'];
    $anio = $_POST['anio_publicacion'];
    $genero = $_POST['genero'];
    $autores = explode(',', $_POST['autores']);  // Convertir autores a un array

    // Iniciar una transacción para respetar ACID
    $conn->begin_transaction();

    try {
        // Insertar el libro en la tabla `libros`
        $stmt_libro = $conn->prepare("INSERT INTO libros (titulo_libro, anio_publicacion, genero) VALUES (?, ?, ?)");
        $stmt_libro->bind_param("sis", $titulo, $anio, $genero);
        $stmt_libro->execute();
        $id_libro = $stmt_libro->insert_id;

        // Insertar cada autor y establecer la relación
        foreach ($autores as $autor) {
            $autor = trim($autor);
            $stmt_autor = $conn->prepare("INSERT INTO autores (nombre_autor) VALUES (?) ON DUPLICATE KEY UPDATE id_autor=LAST_INSERT_ID(id_autor)");
            $stmt_autor->bind_param("s", $autor);
            $stmt_autor->execute();
            $id_autor = $stmt_autor->insert_id;

            // Establecer la relación en la tabla `libros_autores`
            $stmt_libro_autor = $conn->prepare("INSERT INTO libros_autores (id_libro, id_autor) VALUES (?, ?)");
            $stmt_libro_autor->bind_param("ii", $id_libro, $id_autor);
            $stmt_libro_autor->execute();
        }

        $conn->commit();
        echo "Libro registrado exitosamente.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error al registrar libro: " . $e->getMessage();
    }
}
$conn->close();
?>
