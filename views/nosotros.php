<?php
// Página estática, no requiere BD
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Sobre Tech Store">
    <meta name="author" content="Tech Store">

    <link rel="stylesheet" href="../assetes/css/style_home.css">
    <link rel="icon" href="../imagenes/icono.ico">

    <title>Nosotros - Tech Store</title>
</head>

<body>

<header>

    <section class="lineaSupe">

        <a class="logo" href="home.php">
            <img src="../imagenes/logo1.png" alt="logo">
            <h2>Tech Store</h2>
        </a>

        <div class="somos">
            <a href="home.php">Inicio</a>
            <a href="productos.php">Productos</a>
            <a class="btn-login" href="login.php">Sistema</a>
        </div>

    </section>

</header>

<main>

<section class="bloque-info">

    <h2>¿Quiénes somos?</h2>

    <p>
        <strong>Tech Store</strong> es un sistema web desarrollado como proyecto académico,
        enfocado en la gestión de productos tecnológicos, cotizaciones y administración básica
        utilizando PHP y MySQL.
    </p>

    <p>
        Nuestro objetivo es simular una tienda en línea donde los usuarios pueden explorar
        productos como laptops, celulares, audífonos y accesorios, y enviar solicitudes de cotización
        de manera sencilla.
    </p>

</section>

<section class="bloque-info">

    <h2>Misión</h2>

    <p>
        Brindar una plataforma digital simple, funcional y educativa para la gestión de ventas
        y cotizaciones de productos tecnológicos.
    </p>

</section>

<section class="bloque-info">

    <h2>Visión</h2>

    <p>
        Convertirnos en un modelo de sistema web académico que simule procesos reales de comercio electrónico,
        integrando nuevas funcionalidades como pagos y carrito de compras.
    </p>

</section>

<section class="bloque-info">

    <h2>Desarrollado con</h2>

    <p>
        PHP • MySQL • HTML • CSS • XAMPP
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