<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Gestión</li>
		<li class="active">Listado de Pacientes</li>
	</ol>    
</section>
<section  class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<!---->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<thead>
							<th width="20%">#</th>
							<th width="20%">Nombre Paciente</th>
							<th width="20%">Cedula</th>
							<th width="20%">Sexo</th>
							<th width="20%">Fecha Agenda</th>
						</thead>
						<tbody>
							<?php
								/*if(isset($pacientes) && !empty($pacientes)){
									$i = 0;
									foreach ($pacientes as $key) {
										$i++;
										if ($key->sexo_perfil == 1){
											$sexo = 'Femenino';
										}else{
											$sexo = 'Masculino';
										}                     
										echo 
										'<tr>
											<td>'.$i.'</td>
											<td>'.mysql_to_utf8($key->nombre_paciente, 'titulo').'</td>
											<td>'.$key->cedula_perfil.'</td>
											<td>'.$sexo.'</td>
											<td>'.fecha_mysql_to_php($key->fecha_agenda_cita, 'fecha-hora').'</td>
										</tr>';
									}
								}*/
							?>                                     
						</tbody>
					</table>
				</div> 
			</div>
		</div>
	</div>
</section>