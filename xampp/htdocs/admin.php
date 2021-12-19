
<?php include_once('header.php'); ?>

<div class="row justify-content-center">
	<div class="col-6">
		<h1>Admin Main Menu</h1>
		<h4>Welcome <?php echo $sessionUsername; ?></h4>
		
		<div class="card mb-3">
			<div class="card-header">
				Add Weekly Meal
			</div>
			<div class="card-body">
				<p class="card-text">Create a new weekly meal. View or delete existing weekly meals.</p>
				<a href="admin_weeklymeals.php" class="btn btn-primary">Add Weekly Meal</a>
			</div>
		</div>
		
		<div class="card mb-3">
			<div class="card-header">
				Add New User
			</div>
			<div class="card-body">
				<p class="card-text">Create a new user. View or delete existing users.</p>
				<a href="admin_users.php" class="btn btn-primary">Add New User</a>
			</div>
		</div>
		
		<div class="card mb-3">
			<div class="card-header">
				phpMyAdmin
			</div>
			<div class="card-body">
				<p class="card-text">Manage the database using using the third-party tool: phpMyAdmin.</p>
				<a href="phpmyadmin/db_structure.php?db=<?php echo DB_DATABASE ?>" class="btn btn-primary">phpMyAdmin</a>
			</div>
		</div>
		
	</div>
</div>

<?php include_once('footer.php'); ?>
