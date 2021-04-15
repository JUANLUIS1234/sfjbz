<?php

	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
		$query=mysqli_query($con, "select * from registrojb where id='".$id."'");
		$count=mysqli_num_rows($query);
		if ($id!=1){
			if ($delete1=mysqli_query($con,"DELETE FROM registrojb WHERE id='".$id."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar éste  producto. Existen cotizaciones vinculadas a éste producto. 
			</div>
			<?php
		}
		
		
		
	}
		
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('factura', 'descripcion', 'monto','concepto','periodo');//Columnas de busqueda
		 $sTable = "registrojb";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by id desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5000; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './jbzeus_gastos.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>Factura</th>
					<th>Descripcion</th>
					<th>Monto</th>
					<th>Concepto</th>
					<th>Periodo</th>
					<th>Agregado</th>
					<th><span class="pull-right">Acciones</span></th>
					
				</tr>
				<?php
				$sumar_ingresos=0;
				$sumar_egresos=0;
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$factura=$row['factura'];
						$descripcion=$row['descripcion'];
						$monto=$row['monto'];
						$concepto=$row['concepto'];
						$periodo=$row['periodo'];
						$date_added= date('d/m/Y', strtotime($row['fecha']));
						if ($concepto == 'Ingreso') {
							$sumar_ingresos=$sumar_ingresos + $monto;
						}
						if ($concepto == 'Egreso') {
							$sumar_egresos=$sumar_egresos + $monto;
						}
						$control_registros=$sumar_ingresos - $sumar_egresos;
					?>

				    <input type="hidden" value="<?php echo $factura;?>" id="factura<?php echo $id;?>">
					<input type="hidden" value="<?php echo $descripcion;?>" id="descripcion<?php echo $id;?>">
					<input type="hidden" value="<?php echo $monto;?>" id="monto<?php echo $id;?>">
					<input type="hidden" value="<?php echo $concepto;?>" id="concepto<?php echo $id;?>">
					<input type="hidden" value="<?php echo $periodo;?>" id="periodo<?php echo $id;?>">
				
					<tr>
						<td><?php echo $factura; ?></td>
						<td><?php echo $descripcion ?></td>
						<td>$<?php echo number_format($monto,2); ?></td>
						<td ><?php echo $concepto; ?></td>
						<td ><?php echo $periodo; ?></td>
						<td><?php echo $date_added;?></td>
						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					
					<a href="#" class='btn btn-default' title='Eliminar' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=9><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			  
			</div>
			<div class="row container">
					<div class="col-md-3">
						<div class="form-group">
							<label style="font-size:24px" > Total | Ingreso</label>
							<input type="text" value="$<?php echo number_format($sumar_ingresos,2); ?>" disabled="" style="font-size:20px" class="text-center" >
						</div>
					</div>	
					<div class="col-md-3">
						<div class="form-group">
							<label style="font-size:24px"> Total | Egreso</label>
							<input type="text" value="$<?php echo number_format($sumar_egresos,2); ?>" disabled="" style="font-size:20px" class="text-center">
						</div>
					</div>	
					<div class="col-md-4">
						<div class="form-group">
							<label style="font-size:24px" > Total | Diferencia</label>
							<input type="text" value="$<?php echo number_format($control_registros,2); ?>" disabled="" style="font-size:20px" class="text-center">
						</div>
					</div>	
			   </div>
			<?php
		}
	}
?>