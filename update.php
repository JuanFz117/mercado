<?php
include 'conexion.php';
$id_producto = $_GET['id'];
$sql = "SELECT * FROM productos WHERE id_producto = ?";

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
    <style>
        /* Reseteo de márgenes y paddings predeterminados */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Estilos generales del body */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 20px;
}

/* Título */
h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

/* Estilos del formulario */
form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

/* Estilo de los campos de entrada */
input[type="text"],
input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Estilo del botón de submit */
button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}
    </style>
</head>
<body>
    <h2>Editar Productor</h2>
    <form action="update_productos.php" method="post">
        <input type="hidden" name="id_producto" value="<?=$row['id_producto'] ?>">
        <input type="text" name="nombre_producto" value="<?= $row['nombre_producto'] ?>">
        <input type="number" name="cantidad_producto" value="<?= $row['cantidad_producto'] ?>">
        <input type="number" name="valor_producto" value="<?= $row['valor_producto'] ?>">
        <button type="submit" name="actualizar">Actualizar</button>
    </form>
</body>
</html>
