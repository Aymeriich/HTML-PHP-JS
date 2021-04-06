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
            
            $nomArxiu = $_FILES["arxiu"]["name"];
            $rutaTemporal = $_FILES["arxiu"]["tmp_name"];
            $extension = substr($nomArxiu, strpos($nomArxiu, "."));
            $numeros = rand(00000,99999); 
            $rutaDesti = "files/".date("Ymd").$numeros.$extension;
            $linkAcces = "<a class=\"h3\" href=\"$rutaDesti\">uytransfer/$rutaDesti</a>";
            $foto = "successfull.png";
            
            move_uploaded_file($rutaTemporal, $rutaDesti);
            
            if (empty($_POST["nom"] == false)) {

                $nom = $_POST["nom"];
                $missatge = 'Hola '.$nom.', usa este link para compartir tu archivo.'; 

            }
            else {

                $missatge = 'Aqui tienes el enlace para compartir el archivo.';

            }
            
            $tamany = $_FILES['arxiu']['size'];
            
            if ($tamany > 10485760) {

                $missatge = "ERROR"; 
                $linkAcces = "<p class=\"h3\"> El archivo seleccionado supera los 10MB permitidos. </p>";
                $foto = "error.png";

            }
            
            if ($extension == ".pdf" || $extension == ".png" || $extension == ".jpg" || $extension == ".rar" || $extension == ".zip") { 

                // No passa res

            } else {

                $missatge = "ERROR";
                $linkAcces = "<p class=\"h4\">El archivo no es de un tipo permitido. Debe ser PDF, PNG, JPG, RAR o ZIP.</p>";
                $foto = "error.png";

            }
            

            if (isset($_POST['validacio'])) {
                
                $email = test_input($_POST["mail"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location: index.php?error_mail=1");
                }
                
                $destino = $_POST['mail'];
                $asunto = 'Fichero compartido desde uyTransfer';
                $campmissatge = isset($_POST['missatge']);

                if ($campmissatge == 1) {

                    $missatgecorreu = htmlspecialchars($_POST['missatge'])."<p> Link de acceso al archivo </p>".$linkAcces;
               
                } else {

                    $missatgecorreu = 'Te han enviado un archivo.';      
               
                }

                mail ($destino,$asunto,$missatgecorreu);
            }
            
            
                
        }
        else {
            header("Location: index.php");
        }
    
    ?>
    <div class="row">
        <div class="col">
            <img src="<?php echo $foto ?>"  class="mx-auto d-block"/>
        </div>
        <div class="row col-12 col-lg-8 mt-5 mt-lg-0">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <p class="text-center h2"><?php echo $missatge ?></p>
            </div>
            <div class="col-12 d-flex justify-content-center align-items-top mt-5 mt-lg-0">
                <?php echo $linkAcces ?>
            </div>
        </div>
    </main>
</body>
</html>

