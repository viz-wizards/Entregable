<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Quiénes somos - Tech Store">
    <meta name="author" content="Tech Store">

    <link rel="stylesheet" href="../assetes/css/style_home.css">
    <link rel="icon" href="../imagenes/icono.ico">

    <title>Quiénes somos - Tech Store</title>
</head>

<body>

<header>

    <section class="lineaSupe">

        <a class="logo" href="home.php">
            <img src="../imagenes/logo.png" alt="logo">
            <h2>Tech Store</h2>
        </a>

        <div class="somos">
            <a href="home.php">Inicio</a>
            <a href="productos.php">Productos</a>
            <a href="nosotros.php">Nosotros</a>
            <a class="btn-login" href="login.php">Sistema</a>
        </div>

    </section>

</header>

<main>

<section class="bloque-info">

    <h2>¿Quiénes somos?</h2>

    <p>
        En <strong>Tech Store</strong> somos un proyecto académico enfocado en el desarrollo
        de sistemas web utilizando PHP y MySQL.
    </p>

    <p>
        Simulamos una tienda de tecnología donde los usuarios pueden visualizar productos,
        solicitar cotizaciones y explorar información de la empresa de forma sencilla.
    </p>

</section>

<section class="bloque-info">

    <h2>¿Qué hacemos?</h2>

    <p>
        Desarrollamos un sistema completo de gestión de productos tecnológicos que incluye:
    </p>

    <p>
        <br>Catálogo de productos<br>
        <br>Sistema de cotización<br>
        <br>Administración básica<br>
        <br>Login de usuarios<br>
    </p>

</section>

<section class="bloque-info">

    <h2>Objetivo</h2>

    <p>
        Aprender y aplicar tecnologías web como PHP, MySQL, HTML y CSS en un entorno real simulado,
        fortaleciendo habilidades de desarrollo backend y frontend.
    </p>

</section>

<section class="bloque-info">

    <h2>Equipo</h2>

    <p>
        Proyecto desarrollado por estudiantes con fines educativos en desarrollo web.
    </p>

</section>

</main>

<footer class="footer-vet">

    <section class="footer-vet__barra">
        <p>&copy; <?= date('Y') ?> Tech Store - Todos los derechos reservados</p>
    </section>

</footer>

</body>
</html>