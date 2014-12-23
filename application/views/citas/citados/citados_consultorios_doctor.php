<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Consultorios</li>
	</ol>
</section>
<section class="content"> 
	<div class="row">
		<div class="col-md-4">
			<ul class="list-group">        
				<?php
					if ($consultorios) {
						foreach ($consultorios as $key) {
							echo
							'<a href="'.base_url().'citas/citados/consultorio-'.base64_encode($key->id_consultorio).'" class="list-group-item">
								<span class="fa fa-chevron-right pull-right"></span>
								'.mysql_to_utf8($key->nombre_consultorio, 'titulo').'
							</a>';
						}
					}else{
						echo 
						'<div class="callout callout-info">
							<h4>¿No ve ningun paciente?</h4>
							<p>Le informamos que necesita aprobar las citas pendientes y comenzarán a aparecer reflejadas.</p>
						</div>';
					}                  
				?>     
			</ul>
		</div>

		<div class="col-md-8">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title" style="font-size: 14px;"><i class="fa fa-calendar"></i>&nbsp; Pacientes del día Seleccionado</h3>                                    
				</div>
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th width="5%">#</th>
							<th width="35%">Paciente</th>
							<th width="20%">Cédula</th>
							<th width="20%">Edad</th>                            
							<th width="20%">Fecha</th>
						</tr>
						<tr>      
							<?php              
								if(isset($citados) && !empty($citados)){
									$i = 0;                  
									foreach ($citados as $key) {
										$i++; 
										echo 
										'<tr>
											<td>'.$i.'</td>
											<td>'.mysql_to_utf8($key->nombre_paciente, 'titulo').'</td>
											<td>'.$key->cedula_perfil.'</td>
											<td>'.$key->edad.' Años</td>                                            
											<td>'.str_replace('-', '/', $key->fecha_horario).'</td>
										</tr>';
									}
								}
							?>              
						</tr>  
					</table>
				</div>
			</div>
		</div>     
	</div>
</section>   