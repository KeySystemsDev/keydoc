<script type="text/javascript">
	$(function(){
		$('.popover-msj').popover({
			trigger: 'focus'
		});      
		$('#b_enviar').click(function(event) { 
			a = validar.cedula('i_cedula');
			
			if(a != 0){                           
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>citas/paciente-buscar',
					data: datos,
					beforeSend: function(){
						ajax.before('#ajax', '<?php echo base_url()?>public/img/ajax.gif');
					},          
					success: function (data) {          
						$('#ajax').html(data);       
					},                                         
				});           
			}else{
				ajax.mensaje('msj','Aún debe completar todos los campos', 'error');
			}
		});
	});
</script>
<section class="content-header">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url().'citas'?>"><i class="fa fa-cogs"></i> Citas</li>
		<li class="active">Agendar Cita</li>
	</ol>   
</section>
<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<form id="form" role="form">
				<div class="box-body">
					<div class="form-group">
						<input type="hidden" id="id_usuario" name="id_usuario" value="<?php if (isset($usuario)){ echo $key->id_usuario; }?>">
							<label for="i_cedula">Cédula de Identidad</label>
						<input type="text" class="form-control popover-msj" id="i_cedula" name="i_cedula" placeholder="v00000000" maxlength="9" data-container="body" data-toggle="popover" data-placement="top" data-content="Formato: v22444555 / e99333555"> 
					</div>         
					<div class="box-footer">
						<button type="button" id="b_enviar" class="btn btn-primary">Registrar</button>
					</div>
				</div>                
			</form>
		</div>
	</div>
</section>
<section id="ajax" class="content">
</section>
