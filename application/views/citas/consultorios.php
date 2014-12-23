<script type="text/javascript">
	$(function() {
		$('#listado').dataTable();
	});
</script>
<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Citas</li>
		<li class="active">Listado de Consultorios</li>
	</ol>    
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div id="listado_ajax" class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Listado de Consultorios</h3>                                    
				</div>
				<div class="box-body table-responsive">
					<table id="listado" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre del Consultorio</th>
								<th>Direccion</th>
								<th>Costo Consulta</th>
								<th>Hora Consulta</th>
								<th width="50">	              
									<span class="btn btn-sm btn-success" title="Seleccionar"><i class="fa fa-check"></i></span>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(isset($consultorios) && !empty($consultorios)){
									$i = 0;
									foreach ($consultorios as $key) {
										$i++;
										$boton   = '<span class="btn btn-sm btn-success"><i class="fa fa-check"></i></span>'; 
										echo 
										'<tr>
												<td>'.$i.'</td>
												<td>'.mysql_to_utf8($key->nombre_consultorio, 'titulo').'</td>
												<td>'.mysql_to_utf8($key->direccion_consultorio, 'descripcion').'</td>
												<td>'.$key->costo_horario.'</td>
												<td>'.$key->hora_horario.'</td>
												<td>
													<a href="'.base_url().'citas/especialidades/'.$url.'/'.mysql_to_utf8(str_replace(" ", "-", $key->nombre_consultorio), 'url').'" title="Seleccionar">'.$boton.'</a>
												</td>
											</tr>';
									}
								}
							?>                                      
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
