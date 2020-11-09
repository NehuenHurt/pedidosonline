<?php 
require 'database.php';
$servername = "localhost";
$username = "pharmave_not";
  $password = "DS2020.PP2";
  $dbname = "pharmave_notas";
  //$server = 'localhost';
//$username = 'root';
//$password = '';
//$dbname = 'pharmavet';

$conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error){
    die("Conexión fallida: ".$conn->connect_error);
  }

if(isset($_GET['accion']) && $_GET['accion']=="anyadir"){ 
    $id=intval($_GET['id']); 
    if(isset($_SESSION['carrito'][$id])){ 
        $_SESSION['carrito'][$id]['cantidad']++; 
    }else{ 
        $sql_s="SELECT * FROM productos WHERE codigoPro=$id"; 
        $query_s=mysqli_query($conn, $sql_s); 
        if(mysqli_num_rows($query_s)!=0){ 
            $fila_s=mysqli_fetch_array($query_s); 

            $_SESSION['carrito'][$fila_s['codigoPro']]=array( 
                    "cantidad" => 1, 
                    "precio" => $fila_s['precioPro']);
        }
    }
} 
  
?> 
<h1> En Construccion</h1>
    </tr> 

    <?php 

        $sql="SELECT * FROM productos ORDER BY codigoPro ASC"; 
        $query=mysqli_query($conexion, $sql); 

        while ($fila=mysqli_fetch_array($query)) { 
    ?> 
        <tr> 
            <td><?php echo $fila['descripcionPro'] ?></td> 
            
            <td class="numero"><?php echo $fila['precioPro'] ?> €</td> 
            <td><a href="cargarpedido.php?pagina=comidas&accion=anyadir&id=<?php echo $fila['codigoPro'] ?>">Añadir al carrito</a></td> 
        </tr> 
    <?php } ?> 
</table>
<br>
<a href="cargarpedido.php?pagina=carrito">Ir al carrito</a>