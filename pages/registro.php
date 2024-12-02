
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro de Cursos - UTPL</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>
        <header>
            <h1>Registro de Cursos - UTPL</h1>
            <nav>
                <ul>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="consulta.php">Consulta de Inscripciones</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <h2>Formulario de Registro</h2>
            <form action="../php/register.php" method="POST">
                <div>
                    <label for="curso">Curso:</label><br>
                    <select id="curso" name="curso_id" required>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "CourseRegistration");
                        if ($conn->connect_error) {
                            die("Error en la conexión: " . $conn->connect_error);
                        }
                        $result = $conn->query("SELECT id, name, available_slots, total_slots FROM Courses WHERE available_slots > 0");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["name"] . " (" . $row["available_slots"] . "/" . $row["total_slots"] . " plazas)</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <!-- Campos adicionales -->
                <div>
                    <label for="nombre">Nombre del Estudiante:</label><br>
                    <input type="text" id="nombre" name="student_name" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+">
                </div>
                <div>
                    <label for="edad">Edad:</label><br>
                    <input type="number" id="edad" name="edad" required min="15" max="100">
                </div>
                <div>
                    <label for="genero">Género:</label><br>
                    <select id="genero" name="genero" required>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div>
                    <label for="cedula">Cédula:</label><br>
                    <input type="text" id="cedula" name="cedula" required pattern="\d{10}">
                </div>
                <div>
                    <label for="correo">Correo Electrónico:</label><br>
                    <input type="email" id="correo" name="email" required>
                </div>
                <div>
                    <button type="submit">Registrar</button>
                </div>
            </form>
        </div>
    </body>
    </html>
    