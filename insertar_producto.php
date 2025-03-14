<?php
include 'conexion.php';

if ($_SERVER["request_method"]== "post"){
    $nombre_producto =($_POST['nombre_producto']);
    $cantidad_producto =intval($_POST['cantidad_producto']);
    $id_categoria =intval($_POST['id_categoria']);
}

 $sql = "INSERT INTO pruductos (nombre_producto, cantidad_producto, id_producto)";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("sii",$nombre_producto,$cantidad_producto, $id_categoria);

 if ($stmt->execute()){
    header("location: productos.php");
 }else{
    echo"error al agregar el producto: ".$stmt->error;
 }

$stmt->close();
$conn->close();

?>