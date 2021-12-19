<?php include_once('header.php'); ?>

	<?php
		$meal = mysqli_real_escape_string($db,$_GET['meal']);
		$sql = "SELECT * FROM meals WHERE meal_id = '$meal'";
		$result = mysqli_query($db, $sql);
		$data = mysqli_fetch_assoc($result);
		$isVegetarian = $data["vegetarian"] ? "Yes" : "No";
		$allergies = $data["allergies"];
	?>
	<div class="row col-12">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<?php
					echo "<h3>" . $data["meal_name"] . "</h3>";
					?>
				</div>
				<div class="card-body">
					<?php
					echo "<p>" . $data["description"] . "</p>";
					echo "Vegetarian: " . $isVegetarian . "<br>";
					if($allergies){echo "Allergies: " . $allergies . "<br>";}
					echo "Cooking Time: " . $data["cook_time"] . "<br><br>";
					
					echo '<h4>Ingredients</h4><p style="white-space: pre-wrap;">' . $data["ingredients"] . '</p>';
					?>
				</div>
			</div>
		</div>
		
		<div class="col-6">
			<div class="card">
				<div class="card-body">
					<?php
					echo '<img class="img-fluid rounded" src="images/meals/' . $data['img_filename'] . '">';
					?>
				</div>
			</div>
		</div>
	</div>
	<br/>
	<div class="row col-12">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<?php
					echo '<h4>Cooking Instructions</h4><p>' . $data["instructions"] . '</p><br>';
					?>
				</div>
			</div>
		</div>
	</div>

<?php include_once('footer.php'); ?>

