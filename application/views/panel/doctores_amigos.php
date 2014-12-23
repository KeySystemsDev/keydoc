<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i>Doctores Amigos</li>
	</ol>    
</section>

<style type="text/css">
.perfil-detallado {
		background-color: #FF766C;
		border: 1px solid #ff766c;
		padding: 20px 0px;
}

.perfil-detallado img {
		display: block;
		border: 10px solid rgba(255, 255, 255, 0.3);
		margin: 0 auto;
		margin-top: 10px;
		margin-bottom: 10px;
}
.perfil-detallado p {
		text-align: center;
		color: #fff;
}
</style>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div id="listado_ajax" class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Listado Doctores Amigos</h3>                                    
				</div>
					<?php
						echo "<pre>";
						print_r($amistades);
						echo "</pre>";
					?>
				<div class="box-body table-responsive">
					<table id="listado" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre Doctor</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(isset($amistades) && !empty($amistades)){
									$i = 0;
									
									foreach ($amistades as $key) {
										$i++; 

										echo 
										'<tr>
											<td>'.$i.'</td>
											<td>'.mysql_to_utf8($key->nombre_doctor, 'titulo').'</td>
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
