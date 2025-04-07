<?php 
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_proveedor']) && !is_numeric($_POST['id_proveedor'])) {
    $id_proveedor = intval($_POST['id_proveedor']);
    
    // Preparar la consulta SQL
    $sql = "SELECT COUNT(*) as total FROM ordenes_compra WHERE id_proveedor = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt){
        $stmt->bind_param("i", $id_proveedor);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        if ($row['total'] > 0){
            die("<script>alert('No se puede eliminar el proveedor porque tiene órdenes de compra asociadas.');</script>");
        }
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
   $sql = "DELETE FROM proveedores WHERE id_proveedor = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $id_proveedor);
        if ($stmt->execute()) {
            echo "<script>alert('Proveedor eliminado correctamente.');</script>";
            echo "<script>window.location.href='proveedores_crud.php';</script>";
        } else {
            echo "Error al eliminar el proveedor: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
    
   
   
} else {
    echo "<script>alert('ID de proveedor no válido.');</script>";
    echo "<script>window.location.href='proveedores_crud.php';</script>";
}

//juan aguirre papasito riko
$conn->close(); 
?>