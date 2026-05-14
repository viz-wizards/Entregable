<?php
require_once __DIR__ . '/../controller/AuthController.php';
$mensaje = '';

// 🔹 Inicio de sesión seguro
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id_usuario'])) {
    header("Location: dashboard.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $correo = trim($_POST['txtUser'] ?? '');
    $clave = trim($_POST['txtPass'] ?? '');

    if ($correo === '' || $clave === '') {
        $mensaje = 'Complete todos los campos.';
    } else {
        $auth = new AuthController();

        if ($auth->login($correo, $clave)) {
            header('Location: dashboard.php');
            exit;
        }

        $mensaje = 'Correo o clave incorrectos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Sistema Tienda Tecnología">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="Login del sistema de tienda de tecnología">
    <link rel="icon" href="../imagenes/icono.ico">
    <link rel="stylesheet" href="../assetes/css/style_login.css">

    <title>Login  Tienda Tecnología</title>
</head>

<body>

<main>
    <div class="caja">

        <form action="validar_login.php" method="post" id="frmLogin">

            
            <img src="../imagenes/Logo.png" alt="logo institucional">

            <h1>Acceso al sistema</h1>
            <p>Ingrese sus credenciales</p>

            
            <?php if ($mensaje !== ''): ?>
                <div class="alerta-login">
                    <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

           
            <label for="txtUser">Correo</label>
            <input type="email"
                   name="correo"
                   id="txtUser"
                   placeholder="admin@tienda.com"
                   value="<?= htmlspecialchars($_POST['correo'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

           
            <label for="txtPass">Clave</label>
            <input type="password"
                   name="clave"
                   id="txtPass"
                   placeholder="Ingrese su clave">
            <div class="links">

                <div class="chkMostrar">
                    <input type="checkbox" id="chk">
                    <label for="chk">Mostrar contraseña</label>
                </div>

                <a href="recuperar_password.php">¿Olvidaste tu contraseña?</a>

            </div>
            <div class="buttons">
                <button type="submit" id="btnPrimary">Ingresar</button>
                <button type="reset" id="btnSecondary">Cancelar</button>
            </div>
            <small class="demo">
                Demo: 1590173@senati.pe / 2345
            </small>
        </form>

    </div>
</main>

<script src="../assets/js/app.js"></script>

</body>
</html>
