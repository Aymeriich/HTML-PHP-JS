<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'header.php' ?> 
    
    <?php
        if (empty($_POST) == false) {
            
            $nomarxiu = $_FILES["arxiu"]["name"];
            $rutaTMP = $_FILES["arxiu"]["tmp_name"];
            $extension = substr($nomarxiu, strpos($nomarxiu, "."));
            $numeros = rand(00000,99999);
            $rutaDestino = "files/".date("Ymd").$numeros.$extension;
            
            move_uploaded_file($rutaTMP, $rutaDestino);
            
            if (empty($_POST["nom"] == false)) {
                $nom = $_POST["nom"];
                $missatge = '<p>Hola '.$nom.', usa este enlace para compartir el archivo.</p>';
            }
            
            else {
                $missatge = 'Usa este enlace para compartir el archivo';
            }
                
        }
        else {
            header('Location: index.php');
        }
    
    ?>
    <section class="row">
        <div class="col">
            <img src="successful.png" />
        </div>
        <div class="col-md ">
            <?php echo $missatge ?>
        </div>
    </section>
</body>
</html>
