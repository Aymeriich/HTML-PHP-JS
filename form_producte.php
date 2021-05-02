<?php
	require "header.php";
    
    if(isset($_GET['codi'])) {
            $codi = $_GET['codi'];
            $sql = "SELECT * FROM productes WHERE codi = '$codi'";
        
            $result = $conn->query($sql);
        
            $producte = $result->fetch_assoc();
    }

    if (!empty($_POST)) {
        
        $nomArxiu = $_POST["codi"];
        $rutaTemporal = $_FILES["imatge"]["tmp_name"];
        $extensio = substr($_FILES["imatge"]["name"], strpos($_FILES["imatge"]["name"], "."));
        $rutaDesti = "images/productes/".$nomArxiu.$extensio;
        
        move_uploaded_file($rutaTemporal, $rutaDesti);

        
        $sql = "INSERT INTO productes (codi, categoria, nom, preu, unitats_stock, imatge) VALUES ('$_POST[codi]', '$_POST[categoria]', '$_POST[nom]', '$_POST[preu]', '$_POST[stock]', '$rutaDesti')";
        
        $result = $conn->query($sql);
            
        if ($result) {
            echo "<div class=\"alert alert-success\">El producte s'ha inserit correctament.</div>";
        } else {
            echo "<div class=\"alert alert-danger\">El producte no s'ha pogut inserir correctament.</div>";
        }

    }
?>
		<div class="container m-5 mx-auto text-white">
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-4 offset-2">
						<div class="form-group">
							<label for="codi">Codi:</label>
							<input type="text" class="form-control" name="codi" id="codi" value='<?php echo isset($_POST['codi']) ? $_POST['codi'] : (isset($_GET['codi']) ? $producte['codi'] : ''); ?>' />
						</div>
						<div class="form-group">
							<label for="nom">Nom:</label>
							<input type="text" class="form-control" name="nom" id="nom" value='<?php echo isset($_POST['nom']) ? $_POST['nom'] : (isset($_GET['codi']) ? $producte['nom'] : ''); ?>' />
						</div>
						<div class="form-group">
							<label for="categoria">Categoria:</label>
							<select class="form-control" name="categoria" id="categoria">
								<option value="" selected hidden disabled><?php echo isset($_POST['categoria']) ? $_POST['categoria'] : (isset($_GET['codi']) ? $producte['categoria'] : ''); ?></option>
								
								<?php 
                                    $sql = "SELECT id_categoria, nom FROM categories ORDER BY nom";
                                    $result = $conn->query($sql);
                                    if ($result->numfil > 0) {
								        while ($fil = $result->fetch_assoc()){ 
                                            echo "<option value=\"$fil[id_categoria]\">$fil[nom]</option>";
                                        }
                                    } 
								?>

							</select>
						</div>
						<div class="form-group">
							<label for="preu">Preu:</label>
							<input type="number" class="form-control" name="preu" id="preu" value='<?php echo isset($_POST['preu']) ? $_POST['preu'] : (isset($_GET['codi']) ? $producte['preu'] : ''); ?>' />
						</div>
						<div class="form-group">
							<label for="stock">Unitats en stock:</label>
							<input type="number" class="form-control" name="stock" id="stock" value='<?php echo isset($_POST['stock']) ? $_POST['stock'] : (isset($_GET['codi']) ? $producte['unitats_stock'] : ''); ?>' />
						</div>
						<div class="form-group text-right">
							<a href="productes.php" class="btn btn-outline-secondary mx-2">Tornar</a>
							<button type="submit" class="btn btn-default">Guardar</button>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="imatge">Imatge:</label>
							<input type="file" class="form-control" name="imatge" id="imatge" />
						</div>
						<div class="text-center">
							<img src="<?php echo isset($_GET['codi']) ? $producte['imatge'] : 'images/productes/no-image.png'; ?>" class="img-thumbnail" style="height: 250px;" />
						</div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
