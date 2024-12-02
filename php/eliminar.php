
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "CourseRegistration";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enrollment_ids"])) {
        $enrollment_ids = $_POST["enrollment_ids"];
        foreach ($enrollment_ids as $id) {
            $id = intval($id);
            // Recuperar el curso asociado al registro para incrementar los available_slots
            $result = $conn->query("SELECT course_id FROM Enrollments WHERE id = $id");
            $row = $result->fetch_assoc();
            $course_id = $row["course_id"];

            // Eliminar el registro de inscripción
            $conn->query("DELETE FROM Enrollments WHERE id = $id");

            // Incrementar las plazas disponibles del curso
            $conn->query("UPDATE Courses SET available_slots = available_slots + 1 WHERE id = $course_id");
        }
        echo "
            <script>
                alert('Registros eliminados exitosamente.');
                window.location.href = '../pages/consulta.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('No se seleccionó ningún registro para eliminar.');
                window.location.href = '../pages/consulta.php';
            </script>
        ";
    }

    $conn->close();
    ?>
    