<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

include_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alojamientos Web</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <h1 class="white">Alojamientos Web</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <?php if(isLoggedIn()): ?>
            <?php if(isAdmin()): ?>
                <a href="admin.php">Panel Admin</a>
            <?php else: ?>
                <a href="dashboard.php">Mi Cuenta</a>
            <?php endif; ?>
            <a href="logout.php">Cerrar Sesión</a>
        <?php else: ?>
            <a href="login.php">Iniciar Sesión</a>
        <?php endif; ?>
    </nav>
</header>
