
<ul class="navbar-nav nav-pills">

<?php
	// navbar active states
	$navactive_admin = $navactive_weeklymeal = $navactive_newuser = '';
	
	// check page base url
	$isAdminPage = true;
	if($self_url == '/admin.php'){
		$navactive_admin = $navactive_class;
	}else if($self_url == '/admin_weeklymeals.php'){
		$navactive_weeklymeal = $navactive_class;
	}else if($self_url == '/admin_users.php'){
		$navactive_newuser = $navactive_class;
	}else{
		$isAdminPage = false;
	}
	
	// check admin-menu access
	if($sessionLevel >= 1){
		echo '<span class="border-left border-secondary"></span>';
		echo '<a class="nav-link ' . $navactive_admin . '" href="admin.php">Admin Home</a>';
		echo '<a class="nav-link ' . $navactive_weeklymeal . '" href="admin_weeklymeals.php">Add Weekly Meal</a>';
		echo '<a class="nav-link ' . $navactive_newuser . '" href="admin_users.php">Add New User</a>';
		echo '<a class="nav-link " href="phpmyadmin/db_structure.php?db=' . DB_DATABASE . '">phpMyAdmin</a>';
		echo '<span class="border-left border-secondary"></span>';
	}
	
	// --------VERY IMPORTANT!---------
	// check page is admin-page and user-level is admin
	if($isAdminPage && ($sessionLevel <= 0)){
		echo '</ul></div></nav><div class="row"><div class="col-12 w-25">';
		echo 'Error: Unauthorized user.';
		include_once('footer.php');
		// halt output and processing of html and php
		die();
	}
?>

</ul>
