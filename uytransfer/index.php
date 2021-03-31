<!DOCTYPE html>
<html lang="">
<head>
    <title>uytransfer</title>
</head>
<body>
    <?php include 'header.php' ?> 
    <div class="col-lg-5 col-md-8 col-sm-10 col mx-auto">
        <form name="upload" class="col" action="upload.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <input name="nom" class="col-lg col-sm-12 col-12 mt-5 form-control" type="text" placeholder="Tu Nombre" />
            
            <div class="col mt-4 custom-file">
                <input name="arxiu" class="custom-file-input" type="file" placeholder="Selecciona un archivo" />
                <label class="custom-file-label" for="customFile">Selecciona un archivo</label>
            </div>
            
            <div class="col custom-control custom-checkbox mt-4 mb-4">
                <input name="validacio" id="checkbox" class="custom-control-input" type="checkbox" />
                <label for="checkbox" class="custom-control-label">Quiero enviar el link de descarga por email</label>
            </div>
            
            <input name="mail" class="col-12 form-control" type="email" placeholder="Email del destinatario" />
            
            <label for="msg" class="col-12 mt-4">Mensaje</label>
            <textarea name="msg" class="col form-control" id="msg" form="upload"></textarea>
            
            <div class="mt-5 text-right">
                <button type="submit" value="upload" class="btn btn-outline-secondary">Subir Archivo</button>
            </div>
        </form>
    </div>
</body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet"> 
</html>
