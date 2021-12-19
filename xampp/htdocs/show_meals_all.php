<?php include_once('header.php'); ?>

<?php
	// check for vegetarian filter
	if(isset($_GET['veg'])){
		// get filter
		$isVegetarian = mysqli_real_escape_string($db, $_GET['veg']);
	}else{
		// set default filter off -1
		$isVegetarian = -1;
	}
	// header text
	if($isVegetarian == -1){
		echo '<h3>All Meals</h3>';
	}else if($isVegetarian == 0){
		echo '<h3>Non-Vegetarian Meals</h3>';
	}else if($isVegetarian == 1){
		echo '<h3>Vegetarian Meals</h3>';
	}
	// find out how many rows are in the table
	if($isVegetarian == -1){
		$sql = "SELECT COUNT(*) FROM meals";
	}else{
		$sql = "SELECT COUNT(*) FROM meals WHERE vegetarian='$isVegetarian'";
	}
	$result = mysqli_query($db, $sql);
	$numrows = mysqli_num_rows($result);
	$r = mysqli_fetch_assoc($result);

	// number of rows in table to show per page
	$rowsperpage = 4;
	// find out total pages
	$totalpages = ceil($numrows / $rowsperpage);

	// get the current page or set a default
	if (isset($_GET['page']) && is_numeric($_GET['page'])) {
	   // cast var as int
	   $currentpage = (int) mysqli_real_escape_string($db, $_GET['page']);
	} else {
	   // default page number
	   $currentpage = 1;
	} // end if

	// if current page is greater than total pages...
	if ($currentpage > $totalpages) {
	   // set current page to last page
	   $currentpage = $totalpages;
	} // end if
	// if current page is less than first page...
	if ($currentpage < 1) {
	   // set current page to first page
	   $currentpage = 1;
	} // end if

	// the offset of the list, based on current page 
	$offset = ($currentpage - 1) * $rowsperpage;

	// get the info from the db
	if($isVegetarian == -1){
		$sql = "SELECT * FROM meals LIMIT $offset, $rowsperpage";
	}else{
		$sql = "SELECT * FROM meals WHERE vegetarian = $isVegetarian LIMIT $offset, $rowsperpage";
	}

	$result = mysqli_query($db, $sql);

	$posts = array();
	while($row = mysqli_fetch_assoc($result)){
		$posts[] = $row;
	}

	echo '<div class="row">';
	$postChunks = array_chunk($posts, 4); // 4 is used to have 4 items in a row
	foreach ($postChunks as $posts) {
		foreach ($posts as $meal_data) {
			echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3"> <!-- remember to change this so that your rows add up to 12 -->';
			include('show_meals_card.php');
			echo '</div>';
		}
	}
	echo '</div>';
?>
	
<?php 
	/******  build the pagination links ******/
	echo '<nav aria-label="Page navigation example"><ul class="pagination">';
	// range of number of links to show
	$range = 5;
	// if not on page 1, don't show back links
	if ($currentpage > 1) {
		// show << link to go back to page 1
		echo '<li class="page-item">';
	   // get previous page num
	   $prevpage = $currentpage - 1;
	}else{
		echo '<li class="page-item disabled">';
	}	// end if 
	echo '<a class="page-link" href="' . $_SERVER["PHP_SELF"] . '?page=1&veg=' . $isVegetarian . '" aria-label="Previous">';
	echo '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';

	// loop to show links to range of pages around current page
	for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
		// if it's a valid page number...
		if (($x > 0) && ($x <= $totalpages)) {
			// if we're on current page...
			if ($x == $currentpage) {
				// 'highlight' it but don't make a link
				//echo " [<b>$x</b>] ";
				echo '<li class="page-item active">';
				// if not current page...
			} else {
				// make it a link
				echo '<li class="page-item">';
			} // end else
			echo '<a class="page-link" href="' . $_SERVER["PHP_SELF"] . '?page=' . $x . '&veg=' . $isVegetarian . '">' . $x . '</a></li>';
		} // end if 
	} // end for

	// if not on last page, show forward and last page links        
	if ($currentpage != $totalpages) {
		// get next page
		$nextpage = $currentpage + 1;
		// echo forward link for last page
		echo '<li class="page-item">';
	}else{
		echo '<li class="page-item disabled">';
	} // end if
	echo '<a class="page-link" href="' . $_SERVER["PHP_SELF"] . '?page=' . $totalpages . '&veg=' . $isVegetarian . '" aria-label="Next">';
	echo '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
	echo '</ul></nav>';
	/****** end build pagination links ******/
?>
	
<?php include_once('footer.php'); ?>

