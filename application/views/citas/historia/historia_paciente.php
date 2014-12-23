<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Historia del Paciente</li>
	</ol>   
</section>
<section class="content">  
	linea de tiempo de la historia del paciente
	<a href="<?php echo base_url().'citas/historia/'.str_replace('_', '-', $url).'/cita-'.base64_encode(3); ?>"> Atender </a>

	<?php echo '<pre>'; print_r($historial); echo '</pre>'; ?>
</section>
