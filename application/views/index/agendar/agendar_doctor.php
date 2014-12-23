<section class="content">  
	<div class="col-md-6 col-md-push-3">
		<div class="progress progress-striped active">
			<div class="progress-bar progress-bar-info"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
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
							'.mysql_to_utf8($key->nombre_tipo, 'titulo').'
						</li>';
					}
				?>
				<?php
					foreach ($estado as $key) {
						echo
						'<li class="list-group-item disabled">
								'.mysql_to_utf8($key->nombre_tipo, 'titulo').'
						</li>';
					}
				?>
				<?php
					foreach ($municipio as $key) {
						echo
						'<a href="'.base_url().'agendar/'.str_replace('_', '-', $url_1).'/'.str_replace('_', '-', $url_2).'" class="list-group-item disabled">
							<span class="badge" style="background: red;"><span class="fa fa-times"></span></span>
							'.mysql_to_utf8($key->nombre_tipo, 'titulo').'
						</a>';
					}
				?>       
			</ul>
			<ul class="list-group">
				<li class="list-group-item ">
					Ahora solo te queda seleccionar el doctor de tu preferencia.
				</li>
			</ul>      
		</div>
		<div class="col-md-8"> 
			<div class="box box-info" >
				<div class="box-header">
					<div class="box-title" style="font-size: 14px;"><i class="fa fa-stethoscope"></i>&nbsp; Doctores Disponibles</div>
				</div>
				<div class="box-body chat">
					<?php
						if(isset($doctores) && !empty($doctores)){
							foreach ($doctores as $key) {
								echo
								'<div class="box-footer item">                
									<img src="'.base_url().$key->url_imagen_perfil.'" alt="user image" class="online"/>
									<p class="message">
										<a href="'.base_url().'agendar/'.str_replace('_', '-', $url).'/doctor-'.base64_encode($key->id_usuario).'" class="name" style="margin-top: 10px;">
											'.mysql_to_utf8($key->nombre_doctor, 'titulo').'
										</a>
									</p>
								</div>';
							}
						} 
					?>        
			</div>
		</div>
	</div>  