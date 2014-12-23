<section class="content">
	<div class="mailbox row">
		<div class="col-xs-12">
			<div class="box box-solid">
				<div class="box-body">
					<div class="row">
						<div class="col-md-3 col-sm-4">
							<div class="box-header">
								<i class="fa fa-fire"></i>
								<h5 class="box-title">Mi perfil</h5>
							</div>
							<?php
								if(isset($resumen_perfil) && !empty($resumen_perfil)){
									foreach ($resumen_perfil as $key) {
										echo 
										'<div class="thumbnail">
											<img src="'.base_url().$key->url_imagen_perfil.'" width="100%" class="img-responsive">
										</div>';
									}
								}
							?>
						</div>
						<div class="col-md-9 col-sm-8">
							<div class="row pad">
								<div class="col-sm-6">
									<div class="btn-group">
										<button type="button" class="btn btn-info btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
											Acciones <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="<?php echo base_url().'perfil-contrasena'?>">Cambiar Contraseña</a></li>
											<li><a href="<?php echo base_url().'perfil-editar'?>">Editar Perfil</a></li>
											<li class="divider"></li>
											<li><a href="<?php echo base_url().'agendar'?>">Agendar Cita</a></li>
										</ul>
									</div>                
								</div>
							</div>
							<ul class="list-group">                 
								<?php
									if(isset($resumen_perfil) && !empty($resumen_perfil)){
										foreach ($resumen_perfil as $key) {
											echo     
											'
											<li class="list-group-item">
												<span class="fa fa-check-square-o"></span>
												&nbsp;<b>Nombre:</b> '.mysql_to_utf8($key->nombre_perfil, 'titulo').'
											</li>
											<li class="list-group-item">
												<span class="fa fa-check-square-o"></span>
												&nbsp;<b>Cédula:</b> '.mysql_to_utf8($key->cedula_perfil, 'titulo').'
											</li>
											<li class="list-group-item">
												<span class="fa fa-check-square-o"></span>
												&nbsp;<b>Teléfono:</b> '.$key->telefono_perfil.'
											</li>
											<li class="list-group-item">
												<span class="fa fa-check-square-o"></span>
												&nbsp;<b>Direccion:</b> '.cortar_titulo($key->direccion_perfil, 100).'
											</li>
											<li class="list-group-item">
												<span class="fa fa-check-square-o"></span>
												&nbsp;<b>Correo:</b> '.mysql_to_utf8($key->correo_usuario, 'titulo').'
											</li>
											<li class="list-group-item">
												<span class="fa fa-check-square-o"></span>
												&nbsp;<b>Fecha Nacimiento:</b> '.fecha_mysql_to_php($key->fecha_nacimiento_perfil, 'fecha').'
											</li>
											';
										}
									}
								?>               
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>