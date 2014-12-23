<script type="text/javascript">
	$(function() {
		evento.mostrar('.mostrar');
		$("#i_nombre_consultorio").charCount({
			allowed: 60,    
			counterText: 'Restante: '   
		});
		$("#i_direccion_consultorio").charCount({
			allowed: 300,    
			counterText: 'Restante: '   
		});
		$('#b_enviar').click(function(event) { 
			a = validar.logico('id_consultorio');
			b = validar.string('i_nombre_consultorio');
			c = validar.string('i_direccion_consultorio');  
			d = validar.logico('id_usuario');  

			if(a != 0 && b != 0 && c != 0 && d != 0){
				var datos = $("#form").serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>gestion/consultorio_actualizar',
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
		<li><i class="fa fa-cogs"></i> Editando Consultorio</li>
	</ol>  
</section>
<section class="content">  
	<div class="col-md-6 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Editar Consultorio</h3>
			</div>
			<form id="form" role="form">
				<?php 
					if(isset($consultorio) && !empty($consultorio)){
						foreach ($consultorio as $key) {
							$id_consultorio         = $key->id_consultorio;
							$nombre_consultorio     = $key->nombre_consultorio;
							$direccion_consultorio  = $key->direccion_consultorio;
						}
					}
				?>        
				<div class="box-body">
					<div class="form-group">
						<input type="hidden" class="form-control" id="id_consultorio" name="id_consultorio" value="<?php echo $id_consultorio; ?>">
						<input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $id_usuario; ?>" maxlength="70">  
					</div>
					<div class="form-group">
						<label for="i_nombre">Nombre Consultorio:</label>
						<input type="text" class="form-control" id="i_nombre_consultorio" name="i_nombre_consultorio" value="<?php echo mysql_to_utf8($nombre_consultorio, 'titulo') ?>" placeholder="Ingresar Nombre" maxlength="60">
					</div>
					<div class="form-group">
						<label for="i_apellido">Direccion Consultorio:</label>
						<textarea class="form-control" rows="5" id="i_direccion_consultorio" name="i_direccion_consultorio" placeholder="Dirección" maxlength="300"><?php echo mysql_to_utf8($direccion_consultorio, 'descripcion') ?> </textarea>
					</div>
					<div class="btn-group col-md-push-4 mostrar">
						<a href="<?php echo base_url();?>gestion/consultorio" class="btn btn-success">Gestionar Consultorio</a>
					</div>
				</div>
				<div class="box-footer enviar">
					<button type="button" id="b_enviar" class="btn btn-success">Actualizar</button>
				</div>
			</form>
			<div id="msj" class="panel-footer">
				<info id="msj">Aquí aparecerán mensajes del sistema</info>
			</div> 
		</div> 
	</div>
</section>