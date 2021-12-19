
<?php
	// $meal_data provided by caller
	$meal_id = $meal_data['meal_id'];
	$meal_name = $meal_data['meal_name'];
	$meal_image = $meal_data['img_filename'];
	$description = $meal_data['description'];
	// meal description not to exceed 200 characters
	$description_maxlength = 200;
	if (strlen($description) > $description_maxlength){
		$description = substr($description, 0, $description_maxlength-3) . '...';
	}
	// link to the meal page
	$meal_href = 'href="show_meal.php?meal=' . $meal_id . '"';
	// html output
	echo '<div class="card bg-light border-secondary mb-3">';
		echo '<div class="card-body text-center">';
			echo '<a ' . $meal_href . '><img class="card-img-top img-fluid mb-3 rounded" src="images/meals/' . $meal_image . '"></a>';
			echo '<a ' . $meal_href . '><h5 class="card-title">' . $meal_name . '</h5></a>';
			echo '<p class="card-text text-justify">' . $description . '</p>';
		echo '</div>';
	echo '</div>';
?>

