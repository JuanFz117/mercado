<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/estilo.css">
</head>
<body>
    <h2>Actualizar categoria</h2>
    <form action="update_categoria.php" method="post">
        <label for="id_categoria">Selecciona Categoria</label>
        <select name="id_categoria" required>
            <option value="">Seleccione una categoria</option>
            <?php
             include '../conexion.php';
             $sql= "SELECT id_categoria, nombre_categoria FROM categorias";
            $result =$conn->query($sql);
            while ($row = $result-> fetch_assoc()){
                 echo "<option value= ' ".$row['id_categoria']."'>".$row['nombre_categoria']."</option>";

             }
            
            ?>
        </select>
        <input type="text" name="nuevo_nombre" placeholder="Nuevo nombre de la categoria" required>
        <button type="submit" name="actualizar">Actualizar categoria</button>
    </form>
</body>
</html>