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
			
			
			
			
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-success text-center tittles">
								Cliente Seleccionado
							</div>
							<div class="full-width panel-content">
								
										
											
		

<?php
  

  //$servername = "localhost";
    //$username = "pharmave_not";
  	//$password = "DS2020.PP2";
	  //$dbname = "pharmave_notas";
	  $servername = 'localhost';
	  $username = 'root';
	  $password = '';
	  $dbname = 'pharmavet';

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    
      $id = $_GET['id'];
    $query = "SELECT * FROM clientes WHERE codigoCli =".$id;


    $resultado = $conn->query($query);
    $salida = "";
    if ($resultado->num_rows>0) {
		$salida.="
		<table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive'>
					<thead>
						<tr>
							<th class='mdl-data-table__cell--non-numeric'>Id</th>
							<th>Nombre</th>
                            <th>Vendedor</th>
                            <th>Direccion</th>
                            <th>Localidad</th>
                            <th>Provincia</th>
							<th>Telefono</th>
							
                            
							
						</tr>";
		
	
		
		

    	while ($fila = $resultado->fetch_assoc()) {
			
			$salida.=
			'
			<tr >
			
			
						<td>' .$fila['codigoCli'].'</td></a>
                        <td>' .$fila['nombreCli'].'</td></a>
                        <td>' .$fila['vendedorCli'].'</td></a>
                        <td>' .$fila['direccionCli'].'</td></a>
                        <td>' .$fila['localidadCli'].'</td></a>
                        <td>' .$fila['provinciaCli'].'</td></a>
						<td>' .$fila['telefonoCli'].'</td></a>
						
						
						
						
						
						'
						
						
    					;

    	}
    	$salida.="</tbody></table>";
    }else{
		$salida.="NO SE ENCONTRARON DATOS";

		
	}
	


	echo $salida;
	
		
		
	
	
?>
<div class="container-fluid" id="main-content">
        <div class="container">
            <div class="row">
			
       
	<div class="container-fluid">
  <div class="row text-white text-center">
    <div class="col-2 bg-dark border"> <a href="cargarpedido.php?id=<?php echo $id;?>">Cargar Productos</a><br></div>
    <div class="col-10 bg-dark border"><a href="clientes.php">Volver A elegir otro cliente</a></div>
	</div>
        </div>
	</div>
 
