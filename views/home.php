<?php
require_once __DIR__ . '/../model/Producto.php';
require_once __DIR__ . '/../helpers/helpers.php';

$productos = [];

try {
    $productos = (new Producto())->listarDestacados();
} catch (Throwable $e) {

    $productos = [
        [
            'id_producto' => 1,
            'nombre' => 'Laptop Lenovo IdeaPad',
            'descripcion' => 'Ryzen 5, 8GB RAM, SSD 512GB',
            'precio' => 2500.00,
            'imagen' => 'laptop.jpg'
        ],
        [
            'id_producto' => 2,
            'nombre' => 'Samsung Galaxy A54',
            'descripcion' => '128GB, cámara 50MP',
            'precio' => 1400.00,
            'imagen' => 'celular.jpg'
        ],
        [
            'id_producto' => 3,
            'nombre' => 'Audífonos Logitech G435',
            'descripcion' => 'Inalámbricos gamer',
            'precio' => 320.00,
            'imagen' => 'audifonos.jpg'
        ],
        [
            'id_producto' => 4,
            'nombre' => 'Mouse Redragon',
            'descripcion' => 'RGB gamer alta precisión',
            'precio' => 120.00,
            'imagen' => 'mouse.jpg'
        ]
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="Sistema Tienda Tecnología">
    <meta name="robots" content="index,follow">
    <meta name="description" content="Sistema web tienda de tecnología">

    <link rel="icon" href="../imagenes/icono.ico">
    <link rel="stylesheet" href="../assetes/css/style_home.css">

    <title>Tienda Tecnología</title>
</head>

<body>

<header>

    <section class="lineaSupe">

        <a class="logo" href="home.php">
            <img src="../imagenes/logo.png" alt="logo">
            <h2>Tech Store</h2>
        </a>

        <div class="somos">
            <a href="somos.php">¿Quiénes somos?</a>
            <a class="btn-login" href="login.php">Iniciar sesión</a>
        </div>

    </section>

    <section class="lineaInfe">
        <nav>
            <ul>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="cotizacion.php">Cotización</a></li>
                <li><a href="nosotros.php">Nosotros</a></li>
                <li><a href="login.php">Sistema</a></li>
            </ul>
        </nav>
    </section>

</header>


<section class="carrusel">

    <div class="fondo">
        <img src="../imagenes/logo.png" alt="logo tienda">
    </div>

    <div class="titulo">
        <h1>Tecnología al mejor precio</h1>
        <p>Encuentra laptops, celulares, audífonos y más. Solicita cotización en línea fácilmente.</p>
        <a href="productos.php">Ver productos</a>
    </div>

</section>

<main>


<section id="productos" class="servicios-publicos">

    <div class="encabezado-servicios">
        <span class="etiqueta-publica">Productos destacados</span>
        <h2>Catálogo de tecnología</h2>
        <p>Explora nuestros productos y solicita una cotización desde el sistema.</p>
    </div>

    <div class="servicios-grid-publico">

        <?php foreach ($productos as $p): ?>

        <article class="card-servicio-publico">

            <div class="icono-servicio">💻</div>

            <h3><?= e($p['nombre']) ?></h3>

            <p><?= e($p['descripcion']) ?></p>

            <div class="card-servicio-publico__pie">
                <strong><?= money($p['precio']) ?></strong>
                <a href="cotizacion.php?id_producto=<?= $p['id_producto'] ?>">
                    Cotizar
                </a>
            </div>

        </article>

        <?php endforeach; ?>

    </div>

</section>

<section class="agenda-rapida-home">

    <div>
        <span class="card-etiqueta">Sistema en línea</span>
        <h2>Solicita tu cotización fácilmente</h2>
        <p>El cliente puede elegir productos y enviar solicitudes sin iniciar sesión.</p>
    </div>

    <a href="cotizacion.php">Cotizar ahora</a>

</section>


<section id="nosotros" class="bloque-info">

    <h2>Sistema Tienda Tecnología</h2>
    <p>Proyecto académico con PHP, MySQL, CRUD, login y dashboard administrativo.</p>

</section>

</main>

<footer class="footer-vet">

    <section class="footer-vet__contenido">

        <article class="footer-vet__columna">
            <h3>Tech Store</h3>
            <p>Venta de productos tecnológicos con sistema de cotización y administración.</p>
        </article>

        <article class="footer-vet__columna">
            <h3>Contacto</h3>
            <p>Av. Tecnología 123</p>
            <p>979809212</p>
            <p>ventas@tesds.com</p>
        </article>

        <article class="footer-vet__columna">
            <h3>Productos</h3>
            <ul>
                <li><a href="productos.php">Laptops</a></li>
                <li><a href="productos.php">Celulares</a></li>
                <li><a href="productos.php">Accesorios</a></li>
            </ul>
        </article>

        <article class="footer-vet__columna">
            <h3>Sistema</h3>
            <ul>
                <li><a href="login.php">Acceso admin</a></li>
                <li><a href="cotizacion.php">Cotizaciones</a></li>
            </ul>
        </article>

    </section>

    <section class="footer-vet__barra">
        <p>&copy; <?= date('Y') ?> Tech Store. Todos los derechos reservados.</p>
    </section>

</footer>

</body>
</html>

