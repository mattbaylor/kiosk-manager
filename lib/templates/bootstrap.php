<?php 
$navHidden=''; 
if(!checkUser($_COOKIE['username'])){
	$navHidden = 'hidden';
} else {
 	$role = checkUser($_COOKIE['username']);	
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/assets/ico/favicon.ico">

    <title>Kiosk Controller for KioskPro 4.*</title>

    <!-- Le styles -->
            <link href="/css/bootstrap.min.css" rel="stylesheet">
            <link type="text/css" href="/css/custom-theme/jquery-ui-1.10.0.custom.css" rel="stylesheet" />
            <link type="text/css" href="/assets/css/font-awesome.min.css" rel="stylesheet" />
            <!--[if IE 7]>
            <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css">
            <![endif]-->
            <!--[if lt IE 9]>
            <link rel="stylesheet" type="text/css" href="css/custom-theme/jquery.ui.1.10.0.ie.css"/>
            <![endif]-->
            <!--<link href="/assets/css/docs.css" rel="stylesheet">-->
            <link href="/assets/js/google-code-prettify/prettify.css" rel="stylesheet">

            <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->

            <!-- Le fav and touch icons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
            <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
            <link rel="shortcut icon" href="/assets/ico/favicon.png">
	<style>
		.form-horizontal .control-label{padding-top:0;}	
		label{margin-bottom:0;}	
	</style>
  </head>

  <body data-spy="scroll" data-target=".bs-docs-sidebar" data-twttr-rendered="true">

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top <?php echo($navHidden); ?>" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="kioskcontroller">Kiosk Controller</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav" id="nav">
            <li><a href="kioskcontroller">Home</a></li>
<?php 
	$ret = '';
	if(is_numeric(strpos($role,'s'))){
		$ret .= '<li><a href="kioskcontroller?page=kioskSettings">Manage Applications on Kiosks</a></li>';
	}
	if(is_numeric(strpos($role,'k'))){
		$ret .= '<li><a href="kioskcontroller?page=kiosks">Manage Kiosks</a></li>';	
	}
	if(is_numeric(strpos($role,'p'))){
		$ret .= '<li><a href="kioskcontroller?page=applications">Manage Applications</a></li>';	
	}
	if(is_numeric(strpos($role,'d'))){
		$ret .= '<li><a href="kioskcontroller?page=schedules">Manage Recurring Schedules</a></li>';	
	}
	if(is_numeric(strpos($role,'u'))){
		$ret .= '<li><a href="kioskcontroller?page=users">Manage Users</a></li>';	
	}
	echo($ret);
?> 
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="kioskcontroller?page=logout">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="js/timepicker.js"></script>
    <script src="js/nav.js"></script>
    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <?php echo $__payload; ?>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>