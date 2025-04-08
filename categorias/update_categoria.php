<?php
include '../conexion.php';

if (isset($_POST['actualizar'])){
    $id_categoria =$_POST['id_categoria'];
    $nuevo_nombre = $_POST['nuevo_nombre'];

    $sql = "UPDATE categorias SET nombre_categoria = ? WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si",$nuevo_nombre, $id_categoria);



    if ($stmt->execute()){
        echo "Categoria actualizar con exito ";

    }else{
        echo "Error al actualizar la categoria".$stmt->error;
    }

    $stmt->close();
    $conn->close();
}


?>
