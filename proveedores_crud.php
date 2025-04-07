<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <form action="guardar_proveedor.php" method="post" id="form" name="form">
        <fieldset>
            <h2>Proveedores CRUD</h2>
            <input type="text" name="nombre_proveedor" id="nombre_proveedor" placeholder="Nombre Proveedor" required><br><br>
            <input type="text" name="contacto_interno" id="contacto_interno" placeholder="contacto interno" required><br><br>
            <input type="text" name="telefono_contacto" id="telefono_contacto" placeholder="Telefono Proveedor" required><br><br>
            <input type="text" name="email_contacto" id="email_contacto" placeholder="Email Proveedor" required><br><br>
            <input type="text" name="direccion" id="direccion" placeholder="Direccion Proveedor" required><br><br>
            <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad Proveedor" required><br><br>
            <input type="text" name="pais" id="pais" placeholder="Pais Proveedor" required><br><br>
            <input type="text" name="observaciones" id="observaciones" placeholder="Observaciones Proveedor"><br><br>
            <input type="button" value="enviar" id="enviar" name="enviar" onclick="document.form.action='guardar_proveedor.php';document.form.submit()"/>
        </fieldset>
    </form>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Contacto</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Direccion</th>
            <th>Ciudad</th>
            <th>Pais</th>
            <th>Acciones</th>
        </tr>
        <?php
        include 'conexion.php';
        $sql = "SELECT * FROM proveedores";
        $result= $conn ->query($sql);
        
            while ($row = $result-> fetch_assoc()) {?>
                <tr>                
                    <td><?=$row['nombre_proveedor']?></td>
                    <td><?=$row['contacto_interno']?></td>
                    <td><?=$row['telefono_contacto']?></td>
                    <td><?=$row['email_contacto']?></td>
                    <td><?=$row['direccion']?></td>";
                    <td><?=$row['ciudad']?></td>
                    <td><?=$row['pais']?></td>
                    
                    <td>
                        <a href="editar_proveedor.php?id=<?=$row['id_proveedor']?>">Editar</a> 
                        <a href="eliminar_proveedor.php?id=<?=$row['id_proveedor']?>">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
    </table>

</body>
</html>