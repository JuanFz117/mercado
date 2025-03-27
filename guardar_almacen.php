<?php 
include 'conexion.php';

$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];



$foto = null;
if (!empty($_FILES['foto']['name'])){
    $foto = "uploads/". basename($_FILES['foto']['name']);
    move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
}

$sql = "INSERT INTO almacenes(nombre, direccion, latitud, longitud, foto) VALUES (?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdds", $nombre, $direccion, $latitud, $longitud, $foto);



if ($stmt->execute()){
    echo "Almacen guardado correctamente <br><br>";
    echo "<a href='almacen_crud.php'>Volver</a>";
}else{
    echo "Error al guardar el almacen".$stmt->error;
}
$stmt->close();
$conn->close();

?>