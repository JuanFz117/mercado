<?php
include 'conexion.php';


if (isset($_POST['actualizar'])){
    $id_producto =$_POST['id_producto'];
    $cantidad_producto = $_POST['cantidad_producto'];
    $nombre_producto = $_POST['nombre_producto'];

    $sql = "UPDATE productos SET nombre_producto = ?, cantidad_producto = ?, id_categoria = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii",$nuevo_nombre, $nueva_cantidad, $nueva_categoria, $id_producto);


    if ($stmt->execute()){
        header("Location: productos.php");
        exit();
    }else{
        echo "Error al actualizar el producto".$stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>