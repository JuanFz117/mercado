<?php
include 'conexion.php';
$sql = "SELECT * FROM productos WHERE id_producto = ?";
$result = $conn->query($sql);
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Editar Productor</h2>
    <form action="update_productos.php" method="post">
        <input type="hidden" name="id_producto" value="<?= $row['id_producto'] ?>">
        <input type="text" name="nombre_producto" value="<?= $row['nombre_producto'] ?>" required>
        <input type="number" name="cantidad_producto" value="<?= $row['cantidad_producto'] ?>" required>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>
</body>
</html>
