<section class="content-header">
  <ol class="breadcrumb">
	<li><i class="fa fa-cogs"></i> Registro</li>
	<li class="active">Agendar Cita</li>
  </ol>   
</section>

<section class="content">  
  <div class="box box-info">
	<div class="box-body">
	  <div class="row">
		<div class="col-md-12">          
		  <?php       
			if(isset($consultorios) && !empty($consultorios)){
			  foreach ($consultorios as $key) {
				echo
				'<div class="col-md-4" align="center">
				  	<a href="'.base_url().'citas/recepcionista/'.str_replace("_", "-", $url).'/consultorio-'.codificar($key->id_consultorio).'" class="action-button shadow animate blue col-md-12">
						'.mysql_to_utf8($key->nombre_consultorio, 'titulo').'
				  	</a>          
				</div>';
			  }
			} 
		  ?>
		</div>
	  </div>
	</div>
  </div>
</section> 