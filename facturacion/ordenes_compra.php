<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercado";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$sqlProveedores = "SELECT * FROM proveedores";
$sqlProveedores = $conn->query($sqlProveedores);

$sqlClientes = "SELECT id_cliente, nombre_cliente FROM clientes";
$resultClientes = $conn->query($sqlClientes);

$ordenCompra = "SELECT * FROM ordenes_compra";
$ordenCompra = $conn->query($ordenCompra);

$sqlProductos = "SELECT id_producto, nombre_producto, valor_producto FROM productos";
$resultProductos = $conn->query($sqlProductos);

$result = $conn->query("SHOW COLUMNS FROM ordenes_compra LIKE 'estado'");
$row = $result->fetch_assoc();

$enum = $row['Type']; // algo como: enum('Pendiente','Procesada','Cancelada')

// Limpiar y separar los valores del ENUM
$enum = str_replace(["enum('", "')"], '', $enum);
$valores = explode("','", $enum);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orden de compra</title>
    <link rel="stylesheet" href="../styles/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Orden de compra</h2>
        <div class="total-factura">Total orden de compra: <span id="totalFacturaActual">$0.00</span></div>
        <form action="procesar_compra.php" method="post">
            <label>Fecha de Emisión:</label>
            <input type="date" name="fecha_emision" value="<?php echo date('Y-m-d'); ?>" required>
            
            <label>Proveedor:</label>
            <select name="id_proveedor" required>
                <option value="">Seleccionar proveedor</option>
                <?php while ($row = $sqlProveedores->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id_proveedor']; ?>"><?php echo $row['nombre_proveedor']; ?></option>
                    <!-- <?php echo $row['contacto_interno']; ?> -->
                <?php } ?>
            </select>
            <label for="estado">Estado:</label>
                <select name="estado" id="estado">
                    <option value="">Seleccione un estado</option>
                    <?php foreach ($valores as $estado) { ?>
                        <option value="<?php echo $estado; ?>"><?php echo $estado; ?></option>
                    <?php } ?>
                    </select>
            <h3>Productos</h3>
            <table id="productosTable">
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </table>
            <!-- <input type="button" value="Consultar" id="Consultar" name="Consultar" onclick="document.form.action='consultar_orden.php';
                document.form.submit()"/> -->
            <button type="button" onclick="agregarProducto()">Agregar Producto</button>
            <input type="submit" value="Terminar Orden">
            
        </form>
    </div>

    <script>
        let productos = [];
        <?php while ($row = $resultProductos->fetch_assoc()) { ?>
            productos.push({ id: <?php echo $row['id_producto'];?>, nombre: "<?php echo $row['nombre_producto'];?>", precio: <?php echo $row['valor_producto'];?> });
        <?php } ?>

        function agregarProducto() {
    const table = document.getElementById('productosTable');
    const row = table.insertRow();

    // Crear select de productos
    let select = document.createElement('select');
    select.name = 'productos[]';
    select.onchange = actualizarTotal;

    let optionDefault = document.createElement('option');
    optionDefault.text = 'Seleccionar producto';
    optionDefault.value = "";
    select.appendChild(optionDefault);

    productos.forEach(prod => {
        let option = document.createElement('option');
        option.value = prod.id;
        option.text = `${prod.nombre} - $${prod.precio}`;
        select.appendChild(option);
    });

    row.insertCell(0).appendChild(select);

    // Crear input de cantidad
    let cantidad = document.createElement('input');
    cantidad.type = 'number';
    cantidad.name = 'cantidad[]';
    cantidad.min = 1;
    cantidad.value = 1;
    cantidad.onchange = actualizarTotal;
    row.insertCell(1).appendChild(cantidad);

    // Crear celda de precio unitario
    let precioUnitario = document.createElement('span');
    precioUnitario.innerText = "$0.00";
    row.insertCell(2).appendChild(precioUnitario);

    // Crear celda de total
    let total = document.createElement('span');
    total.innerText = "$0.00";
    row.insertCell(3).appendChild(total);

    // Crear botón de eliminar
    let botonEliminar = document.createElement('button');
    botonEliminar.innerText = 'Borrar';
    botonEliminar.onclick = function () { table.deleteRow(row.rowIndex); actualizarTotal(); }
    row.insertCell(4).appendChild(botonEliminar);
}


        function actualizarTotal() {
            const rows = document.querySelectorAll('#productosTable tr');
            let totalFactura = 0;

            rows.forEach((row, index) => {
                if (index === 0) return;
                const select = row.cells[0].querySelector('select');
                const cantidad = parseInt(row.cells[1].querySelector('input').value);
                const producto = productos.find(p => p.id == select.value);

                row.cells[2].querySelector('span').innerText = `$${producto.precio.toFixed(2)}`;
                const totalProducto = producto.precio * cantidad;
                row.cells[3].querySelector('span').innerText = `$${totalProducto.toFixed(2)}`;
                totalFactura += totalProducto;
            });
            document.getElementById('totalFacturaActual').innerText = `$${totalFactura.toFixed(2)}`;
        }
    </script>
</body>
</html>
<?php $conn->close(); ?>
