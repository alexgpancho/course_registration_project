<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CourseRegistration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["cedula"])) {
        $cedula = $_POST["cedula"];
        $result = $conn->query("SELECT Enrollments.id AS enrollment_id, Courses.name AS curso, Enrollments.student_name AS estudiante
                                FROM Enrollments
                                JOIN Courses ON Enrollments.course_id = Courses.id
                                WHERE Enrollments.cedula = '$cedula'");

        echo "<h2>Inscripciones encontradas:</h2>";
        echo "<form method='POST' action='../php/eliminar.php'>";
        echo "<table border='1'>";
        echo "<thead><tr><th>Seleccionar</th><th>Curso</th><th>Estudiante</th></tr></thead><tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='enrollment_ids[]' value='" . $row["enrollment_id"] . "'></td>";
            echo "<td>" . $row["curso"] . "</td>";
            echo "<td>" . $row["estudiante"] . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
        echo "<button type='submit' onclick=\"return confirm('¿Estás seguro de que deseas eliminar los registros seleccionados?');\">Eliminar seleccionados</button>";
        echo "</form>";
    }
}

// Botón para volver a la consulta
echo "<br><a href='../pages/consulta.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 5px;'>Volver a la consulta</a>";

$conn->close();
?>