<?php 
include '../conexion.php';
if (!isset($_GET['id'])) {
    echo "ID no proporcionado.";
    exit;
}


$id_proveedor = $_GET['id'];
$sql = "SELECT * FROM proveedores WHERE id_proveedor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_proveedor);  
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
   die("No se encontró el proveedor con ID: " . $id_proveedor);
} 
$proveedor = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/estilo.css">
</head>
<body>
    <h2>Editar Proveedor</h2>
    <form action="actualizar_proveedor.php" method="post">
        <input type="text" name="id_proveedor" id="id_proveedor" value="<?php echo $proveedor['id_proveedor']; ?>" hidden>
        <input type="text" name="nombre_proveedor" id="nombre_proveedor" value="<?php echo $proveedor['nombre_proveedor']; ?>" placeholder="Nombre Proveedor" required><br><br> 
        <input type="text" name="contacto_interno" id="contacto_interno" value="<?php echo $proveedor['contacto_interno']; ?>" placeholder="Contacto Interno" required><br><br>
        <input type="text" name="telefono_contacto" id="telefono_contacto" value="<?php echo $proveedor['telefono_contacto']; ?>" placeholder="Telefono Proveedor" required><br><br>
        <input type="text" name="email_contacto" id="email_contacto" value="<?php echo $proveedor['email_contacto']; ?>" placeholder="Email Proveedor" required><br><br>
        <input type="text" name="direccion" id="direccion" value="<?php echo $proveedor['direccion']; ?>" placeholder="Direccion Proveedor" required><br><br>
        <input type="text" name="ciudad" id="ciudad" value="<?php echo $proveedor['ciudad']; ?>" placeholder="Ciudad Proveedor" required><br><br>
        <input type="text" name="pais" id="pais" value="<?php echo $proveedor['pais']; ?>" placeholder="Pais Proveedor" required><br><br>
        <input type="text" name="observaciones" id="observaciones" value="<?php echo $proveedor['observaciones']; ?>" placeholder="Observaciones Proveedor"><br><br>
        <input type="submit" value="Actualizar Proveedor">
        <input type="button" value="Cancelar" onclick="window.location.href='proveedores_crud.php'"><br><br>
    </form>
</body>
</html>
<?php
$conn->close();
?>