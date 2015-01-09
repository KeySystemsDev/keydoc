<script type="text/javascript">
	$(function() {
		$('#i_nombre').caracteres('abcdefghijklmnñopqrstuvwxyz ');
		$('#i_apellido').caracteres('abcdefghijklmnñopqrstuvwxyz ');
		$('#i_cedula').caracteres('1234567890ve');    
		$('#i_telefono').caracteres('1234567890');
		$('#i_direccion').caracteres('abcdefghijklmnñopqrstuvwxyz 0123456789,.:-_#/()&´"áéíóú');
		$('#i_fecha_nacimiento').caracteres('1234567890/');
		$('#i_fecha_nacimiento').datepicker({
			format: 'dd/mm/yyyy'
		});
		$('.popover-msj').popover({
			trigger: 'focus'
		});
		evento.mostrar('.mostrar');
		$('#b_enviar').click(function(event) {   
			a = validar.logico('id_usuario');
			b = validar.string('i_nombre');
			c = validar.string('i_apellido');
			d = validar.cedula('i_cedula');    
			e = validar.telefono('i_telefono');             
			f = validar.fecha('i_fecha_nacimiento');      
			g = validar.string('i_direccion');
					
			if(a != 0 && b != 0 && c != 0 && d != 0 
			&& e != 0 && f != 0 && g != 0){               
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>perfil_actualizar',
					data: datos,
					success: function(data){         
						evento.mostrar('.ocultar, .mostrar');
						ajax.mensaje('msj','Información de perfil actualizada', 'success');                          
					},                                          
				});         
			}else{
				ajax.mensaje('msj','Aún debe completar todos los campos', 'error');
			}
		}); 
	}); 
</script>
<?php
	if (isset($datos_perfil) && !empty($datos_perfil)) {
		foreach ($datos_perfil as $key) {
			$nombre_apellido  = explode(' ', $key->nombre_perfil);
			$cedula           = $key->cedula_perfil;
			$direccion        = $key->direccion_perfil;
			$fecha_nacimiento = $key->fecha_nacimiento_perfil;
			$telefono         = $key->telefono_perfil;
			$url_imagen       = $key->url_imagen_perfil;
			$sexo             = $key->sexo_perfil;
			$portal_web       = $key->portal_web_perfil;
		}
	}
?>
<section class="content">  
	<div class="col-md-4" align="center">
		<div class="thumbnail">
			<img src="<?php echo base_url().$url_imagen?>" width="100%" class="img-responsive centrado">
		</div>
		<!--<div class="btn-group">
			<a href="<?php echo base_url();?>foto" class="btn btn-info">Subir Foto</a>
			<a href="<?php echo base_url();?>foto" class="btn btn-info">
				<span class="fa fa-arrow-up"></span>
			</a>
		</div>-->
		<div class="btn-group">
			<a href="<?php echo base_url();?>perfil" class="btn btn-success">
				<span class="fa fa-arrow-left"></span>
			</a>
			<a href="<?php echo base_url();?>perfil" class="btn btn-success">Volver al Perfil</a>    
		</div>    
	</div>  
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Editar Datos del Perfil</h3>
			</div>
			<form id="form" role="form">
				<div class="box-body">
					<div class="form-group">
						<input type="hidden" id="id_usuario" name="id_usuario" value="<?php if (isset($arreglo)) {  echo $arreglo['id_usuario']; }?>">
						<label for="i_nombre">Nombre</label>
						<input type="text" class="form-control" id="i_nombre" name="i_nombre" value="<?php echo mysql_to_utf8($nombre_apellido[0], 'titulo'); ?>">
					</div>
					<div class="form-group">
						<label for="i_apellido">Apellido</label>
						<input type="text" class="form-control" id="i_apellido" name="i_apellido" value="<?php echo mysql_to_utf8($nombre_apellido[1], 'titulo'); ?>">
					</div>
					<div class="form-group">
						<label for="i_fecha_nacimiento">Fecha de Nacimiento</label>
						<input type="text" class="form-control" id="i_fecha_nacimiento" name="i_fecha_nacimiento" value="<?php echo fecha_mysql_to_php($fecha_nacimiento, 'fecha'); ?>" maxlength="10">
					</div>          
					<div class="form-group">
						<label for="i_cedula">Cédula de identidad</label>
						<input type="text" class="form-control popover-msj" id="i_cedula" name="i_cedula" placeholder="v00000000" maxlength="9" data-container="body" data-toggle="popover" data-placement="top" data-content="Formato: v22444555 / e99333555" value="<?php echo $cedula; ?>">             
					</div>
					<div class="form-group">
						<label for="i_sexo">Sexo</label>
						<div class="radio">
							<label>
								<input type="radio" name="i_sexo" id="i_sexo" value="F" <?php if ($sexo == 'F'){ echo "checked=true"; } ?>>
								Femenino
							</label>
							<label>
								<input type="radio" name="i_sexo" id="i_sexo" value="M" <?php if ($sexo == 'M'){ echo "checked=true"; } ?>>
								Masculino
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="i_telefono">Teléfono</label>
						 <input type="text" class="form-control popover-msj" id="i_telefono" name="i_telefono" placeholder="Teléfono" maxlength="11" data-container="body" data-toggle="popover" data-placement="top" data-content="Formato: 02124442233 / 04164442233" value="<?php echo $telefono; ?>">
					</div>          
					<div class="form-group">
						<label for="i_direccion">Direccion</label>
						<textarea class="form-control" id="i_direccion" name="i_direccion"><?php echo mysql_to_utf8($direccion, 'descripcion'); ?></textarea> 
					</div>
					<div class="form-group">
						<label for="i_portal_web">Pagina Web (Opcional)</label>
						<input type="text" class="form-control popover-msj" id="i_portal_web" name="i_portal_web" <?php echo mysql_to_utf8($portal_web, 'descripcion'); ?>>
					</div>
				</div>
				<div class="box-footer ocultar">
					<button type="button" id="b_enviar" class="btn btn-success">Modificar</button>
				</div>
				<div class="box-footer mostrar">
					<a href="<?php echo base_url();?>perfil" class="btn btn-primary">Ver Perfil</a>
				</div>
			</form>
			<div id="msj" class="panel-footer">
				<info id="msj">Aquí aparecerán mensajes del sistema</info>
			</div>
		</div>  
	</div>
</section>