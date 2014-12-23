<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Registro</li>
		<li class="active">Estado</li>
	</ol>

</section>    
<section class="content"> 
	<div class="col-md-4">
		<ul class="list-group">        
			<?php
				foreach (array_slice($estados, 0, 8)  as $key) {
					echo
					'<a href="'.base_url().'registro/consultorio-estado/estado-'.base64_encode($key->id_tipo).'" class="list-group-item">
						<span class="badge" style="background: green;"><span class="fa fa-check"></span></span>
						'.mysql_to_utf8($key->nombre_tipo, 'titulo').'
					</a>';
				}
			?>     
		</ul>
	</div>
	<div class="col-md-4">
		<ul class="list-group">        
			<?php
				foreach (array_slice($estados, 9, 8)  as $key) {
					echo
					'<a href="'.base_url().'registro/consultorio-estado/estado-'.base64_encode($key->id_tipo).'" class="list-group-item">
						<span class="badge" style="background: green;"><span class="fa fa-check"></span></span>
						'.mysql_to_utf8($key->nombre_tipo, 'titulo').'
					</a>';
				}
			?>     
		</ul>
	</div>
	<div class="col-md-4">
		<ul class="list-group">        
			<?php
				foreach (array_slice($estados, 17, 8)  as $key) {
					echo
					'<a href="'.base_url().'registro/consultorio-estado/estado-'.base64_encode($key->id_tipo).'" class="list-group-item">
						<span class="badge" style="background: green;"><span class="fa fa-check"></span></span>
						'.mysql_to_utf8($key->nombre_tipo, 'titulo').'
					</a>';
				}
			?>     
		</ul>
	</div>
</section>
