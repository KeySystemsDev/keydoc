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
						$detalle = (isset($key->descripcion_detalle_rechazo_cita)) ? $key->descripcion_detalle_rechazo_cita : '';
						echo
						'
						<li class="time-label">
							<span class="bg-red">
								'.str_replace('-', '/', $key->fecha_agenda_cita).'
							</span>
						</li>
						<li>
							<i class="fa fa-envelope bg-blue"></i>
							<div class="timeline-item">
								<span class="time"><i class="fa fa-clock-o"></i> Desde: '.$key->desde_hora_horario.' Hasta: '.$key->hasta_hora_horario.'</span>
								<h3 class="timeline-header">Detalles de la cita con el doctor: <b>'.ucwords($key->nombre_doctor).'</b></h3>
								<div class="timeline-body table-responsive no-padding">
									<table class="table table-hover">
										<tr>
											<th width="5%">Doctor</th>
											<th width="20%">Consultorio</th>
											<th width="15%">Especialidad</th>
											<th width="40%">Direccion</th>
											<th width="5%">Costo</th> 
											<th width="15%">Estatus</th>                              
										</tr>
										<tr>
											<td><img src="'.base_url().$key->imagen_doctor.'" class="img-circle" width="30"/></td>
											<td>'.ucfirst($key->nombre_consultorio).'</td>
											<td>'.ucfirst($key->especialidad).'</td>
											<td>'.ucfirst($key->direccion_consultorio).'</td>
											<td>'.ucfirst($key->costo_horario).'</td>
											<td>';
												if ($key->status_rechazado_cita == 1) {
													echo 
													'<a href="#" data-toggle="modal" data-target="#modal" class="label label-lg label-danger" style="font-size: 16px;">Ver motivo del rechazo</span>';
												}else if ($key->status_pendiente_cita == 1) {
													echo '<span class="label label-lg label-info" style="font-size: 16px;">Solicitud Enviada</span>';
												}else if ($key->status_aprobado_cita == 1) {
													echo '<span class="label label-lg label-success" style="font-size: 16px;">Solicitud Aceptada</span>';
												}
											echo
											'</td>
										</tr>
									</table>
								</div>
							</div>
						</li>
						';
					}
				?>
			</ul>
		</div>
	</div>
</section>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel" align="center">Motivo del Rechazo</h4>
			</div>        
			<div class="modal-body">
				<?php echo $detalle ?>                
			</div>
			<div class="modal-footer ocultar">
				<button type="button" class="btn btn-info" data-dismiss="modal">Entiendo</button>    
			</div>
		</div>
	</div>
</div>