<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Historia del Paciente</li>
	</ol>   
</section>
<section class="content">  
  	<div class="row">                        
		<div class="col-md-12">
			<div class="box">
                <div class="box-header">
                    <h3 class="box-title">Datos del Paciente</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tr>
                            <th>Imagen</th>
                            <th>Paciente</th>
                            <th>Edad</th>
                            <th>Cedula</th>
                            <th>id_paciente (Oculto)</th>

                        </tr>
                        <?php 

	                        foreach (array_slice($historial, 0, 1) as $key) { 
		                        echo 
		                        '<tr>
		                            <th><img src="'.base_url().$key->url_imagen_perfil.'" width="50"></th>
		                            <th>'.$key->nombre_paciente.'</th>
		                            <th>'.$key->edad.'</th>
		                            <th>'.$key->cedula_perfil.'</th>
		                            <th>'.$key->id_usuario_paciente.' [id_paciente]</th>
		                        </tr>';
							}
						?>
                    </table>
                </div>
            </div>
		</div>
  	</div>
  	<div class="row">                        
		<div class="col-md-12">
			<div class="box">
                <div class="box-header">
                    <h3 class="box-title">Linea de tiempo de las citas del Pacientes</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tr>
                            <th>Fecha de Cita</th>                            
                            <th>Monto de cita</th>
                            <th>Consultorio</th>
                            <th>Accion</th>
                            <th>Costo</th>
                            <th>Costo Adicional</th>
                            <th>Costo Total</th>
                            <th>Observacion Publica</th>
                            <th>Observacion Privada</th>
                        </tr>
						<?php 
							foreach ($historial as $key) { 
		                        echo
		                        '<tr>
		                            <th>'.$key->fecha_horario.'</th>		                            
		                            <th>Monto de cita</th>
		                            <th>'.$key->nombre_consultorio.'</th>
		                            <th>';
										if ($key->asistencia_cita == 0) {
											echo '<a href="'.base_url().'citas/historia/'.str_replace('_', '-', $url).'/cita-'.base64_encode($key->id_cita).'">Atender</a>';
										}elseif ($key->asistencia_cita == 1) {
											echo '<a href="">Ver Detalle</a>';
										}elseif ($key->asistencia_cita == -1) {
											echo '<a href="">Falto</a>';
										}	
		                            
									echo 
		                            '</th>
		                            <th>Costo</th>
		                            <th>Costo Adicional</th>
		                            <th>Costo Total</th>
		                            <th>Observacion Publica</th>
		                            <th>Observacion Privada</th>
		                        </tr>';
		                    }
	                    ?>
                    </table>
                </div>
            </div>
		</div>
  	</div>
</section>
<section class="content">  
	linea de tiempo de la historia del paciente
	<a href="<?php echo base_url().'citas/historia/'.str_replace('_', '-', $url).'/cita-'.base64_encode(3); ?>"> Atender </a>

	<?php echo '<pre>'; print_r($historial); echo '</pre>'; ?>
</section>
