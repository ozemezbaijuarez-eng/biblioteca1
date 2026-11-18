<?php 
/**
 * Procesa y guarda un nuevo libro en la base de datos de forma segura.
 * 
 * @param mysqli $conexion Objeto de conexión activa a la base de datos.
 * @param string $tituloLibro Título del libro enviado por el formulario.
 * @param string $autorLibro Autor del libro enviado por el formulario.
 * @param string $isbnLibro Código ISBN del libro enviado por el formulario.
 * @return bool Retorna true si la inserción fue exitosa, false en caso contrario.
 */
function insertarLibro($conexion, $tituloLibro, $autorLibro, $isbnLibro) {
    $consultaSql = "INSERT INTO libros (titulo, autor, isbn) " 
                 . "VALUES ('$tituloLibro', '$autorLibro', '$isbnLibro')"; 

    if ($conexion->query($consultaSql) === TRUE) { 
        return true; 
    } 
    
    return false;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    $hostServidor = "fdb1029.awardspace.net"; 
    $usuarioBaseDatos = "4794850_pruebadb"; 
    $passwordBaseDatos = "eviltux00"; 
    $nombreBaseDatos = "4794850_pruebadb"; 

    $conexion = new mysqli(
        $hostServidor, 
        $usuarioBaseDatos, 
        $passwordBaseDatos, 
        $nombreBaseDatos
    );

    if ($conexion->connect_error) { 
        die("Error de conexión: " . $conexion->connect_error); 
    } 

    // Limpiar variables para evitar inyecciones SQL básicas 
    $tituloLibro = $conexion->real_escape_string($_POST['titulo']); 
    $autorLibro = $conexion->real_escape_string($_POST['autor']); 
    $isbnLibro = $conexion->real_escape_string($_POST['isbn']); 

    // Ejecutar función documentada
    if (insertarLibro($conexion, $tituloLibro, $autorLibro, $isbnLibro)) { 
        // Redireccionar de vuelta a la página principal si se guardó con éxito  
        header("Location: index.php?success=1"); 
    } else { 
        echo "Error al guardar el libro: " . $conexion->error; 
    } 

    $conexion->close(); 
} 
?>