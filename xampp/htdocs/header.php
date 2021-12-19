<?php
	include_once('functions.php');
	include_once('db.php');
	include_once('session.php');
	
	// constants & variable declarations
	$dayofweek_map = array('0', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
	// navbar active states
	$navactive_home = $navactive_all = $navactive_veg = '';
	$navactive_class = 'bg-secondary text-light active';
	// check page base url
	$self_url = $_SERVER["PHP_SELF"];
?>

<!DOCTYPE html>
<html class="full" lang="en">
   
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>SuperFresh</title>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.php">SuperFresh</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<?php
			// set active class on current navbar button
			if(($self_url == '/index.php') || ($self_url == '/')){
				$navactive_home = $navactive_class;
			}else if($self_url == '/show_meals_all.php'){
				if(isset($_GET['veg'])){
					if($_GET['veg'] == -1){
						$navactive_all = $navactive_class;
					}else if($_GET['veg'] == 1){
						$navactive_veg = $navactive_class;
					}
				}else{
					$navactive_all = $navactive_class;
				}
			}
		?>
		
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav nav-pills">
				<a class="nav-link <?php echo $navactive_home; ?>" href="index.php">Home<span class="sr-only">(current)</span></a>
				<a class="nav-link <?php echo $navactive_all; ?>" href="show_meals_all.php">All Meals</a>
				<a class="nav-link <?php echo $navactive_veg; ?>" href="show_meals_all.php?veg=1">Vegetarian Meals</a>
			</ul>
			
			<form class="form-inline ml-5 mr-auto" action="show_meals_week.php" method="get">
				<input class="form-control mr-sm-2" type="search" placeholder="Week Search" aria-label="Type in Weekly Meals ID" name="week_id">
				<button class="btn btn-outline-success" type="submit">See Meals</button>
			</form>
			
			<?php include_once('admin_header.php'); ?>
			
			<ul class="navbar-nav nav-pills">
				<li class="nav-item">
					<?php
						if($sessionUsername != ''){
							//echo '<a class="nav-link ' . $navactive_class . '" href="">' . $sessionUsername . '</a>';
							echo '<a class="nav-link" href="">' . $sessionUsername . '</a>';
							echo '</li>';
							echo '<span class="border-left border-secondary"></span>';
							echo '<li class="nav-item">';
							echo '<a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a>';
						}else{
							echo '<a class="nav-link" href="login.php"><span class="glyphicon glyphicon-log-in"></span>Login</a>';
						}
					?>
				</li>
			</ul>
		</div>
	</nav>
	
	<div class="row justify-content-center">
		<div class="col-12 col-lg-10">
	
	