<script type="text/javascript">
	$(function() {
		evento.mostrar('.mostrar');
		$('#s_especialidad').select2();
		$('#b_enviar').click(function(event) { 
			a = validar.logico('id_detalle_especialidad');
			b = validar.logico('s_especialidad'); ;  

			if(a != 0 && b != 0){
				var datos = $("#form").serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>gestion/especialidad_actualizar',
					data: datos,         
					success: function (data) {          
						evento.mostrar('.mostrar, .enviar');
						ajax.mensaje('msj','Se ha actualizado correctamente', 'success');  
					},
				});
			}else{
				ajax.mensaje('msj','Aun debe completar todos los campos', 'error');
			}
		}); 
	}); 
</script>
<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Editando Especialidad</li>
	</ol>  
</section>
<section class="content">  
	<div class="col-md-6 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Editar Especialidad</h3>
			</div>
			<form id="form" role="form">
				<?php 
					if(isset($especialidad) && !empty($especialidad)){
						foreach ($especialidad as $key) {
							$id_tipo                = $key->id_tipo;
							$nombre_especialidad    = $key->nombre_tipo;
						}
					}
				?>        
				<div class="box-body">
					<div class="form-group">
						<input type="hidden" class="form-control" id="id_detalle_especialidad" name="id_detalle_especialidad" value="<?php echo $id_detalle_especialidad; ?>">  
					</div>
					<div class="form-group">
						<label for="s_especialidad">Especialidad:</label>
						<select style="width:100%" id="s_especialidad" name="s_especialidad"> 
							<?php echo '<option value="'.$id_tipo.'" selected>'.mysql_to_utf8($nombre_especialidad, 'titulo').'</option>';?>           
							<?php               
								if(isset($especialidades) && !empty($especialidades)){                  
									foreach ($especialidades as $key) {
										echo  
										'<option value="'.$key->id_tipo.'"> '.mysql_to_utf8($key->nombre_tipo, 'titulo').' </option>';
									}
								}
							?> 
						</select> 
					</div>
					<div class="btn-group col-md-push-4 mostrar">
						<a href="<?php echo base_url();?>gestion/especialidad" class="btn btn-success">Gestionar Especialidades</a>
					</div>        
					<div class="box-footer enviar">
						<button type="button" id="b_enviar" class="btn btn-success">Actualizar</button>
					</div>
				</div>
			</form>
			<div id="msj" class="panel-footer">
				<info id="msj">Aquí aparecerán mensajes del sistema</info>
			</div> 
		</div> 
	</div>
</section>