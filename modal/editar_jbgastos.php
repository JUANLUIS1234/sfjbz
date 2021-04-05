	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div style="background-color: #3498db" class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar registro</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_registrojb" name="editar_registrojb">
			<div id="resultados_ajax2"></div>
			
			 <div class="form-group">
				<label for="mod_factura" class="col-sm-3 control-label">Factura</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_factura" name="mod_factura" placeholder="Nº factura" readonly="">
                 <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			<div class="form-group">
				<label for="mod_descripcion" class="col-sm-3 control-label">Descripcion</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_descripcion" name="mod_descripcion" placeholder="Descripcion">
				 
				</div>
			  </div>
			  <div class="form-group">
				<label for="mod_monto" class="col-sm-3 control-label">Monto</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_monto" name="mod_monto" placeholder="Monto" >
				</div>
			  </div>
			  <div class="form-group">
				<label for="mod_periodo" class="col-sm-3 control-label">Periodo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_periodo" name="mod_periodo" placeholder="Periodo" readonly="" >
				</div>
			  </div>
			  <div class="form-group">
				<label for="mod_concepto" class="col-sm-3 control-label">Concepto</label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_concepto" name="mod_concepto" required>
					<option value="">-- Selecciona Concepto --</option>
					<option value="Ingreso" >Ingreso</option>
					<option value="Egreso">Egreso</option>
				  </select>
				</div>
			  </div>
			  
						 	 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>