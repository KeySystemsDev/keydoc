<section class="content-header">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url().'registro'?>"><i class="fa fa-cogs"></i> Registro</a></li>
		<li><a href="<?php echo base_url().'registro/recepcionista'?>">Elegir Recepcionista</a></li>
		<li class="active">Elegir Consultorio</li>
	</ol>   
</section>
<section class="content">  
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">   
				<?php  
					if(isset($consultorios) && !empty($consultorios)){
						foreach ($consultorios as $key) {
							echo
							'<div class="col-md-4">
								<a href="'.base_url().'registro/recepcionista/'.$url.'/consultorio_'.base64_encode($key->id_consultorio).'">
									<div class="box box-info">
										<div class="box-header">
											<h3 class="box-title">'.mysql_to_utf8($key->nombre_consultorio, 'titulo').'</h3>
										</div>
									</div>
								</a>
							</div>';
						}
					} 
				?>
			</div>      
		</div>
	</div>
</section>
