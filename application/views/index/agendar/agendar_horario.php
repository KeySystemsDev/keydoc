<section class="content">  
	<div class="col-md-6 col-md-push-3">
		<div class="progress progress-striped active">
			<div class="progress-bar progress-bar-info"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
			</div>        
		</div>
	</div>      
</section>
<section class="content">
	<div class="mailbox row">
		<div class="col-xs-12">
			<div class="box box-solid">
				<div class="box-body">
					<div class="row">          
						<div class="col-md-3">
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
									'<li class="list-group-item disabled">
										'.mysql_to_utf8($key->nombre_tipo, 'titulo').'
									</li>';
								  }
								?>
								<?php
								  foreach ($doctor as $key) {
									echo
									'<a href="'.base_url().'agendar/'.str_replace('_', '-', $url_1).'/'.str_replace('_', '-', $url_2).'/'.str_replace('_', '-', $url_3).'" class="list-group-item disabled">
										<span class="badge" style="background: red;"><span class="fa fa-times"></span></span>
										'.mysql_to_utf8($key->nombre_perfil, 'titulo').'
									</a>';
								  }
								?>   
							</ul>            
							<img src="<?php echo base_url().'public/img/upload.png'?>" width="100%">
							<div style="margin-top: 15px;">                                                            
								<?php             
									if ($amistad) {
										foreach ($amistad as $key) {
											$aprobado  = $key->status_aprobado;
											$rechazado = $key->status_rechazado;
										}
										if ($aprobado == 1) {
											foreach ($doctor as $key) {
												echo '
												<ul class="nav nav-pills nav-stacked">
													<li><a href="#"><i class="fa fa-pencil-square-o"></i> <b>Doctor:</b> '.ucwords($key->nombre_perfil).'</a></li>
													<li><a href="#"><i class="fa fa-mail-forward"></i> <b>Cédula:</b> '.ucwords($key->cedula_perfil).'</a></li>
													<li><a href="#"><i class="fa fa-star"></i> <b>Correo:</b> '.strtolower($key->correo_usuario).'</a></li>
													<li><a href="#"><i class="fa fa-folder"></i> <b>Web:</b> '.strtolower($key->portal_web_perfil).'</a></li>
												</ul>';                
											}
										}elseif($rechazado == 0){
											echo 
											'<div class="callout callout-info col-md-12">
												<h4>¡A la espera!</h4>
												<p>Estamos esperando la confirmación de solicitud del doctor, de igual forma puede apartar una cita si así lo desea.</p>
											</div>';
										}elseif($rechazado == 1){
											echo 
											'<div class="callout callout-info col-md-12">
												<h4>¡A la espera!</h4>
												<p>Estamos esperando la confirmación de solicitud del doctor, de igual forma puede apartar una cita si así lo desea.</p>
											</div>';
										}                                    
									}else{
										if ($this->session->userdata('id_usuario')) {
											echo 
											'<div class="callout callout-info col-md-12">
												<h4>¡Importante!</h4>
												<p>Podrás ver su información cuando eseas su amigo o sea aprobada tu primera cita.</p>
												<a href="'.base_url().'enviar-solicitud/doctor-'.base64_encode($id_doctor).'/paciente-'.base64_encode($this->session->userdata('id_usuario')).'" class="btn btn-primary col-md-12" >Enviar Solicitud</a>
											</div>';
										}else{
											echo '<a href="'.base_url().'sesion"><span class="btn btn-lg btn-info col-md-12"><i class="fa fa-check"></i> Ingresar</span></a>';
										}
									}                  
								?>    
							</div>                                                
						</div>              				
						<div class="col-md-9">
							<!--<div class="row pad">
								<div class="col-sm-6">
									<div class="btn-group">
										<button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
											Action <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#">Mark as read</a></li>
											<li><a href="#">Mark as unread</a></li>
											<li class="divider"></li>
											<li><a href="#">Move to junk</a></li>
											<li class="divider"></li>
											<li><a href="#">Delete</a></li>
										</ul>
									</div>
								</div>
								<div class="col-sm-6 search-form">
									<form action="#" class="text-right">
										<div class="input-group">                                                            
											<input type="text" class="form-control input-sm" placeholder="Search">
											<div class="input-group-btn">
												<button type="submit" name="q" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
											</div>
										</div>                                                     
									</form>
								</div>
							</div>-->
							<table class="table table-hover">
								<tr>
									<th width="5%">#</th>
									<th width="25%">Consultorio</th>
									<th width="20%">Especialidad</th>
									<th width="15%">Fecha</th>
									<th width="10%">Desde</th>
									<th width="10%">Hasta</th>
									<th width="5%">Costo</th>
									<th width="10%">Acción</th>
								</tr>
								<?php                 
									if($horarios){
										$i = 0;
										foreach ($horarios as $key) {
											$i++; 
											echo 
											'<tr>
												<td>'.$i.'</td>
												<td>'.mysql_to_utf8($key->nombre_consultorio, 'titulo').'</td>
												<td>'.mysql_to_utf8($key->especialidad, 'titulo').'</td>
												<td>'.$key->fecha_horario.'</td>
												<td>'.$key->desde_hora_horario.'</td>
												<td>'.$key->hasta_hora_horario.'</td>
												<td>'.$key->costo_horario.'</td>
												<td>';
												  if ($this->session->userdata('id_usuario')){
													echo '<a href="'.base_url().'agendar/'.str_replace('_', '-', $url).'/horario-'.base64_encode($key->id_horario).'"><span class="btn btn-sm btn-success"><i class="fa fa-check"></i> Agendar</span></a>';
												  }else{
													echo '<a href="'.base_url().'sesion"><span class="btn btn-sm btn-info"><i class="fa fa-check"></i> Ingresar</span></a>';
												  }
												echo
												'</td>
											</tr>';
										}
									}
								?>                   
							</table>                                                
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>