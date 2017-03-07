<?php 
  setlocale(LC_ALL,"es_ES");
?>

<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<html lang="en">

<head>
  	<meta charset="utf-8">
    <title>LOGIA</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>img/apple-touch-icon-144x144-precomposed.png">
    
    <!-- REVOLUTION BANNER CSS SETTINGS -->
	<!--<link href="rs-plugin/css/settings.css" media="screen" rel="stylesheet">-->
    
    <!-- CSS -->
    <link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet">
    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
    <!--<link href="css/superfish.css" rel="stylesheet">-->
    <!--<link href="css/style.css" rel="stylesheet">-->
    <!--<link href="fontello/css/fontello.css" rel="stylesheet">-->
       
    <!--[if lt IE 9]>
      <script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <?php wp_enqueue_script("jquery");?>
    <?php wp_head();?>

  </head>
  
  <body>
  <header>
  	<div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-3">
			<a href="index.html" id="logo">LOGIA</a>
		</div>
		<div class="col-md-9 col-sm-9 col-xs-9">
			<div class=" pull-right"><a href="https://actividades-thrashgo.c9users.io/aplicacion/index.php" class="button_top" id="login_top">Inicia sesion</a></div>
            <ul id="top_nav" class="hidden-xs">
                <li><a href="about_us.html">Sobre Nosotros</a></li>
                <li><a href="apply.html">Wizard Apply</a></li>
                <li><a href="register.html">Registro</a></li>
            </ul>
		</div>
	</div>
</div>
</header><!-- End header -->