<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mercado";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sqlClientes = "SELECT id_cliente, nombre_cliente FROM clientes";
$resultClientes = $conn->query($sqlClientes);

$sqlProductos = "SELECT ID_PRODUCTO, NOMBRE_PRODUCTO, VALOR_PRODUCTO FROM productos";
$resultProductos = $conn->query($sqlProductos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación</title>
    
</head>
<body>
    <div class="container">
        <h2>Facturación</h2>
        <div class="total-factura">Total factura Actual: <span id="totalFacturaActual">$0.00</span></div>
        <form action="procesar_factura.php" method="post">
            <label>Fecha de Emisión:</label>
            <input type="date" name="fecha_emision" value="<?php echo date('Y-m-d'); ?>" required>
            
            <label>Cliente:</label>
            <select name="id_cliente" required>
                <option value="">Seleccionar cliente</option>
                <?php while ($row = $resultClientes->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id_cliente']; ?>"> <?php echo $row['nombre_cliente']; ?> </option>
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
            
            <button type="button" onclick="agregarProducto()">Agregar Producto</button>
            <input type="submit" value="Terminar Factura">
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

            let select = document.createElement('select');
            select.name = 'productos[]';
            productos.forEach(prod => {
                let option = document.createElement('option');
                option.value = prod.id;
                option.text = ${prod.nombre} - $${prod.precio.toFixed(2)};
                select.appendChild(option);
            });
            row.insertCell(0).appendChild(select);

            let cantidad = document.createElement('input');
            cantidad.type = 'number';
            cantidad.name = 'cantidad[]';
            cantidad.min = 1;
            cantidad.value = 1;
            cantidad.onchange = actualizarTotal;
            row.insertCell(1).appendChild(cantidad);

            let precioUnitario = document.createElement('span');
            precioUnitario.innerText = "$0.00";
            row.insertCell(2).appendChild(precioUnitario);

            let total = document.createElement('span');
            total.innerText = "$0.00";
            row.insertCell(3).appendChild(total);

            let botonEliminar = document.createElement('button');
            botonEliminar.innerText = 'Borrar';
            botonEliminar.classList.add('btn-delete');
            botonEliminar.onclick = function () { table.deleteRow(row.rowIndex); actualizarTotal(); }
            row.insertCell(4).appendChild(botonEliminar);
            actualizarTotal();
        }

        function actualizarTotal() {
            const rows = document.querySelectorAll('#productosTable tr');
            let totalFactura = 0;

            rows.forEach((row, index) => {
                if (index === 0) return;
                const select = row.cells[0].querySelector('select');
                const cantidad = parseInt(row.cells[1].querySelector('input').value);
                const producto = productos.find(p => p.id == select.value);

                row.cells[2].querySelector('span').innerText = $${producto.precio.toFixed(2)};
                const totalProducto = producto.precio * cantidad;
                row.cells[3].querySelector('span').innerText = $${totalProducto.toFixed(2)};
                totalFactura += totalProducto;
            });
            document.getElementById('totalFacturaActual').innerText = $${totalFactura.toFixed(2)};
        }
    </script>
</body>
</html>
<?php $conn->close(); ?>
