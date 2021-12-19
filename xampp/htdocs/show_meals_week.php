<?php include_once('header.php'); ?>

<?php
	$week_id = mysqli_real_escape_string($db,$_GET["week_id"]);
	// html output
	echo '<h3>Week ' . $week_id . ' Meals</h3>';
	// SQL
	$sql = "
		SELECT * 
		FROM weeklymeals_linktable 
		JOIN meals USING (meal_id)
		WHERE week_id = '$week_id'
		ORDER BY dayofweek;";
	// get rows
	$result = mysqli_query($db, $sql);
	// got any results?
	if(mysqli_num_rows($result) == 0){
		// notify user
		echo 'No results found for week ' . $week_id;
	}else{
		echo '<div class="row">';
		// for each row
		while($row = mysqli_fetch_assoc($result)){
			$meal_data = $row;
			$dayofweek = $meal_data['dayofweek'];
			// show the meal card
			echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3">';
				echo '<b>' . $dayofweek_map[$dayofweek] . '</b>';
				include('show_meals_card.php');
			echo '</div>';
		}
		echo '</div>';
	}
?>

<?php include_once('footer.php'); ?>

