<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/estilo.css">
</head>
<body>
    
        <form id="form" method="post" name="form">
            <fieldset>
                <h1>Categorias</h1>
            <label for="">Nombre de la categoria <input type="text" name="nombre_categoria"size="40" maxlegth="10" tabindex="1" autofocus><br><br>


            </label>
            </fieldset>
            <input type="button" value="Insertar datos" id="nuevo" name="nuevo" onclick="document.form.action='insertar.php'; 
              document.form.submit()"/>
            <input type="button" value="Eliminar datos" id="eliminar" name="eliminar" onclick="document.form.action='eliminar.php';
              document.form.submit()"/>
            <input type="button" value="Consulta" id="consulta" name="consulta" onclick="document.form.action='consulta.php';
               document.form.submit()"/>
            <input type="button" value="Actualizar" id="actualizar" name="actualizar" onclick="document.form.action='frm_actualizar.php';
               document.form.submit()"/>

            
        </form>
    
</body>
</html>