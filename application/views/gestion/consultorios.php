<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Gestión de Consultorios</li>
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
							<th width="60%">Dirección</th>
							<th width="5%">Estatus</th>
							<th width="10%" colspan="2">Acciones</th>
						</tr>
						<?php
							if(isset($listado) && !empty($listado)){
								$i = 0;
								foreach ($listado as $key) {
									$i++; 
									if ($key->habilitado_consultorio == 1){
										$estatus = '<span class="label label-success">Habilitado</span>';
										$boton   = '<span class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Dehabilitar</span>';
									}else{
										$estatus = '<span class="label label-danger">Deshabilitado</span>';
										$boton   = '<span class="btn btn-sm btn-success"><i class="fa fa-check"></i> Habilitar</span>';
									}

									echo 
									'<tr>
										<td>'.$i.'</td>
										<td>'.mysql_to_utf8($key->nombre_consultorio, 'titulo').'</td>
										<td>'.mysql_to_utf8($key->direccion_consultorio, 'descripcion').'</td>
										<td>'.$estatus.'</td>
										<td>
											<a href="'.base_url().'gestion/consultorio-editar/consultorio-'.base64_encode($key->id_consultorio).'"><span class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Editar</span></a>
										</td>
										<td>
											<a href="'.base_url().'gestion/consultorio-eliminar/consultorio-'.base64_encode($key->id_consultorio).'">'.$boton.'</a>
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
