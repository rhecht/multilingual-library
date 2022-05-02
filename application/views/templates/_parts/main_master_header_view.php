<!DOCTYPE html>
<html <?php if($this->languageCode == 'he'):?>dir="rtl" lang="ar"<?php else:?>lang="en"<?php endif;?>>
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
    
    <base href=<?php echo $this->config->item('base_url') ?> />
	
	<title><?php echo lang('Tekhelet');?></title>
	
	<!-- BEGIN CORE FRAMEWORK -->
	
	<?php if($this->languageCode == 'he'): // use bootstrap RTL?>
	<link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.0.0/css/bootstrap.min.css" integrity="sha384-P4uhUIGk/q1gaD/NdgkBIl3a6QywJjlsFJFk7SPRdruoGddvRVSwv5qFnvZ73cpz" crossorigin="anonymous">
	<?php else:?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<?php endif;?>

	<link href="<?php echo $this->config->item('admin_theme') ?>/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="<?php echo $this->config->item('admin_theme') ?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<!-- END CORE FRAMEWORK -->
	
	
	<!-- BEGIN THEME STYLES -->
	<link href="<?php echo $this->config->item('admin_theme') ?>/css/material.css" rel="stylesheet" />
	<link href="<?php echo $this->config->item('admin_theme') ?>/css/style.css" rel="stylesheet" />
	<link href="<?php echo $this->config->item('admin_theme') ?>/css/plugins.css" rel="stylesheet" />
	<link href="<?php echo $this->config->item('admin_theme') ?>/css/helpers.css" rel="stylesheet" />
	<link href="<?php echo $this->config->item('admin_theme') ?>/css/responsive.css" rel="stylesheet" />
	<!-- END THEME STYLES -->

	<!-- DATATABLES -->
	<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>	-->
	<script src="<?php echo $this->config->item('admin_theme') ?>/plugins/jquery-1.11.1.min.js" type="text/javascript"></script>

	<script>
		var baseUrl = '<?php echo base_url();?>';
		var baseAdminUrl = '<?php echo site_url('admin');?>';
	</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="<?php echo $body_class;?>">