
<?php
include 'conexion.php';

if (isset($_GET['id'])){
    $id_producto = intval($_GET['id']);

    $sql = "DELETE FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id_producto);

    if ($stmt ->execute()){
        header("location: productos.php");
        exit();
    }else {
        echo "Error al eliminar producto: ". $stmt->error;
    }

    $stmt->close();
    $stmt->close();


}


?>