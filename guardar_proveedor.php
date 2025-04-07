<?php 
include 'conexion.php';

$nombre_proveedor = $_POST['nombre_proveedor'];
$contacto_interno = $_POST['contacto_interno'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$pais = $_POST['pais'];
$telefono_contacto = $_POST['telefono_contacto'];
$email_contacto = $_POST['email_contacto'];
$observaciones = $_POST['observaciones'];


$sql = "INSERT INTO proveedores (nombre_proveedor, contacto_interno, telefono_contacto, email_contacto, direccion, ciudad, pais, observaciones) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $nombre_proveedor, $contacto_interno, $telefono_contacto, $email_contacto, $direccion, $ciudad, $pais, $observaciones);


if ($stmt->execute()) {
    echo "Proveedor guardado correctamente.";
    echo "<br><a href='proveedores_crud.php'>Volver a la lista de proveedores</a>";
} else {
    echo "Error al guardar el proveedor: " . $stmt->error;
}
$stmt->close(); 
$conn->close();
?>