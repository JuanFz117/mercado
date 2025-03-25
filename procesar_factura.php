<?php
include 'conexion.php';

$id_cliente = $_POST['id_cliente'];
$fecha_emision = $_POST['fecha_emision'];
$productos = $_POST['productos'];
$cantidades = $_POST['cantidad'];


$total_factura = 0;


for ($i = 0; $i < count($productos); $i++) {
    $id_producto = $productos[$i];
    $cantidad = $cantidades[$i];

    $sql = "SELECT valor_producto FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmtPrecio) {
        echo "Error al obtener el precio del producto: " . $stmt->error;
    }


    $stmtPrecio->bind_param("i", $id_producto);
    $stmtPrecio->execute();
    $stmtPrecio->bind_result($precio_unitario);
    $stmtPrecio->fetch();
    $stmtPrecio->close();


    $subtotal = $precio_unitario * $cantidad;
    $total_factura += $subtotal;

}



$sql = "INSERT INTO facturas (id_cliente, fecha_factura, total_factura) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);


if (!stmt) {
    echo "Error al agregar la factura: " . $stmt->error;
}


$stmt->bind_param("isd", $id_cliente, $fecha_emision, $total_factura);
if ($stmt->execute()){
    die("Error al agregar la factura: " . $stmt->error);
}
$id_factura = $stmt->insert_id;
$stmt->close();


$sqlDetalle = "INSERT INTO detalle_factura (id_factura, id_producto, cantidad, subtotal) VALUES (?, ?, ?, ?)";
$stmtDetalle = $conn->prepare($sqlDetalle);


if (!$stmtDetalle) {
    die("Error al agregar el detalle de la factura: " . $stmtDetalle->error);
}


for ($i = 0; $i < count($productos); $i++) {
    $id_producto = $productos[$i];
    $cantidad = $cantidades[$i];
    $stmtDetalle->bind_param("iiid", $id_factura, $id_producto, $cantidad, $subtotal);
    
    if (!$stmtDetalle->execute()) {
        die("Error al agregar el detalle de la factura: " . $stmtDetalle->error);
    }
}
$stmtDetalle->close();
$conn->close();


echo "Factura agregada con exito, numero de factura: " . $id_factura ."<br>";
echo "Total factura: $" . number_format($total_factura, 2);
?>