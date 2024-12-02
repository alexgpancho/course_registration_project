
    <?php
    // Script solo accesible desde PHPMyAdmin o uso administrativo
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "CourseRegistration";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Este script no genera HTML, está diseñado para ser ejecutado directamente desde el backend
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST as $course_id => $new_slots) {
            $course_id = intval($course_id);
            $new_slots = intval($new_slots);
            $conn->query("UPDATE Courses SET available_slots = $new_slots WHERE id = $course_id");
        }
    }

    $conn->close();
    ?>
    