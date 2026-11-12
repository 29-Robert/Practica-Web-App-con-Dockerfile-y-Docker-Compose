<?php
$host = getenv('DB_HOST') ?: 'db';
$db = getenv('DB_NAME') ?: 'hola_mundo';
$user = getenv('DB_USER') ?: 'appuser';
$password = getenv('DB_PASSWORD') ?: 'apppass123';

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $password
    );

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $version = $conexion->query("SELECT VERSION()")->fetchColumn();

    $mensaje = "Conexión exitosa con MySQL";
} catch (PDOException $e) {
    $mensaje = "Error de conexión: " . $e->getMessage();
    $version = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola Mundo Docker</title>
</head>
<body>
    <h1>¡Hola Mundo!</h1>

    <h2>Conexión a la base de datos</h2>

    <p><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></p>

    <?php if ($version): ?>
        <p>Versión de MySQL: <?= htmlspecialchars($version, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
</body>
</html>