<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $this->layout->getTitle(); ?></title>
		<meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>">
		<meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
		<link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/favicon.png" type="image/x-icon"/>

		<!-- BOOTSTRAP CSS -->
		<link href="<?php echo base_url(); ?>public/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>public/libs/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>public/libs/bootstrap/css/admin.css" rel="stylesheet" type="text/css" />

		<!-- INDIVIDUALES CSS -->
		<link href="<?php echo base_url(); ?>public/css/config-master.css" rel="stylesheet" type="text/css" />


		<!-- INDIVIDUALES JS -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/js/helper.js"></script>

		<!-- BOOTSTRAP JS -->
		<script src="<?php echo base_url(); ?>public/libs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    

		<!--  AUXILIARES CODEIGNITER -->
		<?php echo $this->layout->css; ?> 
		<?php echo $this->layout->js; ?> 
		<script type="text/javascript">
			$(function() {
				$('.popover-msj').popover({ trigger: 'focus'});
			});
		</script>
	</head>
	<body class="bg-sesion">
		<?php echo $content_for_layout; ?>
	</body>
		
  
</html>