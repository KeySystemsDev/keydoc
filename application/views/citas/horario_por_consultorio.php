<section class="content-header">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url().'citas'?>"><i class="fa fa-cogs"></i> Citas</a></li>
		<li><a href="<?php echo base_url().'citas/listado'?>"> Consultorios Doctor</a></li>
		<li class="active">Horarios por Consultorio</li>
	</ol>

</section>
<section class="content">  
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Horarios por Día</h3>                                    
		</div>
		<div class="box-body">
			<div class="row">             
				<?php       
					if(isset($dias) && !empty($dias)){
						foreach ($dias as $key) {
							$aux = (string)$key->fecha_cita;
							$fecha = strrev(substr(strrev($aux),0,10));
							$nueva_fecha = str_replace("/", "-", $fecha);

							echo
							'<div class="col-lg-3 col-xs-6">
								<div class="small-box bg-blue">
									<a href="'.base_url().'citas/listado/'.str_replace("_", "-", $url).'/horario-'.$nueva_fecha.'" class="small-box-footer">
										<div class="inner">
											<h5>
												'.mysql_to_utf8($key->fecha_cita, 'titulo').'
											</h5>
											<p>
												<i class="fa fa-3x fa-check-square-o"></i>
											</p>
										</div>                    
									</a>
								</div>
							</div>';
						}
					} 
				?>
			</div>
		</div>
	</div>
</section>    