<script type="text/javascript">
	$(function() {
		$('#i_correo').caracteres('abcdefghijklmnñopqrstuvwxyz0123456789._@');
		evento.mostrar('.mostrar');
		$('#b_enviar').click(function(event) { 
			a = validar.correo('i_correo');
			b = validar.string('i_contrasena');
			c = validar.string('i_repetir_contrasena');  

			if(a != 0 && b != 0 && c != 0){               
				if(b == c){      
					datos = $('#form').serialize();
					$.ajax({
						type: 'POST',
						url: '<?php echo base_url()?>configuracion/perfil_editar_contrasena',
						data: datos,
						success: function(data){         
							evento.mostrar('#b_enviar, .mostrar');
							ajax.mensaje('msj','Datos ingresados correctamente', 'success');                          
						},                                          
					});          
				}else{
					ajax.mensaje('msj','Las contraseñas no coinciden', 'error');
				}
			}else{
				ajax.mensaje('msj','Aún debe completar todos los campos', 'error');
			}
		}); 
	}); 
</script>

<section class="content-header">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url().'configuracion/perfil'?>"><i class="fa fa-cogs"></i> Cambiando Contraseña</a></li>
	</ol>   
</section>
<section class="content"> 
	 <div class="col-md-2 col-md-push-2">
		<div class="thumbnail">
			<img src="<?php echo base_url().'public/img/logo_500x500.png'?>">
			<div class="caption">
				<div class="row">
					<div class="col-md-12" align="center">
						<div class="btn-group">
							<a href="<?php echo base_url();?>configuracion/perfil" class="btn btn-success">
								<span class="fa fa-arrow-left"></span>
							</a>
							<a href="<?php echo base_url();?>configuracion/perfil" class="btn btn-success">Volver al Perfil</a>    
						</div>
					</div>
				</div>
			</div>      
		</div>
	</div>
	<div class="col-md-6 col-md-push-2">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Modificación de Contraseña</h3>
			</div>
			<?php
				if(isset($datos_usuario) && !empty($datos_usuario)){                
					foreach ($datos_usuario as $key) {
						$arreglo = array(
							'correo'   => $key->correo_usuario,
							'password' => $key->clave_usuario
						);
					}
				}
			?>
			<form id="form" role="form">
				<div class="box-body">
					<div class="form-group">
						<input type="hidden" id="i_correo" name="i_correo" value="<?php if (isset($arreglo)) {  echo $arreglo['correo']; }?>" maxlength="100">
						<label for="i_contrasena">Contraseña Nueva</label>
						<input type="password" class="form-control" id="i_contrasena" name="i_contrasena" placeholder="Contraseña Nueva" maxlength="100">
					</div>
					<div class="form-group">
						<label for="i_repetir_contrasena">Repetir Contraseña</label>
						<input type="password" class="form-control" id="i_repetir_contrasena" name="i_repetir_contrasena" placeholder="Repetir Contraseña" maxlength="100">
					</div>                             
					<div class="box-footer">
						<button type="button" id="b_enviar" class="btn btn-success">Enviar</button>
					</div>
					<div class="btn-group col-md-push-2 mostrar">
						<a href="<?php echo base_url();?>configuracion/perfil" class="btn btn-primary">Ir al Perfil</a>
					</div>
				</div>
			</form>
			<div id="msj" class="panel-footer">
				<info id="msj">Aquí aparecerán mensajes del sistema</info>
			</div>
		</div>  
	</div>
</section>   