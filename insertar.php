<?php
$severname= "localhost";
$username= "root";
$password = "";
$bdname = "mercado";
$name1=$_POST['nombre_categoria'];

$conn = new mysqli($severname, $username, $password, $bdname);


if ($conn ->connect_error) {
    die ("connection falied" . $conn->connect_error);
}

$sql = "INSERT INTO categorias(nombre_categoria) VALUES ('$name1')";


if($conn->query($sql) === TRUE){
    echo "new record created suceccesfully";
} else {
    echo "error: " . $sql ." <br>" . $conn->error;
}

$conn->close();


?>