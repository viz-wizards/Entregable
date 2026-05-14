<?php
require_once __DIR__ . '/../config/Database.php';

try {
    // 🔹 Crear la conexión
    $db = new Database();
    $pdo = $db->conectar();

    // 🔹 Consulta de productos
    $sql = "SELECT 
                p.id_producto,
                p.nombre,
                p.descripcion,
                p.precio,
                p.stock,
                p.imagen,
                c.nombre AS categoria,
                pr.razon_social AS proveedor
            FROM productos p
            INNER JOIN categorias c 
                ON p.id_categoria = c.id_categoria
            LEFT JOIN proveedores pr 
                ON p.id_proveedor = pr.id_proveedor
            WHERE p.estado = 'Disponible'";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Throwable $e) {
    die("Error al cargar productos: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Tech Store</title>
    <link rel="stylesheet" href="../assetes/css/style_productos.css">
</head>
<body>

<header>
    <section class="lineaSupe">
        <a class="logo" href="home.php">
            <img src="../imagenes/Logo.png" alt="logo">
            <h2>Tech Store</h2>
        </a>
        <div class="somos">
            <a href="home.php">Inicio</a>
            <a class="btn-login" href="login.php">Sistema</a>
        </div>
    </section>
</header>

<main>
<section class="servicios-publicos">
    <div class="encabezado-servicios">
        <span class="etiqueta-publica">Catálogo</span>
        <h2>Productos disponibles</h2>
        <p>Lista de productos conectados directamente a la base de datos.</p>
    </div>

    <div class="servicios-grid-publico">
        <?php if (count($productos) > 0): ?>
            <?php foreach ($productos as $p): ?>
                <article class="card-servicio-publico">
                    <div class="icono-servicio">💻</div>
                    <h3><?= htmlspecialchars($p['nombre']) ?></h3>
                    <p><?= htmlspecialchars($p['descripcion']) ?></p>
                    <p style="font-size:13px;color:#64748b;">Categoría: <?= htmlspecialchars($p['categoria']) ?></p>
                    <p style="font-size:13px;color:#64748b;">Proveedor: <?= htmlspecialchars($p['proveedor'] ?? 'Sin proveedor') ?></p>
                    <p style="font-size:13px;color:#64748b;">Stock: <?= $p['stock'] ?></p>
                    <div class="card-servicio-publico__pie">
                        <strong>S/ <?= number_format($p['precio'], 2) ?></strong>
                        <a href="cotizacion.php?id_producto=<?= $p['id_producto'] ?>">Cotizar</a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center;width:100%;">No hay productos disponibles.</p>
        <?php endif; ?>
    </div>
</section>
</main>

<footer class="footer-vet">
    <section class="footer-vet__barra">
        <p>&copy; <?= date('Y') ?> Tech Store</p>
    </section>
</footer>

</body>
</html>