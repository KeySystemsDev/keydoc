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

		$('#b_perfil').click(function() { 
			a = validar.logico('id_usuario');
			b = validar.logico('id_aplicacion');
			c = validar.string('i_nombre');
			d = validar.string('i_apellido');
			e = validar.cedula('i_cedula');    
			f = validar.telefono('i_telefono');             
			g = validar.fecha('i_fecha_nacimiento');      
			h = validar.string('i_direccion');
					
			if(a != 0 && b != 0 && c != 0 && d != 0 
			&& e != 0 && f != 0 && g != 0){               
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>perfil_agregar',
					data: datos,
					success: function(data){ 
						$('.ocultar').hide();        
						evento.mostrar('.mostrar');
						ajax.mensaje('msj','Datos ingresados correctamente', 'success');                          
					},                                          
				});         
			}else{
				ajax.mensaje('msj','Aún debe completar todos los campos', 'error');
			}
		}); 
	}); 
</script>
<section class="content">  
	<div class="container">
		<div class="col-md-4" align="center">
			<div class="thumbnail">
				<img src="<?php echo base_url().'public/img/upload.png'?>" width="100%" class="img-responsive centrado">
			</div>
			<a href="<?php echo base_url();?>foto" class="btn btn-info col-md-12"> 
				<i class="fa fa-edit"></i> Subir Foto
			</a>    
		</div> 
		<div class="col-md-6">
			<div class="box box-primary">
				<form id="form" role="form">
					<div class="box-body">
						<div class="form-group">
							<input type="hidden" id="id_usuario" name="id_usuario" value="<?php if (isset($arreglo)) {  echo $arreglo['id_usuario']; }?>">
							<input type="hidden" id="id_aplicacion" name="id_aplicacion" value="<?php if (isset($arreglo)) {  echo $arreglo['id_aplicacion']; }?>">
							<label for="i_nombre">Nombre</label>
							<input type="text" class="form-control" id="i_nombre" name="i_nombre" placeholder="Nombre">
						</div>
						<div class="form-group">
							<label for="i_apellido">Apellido</label>
							<input type="text" class="form-control" id="i_apellido" name="i_apellido" placeholder="Apellido">
						</div>
						<div class="form-group">
							<label for="i_fecha_nacimiento">Fecha de Nacimiento</label>
							<input type="text" class="form-control" id="i_fecha_nacimiento" name="i_fecha_nacimiento" placeholder="Fecha Nacimiento" maxlength="10">
						</div>          
						<div class="form-group">
							<label for="i_cedula">Cédula de identidad</label>
							<input type="text" class="form-control popover-msj" id="i_cedula" name="i_cedula" placeholder="v00000000" maxlength="9" data-container="body" data-toggle="popover" data-placement="top" data-content="Formato: v22444555 / e99333555">             
						</div>
						<div class="form-group">
							<label for="i_sexo">Sexo</label>
							<div class="radio">
								<label>
									<input type="radio" name="i_sexo" id="i_sexo" value="F" checked>
									Femenino
								</label>
								<label>
									<input type="radio" name="i_sexo" id="i_sexo" value="M">
									Masculino
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="i_telefono">Teléfono</label>
							<input type="text" class="form-control popover-msj" id="i_telefono" name="i_telefono" placeholder="Teléfono" maxlength="11" data-container="body" data-toggle="popover" data-placement="top" data-content="Formato: 02124442233 / 04164442233">
						</div>
						<div class="form-group">
							<label for="i_direccion">Dirección</label>
							<textarea class="form-control" id="i_direccion" name="i_direccion" placeholder="Dirección de habitación"></textarea> 
						</div>
						<div class="form-group">
							<label for="i_portal_web">Pagina Web (Opcional)</label>
							<input type="text" class="form-control popover-msj" id="i_portal_web" name="i_portal_web" placeholder="Pagina Web">
						</div>
					</div>
					<div class="box-footer ocultar">
						<button type="button" id="b_perfil" class="click btn btn-primary">Registrar</button>
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
	</div>
</section>