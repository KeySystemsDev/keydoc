<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Registro</li>
		<li class="active">Estado</li>
	</ol>
</section>
<section class="content">  
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">   
				<?php       
					if(isset($estados) && !empty($estados)){
						foreach ($estados as $key) {
							echo
							'<div class="col-md-3" align="center">
								<a href="'.base_url().'registro/consultorio-doctor/'.str_replace("_", "-", $url).'/estado-'.codificar($key->id_tipo).'" class="action-button shadow animate blue col-md-12">
									'.mysql_to_utf8($key->nombre_tipo, 'titulo').'
								</a>          
							</div>';
						}
					} 
				?>         
			</div>
		</div>
	</div>
</section>   