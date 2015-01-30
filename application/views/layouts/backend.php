<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<title><?php echo $this->layout->getTitle(); ?></title>
		<meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
		<meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/favicon.ico" type="image/x-icon"/>

		<!-- CSS LIBRERIA --> 
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/font-awesome.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/ionicons.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/admin.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/bootstrap/bootstrap-colorpicker.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/bootstrap/bootstrap3-wysihtml5.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/bootstrap/data-tables.bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/bootstrap/bootstrap-timepicker.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/bootstrap/daterangepicker-bs3.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/bootstrap/datepicker.css"/>    
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/morris/morris.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/jvectormap/jquery-jvectormap-1.2.2.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/fullcalendar/fullcalendar.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/bootstrap/css/icheck/all.css"/>   
		 
		<!-- CSS INDIVIDUALES -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/config-master.css"/> 
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/select2/select2.css"/>    
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/config-tooltip.css"/> 

		<!-- FONT -->
		<link href='http://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>

		<!-- JS INDIVIDUALES -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.tooltip.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/js/helper.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/js/select2.js"></script>    
		<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.char.count.js"></script>

		<!-- JS LIBRERIA -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/raphael-min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/admin/app.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/admin/dashboard.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/bootstrap/bootstrap-colorpicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/bootstrap/bootstrap-timepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/bootstrap/jquery.data-tables.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/bootstrap/data-tables.bootstrap.js"></script>    
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/bootstrap/bootstrap3-wysihtml5.all.min.js"></script>    <!--<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/morris/morris.min.js"></script>-->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/bootstrap/daterangepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/sparkline/jquery.sparkline.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/fullcalendar/fullcalendar.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/jqueryKnob/jquery.knob.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/libs/bootstrap/js/plugins/icheck/icheck.min.js"></script>
				 
		<!--  AUXILIARES CODEIGNITER -->
		<?php echo $this->layout->css; ?> 
		<?php echo $this->layout->js; ?> 
		<script type="text/javascript">
			$(function() { 
				$('.tiptip').tipTip();
				$('.popover-msj').popover({ trigger: 'focus'});
			});
		</script>
		</head>
	<body class="skin-blue fixed">
		<!-- header logo: style can be found in header.less -->
		<header class="header">
			<a href="<?php echo base_url()?>panel" class="logo">
				<img class="logo-img" src="<?php echo base_url()?>/public/img/logo_keydoc.png">
			</a>
			<nav class="navbar navbar-static-top" role="navigation">
				<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
					<div id="ajax-carga"></div>
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="navbar-left">
					<ul class="nav navbar-nav">
						<?php 
							if(isset($sub_menu)){
								$i = 'A';
								foreach ($sub_menu as $key) {                  
									$activo = menu_superior($key->link_menu);
									echo 
									'<li class="messages-menu menu-superior">
										<a href="'.base_url().$key->link_menu.'" class="tiptip '.$activo.'" title="'.utf8_decode($key->descripcion_menu).'">
											<span class="mn-vertical">'.$i.'</span>
											<!--<span class="label label-success">1</span>-->
										</a>
									</li>';
									$i++;
								}
							}
						?>            
					</ul>
				</div>
				<div class="navbar-right">
					<ul class="nav navbar-nav">
						<!--
						* Se muestran las solicitudes de amistad
						-->
						<?php               
							if ($this->solicitud_amistad){
								$notificaciones = 0;
								foreach ($this->solicitud_amistad as $key) {
									if ($key->leida_notificacion_doctor == 0) {
										$notificaciones ++;
									}                    
								}
								echo 
								'<li class="dropdown messages-menu">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-inbox"></i>';
										if ($notificaciones > 0) {
											echo '<span class="label label-success">'.$notificaciones.'</span>';
										}                    
									echo
									'</a>
									<ul class="dropdown-menu">
										<li class="header">Tiene  <b>'.$notificaciones.'</b> solicitudes aprobadas.</li>
										<li>
											<ul class="menu">';
												foreach ($this->solicitud_amistad as $key) {
													echo  
													'<li>
														<a href="'.base_url().'configuracion/amistad/usuario-'.base64_encode($key->id_usuario_paciente).'">
															<div class="pull-left">
																<img src="'.base_url().$key->url_imagen_perfil.'" class="img-circle" alt="Key Doc"/>
															</div>
															<p>Hace '.$key->diferencia_tiempo.' <i class="fa fa-clock-o"></i></p>
															<p>Una nueva solicitud de amistad por <br>
															<b>'.cortar_titulo(mysql_to_utf8($key->nombre_paciente, 'titulo'), 20).'</b> </p>';
															if ($key->status_rechazado == 1) {
																echo '<span class="label label-danger pull-right">Ha sido Rechazada</span>';
															}else if ($key->status_aprobado == 1) {
																echo '<span class="label label-success pull-right">Ha sido Aceptada</span>';
															}else{
																echo '<span class="label label-info pull-right">Por Aprobar</span>';
															}                               
														echo
														'</a>
													</li>';                            
												}
											echo                                                           
											'</ul>
										</li>
										<li class="footer"><a href="'.base_url().'notificaciones-todas">Ver todas las Notificaciones</a></li>
									</ul>
								</li>';
							}
						?>
						<!--
						* Se muestran las notificaciones del doctor
						-->
						<?php 
							if (isset($this->notificacion_doctor)){
								$notificaciones = 0;
								foreach ($this->notificacion_doctor as $key) {
									if ($key->leida_notificacion_doctor_cita == 0) {
										$notificaciones ++;
									}
								}
								echo 
								'<li class="dropdown messages-menu">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-stethoscope"></i>';
										if ($notificaciones > 0) {
											echo '<span class="label label-success">'.$notificaciones.'</span>';
										}                    
									echo
									'</a>
									<ul class="dropdown-menu">
										<li class="header">Tiene  <b>'.$notificaciones.'</b> notificaciones de tus pacientes.</li>
										<li>
											<ul class="menu">';
												foreach ($this->notificacion_doctor as $key) {
													if ($key->leida_notificacion_doctor_cita == 0) {
														$lectura = '<span class="label label-default pull-right">No leído</span>&nbsp;';
													}else{
														$lectura = '';
													}
													echo  
													'<li>
														<a href="'.base_url().'panel/doctor/notificacion-'.base64_encode($key->id_cita).'">
															<div class="pull-left">
																<img src="'.base_url().$key->url_imagen_perfil.'" class="img-circle" alt="Key Doc"/>
															</div>
															<p>'.$key->fecha_agenda_cita.' <i class="fa fa-clock-o"></i> '.$lectura.'</p>
															<p><b>'.cortar_titulo(mysql_to_utf8($key->nombre_paciente, 'titulo'), 20).'</b> ha reservado una cita</p>';
															if ($key->status_rechazado_cita == 1) {
																echo '<span class="label label-danger pull-right">Solicitud Rechazada</span>';
															}else if ($key->status_pendiente_cita == 1) {
																echo '<span class="label label-info pull-right">Solicitud Pendiente</span>';
															}else if ($key->status_aprobado_cita == 1) {
																echo '<span class="label label-success pull-right">Solicitud Aceptada</span>';
															}                               
														echo
														'</a>
													</li>';                            
												}
											echo                                                           
											'</ul>
										</li>
										<li class="footer"><a href="'.base_url().'panel/notificaciones-todas">Ver todas las Notificaciones</a></li>
									</ul>
								</li>';
							}
						?> 
						<!--
						* Se muestran las nostificaciones del paciente
						-->
						<?php               
							if (isset($this->notificacion_paciente)){
								$notificaciones = 0;
								foreach ($this->notificacion_paciente as $key) {
									if ($key->leida_notificacion_paciente_cita == 0) {
										$notificaciones ++;
									}
								}
								echo 
								'<li class="dropdown messages-menu">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-bell"></i>';
										if ($notificaciones > 0) {
											echo '<span class="label label-success">'.$notificaciones.'</span>';
										}                    
									echo
									'</a>
									<ul class="dropdown-menu">
										<li class="header">Tiene  <b>'.$notificaciones.'</b> notificaciones de tus doctores.</li>
										<li>
											<ul class="menu">';
												foreach ($this->notificacion_paciente as $key) {                                                                              
													if ($key->leida_notificacion_paciente_cita == 0) {
														$lectura = '<span class="label label-default pull-right">No leído</span>&nbsp;';
													}else{
														$lectura = '';
													}
													echo  
													'<li>
														<a href="'.base_url().'paciente/notificacion-'.base64_encode($key->id_cita).'">
															<div class="pull-left">
																<img src="'.base_url().$key->url_imagen_perfil.'" class="img-circle" alt="Key Doc"/>
															</div>
															<p>'.$key->fecha_agenda_cita.' <i class="fa fa-clock-o"></i> '.$lectura.'</p>
															<p>A citado con: <b>'.cortar_titulo(mysql_to_utf8($key->nombre_doctor, 'titulo'), 20).'</b></p>';
															
															if ($key->status_rechazado_cita == 1) {
																echo '<span class="label label-danger pull-right">Solicitud Rechazada</span>';
															}else if ($key->status_pendiente_cita == 1) {
																echo '<span class="label label-info pull-right">Solicitud Enviada</span>';
															}else if ($key->status_aprobado_cita == 1) {
																echo '<span class="label label-success pull-right">Solicitud Aceptada</span>';
															}                                
														echo
														'</a>
													</li>';                            
												}
											echo                                                           
											'</ul>
										</li>
										<li class="footer"><a href="'.base_url().'notificaciones-todas">Ver todas las Notificaciones</a></li>
									</ul>
								</li>';
							}
						?>
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="glyphicon glyphicon-user"></i>
								<span>
									<?php
										if ($this->session->userdata('id_usuario')){                      
											if($this->perfil != 0){
												foreach ($this->datos_perfil as $key) {
													echo cortar_titulo(ucwords($key->nombre_perfil), 10);
												}                          
											}else{
												$usuario = explode('@', $this->session->userdata('usuario'));
												echo cortar_titulo(ucwords($usuario[0]), 10);
											}
										}else{
											echo 'Ingresar';
										} 
									?>
									<i class="caret"></i>
								</span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header bg-light-blue">
									<?php
										if (!$this->datos_perfil) {
											echo '<img src="'.base_url().'public/img/upload.png" class="img-circle" alt="User Image" />';
										}else{
											foreach ($this->datos_perfil as $key) { 
												echo '<img src="'.base_url().$key->url_imagen_perfil.'" class="img-circle" alt="User Image" />';
											}
										}
									?>
									<p style="font-size: 12px;">
										<?php
											foreach ($this->validar_perfil as $key) { $i = $key->nombre_apellido;}
											if ($i != 0) {
												if (isset($this->datos_perfil) && !empty($this->datos_perfil)) {
													foreach ($this->datos_perfil as $key) {
														echo cortar_titulo(ucwords($key->nombre_perfil), 24);
													}
												}
											}else{
												$usuario = explode('@', $this->session->userdata('usuario'));
												echo cortar_titulo(ucwords($usuario[0]), 10);
											} 
										?>
									</p>
									<small>
										<?php
											date_default_timezone_set('America/Caracas');
											setlocale(LC_TIME, 'spanish');
											$fecha=strftime("%A, %d de %B de %Y");
											echo utf8_encode($fecha);
										?>
									</small>                  
								</li>
								<li class="user-footer">
									<div class="btn-group">
										<?php if($this->session->userdata('usuario')){ ?>
											<a href="<?php echo base_url();?>sesion/desconectar" class="btn-sm btn-default">Desconectarme</a>
											<a href="<?php echo base_url();?>configuracion/perfil" class="btn-sm btn-default">Perfil</a>
										<?php } ?>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="wrapper row-offcanvas row-offcanvas-left">
			<aside class="left-side sidebar-offcanvas">
				<section class="sidebar">
					<div class="user-panel">
						<div class="pull-left image">
							<?php
								if (!$this->datos_perfil) {
									echo '<img src="'.base_url().'public/img/upload.png" class="img-circle" alt="User Image" />';
								}else{
									foreach ($this->datos_perfil as $key) { 
										echo '<img src="'.base_url().$key->url_imagen_perfil.'" class="img-circle" alt="User Image" />';
									}
								}
							?>              
						</div>
						<div class="pull-left info">
							<p>
								<?php
									if ($this->session->userdata('id_usuario')) {
										if($this->perfil != 0){
											foreach ($this->datos_perfil as $key) {
												echo cortar_titulo(ucwords($key->nombre_perfil), 20);
											} 
										}else{
											$usuario = explode('@', $this->session->userdata('usuario'));
											echo cortar_titulo(ucwords($usuario[0]), 10);
										}
									}
								?>
							</p>
							<a href="#"><i class="fa fa-circle text-success"></i> En Línea</a>
						</div>
					</div>
					<!--<form action="#" method="get" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="q" class="form-control" placeholder="Search..."/>
							<span class="input-group-btn">
								<button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>-->
					<ul class="sidebar-menu">            
						<?php 
							if(isset($menu)){
								$j = 1;
								foreach ($menu as $key) {                  
									$activo = menu_lateral($key->link_menu);
									echo 
									'<li class="'.$activo.'">
										<a href="'.base_url().$key->link_menu.'">
											<i class="fa fa-folder-o"></i>
											<span>'.ucwords(utf8_decode($key->descripcion_menu)).'</span>
										</a>
									</li>';
									$j++;
								}
							}
						?> 
					</ul>
				</section>
			</aside>
			<aside class="right-side">
				<?php 
					echo $content_for_layout; 				   
				?>         
			</aside>
		</div>
	</body>
</html>