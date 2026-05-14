<?php
require_once __DIR__ . '/../config/Database.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $correo = trim($_POST['correo'] ?? '');

    if ($correo === '') {
        $mensaje = "Ingrese su correo.";
    } else {

        try {
            $db = new Database();
            $pdo = $db->conectar();

            $sql = "SELECT * FROM usuario WHERE correo = :correo LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':correo' => $correo]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                // ⚠️ Simulación (no envío real de correo)
                $mensaje = "Se envió un enlace de recuperación a su correo.";
            } else {
                $mensaje = "El correo no está registrado.";
            }

        } catch (Throwable $e) {
            $mensaje = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assetes/css/style_recuperar_password.css">
</head>

<body>

<div class="login-container">

    <form method="POST" class="login-box">

        <h2>Recuperar contraseña</h2>

        <p>Ingresa tu correo registrado</p>

        <?php if ($mensaje != ""): ?>
            <div class="alert">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <label>Correo</label>
        <input type="email" name="correo" placeholder="correo@ejemplo.com" required>

        <button type="submit">Recuperar</button>

        <a href="login.php">Volver al login</a>

    </form>

</div>

</body>
</html>