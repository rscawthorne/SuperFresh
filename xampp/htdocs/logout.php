
<?php include_once('header.php'); ?>

<div class="row justify-content-center">
	<div class="w-25">
		<?php
			// destroy the session
			if(session_destroy()){
				// successful
			}
			// check if refreshed
			if(isset($_GET['logout'])){
				// notify user
				echo 'You have been logged out';
			}else{
				// notify user
				echo 'Refreshing...';
				// refresh the page
				header("location:logout.php?logout=1");
			}
		?>
	</div>
</div>

<?php include_once('footer.php'); ?>

