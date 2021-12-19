
<?php
	include_once('db.php');
	
	// initialize variables
	$sessionUsername = '';
	$sessionLevel = 0;
	// load the cookie
	session_start();
	// check if there exists a session cookie
	if(isset($_SESSION['login_user'])){
		$sessionUsername = mysqli_real_escape_string($db,$_SESSION['login_user']);
		$sessionKey = mysqli_real_escape_string($db,$_SESSION['login_key']);
		// check for matching username and sessionkey
		$query = "select * from users where username='$sessionUsername' AND sessionkey='$sessionKey';";
		$result = mysqli_query($db,$query) or die("Error: " . mysqli_error($db));
		// Count the returned rows, 1 would mean username and session-key was found
		if(mysqli_num_rows($result)){
			// count is non-zero
			$row = mysqli_fetch_assoc($result);
			// read admin-level from database
			$sessionLevel = $row['level'];
		}else{
			// invalid cookie username and/or sessionkey
			echo 'Invalid session';
			// destroy cookie
			session_destroy();
			// reload the cookie
			session_start();
		}
	}
?>
