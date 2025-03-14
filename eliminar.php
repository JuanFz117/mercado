<?php
$severname= "localhost";
$username= "root";
$password = "";
$bdname = "mercado";
$name1=$_POST['nombre_categoria'];

$conn = new mysqli($severname, $username, $password, $bdname);


if ($conn -> connect_error){
    die("connection fieled: " . $conn ->connect_error);
}


$sql= "DELETE FROM categorias WHERE nombre_categoria = '$name1'";

if ($conn->query($sql) === TRUE){  
    echo " record deleted successfully";
} else { 
    echo " Error deleting record" . $conn->error;
}
$conn->close();


?>