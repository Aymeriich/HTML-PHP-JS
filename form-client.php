<?php // REQUIRE I INCLUDE
	require "header.php";
    include "common/validacions.php";
?>
<?php

    $correcte = false;

    if(!empty($_POST)) {
        
        $obligatori = array('username', 'pass', 'rp_pass', 'nombre', 'apellidos', 'direccion', 'codigo_postal', 'poblacion');
        
        $complert = true;
        
        foreach ($obligatori as $camp) {
            if (!isset($_POST[$camp])) {
                $complert = false;
            }
        }
        
        if (!$complert) {
            echo "<div class=\"alert alert-danger\">Hi ha camps sense informació</div>";
        }
        $correcte = true;
        
        if (!nomUsuariValid($_POST['username'])) {
            echo "<div class=\"alert alert-danger\">El nom d'usuari ha de tenir un mínim de 8 caràcters</div>";
            $correcte = false;
        }
        if (seguretatContrasenya($_POST['pass']) != 3) {
            echo "<div class=\"alert alert-danger\">La contrasenya no és segura actualment; pots utilitzar números i caràcters especials.</div>";
            $correcte = false;
        }
        if ($_POST['pass'] != $_POST['rp_pass']) {
            echo "<div class=\"alert alert-danger\">Les contrasenyes no coincideixen.</div>";
            $correcte = false;
        }
        if (esEmail($_POST['mail'])) {
            echo "<div class=\"alert alert-danger\">L'email introduit no és vàlid.</div>";
            $correcte = false;
        }
        if (NIFValid($_POST['nif'])) {
            echo "<div class=\"alert alert-danger\">El format del NIF es incorrecte.</div>";
            $correcte = false;
        }
        if ($correcte) {
            $sql = "INSERT INTO clients (nom_usuari, contrasenya, nom, cognoms, nif, adreca, codi_postal, poblacio, telefon, email) VALUES ('$_POST[username]', '$_POST[pass]', '$_POST[nombre]', '$_POST[apellidos]', '$_POST[nif]', '$_POST[direccion]', '$_POST[codigo_postal]', '$_POST[poblacion]', '$_POST[telefono]', '$_POST[mail]')";
                        
            $result = $conn->query($sql);
            
            if ($result) {
                header("Location: entrar.php");
		    } else {
                echo "<div class=\"alert alert-danger\">Hi ha dades incorrectes. Comprova les dades.</div>";
		    }
        }
		$conn->close();
    }
        
        
?>
		<div class="container m-5 mx-auto text-white">
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
				<div class="fil">
					<div class="col-4 offset-2">
						<div class="form-group">
							<label for="username">Nom d'usuari (obligatori):</label>
							<input type="text" class="form-control" name="username" id="username" value='<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>' />
						</div>
						<div class="form-group">
							<label for="pass">Contrasenya (obligatori):</label>
							<input type="password" class="form-control" name="pass" id="pass" value='<?php echo isset($_POST['pass']) ? $_POST['pass'] : ''; ?>' />
						</div>
						<div class="form-group">
							<label for="rp_pass">Repeteix la contrasenya (obligatori):</label>
							<input type="password" class="form-control" name="rp_pass" id="rp_pass" value='<?php echo isset($_POST['rp_pass']) ? $_POST['rp_pass'] : ''; ?>' />
						</div>
						<div class="form-group">
							<label for="nombre">Nom (obligatori):</label>
							<input type="text" class="form-control" name="nombre" id="nombre" value='<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>' />
						</div>
						<div class="form-group">
							<label for="apellidos">Cognoms (obligatori):</label>
							<input type="text" class="form-control" name="apellidos" id="apellidos" value='<?php echo isset($_POST['apellidos']) ? $_POST['apellidos'] : ''; ?>' />
						</div>
						<div class="form-group">
							<label for="nif">NIF (obligatori):</label>
							<input type="text" class="form-control" name="nif" id="nif" value='<?php echo isset($_POST['nif']) ? $_POST['nif'] : ''; ?>' />
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="direccion">Adreça (obligatori):</label>
							<input type="text" class="form-control" name="direccion" id="direccion" value='<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : ''; ?>' />
						</div>
						<div class="form-group">
							<label for="codigo_postal">Codi postal (obligatori):</label>
							<input type="text" class="form-control" name="codigo_postal" id="codigo_postal" value='<?php echo isset($_POST['codigo_postal']) ? $_POST['codigo_postal'] : ''; ?>' />
						</div>
						<div class="form-group">
							<label for="poblacion">Població (obligatori):</label>
							<select class="form-control" name="poblacion" id="poblacion">
                            <option value ="" selected disabled hidden>Seleccione una población</option>
							 
                            <?php 
                                $sql = "SELECT id_poblacio, nom FROM poblacions ORDER BY nom";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
								    while ($fil = $result->fetch_assoc()){ 
                                         echo "<option value=\"$fil[id_poblacio]\">$fil[nom]</option>";
                                    }
                                }
							?>

							</select>
						</div>
						<div class="form-group">
							<label for="telefono">Telèfon:</label>
							<input type="text" class="form-control" name="telefono" id="telefono" value='<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : ''; ?>' />
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="text" class="form-control" name="mail" id="mail" value='<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>' />
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-default">Enviar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
