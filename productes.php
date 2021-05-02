<?php
	require "header.php";

    if (!empty($_POST)) {
        $sql = "DELETE FROM productes WHERE codi = '$_POST[codi]'";
        
        $result = $conn->query($sql);
        
        unset($sql);
        unset($result);
    }
?>
		<div class="container m-5 mx-auto">
			<div class="col-8 offset-2">
				<table class="table">        
					<tr> 
						<th>Producte</th> 
						<th>Categoria</th>
						<th>Preu</th>
						<th></th>
					</tr>
                    <tr> 
                        <?php       
                            $sql = "SELECT * FROM detall_productes";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($files = $result->fetch_assoc()){ 
                                    echo "<tr>
                                          <td class=\"align-middle\">
							                 <img src=\"$files[imatge]\" class=\"img-thumbnail mr-2\" style=\"height: 50px;\" />
							                 $files[nom]
						                  </td>
						                  <td class=\"align-middle\">$files[nom_categoria]</td>
						                  <td class=\"align-middle\">$files[preu] €</td>
						                  <td class=\"align-middle\">
							                 <form class=\"form-inline\" action=$_SERVER[PHP_SELF] method=\"post\">
								                <a href=\"form_producte.php?codi=$files[codi]\" class=\"btn btn-primary\"><i class=\"fas fa-pencil-alt\"></i></a>
								                <div class=\"form-group\">
									               <input type=\"hidden\" name=\"codi\" value=\"$files[codi]\" />
								                </div>
								                <button type=\"submit\" class=\"btn btn-primary\"><i class=\"fas fa-trash-alt\"></i></button>
							                 </form>
						                  </td>
                                          </tr>";
                                }
                            } 
                            $conn->close();
                        ?>
					</tr>
					
				</table>
			</div>
		</div>
	</body>
</html>
