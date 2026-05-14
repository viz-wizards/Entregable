<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
require_once __DIR__ . '/../helpers/helpers.php';
$paginaActual = basename($_SERVER['PHP_SELF']);

function navActivo(string $pagina, string $actual): string {
    return $pagina === $actual ? 'class="activo"' : '';
}
?>
<header class="topbar">
    <section class="lineaSupe">
        <a class="logo" href="home.php">
            <img src="../imagenes/logo.png" alt="logo empresa">
            <span>Tech Store</span>
        </a>
        <div class="usuario-box">
            <?php if(isset($_SESSION['id_usuario'])): ?>
                <span><?= e($_SESSION['usuario'] ?? 'Usuario') ?></span>
                <small><?= e($_SESSION['rol'] ?? 'Cliente') ?></small>
                <a class="btn-salir" href="logout.php">Cerrar sesión</a>
            <?php else: ?>
                <a class="btn-login" href="login.php">Iniciar sesión</a>
            <?php endif; ?>
        </div>
    </section>

    <section class="lineaInfe">
        <nav>
            <ul>
                <li><a <?= navActivo('home.php', $paginaActual) ?> href="home.php">Inicio</a></li>
                <li><a <?= navActivo('productos.php', $paginaActual) ?> href="productos.php">Productos</a></li>
                <li><a <?= navActivo('cotizacion.php', $paginaActual) ?> href="cotizacion.php">Cotización</a></li>
                <li><a <?= navActivo('nosotros.php', $paginaActual) ?> href="nosotros.php">Nosotros</a></li>
                <li><a <?= navActivo('login.php', $paginaActual) ?> href="login.php">Sistema</a></li>
            </ul>
        </nav>
    </section>
</header>