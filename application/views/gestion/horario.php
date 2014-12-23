<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Gestión</li>
		<li class="active">Horario</li>
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
							<th width="20%">Consultorio</th>
							<th width="15%">Especialidad</th>
							<th width="15%">Fecha</th>
							<th width="10%">Desde</th>
							<th width="10%">Hasta</th>
							<th width="10%">Costo</th>              
							<th width="5%">Estatus</th>
							<th width="10%" colspan="2">Acciones</th>
						</tr>
						<?php
							if(isset($horarios) && !empty($horarios)){
								$i = 0;
								foreach ($horarios as $key) {
									$i++; 
									if ($key->habilitado_horario == 1){
										$estatus = '<span class="label label-success">Habilitado</span>';
										$boton   = '<span class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Dehabilitar</span>';
									}else{
										$estatus = '<span class="label label-danger">Deshabilitado</span>';
										$boton   = '<span class="btn btn-sm btn-success"><i class="fa fa-check"></i>Habilitar</span>';
									}

									echo 
									'<tr>
										<td>'.$i.'</td>
										<td>'.cortar_titulo($key->nombre_consultorio, 17).'</td>
										<td>'.cortar_titulo($key->especialidad, 20).'</td>
										<td>'.$key->fecha_horario.'</td>
										<td>'.$key->desde_hora_horario.'</td>
										<td>'.$key->hasta_hora_horario.'</td>
										<td>'.$key->costo_horario.'</td>
										<td>'.$estatus.'</td>
										<td>
											<a href="'.base_url().'gestion/horario-editar/horario-'.base64_encode($key->id_horario).'"><span class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Editar</span></a>
										</td>
										<td>
											<a href="'.base_url().'gestion/horario-eliminar/horario-'.base64_encode($key->id_horario).'">'.$boton.'</a>
										</td>
									</tr>';
								}
							}else{
								echo
								'<tr>
									<th colspan="10">No se encontraron resultados.</th>
								</tr>';
							}
						?>                  
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

