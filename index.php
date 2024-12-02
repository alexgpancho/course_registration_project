
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscripción de Cursos - UTPL</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <header>
            <h1>Bienvenido al Sistema de Inscripción de Cursos - UTPL</h1>
            <nav>
                <ul>
                    <li><a href="pages/registro.php">Registro de Cursos</a></li>
                    <li><a href="pages/consulta.php">Consulta de Inscripciones</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <h2>Cursos Disponibles</h2>
            <p>Explora nuestra oferta académica y regístrate de manera sencilla.</p>
            <table>
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Descripción</th>
                        <th>Plazas</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = new mysqli("localhost", "root", "", "CourseRegistration");
                    if ($conn->connect_error) {
                        die("Error en la conexión: " . $conn->connect_error);
                    }
                    $result = $conn->query("SELECT id, name, description, total_slots, available_slots, image_path FROM Courses");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["available_slots"] . "/" . $row["total_slots"] . "</td>";
                        echo "<td><img src='" . $row["image_path"] . "' alt='Imagen del curso' style='width:100px;'></td>";
                        echo "</tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </body>
    </html>
    