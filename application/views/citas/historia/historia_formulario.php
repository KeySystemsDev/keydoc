<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Historia del Paciente</li>
	</ol>   
</section>
<section class="content">  
	<div class="col-md-6">
		<form id="form">
			<div class="form-group">
				<label for="i_monto_base">Monto Base</label>
				<input type="text" id="i_monto_base" class="form-control" name="i_monto_base" placeholder="Monto Base" readonly>
			</div>
			<div class="form-group">
				<label for="i_monto_adicional">Monto Adicional</label>
				<input type="text" id="i_monto_adicional" class="form-control" name="i_monto_adicional" placeholder="Monto Adicional">
			</div>
			<div class="form-group">
				<label for="i_monto_total">Monto a Cancelar</label>
				<input type="text" id="i_monto_total" class="form-control" name="i_monto_total" placeholder="Monto Total" readonly>
			</div>
			<div class="form-group">
				<label for="i_observacion_publica">Observacion Pública</label>
				<textarea class="form-control" rows="5" id="i_observacion_publica" name="i_observacion_publica" placeholder="Observación Pública" maxlength="300"></textarea>
			</div>
			<div class="form-group">
				<label for="i_observacion_privada">Observacion Privada</label>
				<textarea class="form-control" rows="5" id="i_observacion_privada" name="i_observacion_privada" placeholder="Observación Privada" maxlength="300"></textarea>
			</div>

			<button id="enviar">Registrar</button>
		</form>	
	</div>
</section>
