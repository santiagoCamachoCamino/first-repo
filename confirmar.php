<?php


$nombre = $_GET['nombre'] ?? 'Usuario';
$idLibro = $_GET['id'] ?? '';

include 'includes/libros.php';

$libroReservado = null;
foreach ($libros as $libro) {
    if ($libro['id'] == $idLibro) {
        $libroReservado = $libro;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Reserva Confirmada</title>
</head>
<body>
    <h1>¡Gracias, <?= $nombre ?>!</h1>
    <p>Has reservado <strong><?= $libroReservado['titulo'] ?></strong> de <em><?= $libroReservado['autor'] ?></em>.</p>
    <p>Fecha y hora: <?= date('Y-m-d H:i:s') ?></p>
</body>
</html>
