<?php 
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

/**
 * Obtiene la lista completa de libros ordenados por ID de forma descendente.
 * 
 * @param mysqli $conexion Instancia de la conexión a la base de datos.
 * @return mysqli_result|false Conjunto de resultados de la consulta o false si falla.
 */
function obtenerInventarioLibros($conexion) {
    return $conexion->query("SELECT * FROM libros ORDER BY id DESC");
}

// Obtener los libros existentes usando la función documentada
$resultadoLibros = obtenerInventarioLibros($conexion); 
?>
<!DOCTYPE html> 
<html lang="es"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Control de Biblioteca</title> 
    <link rel="stylesheet" href="styles.css"> 
</head> 
<body> 
    <header> 
        <h1>Sistema de Control de Biblioteca</h1> 
    </header> 
    
    <main class="container"> 
        <!-- Formulario para agregar libros --> 
        <section class="card"> 
            <h2>Registrar Nuevo Libro</h2> 
            <form id="formLibro" action="guardar.php" method="POST"> 
                <div class="form-group"> 
                    <label for="titulo">Título del Libro:</label> 
                    <input type="text" id="titulo" name="titulo" required> 
                </div> 
                <div class="form-group"> 
                    <label for="autor">Autor:</label> 
                    <input type="text" id="autor" name="autor" required> 
                </div> 
                <div class="form-group"> 
                    <label for="isbn">ISBN:</label> 
                    <input type="text" id="isbn" name="isbn" required> 
                </div> 
                <button type="submit" class="btn">Guardar Libro</button> 
            </form> 
        </section> 
        
        <!-- Tabla de libros en la Base de Datos --> 
        <section class="card table-container"> 
            <h2>Inventario de Libros</h2> 
            <table id="tablaLibros"> 
                <thead> 
                    <tr> 
                        <th>ID</th> 
                        <th>Título</th> 
                        <th>Autor</th> 
                        <th>ISBN</th> 
                        <th>Estado</th>
                    </tr> 
                </thead> 
                <tbody> 
                    <?php if ($resultadoLibros && $resultadoLibros->num_rows > 0): ?> 
                        <?php while ($filaLibro = $resultadoLibros->fetch_assoc()): ?> 
                            <tr> 
                                <td><?php echo $filaLibro['id']; ?></td> 
                                <td><strong><?php echo htmlspecialchars($filaLibro['titulo']); ?></strong></td> 
                                <td><?php echo htmlspecialchars($filaLibro['autor']); ?></td> 
                                <td><?php echo htmlspecialchars($filaLibro['isbn']); ?></td> 
                                <td> 
                                    <span class="badge <?php echo $filaLibro['disponible'] ? 'dispo' : 'prestado'; ?>"> 
                                        <?php echo $filaLibro['disponible'] ? 'Disponible' : 'Prestado'; ?> 
                                    </span> 
                                </td> 
                            </tr> 
                        <?php endwhile; ?> 
                    <?php else: ?> 
                        <tr> 
                            <td colspan="5" style="text-align: center;">No hay libros registrados.</td> 
                        </tr> 
                    <?php endif; ?> 
                </tbody> 
            </table> 
        </section> 
    </main> 
    
    <script src="script.js"></script> 
</body> 
</html> 
<?php 
$conexion->close(); 
?>