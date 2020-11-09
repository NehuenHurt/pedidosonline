
<?php
// Esto le dice a PHP que usaremos cadenas UTF-8 hasta el final
mb_internal_encoding('UTF-8');
 
// Esto le dice a PHP que generaremos cadenas UTF-8
mb_http_output('UTF-8');

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pharmavet';;
	  //$servername = "localhost";
    //$username = "pharmave_not";
  	//$password = "DS2020.PP2";
//$dbname = "pharmave_notas";

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT * FROM clientes WHERE nombreCli NOT LIKE '' ORDER BY codigoCli LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
		$query = "SELECT * FROM clientes WHERE nombreCli LIKE '%$q%' OR codigoCli LIKE '%$q%'  ";
		
	}
	$query1=utf8_encode($query);

	$resultado = $conn->query($query1);
	$sql= "SELECT * FROM clientes";
	$clientes=mysqli_query($conn,$sql);


    if ($resultado->num_rows>0) {
		$salida.="
		<div class='full-width divider-menu-h'></div>
		<div class='mdl-grid'>
			<div class='mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop'>
				<table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive'>
					<thead>
						<tr>
							<th class='mdl-data-table__cell--non-numeric'>ID</th>
							<th>Nombre</th>
							
						</tr>";;
		
	
		
		

    	while ($fila = $resultado->fetch_assoc()) {
			
			$salida.=
			'
			<tr >
			<tbody>
						<tr>
							
							<td><a href="mostrarcliente.php?id='. $fila['codigoCli'] .'">' .$fila['codigoCli'].'</td></a>
						<td><a href="mostrarcliente.php?id='. $fila['codigoCli'] .'">' .$fila['nombreCli'].'</td></a>
						</tr>
			
			
						
						
						
						
						'
						
						
    					;

    	}
    	$salida.="</tbody></table>";
    }else{
		$salida.="NO SE ENCONTRARON DATOS";

		
	}
	
	



	echo $salida;
	

	
	


	
	
	
	?>
	</tbody>
					
					</table>
			</div>
		</div>
	

