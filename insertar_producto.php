<?php
include 'conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre_producto = ($_POST['nombre_producto']);
    $cantidad_producto = intval($_POST['cantidad_producto']);
    $valor_producto = intval($_POST['valor_producto']);
    $id_categoria = intval($_POST['id_categoria']);

    $sql = "INSERT INTO productos (nombre_producto, cantidad_producto, id_categoria, valor_producto) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $nombre_producto, $cantidad_producto , $id_categoria, $valor_producto);

    if($stmt->execute()){
        header("Location: productos.php");
        exit();
    }else{
        echo "Error al agregar producto: " .$stmt->error;
    }
    $stmt->close();
    $conn->close();


}