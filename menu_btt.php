<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
<link rel="stylesheet" href="estilo.css">
</head>
<body>
    <form method="post" name="form" >
        <fieldset>
            <h2>Menus</h2>
            <input type="button" value="Gestion de productos" id="Gestion de productos" name="Gestion de productos" onclick="document.form.action='productos.php';
               document.form.submit()"/>
            <input type="button" value="Gestion de categorias" id="Gestion de categorias" name="Gestion de categorias" onclick="document.form.action='frm_categoria.php';
               document.form.submit()"/>
                <input type="button" value="Gestionar clientes" id="Gestionar clientes" name="Gestionar clientes" onclick="document.form.action='clientes.php';
                 document.form.submit()"/>  
                <input type="button" value="Gestionar facturas" id="Gestionar facturas" name="Gestionar facturas" onclick="document.form.action='factura_crud.php';
               document.form.submit()"/>  
        </fieldset>
    </form>
</body>
</html>