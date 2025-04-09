<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Consultar Orden</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Contacto</th>
            <th>Telefono</th>
            <th>fecha de Orden</th>
            <th>producto</th>
            <th>Cantidad</th>
            <th>total</th>
            <th>estado</th>
            <th>Acciones</th>
        </tr>
        <?php
        include '../conexion.php';
        $sql_ordenes = "SELECT * FROM ordenes";
        $result_ordenes = $conn ->query($sql_ordenes);
        $sql_proveedores = "SELECT * FROM proveedores";
        $result_proveedores = $conn ->query($sql_proveedores);
        $sql_productos = "SELECT * FROM productos";
        $result_productos = $conn ->query($sql_productos);
        $resultadoTotal = $result_ordenes->fetch_all(MYSQLI_ASSOC) + $result_proveedores->fetch_all(MYSQLI_ASSOC) + $result_productos->fetch_all(MYSQLI_ASSOC);
            while ($row = $resultadoTotal[0]) {?>
                <tr>                
                    <td><?=$row['nombre_cliente']?></td>
                    <td><?=$row['contacto_cliente']?></td>
                    <td><?=$row['telefono_cliente']?></td>
                    <td><?=$row['fecha_orden']?></td>
                    <td><?=$row['producto']?></td>
                    <td><?=$row['cantidad']?></td>
                    <td><?=$row['total']?></td>
                    <td><?=$row['estado']?></td>
                    
                    <td>
                        <a href="editar_orden.php?id=<?=$row['id_orden']?>">Editar</a> 
                        <a href="eliminar_orden.php?id=<?=$row['id_orden']?>">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        
    </table>
</body>
</html>