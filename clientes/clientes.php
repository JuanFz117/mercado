<?php
// conexion.php
$conn = new mysqli('localhost', 'root', '', 'mercado');
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Crear tabla de clientes si no existe
$sql = "CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre_cliente VARCHAR(50) NOT NULL,
    email_cliente VARCHAR(100) NOT NULL,
    telefono_cliente VARCHAR(20)
)";
$conn->query($sql);

// Procesar acciones CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);

    if (!empty($nombre) && !empty($email)) {
        if (isset($_POST['id_cliente']) && !empty($_POST['id_cliente'])) {
            // Actualizar
            $id_cliente = intval($_POST['id_cliente']);
            $stmt = $conn->prepare("UPDATE clientes SET nombre_cliente=?, email_cliente=?, telefono_cliente=? WHERE id_cliente=?");
            $stmt->bind_param('sssi', $nombre, $email, $telefono, $id_cliente);
        } else {
            // Insertar
            $stmt = $conn->prepare("INSERT INTO clientes (nombre_cliente, email_cliente, telefono_cliente) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $nombre, $email, $telefono);
        }
        if ($stmt->execute()) {
            echo 'Operación realizada con éxito';
        } else {
            echo 'Error: ' . $stmt->error;
        }
    } else {
        echo 'Por favor complete todos los campos obligatorios.';
    }
    header('Location: clientes.php');
    exit;
}

if (isset($_GET['eliminar'])) {
    $id_cliente = intval($_GET['eliminar']);
    $conn->query("DELETE FROM clientes WHERE id_cliente=$id_cliente");
    header('Location: clientes.php');
    exit;
}

// Obtener datos para mostrar
$result = $conn->query("SELECT * FROM clientes");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>CRUD de Clientes</title>
    <link rel="stylesheet" href="../styles/estilo.css" />
</head>
<body>
    <h2>Formulario de Clientes</h2>
    <form action="clientes.php" method="POST">
        <input type="hidden" name="id_cliente" value="<?= isset($_GET['editar']) ? htmlspecialchars($_GET['editar']) : '' ?>">
        <label>Nombre: <input type="text" name="nombre" value="<?= isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '' ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>" required></label><br>
        <label>Teléfono: <input type="text" name="telefono" value="<?= isset($_GET['telefono']) ? htmlspecialchars($_GET['telefono']) : '' ?>"></label><br>
        <button type="submit">Guardar</button>
    </form>


    <h2>Lista de Clientes</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?= $row['id_cliente'] ?></td>
            <td><?= htmlspecialchars($row['nombre_cliente']) ?></td>
            <td><?= htmlspecialchars($row['email_cliente']) ?></td>
            <td><?= htmlspecialchars($row['telefono_cliente']) ?></td>
            <td>
                <a href="clientes.php?editar=<?= $row['id_cliente'] ?>&nombre=<?= urlencode($row['nombre_cliente']) ?>&email=<?= urlencode($row['email_cliente']) ?>&telefono=<?= urlencode($row['telefono_cliente']) ?>">Editar</a>
                <a href="clientes.php?eliminar=<?= $row['id_cliente'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>