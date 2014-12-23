<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Citas</li>
		<li class="active">Municipios</li>
	</ol>

</section>
<section class="content">  
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">        
					<?php       
						if(isset($municipios) && !empty($municipios)){
							$i = 0;
							foreach ($municipios as $key) {
								$i++;
								echo
								'<div class="col-xs-6">
									<!-- small box -->
									<div class="small-box bg-aqua">
										<div class="inner">
											<h3>'.$i.'</h3>
											<p>'.mysql_to_utf8($key->nombre_tipo, 'titulo').'</p>
										</div>
										<a href="'.base_url().'citas/especialidades/'.str_replace("_", "-", $url).'/municipio-'.$key->id_tipo.'" class="small-box-footer">
											Ingresar <i class="fa fa-arrow-circle-right"></i>
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