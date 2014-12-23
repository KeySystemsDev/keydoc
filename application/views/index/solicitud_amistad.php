<section class="content">
	<div class="mailbox row">
		<div class="col-xs-8 col-md-push-2">
			<div class="box box-info">
				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="box-header">
								<i class="fa fa-fire"></i>
								<h5 class="box-title">Perfil del Doctor</h5>
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
						<div class="col-md-8">
							<div class="box-header">
								<i class="fa fa-fire"></i>
								<h5 class="box-title">Detalles del Doctor</h5>
							</div>
							<ul class="list-group">                 
								<?php
									foreach ($amistad as $key) {
										$aprobado  = $key->status_aprobado;
										$rechazado = $key->status_rechazado;
									}
									if ($aprobado == 0) {
										echo
										'<div class="callout callout-info">
											<h4>Mensaje de Información</h4>
											<p>Aún estamos en espera por la aceptación de su solicitud.</p>
										</div>';
									}else{
										if($resumen_perfil){
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