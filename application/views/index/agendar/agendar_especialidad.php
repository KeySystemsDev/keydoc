<section class="content">  
	<div class="col-md-6 col-md-push-3">
		<div class="progress progress-striped active">
			<div class="progress-bar progress-bar-info"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
			</div>        
		</div>
	</div>      
</section>
<section class="content">  
	<div class="row"> 
		<div class="col-md-4">
			<div class="box box-info">
				<div class="box-header" style="text-align: center; padding-top: 10px;">
					<div class="btn-group">
						<button type="button" class="btn btn-info disabled">Especialidad</button>
						<button type="button" class="btn btn-info popover-msj" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Selecciona la especialidad de interés y la información se irá filtrando.">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						</button>            
					</div>
				</div>
				<div class="box-body no-padding">
					<table id="table" class="table">
						<tbody>
							<?php  
								if(isset($especialidades) && !empty($especialidades)){
									foreach ($especialidades as $key) {
										echo
										'<tr>
											<td>
												<a href="'.base_url().'agendar/especialidad-'.base64_encode($key->id_tipo_especialidad).'">
													<span class="badge pull-right">'.$key->cantidad_doctores.'</span>
													'.mysql_to_utf8($key->nombre_especialidad, 'titulo').'
												</a>
											</td>                                                
										</tr>';
									}
								} 
							?>                                                                  
						</tbody>
					</table>
				</div>
			</div>
			<ul class="list-group">
				<li class="list-group-item ">
					Solo aparecerán resultados relacionado a doctores activos.
				</li>
			</ul>
		</div>
		<div class="col-md-8"> 
			<div class="box box-info" >
				<div class="box-header">
					<div class="box-title" style="font-size: 14px;"><i class="fa fa-stethoscope"></i>&nbsp; Doctores Disponibles</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<?php 
							if(isset($doctores) && !empty($doctores)){
								foreach ($doctores as $key) {
									echo
									'<div class="col-md-3">
										<ul class="list-group">                 
											<li class="list-group-item" align="center">
												<a href="'.base_url().'doctor/usuario-'.base64_encode($key->id_usuario).'" class="btn-sm btn-default">'.mysql_to_utf8($key->nombre_doctor, 'titulo').'</a>
											</li>
											<a href="'.base_url().'doctor/usuario-'.base64_encode($key->id_usuario).'" class="list-group-item" align="center" style="padding:0px;">
												<img src="'.base_url().$key->url_imagen_perfil.'" width="100%" alt="'.mysql_to_utf8($key->nombre_doctor, 'titulo').'" class="img-responsive"/>
											</a>
											<li class="list-group-item" align="center">												
												<a href="'.base_url().'doctor/usuario-'.base64_encode($key->id_usuario).'" class="btn-sm btn-default">Visitas 44</a>
											</li>
										</ul>								
									</div>';
								}
							} 
						?>
					</div>         
				</div>
			</div>
		</div>
	</div>  
</section>