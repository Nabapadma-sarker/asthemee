<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Aspiring Solicitors | Home</title>
	<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css" rel="stylesheet">
    <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/responsive.css" rel="stylesheet">
	<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
  <header>
   <div class="row">
   <div class="user_data1">
	    <div class="user_name1">
		  <span class="uname1">Hello John :</span> 
          <span class="profile1">My Profile<span>
		</div>
		<div class="user_percentage1">
		  60%
		</div>
	  </div>
   </div>
   <div class="container">
     <div class="row hedear_top">
	  <div class="logo">
		 <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		  <?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) {?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="logo" />
			<?php
			} 
		  else { ?><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="logo" /> <?php } ?>
		</a>
	  </div>
	  <div class="user_data">
	    <div class="user_name">
		  <span class="uname">Hello John</span> 
          <span class="profile">My Profile<span>
		</div>
		<div class="user_percentage">
		  60%
		</div>
	  </div>
	 </div>
	 <div class="row">
	   	<nav class="navbar navbar-default">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			 <div class="main_menu"> 
			  <?php wp_nav_menu( array('theme_location'  => 'header_menu', 'items_wrap'   => '<ul class="nav navbar-nav">%3$s</ul>', 'container' => '')); ?>
            <form class="navbar-form navbar-right" action="" id="searchform" method="get">
				 <fieldset>									 
					 <img id="searchformswitch" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/search-left.png" />
					 <input type="search" id="s" name="s"/>
					 <input type="image" id="searchsubmit" alt="Search" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/search-right.png" />
				 </fieldset>
			</form>
			</div><!-- /.navbar-collapse -->
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	  </div>
	</div>
  </header>
  
    <div class="header_bottom">
    <div class="container">
     <div class="row">
	   <div class="login-form-container"> 
	   <div class="reg">Register NOW or Login:</div>
	   <form method="post" action="<?php echo wp_login_url(); ?>">
				<p class="login-username">
					<input type="text" name="log" id="user_login" placeholder="Username">
				</p>
				<p class="login-password">
					<input type="password" name="pwd" id="user_pass" placeholder="Password">
				</p>
				<p class="login-submit">
					<input type="submit" value="GO">
				</p>
			</form>
		</div> 
		<div class="clearfy"></div>
	  </div>
	</div>
  </div>