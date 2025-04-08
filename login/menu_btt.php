<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
<link rel="stylesheet" href="../styles/estilo.css">
</head>
<body>
    <form method="post" name="form" >
        <fieldset>
            <h2>Menus</h2>
            <input type="button" value="Gestion de productos" id="Gestion de productos" name="Gestion de productos" onclick="document.form.action='../productos/formulario_productos.php';
               document.form.submit()"/>
            <input type="button" value="Gestion de categorias" id="Gestion de categorias" name="Gestion de categorias" onclick="document.form.action='../categorias/frm_categoria.php';
               document.form.submit()"/>
                <input type="button" value="Gestionar clientes" id="Gestionar clientes" name="Gestionar clientes" onclick="document.form.action='../clientes/clientes.php';
                 document.form.submit()"/>  
                <input type="button" value="Gestionar facturas" id="Gestionar facturas" name="Gestionar facturas" onclick="document.form.action='../facturacion/factura_crud.php';
               document.form.submit()"/>  
                <input type="button" value="Gestionar almacenes" id="Gestionar almacenes" name="Gestionar almacenes" onclick="document.form.action='../almacen/almacen_crud.php';
                document.form.submit()"/>
                <input type="button" value="Gestionar proveedor" id="Gestionar proveedor" name="Gestionar proveedor" onclick="document.form.action='../clientes/proveedores_crud.php';
                document.form.submit()"/>
        </fieldset>
    </form>
</body>
</html>