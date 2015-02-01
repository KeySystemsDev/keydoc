<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Panel</li>
	</ol>    
</section>

<!-- Main content -->


<section class="content">
	<div class="panel-body">  
        <?php 
	        foreach ($this->notificacion_doctor as $key) {
	        	if($key->status_aprobado_cita == 1){
	        		$status = '<span class="label bg-green"><i class="fa fa-check"></i> Aprobado</span>';     			        		
	        	}else if($key->status_pendiente_cita == 1){
	        		$status = '<span class="label bg-blue"><i class="fa fa-refresh"></i> &nbsp;Pendiente por aprobación</span>';
	        	}else if($key->status_rechazado_cita == 1){
	        		$status = '<span class="label bg-red"><i class="fa fa-times"></i> &nbsp;Rechazado</span>';
	        	}
				echo 
	        	'<div class="row panel-row">    
					<br>
					<div class="col-md-2 col-sm-3 text-center">
					  	<a class="story-img" href="#"><img src="'.base_url().$key->url_imagen_perfil.'" style="width:100px;height:100px" class="img-circle"></a>
					</div>
					<div class="col-md-10 col-sm-9">
					  	<h3>'.$key->nombre_paciente.'</h3>
					  	<div class="row">
					    	<div class="col-xs-9">
					      		<p>Consultorio: '.$key->nombre_consultorio.'.</p>
					      		<p>Referencia de la ubicación: '.$key->direccion_consultorio.'.</p>
					      		<p class="lead pull-right">
					      			<span class="label label-default">'.number_format($key->costo_horario, 2, ',', '.').'</span>
					      			'.$status.'	
					      		</p>
					      		<ul class="list-inline lead ">
					      			<li>
					      				<i class="glyphicon glyphicon-time"></i> '.$key->desde_hora_horario.' - '.$key->hasta_hora_horario.'
					      			</li>
					      			<li>
					      				<i class="glyphicon glyphicon-calendar"></i> '.$key->fecha_horario.'
					      			</li>
					      			<li>
					      				<i class="glyphicon glyphicon-user"></i> '.$key->especialidad.'
					      			</li>
					      		</ul>
					      	</div>
					    	<div class="col-xs-3"></div>
						</div>
						<br><br>
					</div>
				</div>
				<hr>';
	        }
		?>         
    </div>    
</section>