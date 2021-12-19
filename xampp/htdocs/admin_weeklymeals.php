
<?php include_once('header.php'); ?>

<?php
	// check current action
	if(isset($_GET['action'])){
		// get action
		$action = mysqli_real_escape_string($db, $_GET['action']);
		// check action type
		if($action == 'delete_weeklymeals'){
			// get weeklymeals_id
			$weeklymeals_id = mysqli_real_escape_string($db, $_GET['weeklymeals_id']);
			// sql to delete a record
			$sql = "DELETE FROM weeklymeals_linktable WHERE weeklymeals_id='$weeklymeals_id'";
			if ($db->query($sql) === TRUE) {
				echo "Record deleted successfully";
			} else {
				echo "Error deleting record: " . $db->error;
			}
		}else if($action == 'insert_weeklymeals'){
			// get parameters
			$week_id = mysqli_real_escape_string($db, $_GET['week_id']);
			$dayofweek = mysqli_real_escape_string($db, $_GET['dayofweek']);
			$meal_id = mysqli_real_escape_string($db, $_GET['meal_id']);
			//SQL Query
			$sql = "INSERT INTO weeklymeals_linktable (week_id, dayofweek, meal_id) VALUES ('$week_id','$dayofweek', '$meal_id')";
			if ($db->query($sql) === TRUE) {
				echo "Record created successfully <br>";
			} else {
				echo "Error updating record: " . $db->error;
			}
		}
	}
?>

<div class="row justify-content-center">
	<div class="col-6">
		<h1>Create a new weekly meal</h1>
		<form class="w-75" action="admin_weeklymeals.php" method="get">
			<input type="hidden" name="action" value="insert_weeklymeals">
			<div class="form-group row">
				<label class="col-4 col-form-label">Week</label>
				<input class="col-8 form-control" type="number" min="0" id="inputWeek" name="week_id" placeholder="Week" required >
			</div>
			<div class="form-group row">
				<label  class="col-4 col-form-label">Day</label>
				<select class="col-8 form-control" id="selectDay" name="dayofweek" required>
					<option value="1">Monday</option>
					<option value="2">Tuesday</option>
					<option value="3">Wednesday</option>
					<option value="4">Thursday</option>
					<option value="5">Friday</option>
					<option value="6">Saturday</option>
					<option value="7">Sunday</option>
				</select>
			</div>
			<div class="form-group row">
				<label class="col-4 col-form-label">Meal ID</label>
				<input class="col-8 form-control" type="number" min="0" id="inputMeal" name="meal_id" placeholder="Meal" required >
			</div>
			<div class="form-group row justify-content-center"><div class="col-9">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Create Weekly Meal</button>
			</div></div>
		</form>
		
		<div class="card mb-3">
			<div class="card-header">
				Available Meals
			</div>
			<div class="card-body">
				<p class="card-text">
					Create a new weekly meal. View or delete existing weekly meals.
				</p>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Meal</th>
						</tr>
					</thead>
					<tbody>
						<?php
							// get a list of meals
							$sql = "SELECT * FROM meals";
							$meals = mysqli_query($db,$sql);
							// show meals
							foreach ($meals as $meal_data){
								echo '<tr>';
									echo '<th scope="row">' . $meal_data['meal_id'] . '</th>';
									echo '<td>' . $meal_data['meal_name'] . '</td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-6">
		<div class="card">
			<div class="card-header">
				Previous Weekly Meals
			</div>
			<div class="card-body">
				<table class="table card-text">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Week</th>
							<th scope="col">Day</th>
							<th scope="col">Meal</th>
							<th scope="col">Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
							// get previous weekly meals
							$sql = "
								SELECT * 
								FROM weeklymeals_linktable 
								JOIN meals USING (meal_id)
								ORDER BY week_id DESC, dayofweek DESC LIMIT 28";
							$result = mysqli_query($db,$sql);
							// output each row
							while($row = mysqli_fetch_assoc($result)){
								// for each table row
								echo '<tr>';
									echo '<th scope="row">' . $row["weeklymeals_id"] . '</th>';
									echo '<td>' . $row["week_id"] . '</td>';
									echo '<td>' . $dayofweek_map[$row["dayofweek"]] . '</td>';
									echo '<td>' . $row["meal_name"] . '</td>';
									echo '<td><a href="\admin_weeklymeals.php?action=delete_weeklymeals&weeklymeals_id=' . $row['weeklymeals_id'] . '"><button type="button" class="btn btn-danger">Delete</button></a></td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include_once('footer.php'); ?>
