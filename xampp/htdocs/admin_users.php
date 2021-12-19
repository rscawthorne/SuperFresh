
<?php include_once('header.php'); ?>

<?php
	// check current action
	if(isset($_POST['action']) || isset($_GET['action'])){
		// get action
		if(isset($_POST['action'])){
			$action = mysqli_real_escape_string($db, $_POST['action']);
		}else{
			$action = mysqli_real_escape_string($db, $_GET['action']);
		}
		//echo $action . '<br>';
		// check action type
		if($action == 'delete_users'){
			// get user_id
			if(isset($_GET['user_id'])){
				$user_id = mysqli_real_escape_string($db, $_GET['user_id']);
				// sql to delete a record
				$sql = "DELETE FROM users WHERE user_id='$user_id';";
				//echo $sql;
				if ($db->query($sql) === TRUE) {
					echo "User deleted successfully. <br>";
				} else {
					echo "Error: " . $db->error;
				}
			}else{
				echo 'Error: user_id not set.';
			}
		}else if($action == 'insert_users'){
			// username and password sent from form 
			$myusername = mysqli_real_escape_string($db,$_POST['username']);
			$mypassword = mysqli_real_escape_string($db,$_POST['password']);
			$mypassword2 = mysqli_real_escape_string($db,$_POST['password2']);
			$mylvl = mysqli_real_escape_string($db,$_POST['level']); 
			
			// SQL find user record
			$sql = "SELECT * FROM users WHERE username='$myusername';";
			$result = mysqli_query($db,$sql);
			// Count the returned rows, 1 would mean username was found
			$count = mysqli_num_rows($result);
			// check username
			if($count >= 1){
				echo "Error: Username already exists. <br>";
			}else{
				// Cryptography
				$key = "25c6c7ff35b9979b151f2136cd13b0ff";
				$cipher = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
				$ivlen = openssl_cipher_iv_length($cipher);
				$iv = openssl_random_pseudo_bytes($ivlen);
				//To Encrypt
				error_reporting(E_ERROR);
				$encryptedPassword = openssl_encrypt($mypassword, $cipher, $key);//, $options=0, $iv);
				error_reporting(E_ALL);
				// confirm password match
				if($mypassword == $mypassword2){
					//SQL Query
					$sql ="INSERT INTO users (username, password, level) VALUES ('$myusername','$encryptedPassword', '$mylvl')";
					if ($db->query($sql) === TRUE) {
						echo "New User created successfully. <br>";
					} else {
						echo "Error: " . $db->error;
					}
				}else{
					echo "Error: Passwords don't match. <br>";
				}
			}
		}
	}
?>

<div class="row justify-content-center">
	<div class="col-4">
		<h1>Create a new user</h1>
		<form class="w-75" action="admin_users.php" method="post">
			<input type="hidden" name="action" value="insert_users">
			<div class="form-group row">
				<label class="col-6 col-form-label">Username</label>
				<input class="col-6 form-control" type="text" name="username" placeholder="Username" required autofocus>
			</div>
			<div class="form-group row">
				<label class="col-6 col-form-label">Password</label>
				<input class="col-6 form-control" type="password" name="password" placeholder="Password" required>
			</div>
			<div class="form-group row">
				<label class="col-6 col-form-label">Confirm Password</label>
				<input class="col-6 form-control" type="password" name="password2" placeholder="Repeat Password" required>
			</div>
			<div class="form-group row">
				<label class="col-6 col-form-label">Level</label>
				<input class="col-6 form-control" type="number" min="0" value="0" name="level" placeholder="Access Level" required>
			</div>
			<div class="form-group row justify-content-center"><div class="col-9">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Create User</button>
			</div></div>
		</form>
	</div>

	<div class="col-8">
		<h4>Existing Users:</h4>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Username</th>
					<th scope="col">Password</th>
					<th scope="col">Level</th>
					<th scope="col">SessionKey</th>
					<th scope="col">Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
					// get previous weekly meals
					$sql = "SELECT * FROM users ORDER BY username";
					$result = mysqli_query($db,$sql);
					// output each row
					while($row = mysqli_fetch_assoc($result)){
						$user_id = $row["user_id"];
						// for each table row
						echo '<tr>';
							echo '<th scope="row">' . $user_id . '</th>';
							echo '<td>' . $row["username"] . '</td>';
							echo '<td>' . $row["password"] . '</td>';
							echo '<td>' . $row["level"] . '</td>';
							echo '<td>' . $row["sessionkey"] . '</td>';
							echo '<td><a href="\admin_users.php?action=delete_users&user_id=' . $user_id . '"><button type="button" class="btn btn-danger">Delete</button></a></td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<?php include_once('footer.php'); ?>