<?php
include '../conexion.php';


if (isset($_POST['actualizar'])){
    $id_producto =intval($_POST['id_producto']);
    $cantidad_producto =intval($_POST['cantidad_producto']);
    $valor_producto = intval($_POST['valor_producto']);
    $nombre_producto = $_POST['nombre_producto'];

    $sql = "UPDATE productos SET nombre_producto = ?, cantidad_producto = ?, valor_producto = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii",$nombre_producto, $cantidad_producto, $valor_producto, $id_producto);


    if ($stmt->execute()){
        header("Location: formulario_productos.php");
        exit();
    }else{
        echo "Error al actualizar el producto".$stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>