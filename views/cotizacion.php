<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../helpers/helpers.php';

// Crear conexión
$db = new Database();
$pdo = $db->conectar();

$mensaje = "";


try {
    $stmt = $pdo->prepare("SELECT id_producto, nombre FROM productos WHERE estado='Disponible'");
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $productos = [];
    $mensaje = "Error al cargar los productos: " . $e->getMessage();
}

// Guardar cotización
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id_cliente = 1; // Aquí puedes usar sesión o formulario de cliente
    $id_producto = $_POST['id_producto'] ?? null;
    $cantidad = $_POST['cantidad'] ?? 1;
    $observacion = $_POST['observacion'] ?? '';

    if ($id_producto) {

        try {
            $sql = "INSERT INTO cotizaciones 
                    (id_cliente, id_producto, cantidad, observacion, estado)
                    VALUES (:cliente, :producto, :cantidad, :obs, 'Pendiente')";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ":cliente" => $id_cliente,
                ":producto" => $id_producto,
                ":cantidad" => $cantidad,
                ":obs" => $observacion
            ]);

            $mensaje = "Cotización enviada correctamente.";

        } catch (Throwable $e) {
            $mensaje = "Error al enviar cotización: " . $e->getMessage();
        }

    } else {
        $mensaje = "Seleccione un producto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cotización - Tech Store</title>

    <link rel="stylesheet" href="../assetes/css/style_cotizacion.css">
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
            <a href="productos.php">Productos</a>
            <a href="login.php" class="btn-login">Sistema</a>
        </div>
    </section>
</header>

<main>

<section class="hero-formulario">

    <span class="etiqueta-publica">Cotización</span>

    <h1>Solicita tu cotización</h1>

    <p>
        Selecciona un producto y envía tu solicitud. El administrador revisará tu pedido.
    </p>

</section>

<?php if($mensaje != ""): ?>
    <div class="mensaje-publico exito">
        <?= htmlspecialchars($mensaje) ?>
    </div>
<?php endif; ?>

<section class="contenedor-cita-publica">

    <form method="POST" class="formulario-publico">

        <h2>Datos de cotización</h2>

        <div class="form-grid-publico">

            <label>
                Producto
                <select name="id_producto" required>
                    <option value="">Seleccione</option>
                    <?php foreach($productos as $p): ?>
                        <option value="<?= $p['id_producto'] ?>">
                            <?= htmlspecialchars($p['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label>
                Cantidad
                <input type="number" name="cantidad" value="1" min="1" required>
            </label>

            <label class="span-2-publico">
                Observación
                <textarea name="observacion" rows="4" placeholder="Escribe detalles..."></textarea>
            </label>

        </div>

        <div class="acciones-publicas">
            <button type="submit">Enviar cotización</button>
            <a href="home.php">Cancelar</a>
        </div>

    </form>

    <aside class="panel-ayuda-cita">

        <h2>Información</h2>

        <p>Tu cotización será revisada por el sistema administrativo.</p>

        <ul>
            <li>Respuesta en 24-48 horas</li>
            <li>Revisión de disponibilidad</li>
            <li>Confirmación por sistema</li>
        </ul>

    </aside>

</section>

</main>

<footer class="footer-vet">

    <section class="footer-vet__barra">
        <p>&copy; <?= date('Y') ?> Tech Store</p>
    </section>

</footer>

</body>
</html>