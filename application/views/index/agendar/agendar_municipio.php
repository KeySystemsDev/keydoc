<section class="content">  
	<div class="col-md-6 col-md-push-3">
		<div class="progress progress-striped active">
			<div class="progress-bar progress-bar-info"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
			</div>        
		</div>
	</div>      
</section>
<section class="content">  
	<div class="row"> 
		<div class="col-md-4">       
			<ul class="list-group">        
				<?php
					foreach ($especialidad as $key) {
						echo
						'<li class="list-group-item disabled">
							<span class="badge"></span>
							'.mysql_to_utf8($key->nombre_tipo, 'titulo').'
						</li>';
					}
				?>
				<?php
					foreach ($estado as $key) {
						echo
						'<a href="'.base_url().'agendar/'.str_replace('_', '-', $url_1).'" class="list-group-item disabled">
							<span class="badge" style="background: red;"><span class="fa fa-times"></span></span>
							'.mysql_to_utf8($key->nombre_tipo, 'titulo').'
						</a>';
					}
				?>       
			</ul>
			<div class="box box-info">
				<div class="box-header" style="text-align: center; padding-top: 10px;">
					<div class="btn-group">
						<button type="button" class="btn btn-info disabled">Municipio</button>
						<button type="button" class="btn btn-info popover-msj" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Selecciona el Municipio más cercado de tu localidad ,si aún no encuentras el doctor que estas buscando de sigue filtrando la información.">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						</button>            
					</div>
				</div>      
				<div class="box-body no-padding">
					<table id="table" class="table">
						<thead>
							<tr>
								<th>Municipio</th>
							</tr>
						</thead>
						<tbody>
							<?php  
								if($municipios){
									foreach ($municipios as $key) {
										echo
										'<tr>
											<td>
												<a href="'.base_url().'agendar/'.str_replace('_', '-', $url).'/municipio-'.base64_encode($key->id_tipo_municipio).'">
													<span class="badge pull-right">'.$key->cantidad_doctores.'</span>
													'.mysql_to_utf8($key->municipio, 'titulo').'
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
												'.mysql_to_utf8($key->nombre_doctor, 'titulo').'
											</li>
											<a href="'.base_url().'doctor/usuario-'.base64_encode($key->id_usuario).'" class="list-group-item" align="center" style="padding:0px;">
												<img src="'.base_url().$key->url_imagen_perfil.'" width="100%" alt="'.mysql_to_utf8($key->nombre_doctor, 'titulo').'" class="img-responsive"/>
											</a>
											<li class="list-group-item" align="center">
												<div class="btn-group">
													<a href="#" class="btn btn-info">Visitas</a>
													<a href="#" class="btn btn-info">
														44
													</a>
												</div>
												<div class="btn-group">
													<a href="'.base_url().'doctor/usuario-'.base64_encode($key->id_usuario).'" class="btn btn-success">Ver Perfil</a>
													<a href="'.base_url().'doctor/usuario-'.base64_encode($key->id_usuario).'" class="btn btn-success">
														<span class="fa fa-arrow-right"></span>
													</a>
												</div>
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