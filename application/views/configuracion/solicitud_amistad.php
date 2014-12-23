<script type="text/javascript">
	$(function() {
		$('#b_aceptar').click(function(event) {             
			datos = $('#form_modal').serialize();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url()?>configuracion/aprobar_solicitud',
				data: datos, 
				success: function () { 
					$('.ocultar').hide();        
					setTimeout(function(){ 
						location.reload();
					}, 2000);                  
				}, 
			});      
		}); 
	});
</script>
<section class="content">
	<div class="mailbox row">
		<div class="col-xs-8 col-md-push-2">
			<div class="box box-info">
				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="box-header">
								<i class="fa fa-fire"></i>
								<h5 class="box-title">Perfil del Paciente</h5>
							</div>
							<?php
								if(isset($resumen_perfil) && !empty($resumen_perfil)){
									foreach ($resumen_perfil as $key) {
										$id_paciente = $key->id_usuario; 
										echo 
										'<div class="thumbnail">
											<img src="'.base_url().$key->url_imagen_perfil.'" width="100%" class="img-responsive">
										</div>';
									}
								}
							?>
						</div>
						<div class="col-md-8">
							<div class="box-header">
								<i class="fa fa-fire"></i>
								<h5 class="box-title">Detalles del Paciente</h5>
							</div>
							<ul class="list-group">                 
								<?php
								foreach ($this->solicitud_amistad as $key) {
									$amigo = $key->status_aprobado;
								}
									if($resumen_perfil){
										foreach ($resumen_perfil as $key) {
											echo     
											'
											<li class="list-group-item">
												<span class="fa fa-check-square-o"></span>
												&nbsp;<b>Nombre:</b> '.mysql_to_utf8($key->nombre_perfil, 'titulo').'
											</li>
											<li class="list-group-item">
												<span class="fa fa-check-square-o"></span>
												&nbsp;<b>Cédula:</b> '.mysql_to_utf8($key->cedula_perfil, 'titulo').'
											</li>';
											if ($amigo == 1) {
												echo 
												'<li class="list-group-item">
													<span class="fa fa-check-square-o"></span>
													&nbsp;<b>Teléfono:</b> '.$key->telefono_perfil.'
												</li>
												<li class="list-group-item">
													<span class="fa fa-check-square-o"></span>
													&nbsp;<b>Direccion:</b> '.cortar_titulo($key->direccion_perfil, 100).'
												</li>
												<li class="list-group-item">
													<span class="fa fa-check-square-o"></span>
													&nbsp;<b>Correo:</b> '.mysql_to_utf8($key->correo_usuario, 'titulo').'
												</li>
												<li class="list-group-item">
													<span class="fa fa-check-square-o"></span>
													&nbsp;<b>Fecha Nacimiento:</b> '.fecha_mysql_to_php($key->fecha_nacimiento_perfil, 'fecha').'
												</li>';
											}else{
												echo
												'<a href="#" data-toggle="modal" data-target="#modal" class="list-group-item active">
													<span class="fa fa-thumbs-up pull-right"></span>
													Aprobar solicitud
												</a>';
											}
										}
									}
								?> 
															
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form_modal" method="post">      
				<div class="modal-header">
					<input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo $id_paciente ?>">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel" align="center">Confirmar Amistad</h4>
				</div>        
				<div class="modal-body">
					Ahora sera amigo de este paciente, ¿Esta de acuerdo?             
				</div>
				<div class="modal-footer ocultar">
					<button type="button" class="btn btn-danger" data-dismiss="modal">No, Aún no.</button>
						<button type="button" class="btn btn-success" id="b_aceptar">Si, ¡Seguro!</button>   
				</div>
			</form>
		</div>
	</div>
</div>