<script type="text/javascript">  
  $(function() {   
	$('#b_enviar').click(function() {
		a = validar.correo('i_usuario');
		b = validar.string('i_password');
		c = validar.string('i_password_repeat');
		d = $("#i_password").val();
		str = d.length;

		if(a != 0){
			if (b == c) {
				if (str >= 8) {
					if(a != 0 && b != 0){
						var datos = $('#form').serialize(); 
						$.ajax({
							type: 'POST',
							url: '<?php echo base_url()?>sesion/existencia',
							data: datos,
							success: function (data) {      
								if(data == 1){
									$('#error').modal({
										show: true 
									})
								}else{
									$('#satisfactorio').modal({ 
										show: true 
									});
									setTimeout(function(){
										var datos = $("#form").submit();
									}, 3000);
								}       
							},
						});
					}
				}else{
					ajax.informacion('msj','Tamaño mínimo de contraseña: 8 caracteres.');
				}
			}else{
				ajax.informacion('msj','Las contraseñas no coincicden.');
			}
		}else {
			ajax.informacion('msj','El formato del correo es incorrecto.');
		}
	}); 

	$(document).keypress(function(e) {
		if(e.which == 13) {
			$('#b_enviar').click(); 
		}
	});
  });
</script>

<div class="form-box" id="login-box">
	<div class="header">
		Regístrate
	</div>
	<form id="form" class="form-signin" role="form" method="post" action="<?php echo base_url().'sesion/registrar'?>">
		<div class="body">
			<div class="form-group">
				<input type="text" class="form-control popover-msj" id="i_usuario" name="i_usuario" placeholder="Correo Electrónico" data-container="body" data-toggle="popover" data-placement="left" data-content="Formato: correo@dominio.com">
			</div>
			<div class="form-group">
				<input type="password" class="form-control popover-msj" id="i_password"  name="i_password" placeholder="Contraseña" maxlength="15" data-container="body" data-toggle="popover" data-placement="left" data-content="Debe contener mínimo 8 caracteres">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="i_password_repeat"  name="i_password_repeat" placeholder="Repetir Contraseña" maxlength="15">
			</div>     
		</div> 
		<div class="footer col-md-12">                                                               
			<a class="btn btn-warning btn-shadow col-md-3" href="<?php echo base_url().'sesion'?>" style="color: #FFF;">Atrás</a>
			<button type="button" class="btn btn-info btn-shadow col-md-8 col-md-push-1" id="b_enviar">Crear Cuenta</button> 
			<p class="col-md-12" id="msj">Aquí aparecerán mensajes del sistema.</p>                  
		</div>     
	</form>

	<div class="margin text-center" style="margin-top: 110px;">
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
						Disculpe!, El usuario que intenta registrar ya existe.
					</div>
					 <div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="satisfactorio">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="col-md-12">
				<div class="box box-solid box-success">
					<div class="box-header">
						<h3 class="box-title">¡Satisfactorio!</h3>
					</div>
					<div class="box-body">
						Se le ha enviado un mensaje a su correo electrónico, para que pueda activar su cuenta y disfrutar del servicio.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
