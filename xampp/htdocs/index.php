
<?php include_once('header.php'); ?>
	
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
	<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
	<div class="carousel-item active">
	  <img class="d-block w-100" src="images\carousel\cowsgrazing2.jpg">
	  <div class="carousel-caption d-none d-md-block">
		<h5>Cows</h5>
		<p>Fresh milk daily</p>
	  </div>
	</div>
	<div class="carousel-item">
	  <img class="d-block w-100" src="images\carousel\farmproduce.jpg">
	  <div class="carousel-caption d-none d-md-block">
		<h5>Farm</h5>
		<p>Fresh produce</p>
	  </div>
	</div>
	<div class="carousel-item">
	  <img class="d-block w-100" src="images\carousel\foodtable.jpg">
	  <div class="carousel-caption d-none d-md-block">
		<h5>Fresh food</h5>
		<p>Healthy eating</p>
	  </div>
	</div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	<span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	<span class="sr-only">Next</span>
  </a>
</div>

<?php include_once('show_meals_all.php'); ?>

<?php include_once('footer.php'); ?>