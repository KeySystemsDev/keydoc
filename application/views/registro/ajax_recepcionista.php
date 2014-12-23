<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tr>
						<th width="5%">#</th>
						<th width="15%"></th>
						<th width="15%">Nombre</th>
						<th width="15%">Apellido</th>
						<th width="20%">Cédula</th>
						<th width="20%">Teléfono</th>
						<th width="20%">Fecha</th>
					</tr>            
					<?php
						if(isset($usuario) && !empty($usuario)){
							$i = 0;
							foreach ($usuario as $key) {
								$i++; 
								$boton = '<span class="btn btn-sm btn-success"><i class="fa fa-check"></i> Seleccionar</span>';
								echo 
								'<tr>
									<td>'.$i.'</td>
									<td><img src="'.base_url().$key->url_imagen_perfil.'" class="img-circle" height="30" width="30"></td>
									<td>'.mysql_to_utf8($key->nombre_perfil, 'titulo').'</td>
									<td>'.mysql_to_utf8($key->apellido_perfil, 'titulo').'</td>
									<td>'.mysql_to_utf8($key->cedula_perfil, 'titulo').'</td>
									<td>'.mysql_to_utf8($key->telefono_perfil, 'titulo').'</td>
									<td>'.fecha_mysql_to_php($key->fecha_nacimiento_perfil, 'fecha').'</td>
									<td>
									<a href="'.base_url().'registro/recepcionista/usuario-'.base64_encode($key->id_usuario).'" class="btn-success">'.$boton.'</a>
									</td>
								</tr>';
							}
						}else{
							echo
							'<tr>
								<th colspan="8">No se encontraron resultados.</th>
							</tr>
							</table>
							</div>
							</div>
							</div>
							</div>
							</section>
							<section class="content">  
								<div class="col-md-6 col-xs-offset-3">
									<div class="box box-primary">     
										<div class="box-body">
											<div>
												<h1 class="seccion" align="center">Atención! </h1>
												<p>La recepcionista que busca <b>no se encuentra registrada en el sistema</b>. Debe indicarle a la misma que cree una nueva cuenta en el sistemaa través del enlace <b>http://www.keydoc.com.ve</b>.</p>
											</div>
										</div>
									</div>  
								</div>
							</section>';
						}
					?>                   
				</table>
			</div>
		</div>
	</div>
</div>
