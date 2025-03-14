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

if ($result->num_rows > 0 ){
    while ($row = $result->fetch_assoc()){
        echo $row["nombre_categoria"]. "<br>";
    }
}else {
     echo "0 resultados";
}
 $conn ->close();

?>