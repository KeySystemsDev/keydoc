<script type="text/javascript">  
	$(function() {    
		$('#b_ingresar').click(function(){
			a = validar.correo('i_usuario');
			b = validar.string('i_password');
			if(a != 0 && b != 0){ 
				var datos = $('#form').serialize(); 
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>sesion/comprobar_usuario',
					data: datos,
					success: function (data) {
						if(data == 0){              
							$('#error').modal({
								show: true 
							})
						}else{
							var datos = $("#form").submit();
						}       
					},
				});          
				var datos = $("#form_entrar").submit();
			}else{
				evento.mostrar('.mostrar');
				ajax.informacion('msj_inicio','Ingrese correo y contraseña');
				setTimeout(function(){          
					evento.mostrar('.mostrar')
				}, 5000);
			}
		});      

		$(document).keypress(function(e) {
			if(e.which == 13) {
				$('#b_ingresar').click(); 
			}
		});
	});
</script>
<div class="form-box" id="login-box">
	<div class="header">
		Entrar
	</div>
	<form id="form" method="post" action="<?php echo base_url().'sesion/conectar'?>">
		<div class="body">
			<div class="form-group">
				<input type="text" id="i_usuario" name="i_usuario" class="form-control popover-msj" placeholder="Correo Electrónico" data-container="body" data-toggle="popover" data-placement="left" data-content="Correo">
			</div>
			<div class="form-group">
				<input type="password" id="i_password" name="i_password" class="form-control popover-msj" placeholder="Contraseña" maxlength="15"  data-container="body" data-toggle="popover" data-placement="left" data-content="Contraseña">
			</div>          
			<div class="form-group">
				<input type="checkbox" name="remember_me"/> Recordarme
				<a href="<?php echo base_url().'sesion/restaurar-contrasena'?>" class="pull-right">¿Olvido su contraseña?</a>
			</div>
		</div>
		<div class="footer" align="center">
			<a class="btn btn-warning btn-shadow col-md-3" href="<?php echo base_url().'agendar'?>" style="color: #FFF;">Atrás</a>
			<a class="btn btn-info btn-shadow col-md-8 col-md-push-1" href="#" id="b_ingresar" style="color: #FFF;">Iniciar Seción</a> 
		  &nbsp;¿Aún no tienes una cuenta?&nbsp; 
			<a href="<?php echo base_url().'sesion/registrate'?>" class="text-center">Crear Cuenta</a>
		</div>
	</form>
	<div class="margin text-center">
		<br/>
		<button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
		<button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
		<button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
	</div>
</div>

<div class="modal fade" id="error">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="col-md-12">
				<div class="box box-solid box-danger">
					<div class="box-header">
						<h3 class="box-title">¡Atención!</h3>
					</div>
					<div class="box-body">
						Usuario o contraseña son incorrectos, favor intente de nuevo.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
