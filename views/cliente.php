<?php
require_once __DIR__ . '/../config/Database.php';

$db = new Database();
$pdo = $db->conectar();

$mensaje = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombres   = $_POST['nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $telefono  = $_POST['telefono'] ?? '';
    $correo    = $_POST['correo'] ?? '';
    $direccion = $_POST['direccion'] ?? '';

    if ($nombres && $apellidos && $telefono) {

        try {
            $sql = "INSERT INTO cliente 
                    (nombres, apellidos, telefono, correo, direccion, estado, creado_en)
                    VALUES 
                    (:nombres, :apellidos, :telefono, :correo, :direccion, 'Activo', NOW())";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ":nombres"   => $nombres,
                ":apellidos" => $apellidos,
                ":telefono"  => $telefono,
                ":correo"    => $correo,
                ":direccion" => $direccion
            ]);

            $mensaje = "Cliente registrado correctamente.";

        } catch (Throwable $e) {
            $mensaje = "Error: " . $e->getMessage();
        }

    } else {
        $mensaje = "Complete los campos obligatorios.";
    }
}

/* =========================
   ELIMINAR CLIENTE
========================= */
if (isset($_GET['eliminar'])) {

    $id = $_GET['eliminar'];

    try {
        $stmt = $pdo->prepare("DELETE FROM cliente WHERE id_cliente = ?");
        $stmt->execute([$id]);

        header("Location: clientep.php");
        exit;

    } catch (Throwable $e) {
        $mensaje = "Error al eliminar cliente.";
    }
}

/* =========================
   LISTAR CLIENTES
========================= */
try {
    $stmt = $pdo->query("SELECT * FROM cliente ORDER BY id_cliente DESC");
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $clientes = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes - Tech Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style_home.css">
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
            <a href="login.php" class="btn-login">Sistema</a>
        </div>
    </section>
</header>

<main>

<section class="bloque-info">
    <h2>Gestión de Clientes</h2>
    <p>Registro y administración de clientes del sistema.</p>
</section>

<?php if($mensaje): ?>
    <div class="mensaje-publico exito">
        <?= htmlspecialchars($mensaje) ?>
    </div>
<?php endif; ?>

<section class="contenedor-cita-publica">

    <!-- FORMULARIO -->
    <form method="POST" class="formulario-publico">

        <h2>Registrar cliente</h2>

        <div class="form-grid-publico">

            <label>
                Nombres
                <input type="text" name="nombres" required>
            </label>

            <label>
                Apellidos
                <input type="text" name="apellidos" required>
            </label>

            <label>
                Teléfono
                <input type="text" name="telefono" required>
            </label>

            <label>
                Correo
                <input type="email" name="correo">
            </label>

            <label class="span-2-publico">
                Dirección
                <input type="text" name="direccion">
            </label>

        </div>

        <div class="acciones-publicas">
            <button type="submit">Guardar cliente</button>
        </div>

    </form>

    <!-- LISTADO -->
    <aside class="panel-ayuda-cita">
        <h2>Clientes registrados</h2>

        <?php if(count($clientes) > 0): ?>
            <ul>
                <?php foreach($clientes as $c): ?>
                    <li>

                        <strong>
                            <?= htmlspecialchars($c['nombres']) ?>
                            <?= htmlspecialchars($c['apellidos']) ?>
                        </strong><br>

                        📞 <?= htmlspecialchars($c['telefono']) ?><br>
                        📧 <?= htmlspecialchars($c['correo']) ?><br>
                        🏠 <?= htmlspecialchars($c['direccion']) ?><br>
                        🟢 <?= htmlspecialchars($c['estado']) ?><br>
                        📅 <?= htmlspecialchars($c['creado_en']) ?><br><br>

                        <a href="clientep.php?eliminar=<?= $c['id_cliente'] ?>"
                           onclick="return confirm('¿Eliminar cliente?')"
                           style="color:red;">
                           Eliminar
                        </a>

                    </li>
                    <hr>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay clientes registrados.</p>
        <?php endif; ?>

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