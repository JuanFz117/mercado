<?php
include 'conexion.php';


$sql = "SELECT p.id_producto, p.nombre_producto, p.cantidad_producto , c.nombre_categoria FROM productos p JOIN categorias c ON p.id_categoria = c.id_categoria";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Gestion de Productos</h2>


    <h3>Agregar Productos</h3>
    <form action="insertar_producto.php" method="post">
        <input type="text" name="nombre_categoria" id="nombre_categoria" placeholder="Nombre del producro" required>
        <input type="number" name="cantidad_producto" id="cantidad_producto" placeholder="Cantidad" required>
        <select name="id_categoria" id=""required>
            <option value="">Selecione una categoria</option>
                <?php
                    
                     $sqlCat= "SELECT id_categoria, nombre_categoria FROM categorias";
                     $resultCat =$conn->query($sqlCat);
                     while ($rowCat = $resultCat-> fetch_assoc()){
                         echo "<option value= ' ".$rowCat['id_categoria']."'>".$rowCat['nombre_categoria']."</option>";
                     }
                ?>
        </select>
        <button type="submit" name="insertar">Agregar</button>
    </form>
    <h3>Lista De Productos</h3>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Categoria</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()):?>
            <tr>
                <td><?=$row['id_producto']?></td>
                <td><?=$row['nombre_producto']?></td>
                <td><?=$row['cantidad_producto']?></td>
                <td><?=$row['nombre_categoria']?></td>
                <td>
                     <a href="update.php?id=<?= $row['id_producto'] ?>">Editar</a> |
                     <a href="delete.php?id=<?= $row['id_producto'] ?>">Eliminar</a>
                </td>  
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>