<?php
//conexion a la base de datos 
$servername="localhost";
$username="root";
$password="";
$dbname="mercado";
$conn=new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//obtener datos del formulario 
$id_cliente= $_POST['id_cliente'];
$fecha_emision= $_POST['fecha_emision'];
$productos= $_POST['productos'];
$cantidades= $_POST['cantidad'];

//calcular el total de la factura 
$total_factura=0;

for($i= 0; $i < count($productos); $i++){
    $id_producto=$productos[$i];
    $cantidad=$cantidades[$i];

    //obtener el precio del producto
    $sqlPrecio="SELECT valor_producto FROM productos WHERE id_producto=?";
    $stmtPrecio=$conn->prepare($sqlPrecio);
    if (!$stmtPrecio){
        die("Error en la preparacion del precio: " . $conn->error);
    }

    $stmtPrecio->bind_param("i", $id_producto);
    $stmtPrecio->execute();
    $stmtPrecio->bind_result($precio_unitario);
    $stmtPrecio->fetch();
    $stmtPrecio->close();

    // Calcular subtotal y sumarlo al total de la factura
    $subtotal = $precio_unitario * $cantidad;
    $total_factura += $subtotal;
}

//insertar la factura en la tabla 'facturas'
$sqlFactura="INSERT INTO facturas (id_cliente, fecha_factura, total_factura) VALUES (?, ?, ?)";
$stmt=$conn->prepare($sqlFactura);
if (!$stmt){
    die("Error en la preparacion de la factura: " . $conn->error);
}

$stmt->bind_param("isd", $id_cliente, $fecha_emision, $total_factura);

if(!$stmt->execute()){
    die("Error al insertar la factura: " . $stmt->error);
}

$id_factura=$stmt->insert_id;
$stmt->close();

//insertar los productos de la factura en la tabla 'detalle_factura'
$sqlDetalle="INSERT INTO detalle_factura (id_factura, id_producto, cantidad) VALUES (?, ?, ?)";
$stmtDetalle=$conn->prepare($sqlDetalle);
if (!$stmtDetalle){
    die("Error en la preparacion del detalle: " . $conn->error);
}
for($i=0; $i < count($productos); $i++){
    $id_producto=$productos[$i];
    $cantidad=$cantidades[$i];

    $stmtDetalle->bind_param("iii", $id_factura, $id_producto, $cantidad);
    if(!$stmtDetalle->execute()){
        die("Error al insertar el detalle: " . $stmtDetalle->error);
    }
}

$stmtDetalle->close();
$conn->close();

//mostrar el total de la factura 
echo "Factura registrada con exito. Numero de Factura " . $id_factura . "<br>";
echo "Total última factura $" . number_format($total_factura, 2);
?>