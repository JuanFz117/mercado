<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $password = $_POST['pass_usuario'];


    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        
        if (password_verify($password, $user['pass_usuario'])) {
            $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
            $_SESSION['id_usuario'] = $user['id_usuario'];
            header("Location: menu_btt.php");
            exit();
        } else {
            $_SESSION['error'] = "Contraseña incorrecta";
            header("Location: inicio.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Usuario no encontrado";
        header("Location: inicio.php");
        exit();
    }
}
?>
