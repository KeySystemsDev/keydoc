<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Registro</li>
		<li class="active">Agendar Cita</li>
	</ol>   
</section>
<section class="content">
	<div class="box box-primary">
		<?php
			echo "<pre>";
			print_r($horario);
			echo "<pre>";
		?>
		<div class="box-body">     
			<div class="row">
				<?php       
					if(isset($horario) && !empty($horario)){
						foreach ($horario as $key) {   
							echo
							'<a href="'.base_url().'registro/recepcionista/'.str_replace("_", "-", $url).'/horario-'.codificar($key->id_horario).'" class="btn btn-default">'.$key->especialidad.'</a>';
						}
					} 
				?>
			</div>
		</div>
	</div>
</section>