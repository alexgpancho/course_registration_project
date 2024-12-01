
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
        $course_id = $_POST["curso_id"];
        $student_name = $_POST["student_name"];
        $email = $_POST["email"];
        $cedula = $_POST["cedula"];
        $edad = $_POST["edad"];
        $genero = $_POST["genero"];

        // Verificar plazas disponibles
        $check_slots = $conn->query("SELECT available_slots FROM Courses WHERE id = $course_id");
        $row = $check_slots->fetch_assoc();
        if ($row["available_slots"] > 0) {
            // Insertar inscripción
            $sql = "INSERT INTO Enrollments (course_id, student_name, email, cedula, edad, genero)
                    VALUES ('$course_id', '$student_name', '$email', '$cedula', '$edad', '$genero')";

            if ($conn->query($sql) === TRUE) {
                // Actualizar plazas disponibles
                $conn->query("UPDATE Courses SET available_slots = available_slots - 1 WHERE id = $course_id");
                $remaining_slots = $row["available_slots"] - 1;
                echo "
                    <script>
                        window.onload = function() {
                            let message = document.createElement('div');
                            message.innerText = 'Registro exitoso. Plazas restantes: $remaining_slots';
                            message.style.position = 'fixed';
                            message.style.top = '20px';
                            message.style.left = '50%';
                            message.style.transform = 'translateX(-50%)';
                            message.style.backgroundColor = '#4CAF50';
                            message.style.color = 'white';
                            message.style.padding = '10px 20px';
                            message.style.borderRadius = '5px';
                            message.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
                            document.body.appendChild(message);
                            
                            setTimeout(function() {
                                message.style.display = 'none';
                                window.location.href = '../pages/registro.php';
                            }, 3000);
                        };
                    </script>
                ";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "
                <script>
                    window.onload = function() {
                        alert('No hay plazas disponibles para este curso.');
                        window.location.href = '../pages/registro.php';
                    };
                </script>
            ";
        }
    }

    $conn->close();
    ?>
    