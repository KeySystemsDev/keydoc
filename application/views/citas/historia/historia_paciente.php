<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Historia del Paciente</li>
	</ol>   
</section>

<!--<section class="content">  
	linea de tiempo de la historia del paciente
	<a href="<?php echo base_url().'citas/historia/'.str_replace('_', '-', $url).'/cita-'.base64_encode(3); ?>"> Atender </a>

	<?php echo '<pre>'; print_r($historial); echo '</pre>'; ?>
</section>-->

<section class="content">


    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
            		<?php 
	                    foreach (array_slice($historial, 0, 1) as $key) { 
		                    echo'
		                        <div class="box-profile">
		                        	<img src="'.base_url().$key->url_imagen_perfil.'"></th>
		                        
		                        	<h3>'.$key->nombre_paciente.'</h3>    
		                      	</div>

		                      	<!--<div class="box-body">
                                    <blockquote>
                                       <p>Edad: '.$key->edad.'</p></i>
                                    </blockquote>
                                    <blockquote>
                                        <p>Cédula: '.$key->cedula_perfil.'</p>
                                    </blockquote>
                                </div>
                                
                                <ul class="list-group">
								  <li class="list-group-item">Edad: '.$key->edad.'</li>
								  <li class="list-group-item">Cédula: '.$key->cedula_perfil.'</li>	 
								</ul>-->

								<ul class="list-group">
								  <li class="list-group-item">
								    <span class="badge">'.$key->edad.'</span>
								    <p class="text-aqua">Edad:</p>
								  </li>
								  <li class="list-group-item">
								    <span class="badge">'.$key->cedula_perfil.'</span>
								    <p class="text-aqua">Cédula:</p>
								  </li>
								</ul>
		                      ';
							}
						?>
                
            </div><!-- /. box -->
        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">                                
                <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                	<div class="box-header">
                    <h3 class="box-title">Citas del Pacientes</h3>
                </div>
                <section class="content">
				    <!-- row -->
				    <div class="row">                        
				        <div class="col-md-12">
				            <!-- The time line -->
				            <ul class="timeline">
				                <!-- timeline item -->
				                <?php 
									foreach ($historial as $key){ 
										echo 
						                '<li class="time-label">
						                    <div class="bg-aqua">
						                        <h4 style="margin: 5px 10px;">
						                        	<i class="fa fa-calendar-o"></i> '.$key->fecha_horario.'
						                        <h4>
						                    </div>

						                    ';
											if ($key->asistencia_cita == 0) {
												echo 	'<div class="bg-green box-action">
						                        			<h4 style="margin: 5px 10px;">
						                        				<i class="fa fa-check"></i>
						                        					<a href="'.base_url().
																 		'citas/historia/'.str_replace('_', '-', $url).
																 		'/cita-'.base64_encode($key->id_cita).'"> 
																 		Atender
																 	</a>
															<h4>
														</div>';
											}elseif ($key->asistencia_cita == 1) {
												echo 	'<div class="bg-teal box-action">
															<h4 style="margin: 5px 10px;">
																<i class="fa fa-pencil-square-o"></i>
																	<a href="">Ver Detalle</a>
															<h4>
													 	</div>';
											}elseif ($key->asistencia_cita == -1) {
												echo 	'<div class="bg-red box-action">
															<h4 style="margin: 5px 10px;">
																<i class="fa fa-exclamation-triangle"></i>
																	<a href="">Falto</a>
															<h4>
														</div>';
												}	
		                            
											echo'
      
						                </li>

			               			 	<li>
						                    <i class="fa fa-clock-o bg-yellow"></i>
						                    <div class="timeline-item">
			                        			<h3 class="timeline-header no-border"><a href="#">Hora: </a> '.$key->fecha_agenda_cita.' </h3>
			                    			</div>
						                </li>

						                <li>
						                    <i class="fa fa-stethoscope bg-teal"></i>
						                    <div class="timeline-item">
			                        			<h3 class="timeline-header no-border"><a href="#">Consultorio: </a> '.$key->nombre_consultorio.'</h3>
			                    			</div>
						                </li>

						                <li>
						                    <i class="fa fa-shopping-cart bg-red"></i>
						                    <div class="timeline-item">
						                        <div class="timeline-item">
							                        					             
							                        <h4> 
							                        	<span class="label label-default bg-green">Costo Base: '.$key->costo_horario.'</span>
														&nbsp;&nbsp;
				
														<span class="label label-default bg-yellow">Costo Adicional: ...'.$key->costo_consulta_adicional.'</span>

														&nbsp;&nbsp;

														
														<span class="label label-default bg-red">Costo Total: ...</span>
													</h4>
			
												</div>
						                    </div>
						                </li>

						                <li>
						                    <i class="fa fa fa-pencil-square-o bg-purple"></i>
						                    <div class="timeline-item">
						                        <h3 class="timeline-header"><a href="#">Observación Pública</a></h3>
						                        <div class="timeline-body">
						                            ...'.$key->observacion_publica.'
						                        </div>
						                        <h3 class="timeline-header"><a href="#">Observación Privada</a></h3>
						                        <div class="timeline-body">
						                            ...'.$key->observacion_privada.'
						                        </div> 
						                    </div>
						                </li>';
				               		}
								?>
 								
				                <li>
				                    <i class="fa"></i>
				                </li>
				            </ul>
				        </div><!-- /.col -->
				    </div><!-- /.row -->
				</section>
                </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col -->
    </div><!-- /.row -->  


</section>

