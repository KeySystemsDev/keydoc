<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Gestión de Especialidades</li>
	</ol>   
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th width="50">#</th>
							<th>Nombre de la Especialidad</th>
							<th width="120">Estatus</th>
							<th width="200">Acciones</th>
						</tr>
						<?php
							if(isset($especialidades) && !empty($especialidades)){
								$i = 0;
								foreach ($especialidades as $key) {
									$i++; 
									if ($key->habilitado_tipo == 1){
										$estatus = '<span class="label label-success">Habilitado</span>';
										$boton   = '<span class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Dehabilitar</span>';
									}else{
										$estatus = '<span class="label label-success">Habilitado</span>';
										$boton   = '<span class="btn btn-sm btn-success"><i class="fa fa-check"></i> Habilitar</span>';
									}

									echo 
									'<tr>
										<td>'.$i.'</td>
										<td>'.mysql_to_utf8($key->nombre_tipo, 'titulo').'</td>
										<td>'.$estatus.'</td>
										<td>
											<a href="'.base_url().'gestion/especialidad-editar/doctor-'.base64_encode($key->id_detalle_doctor_especialidad).'/especialidad-'.base64_encode($key->id_tipo).'">
												<span class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Editar</span>
											</a>
											<a href="'.base_url().'gestion/especialidad-eliminar/especialidad-'.base64_encode($key->id_tipo).'">'.$boton.'</a>
										</td>
									</tr>';
								}
							}
						?>                   
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
