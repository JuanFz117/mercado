<?php 
include '../conexion.php';

$id_proveedor = $_POST['id_proveedor'];
$nombre_proveedor = $_POST['nombre_proveedor'];
$contacto_interno = $_POST['contacto_interno'];
$telefono_contacto = $_POST['telefono_contacto'];
$email_contacto = $_POST['email_contacto'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$pais = $_POST['pais'];
$observaciones = $_POST['observaciones'];

$sql = "UPDATE proveedores SET nombre_proveedor=?, contacto_interno=?, telefono_contacto=?, email_contacto=?, direccion=?, ciudad=?, pais=?, observaciones=? WHERE id_proveedor=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssi", $nombre_proveedor, $contacto_interno, $telefono_contacto, $email_contacto, $direccion, $ciudad, $pais, $observaciones, $id_proveedor);

if ($stmt->execute()) {
    echo "<script>alert('Proveedor actualizado correctamente.');</script>";
    echo "<script>window.location.href='proveedores_crud.php';</script>";
} else {
    echo "Error al actualizar el proveedor: " . $stmt->error;
}
$stmt->close();
$conn->close();

//te amos juancito lindito
?>