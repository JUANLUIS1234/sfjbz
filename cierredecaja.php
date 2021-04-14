<?php
	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_cierre="active";	
	$title="Cierre de Caja";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
  </head>
  <body>
 	<?php
	include("navbar.php");
	?> 
    <div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		   
			<h4><i class='glyphicon glyphicon-search'></i> Cierre de Caja Mensual</h4>
		</div>			
			<div class="panel-body">
			
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">

							<label for="q" class="col-md-2 control-label">Fecha Desde:</label>
							<div class="col-md-2">
							<input style="background-color: lightyellow" type="date" class="form-control" id="q">
							</div>
						    <label for="j" class="col-md-2 control-label">Fecha hasta:</label>
                            <div class="col-md-2">
							<input style="background-color: lightyellow" type="date" class="form-control" id="j">
							</div>
                            <label for="b" class="col-md-1 control-label">Estado</label>
							<div class="col-md-2">
								<select class='form-control input-sm' id="b">
									<option value="1">Pagada</option>
									<option value="2">Pendiente</option>
									<option value="3">Gastos</option>
									<option value="4">Servicios</option>
								</select>
							</div>
							<br>
						    <br>


							<div  style="text-align: center;">
								<button type="button" class="btn btn-info" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar
								</button>
								<span id="loader"></span>
								<button type="submit" class="btn btn-default">
						           <span class="glyphicon glyphicon-print"></span> Imprimir
						        </button>
						    </div> 
							
						 </div>
				
				
				
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
						
			</div>
		</div>

	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/cierredecaja.js"></script>
   </body>
</html>