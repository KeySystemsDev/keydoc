<section class="content">  
  	<div class="row">                        
		<div class="col-md-2">
		  	<div class="thumbnail">
				<?php 
				  	foreach ($detalle_cita as $key) {
						echo '<img src="'.base_url().$key->imagen_paciente.'" width="100%" class="img-responsive centrado">';
				  	}
				?>
		  	</div>
		</div>
		<div class="col-md-10">
		  	<ul class="timeline">
				<?php
					foreach ($detalle_cita as $key) {
						$id_cita             = $key->id_cita;
						$id_usuario_paciente = $key->id_usuario_paciente;
						$id_usuario_doctor   = $key->id_usuario_doctor;
						echo
						'<li class="time-label">
						    <span class="bg-red">
								'.str_replace('-', '/', $key->fecha_agenda_cita).'
						    </span>
						</li>
						<li>
							<i class="fa fa-envelope bg-blue"></i>
							<div class="timeline-item">
								<span class="time"><i class="fa fa-clock-o"></i> Desde: '.$key->desde_hora_horario.' Hasta: '.$key->hasta_hora_horario.'</span>
								<h3 class="timeline-header">Detalles de la cita con el Paciente: <b>'.ucwords($key->nombre_paciente).'</b></h3>
								<div class="timeline-body table-responsive no-padding">
									  <table class="table table-hover">
												<tr>
													  <th width="5%">Doctor</th>
													  <th width="25%">Consultorio</th>
													  <th width="15%">Especialidad</th>
													  <th width="40%">Direccion</th>
													  <th width="5%">Costo</th> 
													  <th width="10%">Estatus</th>                              
												</tr>
												<tr>
													  <td><img src="'.base_url().$key->imagen_doctor.'" class="img-circle" width="30"/></td>
													  <td>'.ucfirst($key->nombre_consultorio).'</td>
													  <td>'.ucfirst($key->especialidad).'</td>
													  <td>'.ucfirst($key->direccion_consultorio).'</td>
													  <td>'.ucfirst($key->costo_horario).'</td>
													  <td>';
														if ($key->status_rechazado_cita == 1) {
														  	echo '<span class="label label-lg label-danger">Rechazada</span>';
														}else if ($key->status_pendiente_cita == 1) {
														  	echo '<span class="label label-lg label-info">En Espera</span>';
														}else if ($key->status_aprobado_cita == 1) {
														  	echo '<span class="label label-lg label-success">Aceptada</span>';
														}
													  echo
													  '</td>
												</tr>
									  </table>
								</div>';
								if ($key->status_pendiente_cita == 1) {
								  	echo 
								  	'<div class="timeline-footer">
										<div class="btn-group">
											<a href="#" data-toggle="modal" data-target="#modal-aceptar" class="btn btn-success">
												<span class="fa fa-thumbs-up"></span>
											</a>
											<a href="#" data-toggle="modal" data-target="#modal-aceptar" class="btn btn-success">Aprobar</a>    
										</div>
										<div class="btn-group">                    
										    <a href="#" data-toggle="modal" data-target="#modal-rechazar" class="btn btn-danger">Rechazar</a>
										    <a href="#" data-toggle="modal" data-target="#modal-rechazar" class="btn btn-danger">
												<span class="fa fa-thumbs-down"></span>
											</a>   
										</div>
								  	</div>';
								}
							echo
							'</div>
						</li>';
					}
				?>
		  	</ul>
		</div>
  	</div>
</section>
<!--
* Modal para aprobar una cita
-->
<script type="text/javascript">
  	$(function() {
		$('#b_aceptar').click(function(event) {             
		  	datos = $('#form_aprobar').serialize();
		  	$.ajax({
				type: 'POST',
				url: '<?php echo base_url()?>panel/notificaciones_aprobar',
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
<div class="modal fade" id="modal-aceptar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<form id="form_aprobar" class="form-horizontal" role="form">
				<!--
				* Valores para apartar una cita
				-->
				<input type="hidden" name="id_cita" value="<?php echo $id_cita ?>">
				<input type="hidden" name="id_usuario_paciente" value="<?php echo $id_usuario_paciente ?>">

				<div class="modal-header">
				  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  	<h4 class="modal-title" id="myModalLabel" align="center">¡Confirmación!</h4>
				</div>        
				<div class="modal-body" align="center">
				  	¿Está seguro que desea rechazar la cita con este paciente?
				</div>
				<div class="modal-footer ocultar">
				  	<button type="button" class="btn btn-danger" data-dismiss="modal">No, Aún no.</button>
				  	<button type="button" class="btn btn-success" id="b_aceptar">Si, ¡Seguro!</button>          
				</div>
		  	</form>
		</div>
  	</div>
</div>
<!--
* Modal para rechazar una cita
-->
<script type="text/javascript">
  	$(function() {
		$('#b_rechazar').click(function(event) {             
		  	a = validar.texto('i_detalle');
		
		  	if(a != 0){         
				datos = $('#form_rechazar').serialize();
				$.ajax({
				  	type: 'POST',
				  	url: '<?php echo base_url()?>panel/notificaciones_agregar_rechazo',
				  	data: datos, 
				  	success: function () { 
						$('.ocultar').hide();        
						setTimeout(function(){ 
						  	location.reload();
						}, 2000);                  
				  	}, 
				}); 
		  	}     
		}); 
  	});
</script>
<div class="modal fade" id="modal-rechazar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
		<div class="modal-content">
		  	<form id="form_rechazar" class="form-horizontal" role="form">
				<input type="hidden" name="id_cita" value="<?php echo $id_cita ?>">
				<div class="modal-header">
				  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  	<h4 class="modal-title" id="myModalLabel" align="center">¡Confirmación!</h4>
				</div>        
				<div class="modal-body" align="center">
				  	<div class="form-group">
						<label for="i_detalle">Describa el motivo del rechazo</label>
						<textarea class="form-control" rows="3" id="i_detalle" name="i_detalle" placeholder="Indique el motivo del Rechazo" maxlength="300"></textarea>
				  	</div>         
				</div>
				<div class="modal-footer ocultar">
				  	<button type="button" class="btn btn-danger" data-dismiss="modal">No, Aún no.</button>
				  	<button type="button" class="btn btn-success" id="b_rechazar">¡Si, Enviar!</button>          
				</div>
		  	</form>
		</div>
  	</div>
</div>