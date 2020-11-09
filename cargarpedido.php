
    <?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['numeroUsu'])) {
    $records = $conn->prepare('SELECT * FROM usuarios WHERE numeroUsu = :id');
    $records->bindParam(':id', $_SESSION['numeroUsu']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

	$user = null;
	

    if (count($results) > 0) {
      $user = $results;
    }
  }

  
  $sth1 = $conn->prepare('SELECT * from clientes');
  $sth1->execute();
  $resultado1 = $sth1->fetch(PDO::FETCH_ASSOC);
  $clientes=$sth1->fetchAll();

    
  
  
  
 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clients</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/freestyle.css">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="js/material.min.js" ></script>
	<script src="js/sweetalert2.min.js" ></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="js/main.js" ></script>
	<script src="lib/jquery.js"></script>
	<script src="busqueda.js"></script>
	<script src=" https://code.jquery.com/jquery-3.3.1.min.js" ></script>
	<script src="buscadorproductos.js"></script>
</head>
<body>
	<!-- Notifications area -->
	<section class="full-width container-notifications">
		<div class="full-width container-notifications-bg btn-Notification"></div>
	    <section class="NotificationArea">
	        <div class="full-width text-center NotificationArea-title tittles">Notifications <i class="zmdi zmdi-close btn-Notification"></i></div>
	        <a href="#" class="Notification" id="notifation-unread-1">
	            <div class="Notification-icon"><i class="zmdi zmdi-accounts-alt bg-info"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle"></i>
	                    <strong>New User Registration</strong> 
	                    <br>
	                    <small>Just Now</small>
	                </p>
	            </div>
	        	<div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-1">Notification as UnRead</div> 
	        </a>
	        <a href="#" class="Notification" id="notifation-read-1">
	            <div class="Notification-icon"><i class="zmdi zmdi-cloud-download bg-primary"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle-o"></i>
	                    <strong>New Updates</strong> 
	                    <br>
	                    <small>30 Mins Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-read-1">Notification as Read</div>
	        </a>
	        <a href="#" class="Notification" id="notifation-unread-2">
	            <div class="Notification-icon"><i class="zmdi zmdi-upload bg-success"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle"></i>
	                    <strong>Archive uploaded</strong> 
	                    <br>
	                    <small>31 Mins Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-2">Notification as UnRead</div>
	        </a> 
	        <a href="#" class="Notification" id="notifation-read-2">
	            <div class="Notification-icon"><i class="zmdi zmdi-mail-send bg-danger"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle-o"></i>
	                    <strong>New Mail</strong> 
	                    <br>
	                    <small>37 Mins Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-read-2">Notification as Read</div>
	        </a>
	        <a href="#" class="Notification" id="notifation-read-3">
	            <div class="Notification-icon"><i class="zmdi zmdi-folder bg-primary"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle-o"></i>
	                    <strong>Folder delete</strong> 
	                    <br>
	                    <small>1 hours Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-read-3">Notification as Read</div>
	        </a>  
	    </section>
	</section>
	<!-- navBar -->
	<div class="full-width navBar">
		<div class="full-width navBar-options">
			<i class="zmdi zmdi-more-vert btn-menu" id="btn-menu"></i>	
			<div class="mdl-tooltip" for="btn-menu">Menu</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
					<li class="btn-Notification" id="notifications">
						<i class="zmdi zmdi-notifications"></i>
						<!-- <i class="zmdi zmdi-notifications-active btn-Notification" id="notifications"></i> -->
						<div class="mdl-tooltip" for="notifications">Notifications</div>
					</li>
					<li class="btn-exit" id="btn-exit">
						<i class="zmdi zmdi-power"></i>
						<a href="logout.php">
        Salir
      </a>
					</li>
					<li class="text-condensedLight noLink" ><small><?= $user['nombreUsu']; ?></small></li>
					<li class="noLink">
						<figure>
							<img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
						</figure>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- navLateral -->
	<section class="full-width navLateral">
		<div class="full-width navLateral-bg btn-menu"></div>
		<div class="full-width navLateral-body">
			<div class="full-width navLateral-body-logo text-center tittles">
				<i class="zmdi zmdi-close btn-menu"></i> Inventario
			</div>
			<figure class="full-width" style="height: 77px;">
				<div class="navLateral-body-cl">
					<img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
				</div>
				<figcaption class="navLateral-body-cr hide-on-tablet">
					<span>
					<?= $user['nombreUsu']; ?>
						
					</span>
				</figcaption>
			</figure>
			<div class="full-width tittles navLateral-body-tittle-menu">
				<i class="zmdi zmdi-desktop-mac"></i><span class="hide-on-tablet">&nbsp; VENDEDOR:<?= $user['nombreUsu']; ?></span>
			</div>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">
					<li class="full-width">
						<a href="index.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-view-dashboard"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Inicio
							</div>
						</a>
					</li>
					
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-face"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Realizar Pedidos
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								
							</li>
							<li class="full-width">
								<a href="clientes.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-accounts"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Realizar Pedidos
									</div>
								</a>
							</li>
						</ul>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="productos.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-washing-machine"></i>
							</div>
							
							<div class="navLateral-body-cr hide-on-tablet">
								ESTADO DE PEDIDOS
							</div>
						</a>
					</li>
					
					</li>
				</ul>
			</nav>
		</div>
	</section>
	<!-- pageContent -->
	<section class="full-width pageContent">
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-accounts"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			
			
			
			
				  
 

								
										
											
		

<?php
  

  //$servername = "localhost";
    //$username = "pharmave_not";
  	//$password = "DS2020.PP2";
	  //$dbname = "pharmave_notas";
	  $servername = 'localhost';
	  $username = 'root';
	  $password = '';
	$dbname = 'pharmavet';

	$conn = new mysqli($servername, $username, $password, $database);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    
      $id = $_GET['id'];
	$query = "SELECT * FROM productos";
	$query1 = "SELECT * FROM clientes WHERE codigoCli =".$id;
	


	$resultado = $conn->query($query);
	
	$salida = "";
	
    if ($resultado->num_rows>0) {
		$salida.="
	
                          
							
                            
							
						</tr>";
		
	
		
		

    	while ($fila = $resultado->FETCH_ASSOC()) {
			
			$salida.=
			'
			
					
                        
						
						
						
						
						
						'
						
						
						
    					;

    	}
    	$salida.="</tbody></table>";
    }else{
		$salida.="NO SE ENCONTRARON DATOS";

		
	}
	


	echo $salida;

	?>
	<?php

require_once 'database.php';
if(isset($_POST['agregar']))
{
    if(isset($_SESSION['add_carro']))
    {
        $item_array_id_cart = array_column($_SESSION['add_carro'],'item_id');
        if(!in_array($_GET['id'],$item_array_id_cart))
        {

            $count= count($_SESSION['add_carro']);
            $item_array = array(
                'item_id'        => $_GET['id'],
                'item_nombre'    => $_POST['hidden_nombre'],
                'item_precio'    => $_POST['hidden_precio'],
                'item_cantidad'  => $_POST['cantidad'],
            );

            $_SESSION['add_carro'][$count]=$item_array;
        }
        else
            {
              echo '<script>alert("El Producto ya existe!");</script>';
            }
    }
    else
        {
            $item_array = array(
                'item_id'        => $_GET['id'],
                'item_nombre'    => $_POST['hidden_nombre'],
                'item_precio'    => $_POST['hidden_precio'],
                'item_cantidad'  => $_POST['cantidad'],
            );

            $_SESSION['add_carro'][0] = $item_array;
        }
}
if(isset($_GET['action']))
{
    if($_GET['action']=='delete')
    {
        foreach ($_SESSION['add_carro'] AS $key => $value)
        {
            if($value['item_id'] == $_GET['id'])
            {
                unset($_SESSION['add_carro'][$key]);
                echo '<script>alert("El Producto Fue Eliminado!");</script>';
                echo '<script>window.location="cargarpedido.php";</script>';
            }

        }

    }

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/carrs.css">
    <title>Carrito</title>
</head>
<body>


    
    <?php
$sql="SELECT * FROM productos";
$resul= mysqli_query($conn,$sql);
$query1 = "SELECT * FROM productos";



    $resultado1 = $conn->query($query1);
	$salida = "";
    if ($resultado1->num_rows>0) {
		 ?>

<label for="caja_busqueda1"></label>
		
		<input type="text" name="caja_busqueda1" id="caja_busqueda1" placeholder="Busque a un cliente"></input>
		<div id="datos1"  >
	
		<table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive'>
					<thead>
						<tr>
							<th >Id</th>
							<th>Descripcion</th>
							<th>Precio</th>
							<th>Agregar</th>
                           
							
                            
							
						</tr>
						<?php
						while ($fila = $resultado1->fetch_assoc()) {
			
							 ?>
						
							
							
							<tr >
							<form method="post" action="cargarpedido.php?action=add&id=<?php echo $fila['codigoPro']; ?>">
							
							
							<td><?php echo $fila['codigoPro'];?></td>
							<td><?php echo $fila['descripcionPro'];?></td>
							<td><?php echo $fila['precioPro'];?></td>
						<td><input type="text" name="cantidad" value="1" /><input type="submit" name="agregar" style="margin-left:5px;" class="btn btn-success" value="Agregar" /></td>
						<input type="hidden" name="hidden_nombre" value="<?php echo $fila['descripcionPro'];?>"/>
						<input type="hidden" name="hidden_precio" value="<?php echo $fila['precioPro'];?>"/>
										
								
										
										
										
										
										
										</tr>
										
										
										
										
				
						
				
						</tbody>
						</form>
						
						
				   </div>
					
					</div>
				
				<?php
					echo $salida;
					?>
								
							
					
				
				
				
				
						
				 
						
				 
					
					<?php
					}
				}
					?>
					</table>
		
	
		
		

    	
					<div id="datos1"  >
	<div style="clear:both"></div>
    <br />
    <h3>Detalle de la Orden</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="40%">Item Nombre</th>
                <th width="10%">Cantidad</th>
                <th width="20%">Precio</th>
                <th width="15%">Total</th>
                <th width="5%">Action</th>
            </tr>
            <?php
            if(!empty($_SESSION["add_carro"]))
            {
                $total = 0;
                foreach($_SESSION["add_carro"] as $keys => $values)
                {
                    ?>
                    <tr>
                        <td><?php echo $values["item_nombre"]; ?></td>
                        <td><?php echo $values["item_precio"]; ?></td>
                        <td>$ <?php echo $values["item_cantidad"]; ?></td>
                        <td>$ <?php echo number_format($values["item_cantidad"] * $values["item_precio"], 2);?></td>
                        <td><a href="cargarpedido.php?action=delete&id=<?php echo $values["item_id"] ; ?>"><span class="text-danger">Remove</span></a></td>
                    </tr>
                    <?php
                    $total = $total + ($values["item_cantidad"] * $values["item_precio"]);
                }
                ?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <?php
            }else{
                ?>
                <tr>
                    <td colspan="4" style="color: red" align="center"><strong>No hay Producto Agregado!</strong></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>



	
	

	
	
		
		
	
	

	
  



	






