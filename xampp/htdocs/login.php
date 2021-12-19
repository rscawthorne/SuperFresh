<?php include_once('header.php'); ?>

<div class="row justify-content-center">
	<div class="w-25">
		<?php
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$myusername = mysqli_real_escape_string($db,$_POST['username']);
				$mypassword = mysqli_real_escape_string($db,$_POST['password']);
				// SQL find user record
				$sql = "SELECT * FROM users WHERE username='$myusername';";
				$result = mysqli_query($db,$sql);
				// Count the returned rows, 1 would mean username was found
				$count = mysqli_num_rows($result);
				// Get row
				$row = mysqli_fetch_assoc($result);
				$level = $row['level'];
				
				// Cryptography
				$key = "25c6c7ff35b9979b151f2136cd13b0ff";
				$cipher = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
				//$ivlen = openssl_cipher_iv_length($cipher);
				//$iv = openssl_random_pseudo_bytes($ivlen);
				// Decrypt the password
				$encryptedPassword = $row['password'];
				$decryptedPassword = openssl_decrypt($encryptedPassword, $cipher, $key);//, $options=0, $iv);
				//check username and password are correct
				if(($count == 1) && ($mypassword == $decryptedPassword)){
					$_SESSION['login_user'] = $myusername;
					// create a session-key
					$sessionKey = $myusername . microtime();
					//To Encrypt
					$ivlen = openssl_cipher_iv_length($cipher);
					$iv = openssl_random_pseudo_bytes($ivlen);
					$sessionKey = openssl_encrypt($sessionKey, $cipher, $key, $options=0, $iv);
					// store session-key
					$_SESSION['login_key'] = $sessionKey;
					$sql = "UPDATE users SET sessionkey='$sessionKey' WHERE username = '$myusername';";
					$result = mysqli_query($db,$sql) or die("Error: " . mysqli_error($db));
					//
					echo 'Login Successful.';// die();
					// check if admin
					if($level == 1){
						// redirect to admin page
						header("location: admin.php");
					}else{
						// redirect to homepage
						header("location: index.php");
					}
				}else{
					// not logged in
					echo 'Incorrect username or password';
					// go back and try again
					//header("location: login.php");
				}
			}
		?>
		
		<h1 class="login-title">User Login</h1>
		<div class="account-wall">
			<form class="form-signin" action = "" method = "post">
			<div class="form-group row">
				<label class="col-6 col-form-label">Username</label>
				<input type="text" name = "username" class="form-control" placeholder="Username" required autofocus>
			</div>
			<div class="form-group row">
				<label class="col-6 col-form-label">Password</label>
				<input type="password" name = "password" class="form-control" placeholder="Password" required>
			</div>
			<div class="form-group row">
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
		</div>
	</div>
</div>

<?php include_once('footer.php'); ?>

