<div class="contenido-global">  
	<div class="bs-example width-1100 margin-auto">

	<div id="listado_ajax" class="width-1000 margin-auto">
		<?php if(!empty($bitacora)){ ?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Notificaciones</th>
					</tr>
				</thead>
				<tbody>          
				<?php
					$i = 0;
					foreach ($bitacora as $key) {
						$i++;
						echo 
						'<tr>
							<td>
								<strong>'.ucwords($key->nombre_usuario).'</strong> ha                  
								<strong>'.$key->descripcion_bitacora.'</strong> 
								Apróximadamente hace'.
								' Dias: '.$key->dias.
								' Horas: '.$key->horas.
								' Minutos '. $key->minutos.
								' Segundos '.$key->segundos.
							'</td>
						</tr>';
					}
				?>                
				</tbody>
			</table>
		<?php } ?>
	</div>  
</div>