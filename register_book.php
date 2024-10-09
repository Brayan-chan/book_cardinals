<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo_libro'];
    $anio = $_POST['anio_publicacion'];
    $genero = $_POST['genero'];
    $id_autores = $_POST['id_autor'];

    $query_libro = "INSERT INTO libros (titulo_libro, anio_publicacion, genero) VALUES ('$titulo', '$anio', '$genero')";

    if (mysqli_query($conn, $query_libro)) {
        $id_libro = mysqli_insert_id($conn);

        foreach ($id_autores as $id_autor) {
            $query_relacion = "INSERT INTO libros_autores (id_libro, id_autor) VALUES ('$id_libro', '$id_autor')";
            mysqli_query($conn, $query_relacion);
        }

        echo "Libro y autores registrados exitosamente.";
    } else {
        echo "Error al registrar libro: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
