<?php
	$servername = "localhost";
    $username = "pharmave_notas";
  	$password = "DS2020.PP2";
  	$dbname = "pharmave_notas";

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

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="<table border=1 class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
    					<td>ID</td>
    					<td>nombre</td>
    					
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['codigoCli']."</td>
    					<td>".$fila['nombreCli']."</td>
    					
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="NO SE ENCONTRARON DATOS";
    }


    echo $salida;

    $conn->close();



?>
