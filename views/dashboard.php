<?php
session_start();
require_once __DIR__ . '/../config/Database.php';


if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}


try {
    $totalProductos = $pdo->query("SELECT COUNT(*) as total FROM productos")->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    $totalClientes = $pdo->query("SELECT COUNT(*) as total FROM clientes")->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    $totalCotizaciones = $pdo->query("SELECT COUNT(*) as total FROM cotizaciones")->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    $totalVentas = $pdo->query("SELECT COUNT(*) as total FROM ventas")->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    $totalPagos = $pdo->query("SELECT COUNT(*) as total FROM pagos")->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
} catch (Throwable $e) {
    die("Error al obtener estadísticas: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tech Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assetes/css/style_dashboard.css">
</head>
<body>

<header>
    <section class="lineaSupe">
        <a class="logo" href="dashboard.php">
            <img src="../imagenes/logo1.png" alt="logo">
            <h2>Tech Store</h2>
        </a>
        <div class="somos">
            <a href="home.php">Inicio</a>
            <a href="productos.php">Productos</a>
            <a href="clientep.php">Clientes</a>
            <a href="login.php" class="btn-login">Salir</a>
        </div>
    </section>
</header>

<main>

<div class="dashboard-header">
    <h1>Panel Administrativo</h1>
    <p>Resumen de la tienda de tecnología</p>
</div>

<div class="dashboard-grid">

    <div class="dashboard-card">
        <h2><?= $totalProductos ?></h2>
        <p>Productos</p>
    </div>

    <div class="dashboard-card">
        <h2><?= $totalClientes ?></h2>
        <p>Clientes</p>
    </div>

    <div class="dashboard-card">
        <h2><?= $totalCotizaciones ?></h2>
        <p>Cotizaciones</p>
    </div>

    <div class="dashboard-card">
        <h2><?= $totalVentas ?></h2>
        <p>Ventas</p>
    </div>

    <div class="dashboard-card">
        <h2><?= $totalPagos ?></h2>
        <p>Pagos</p>
    </div>

</div>

</main>

<footer class="footer-vet">
    <section class="footer-vet__barra">
        <p>&copy; <?= date('Y') ?> Tech Store</p>
    </section>
</footer>

</body>
</html>