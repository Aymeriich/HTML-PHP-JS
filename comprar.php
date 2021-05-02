<?php
	require "header.php";

    if(!isset($_GET['cat'])) {
            $productes = "Els nostres productes";
            $sql = "SELECT * FROM detall_productes";
    } else {
            $categoria = $_GET['cat'];
            $sql = "SELECT * FROM detall_productes WHERE codi_categoria = '$categoria'";
    }
?>
		<div class="container m-5 mx-auto">
			<div class="row">
				<div class="col-2 offset-1">
					<div class="list-group">
						<a href="comprar.php?cat=1" class="list-group-item list-group-item-action">Arròs</a>
						<a href="comprar.php?cat=2" class="list-group-item list-group-item-action">Begudes</a>
						<a href="comprar.php?cat=3" class="list-group-item list-group-item-action">Drogueria</a>
						<a href="comprar.php?cat=4" class="list-group-item list-group-item-action">Conserves</a>
						<a href="comprar.php?cat=5" class="list-group-item list-group-item-action">Esmorzars</a>
						<a href="comprar.php?cat=6" class="list-group-item list-group-item-action">Mascotes</a>
						<a href="comprar.php?cat=7" class="list-group-item list-group-item-action">Lactis i ous</a>
						<a href="comprar.php?cat=8" class="list-group-item list-group-item-action">Llegums</a>
						<a href="comprar.php?cat=9" class="list-group-item list-group-item-action">Oli, vinagre i sal</a>
						<a href="comprar.php?cat=10" class="list-group-item list-group-item-action">Pasta</a>
						<a href="comprar.php?cat=11" class="list-group-item list-group-item-action">Salses i espècies</a>
						<a href="comprar.php?cat=12" class="list-group-item list-group-item-action">Snacks i aperitius</a>
						<a href="comprar.php?cat=13" class="list-group-item list-group-item-action">Sopa i puré</a>
					</div>
				</div>
				<div class="col-8">
					<h3 class="text-white">
                    
                        <?php 
                        $result = $conn->query($sql);
                        
                        if (isset($_GET['cat'])) {
                            $row = $result->fetch_assoc();
                            echo $row["nom_categoria"];
                        }
						else {
                            echo "Els nostres productes";
                        }
                        unset($result);

                        ?>
                    
                    </h3>
					<table class="table">        
						<tr> 
							<th>Producte</th> 
							<th>Categoria</th>
							<th class="text-right">Preu</th>
							<th></th>
						</tr>
						<?php       
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()){ 
                                    echo "<tr> 
						                  <td class=\"align-middle\">
							                 <img src=\"$row[imatge]\" class=\"img-thumbnail mr-2\" style=\"height: 50px;\" />
							                 $row[nom]
						                  </td>
						                  <td class=\"align-middle\">$row[nom_categoria]</td>
						                  <td class=\"align-middle\">$row[preu]€</td>
						                  <td class=\"align-middle\">
							                 <form class=\"form-inline\" action=\"$_SERVER[PHP_SELF]\" method=\"post\">
                                                <a href=\"form_producte.php?codi=$row[codi]\" class=\"btn btn-primary\"><i class=\"fas fa-pencil-alt\"></i></a>
                                                <div class=\"form-group\">
									               <input type=\"hidden\" name=\"codi\" value=\"$row[codi]\" />
								                </div>
								                <button type=\"submit\" class=\"btn btn-primary\"><i class=\"fas fa-trash-alt\"></i></button>
							                 </form>
						                  </td>   
					                      </tr>";
                                }
                            } 
                        $conn->close();
                        ?>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
