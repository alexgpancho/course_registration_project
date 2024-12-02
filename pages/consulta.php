
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Consulta de Inscripciones - UTPL</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>
        <header>
            <h1>Consulta de Inscripciones - UTPL</h1>
            <nav>
                <ul>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="registro.php">Registro de Cursos</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <h2>Consulta tus Inscripciones</h2>
            <form action="../php/consulta.php" method="POST">
                <div>
                    <label for="cedula">Cédula:</label><br>
                    <input type="text" id="cedula" name="cedula" required pattern="\d{10}">
                </div>
                <div>
                    <button type="submit">Consultar</button>
                </div>
            </form>
        </div>
    </body>
    </html>
    