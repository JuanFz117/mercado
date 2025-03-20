<?php
include 'conexion.php';


$sql = "SELECT p.id_producto, p.nombre_producto, p.cantidad_producto ,p.valor_producto, c.nombre_categoria FROM productos p JOIN categorias c ON p.id_categoria = c.id_categoria";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Reseteo de márgenes y paddings predeterminados */
/* Diseño galáctico */
body {
    background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
    font-family: 'Arial', sans-serif;
    color: white;
    margin: 0;
    padding: 0;
    height: 100vh;
}
h3{
    text-align: center;
    margin: 18px;
}
h2 {
    text-align: center;
    color: #fff;
    font-size: 2em;
    margin-top: 30px;
}

form {
    background: rgba(0, 0, 0, 0.6);
    padding: 20px;
    border-radius: 10px;
    width: 60%;
    margin: 20px auto;
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
}

form label {
    display: block;
    margin-bottom: 10px;
    font-size: 1.1em;
}

form input[type="text"], form input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #3a3a3a;
    background-color: #16213e;
    color: white;
    font-size: 1em;
}

form input[type="text"]:focus, form input[type="email"]:focus {
    outline: none;
    border-color: #00ff99;
    box-shadow: 0 0 5px #00ff99;
}

form button {
    background-color: #00ff99;
    color: #16213e;
    border: none;
    padding: 10px 20px;
    margin-top: 15px;
    font-size: 1.2em;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s;
}

form button:hover {
    background-color: #00cc80;
}

table {
    width: 80%;
    margin: 30px auto;
    border-collapse: collapse;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
}

th, td {
    padding: 10px;
    text-align: center;
    font-size: 1.1em;
    border: 1px solid #444;
}

th {
    background-color: #16213e;
    color: #00ff99;
}

td {
    background-color: #0f3460;
}

a {
    color: #00ff99;
    text-decoration: none;
    margin-right: 10px;
    transition: color 0.3s;
}

a:hover {
    color: #00cc80;
}

a:active {
    color: #ffffff;
}

button:focus, a:focus {
    outline: none;
}

    </style>
    
</head>
<body>
    <h2>Gestion de Productos</h2>


    <h3>Agregar Productos</h3>
    <form action="insertar_producto.php" method="post">
        <input type="text" name="nombre_producto" id="nombre_producto" placeholder="Nombre del producto" required>
        <input type="number" name="cantidad_producto" id="cantidad_producto" placeholder="Cantidad" required>
        <input type="number" name="valor_producto" id="valor_producto" placeholder="Valor" required>
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
            <th>Categoria</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Valor</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()):?>
            <tr>
                <td><?=$row['id_producto']?></td>
                <td><?=$row['nombre_categoria']?></td>
                <td><?=$row['nombre_producto']?></td>
                <td><?=$row['cantidad_producto']?></td>
                <td><?=$row['valor_producto']?></td>

                <td>
                     <a href="update.php?id=<?= $row['id_producto'] ?>">Editar</a> |
                     <a href="delete.php?id=<?= $row['id_producto'] ?>">Eliminar</a>
                </td>  
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>