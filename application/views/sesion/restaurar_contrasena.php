<script type="text/javascript">  
	$(function() {
		$('#b_enviar').click(function(){
			a = validar.correo('i_usuario');
			if(a != 0){ 
				var datos = $('#form').serialize(); 
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>sesion/existencia',
					data: datos,
					success: function (data) {  
						if(data == 1){
							var datos = $("#form").submit();
						}else{
							$('#error').modal({
								show: true 
							});
						}       
					},
				});         
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
				$('#b_enviar').click(); 
			}
		});
	});
</script>
<div class="form-box" id="login-box">
	<div class="header">
		Recuperar Contraseña
	</div>
	<form id="form" class="form-signin" role="form" method="post" action="<?php echo base_url().'sesion/enviar-password'?>">
		<div class="body">
			<div class="form-group">
				<input type="text" class="form-control popover-msj" id="i_usuario" name="i_usuario" placeholder="Correo Electrónico" data-container="body" data-toggle="popover" data-placement="left" data-content="Correo para restaurar contraseña">
			</div>
		</div>
		<div class="footer col-md-12">                
			<a href="<?php echo base_url().'sesion/sesion'?>" class="btn btn-warning col-md-3">Atrás</a>  
			<a href="#" id="b_enviar" class="btn btn-info col-md-8 pull-right">Enviar</a>        
		</div>
	</form>

	<div class="margin text-center">
		<br/><br/><br/><br/>
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
						No podemos enviarle la nueva contraseña ya que el correo no existe.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>