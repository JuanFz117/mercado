<?php
$severname= "localhost";
$username= "root";
$password = "";
$bdname = "mercado";


$conn = new mysqli($severname, $username, $password, $bdname);

if ($conn-> connect_error){
    die("connection falied ". $conn -> connect_error);
}

$sql ="SELECT nombre_categoria FROM categorias";
$result = $conn->query($sql);

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
    <h2>Consulta de Categorias</h2>
    <table border="1">
        <tr>
            <th>Nombre Categoria</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) {?>
        <tr>
            <td><?=$row['nombre_categoria'];?></td>
        </tr>
        <?php } ?>
    </table>

    <button onclick="document.form.action='frm_categoria.php'">Regresar</button>
<?php $conn ->close(); ?>
</body>
</html>