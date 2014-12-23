<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Registro</li>
		<li class="active">Agendar Cita</li>
	</ol>   
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th width="5%">#</th>
							<th width="20%">Especialidad</th>
							<th width="20%">Fecha Cita</th>
							<th width="20%">Desde Hora</th>
							<th width="20%">Hasta Hora</th>
							<th width="20%"># Cupos</th>
							<th width="20%">Costo</th>
						</tr>
						<?php
							if(isset($horario) && !empty($horario)){
								$i = 0;
								foreach ($horario as $key) {
									$i++; 
									$boton = '<span class="btn btn-sm btn-success"><i class="fa fa-check"></i> Seleccionar</span>';
									echo 
									'<tr>
										<td>'.$i.'</td>
										<td>'.mysql_to_utf8($key->especialidad, 'titulo').'</td>
										<td>'.fecha_mysql_to_php($key->fecha_horario, 'fecha').'</td>
										<td>'.mysql_to_utf8($key->desde_hora_horario, 'titulo').'</td>
										<td>'.mysql_to_utf8($key->hasta_hora_horario, 'titulo').'</td>
										<td>'.mysql_to_utf8($key->cupos_horario, 'titulo').'</td>
										<td>'.mysql_to_utf8($key->costo_horario, 'descripcion').'</td>
										<td>
											<a href="'.base_url().'citas/recepcionista/'.str_replace("_", "-", $url).'/horario-'.codificar($key->id_horario).'">'.$boton.'</a>
										</td>
									</tr>';
								}
							}else{
								echo
								'<tr>
									<th colspan="5">No se encontraron resultados.</th>
								</tr>';
							}
						?>                   
					</table>
				</div>
			</div>
		</div>
	</div>
</section>