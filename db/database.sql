
    CREATE DATABASE IF NOT EXISTS CourseRegistration;
    USE CourseRegistration;

    CREATE TABLE IF NOT EXISTS Courses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        total_slots INT NOT NULL, -- Número total de cupos
        available_slots INT NOT NULL, -- Número de cupos disponibles
        image_path VARCHAR(255)
    );

    CREATE TABLE IF NOT EXISTS Enrollments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT,
        student_name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        cedula VARCHAR(10) NOT NULL,
        edad INT NOT NULL,
        genero VARCHAR(20) NOT NULL,
        FOREIGN KEY (course_id) REFERENCES Courses(id)
    );

    INSERT INTO Courses (name, description, total_slots, available_slots, image_path) VALUES
    ('Introducción a la Programación', 'Aprende los fundamentos de programación utilizando Python.', 30, 30, 'img/curso1.png'),
    ('Desarrollo Web', 'Domina la creación de sitios web con HTML, CSS y JavaScript.', 25, 25, 'img/curso2.png'),
    ('Base de Datos', 'Conoce cómo diseñar, implementar y gestionar bases de datos con MySQL.', 40, 40, 'img/curso3.png');
    