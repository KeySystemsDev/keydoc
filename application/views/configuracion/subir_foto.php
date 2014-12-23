
<?php if($large_photo_exists && $thumb_photo_exists == NULL):?>
	<script src="<?php echo base_url();?>public/libs/bootstrap/js/plugins/fileinput/jquery.imgpreview.js" type="text/javascript"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(":file").filestyle({disabled: true});
		});
		var thumb_width    = <?php echo $thumb_width ;?> ;
		var thumb_height   = <?php echo $thumb_height ;?> ;
		var image_width    = <?php echo $img['image_width'] ;?> ;
		var image_height   = <?php echo $img['image_height'] ;?> ;  
	</script>
<?php endif ;?>

<section class="content">
	<?php if($error) :?>
		<ul>
			<li><strong>Error uploading an Image!</strong></li>
			<li><?php echo $error ;?></li>
		</ul>
	<?php endif ;?>

	<?php if($large_photo_exists && $thumb_photo_exists) :?>                                 
		<div class="col-md-4 col-md-push-4">
			<div class="bod-body">
				<div class="box-header">
					<i class="fa fa-fire pull-left"></i>
					<h5 class="box-title">Su nueva foto de Perfil ha sido actualizada.</h5>
				</div>
				<div class="thumbnail">
					<?php echo $thumb_photo_exists; ?>
					<!--<p><a href="<?php echo base_url().'configuracion/foto';?>">Add another</a></p>-->
				</div> 
				<div class="form-group" align="center">
					<div class="btn-group">
						<a href="<?php echo base_url();?>configuracion/perfil" class="btn btn-info">Ver Perfil</a>
						<a href="<?php echo base_url();?>configuracion/perfil" class="btn btn-info">
							<span class="fa fa-arrow-right"></span>
						</a>
					</div>
				</div> 
			</div>    
		</div>

	<?php elseif($large_photo_exists && $thumb_photo_exists == NULL) :?>
	
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3" style="margin: 10px 0px;">
						<div class="form-group" align="center">
							<form name="thumbnail" action="<?php echo base_url().'configuracion/foto';?>" method="post">
								<input type="hidden" name="x1" value="" id="x1" />
								<input type="hidden" name="y1" value="" id="y1" />
								<input type="hidden" name="x2" value="" id="x2" />
								<input type="hidden" name="y2" value="" id="y2" />
								<input type="hidden" name="file_name" value="<?php echo $img['file_name'] ;?>" /> 
								<input type="submit" name="upload_thumbnail" class="btn btn-primary col-md-8" value="Recortar Imagen" id="save_thumb"/>               
							</form> 
						</div>        
					</div>
					<div class="col-md-12">
						<img src="<?php echo base_url() . $upload_path.$img['file_name'];?>" class="thumbnail" style="float: left; margin-right: 10px;" id="thumbnail"/>
						<div class="thumb" style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
							<img src="<?php echo base_url() . $upload_path.$img['file_name'];?>" style="position: relative;" alt="Thumbnail Preview" />
						</div> 
																			
					</div>
				</div>             
			</div>
		</div>    

	<?php   else : ?>
	<div class="col-md-4 col-md-push-4">
		<div class="bod-body">
			<div class="thumbnail">                
				<img src="<? echo base_url().'public/img/upload.png'?>" width="100%" class="img-responsive">
			</div>      
			<form name="photo" enctype="multipart/form-data" action="<?php echo base_url().'configuracion/foto';?>" method="post">
				<div class="form-group">
					<input type="file" class="filestyle" data-buttonBefore="true" name="image">
				</div>
				<div class="form-group" align="center">
					<input type="submit" name="upload" class="btn btn-primary col-md-12" value="Subir Imagen"/>
				</div>                  
			</form>   
		</div>    
	</div>
	
	
	<?php   endif ?> 
</section>
