<script type="text/javascript">
	$(function() {
		$('#listado').dataTable();
		$('#i_nombre_consultorio').caracteres('qwertyuiopasdfghjklñzxcvbnm1234567890 ');
		$("#s_municipio").select2();
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
			a = validar.texto('i_nombre_consultorio');
			b = validar.string('i_direccion_consultorio');
			c = validar.logico('s_municipio');
		
			if(a != 0 && b != 0 && c != 0){               
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>registro/consultorio-agregar',
					data: datos,
					success: function () {         
						$('#b_enviar').hide();
						evento.mostrar('.mostrar');
						ajax.mensaje('msj','Consultorio registrado con éxito', 'success');            
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
		<li><i class="fa fa-cogs"></i> Registro</li>
		<li class="active">Consultorio</li>
	</ol>   
</section>
<section class="content">  
	<div class="col-md-6 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Registro de Consultorio</h3>
			</div>
			<form id="form" role="form">
				<div class="box-body">
					<div class="form-group">
						<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $usuario ?>">
						<input type="hidden" id="id_estado" name="id_estado" value="<?php echo $id?>">
						<label for="i_nombre_consultorio">Nombre del Consultorio:</label>
						<input type="text" class="form-control" id="i_nombre_consultorio" name="i_nombre_consultorio" placeholder="Nombre" maxlength="60">
					</div>
					<div class="form-group">
						<label for="s_municipio">Municipio:</label>
						<select style="width:100%" id="s_municipio" name="s_municipio"> 
							<option value="0" selected>Seleccionar</option>           
							<?php 
								if(isset($municipios) && !empty($municipios)){
									foreach ($municipios as $key) {
										echo  
										'<option value="'.$key->id_tipo.'"> '.mysql_to_utf8($key->nombre_tipo, 'titulo').' </option>';
									}
								}
							?> 
						</select> 
					</div>          
					<div class="form-group">
						<label for="i_direccion_consultorio">Dirección del Consultorio</label>
						<textarea class="form-control" rows="5" id="i_direccion_consultorio" name="i_direccion_consultorio" placeholder="Dirección" maxlength="300"></textarea>
					</div>                     
					<div class="box-footer">
						<button type="button" id="b_enviar" class="btn btn-primary">Registrar</button>
					</div>
					<div class="btn-group col-md-push-3 mostrar">
						<a href="<?php echo base_url();?>registro/consultorio" class="btn btn-primary">Registrar otro Consultorio</a>
						<a href="<?php echo base_url();?>gestion/consultorio" class="btn btn-success">Gestionar Consultorio</a>
					</div>
				</div>        
			</form>
			<div id="msj" class="panel-footer">
				<info id="msj">Aquí aparecerán mensajes del sistema</info>
			</div>      
		</div>
	</div>
</section>