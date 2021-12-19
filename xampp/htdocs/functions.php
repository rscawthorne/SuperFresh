
<?php
	//The functions for the system.

	//connect to database
	function db(){
		define('DB_SERVER', 'localhost');
		define('DB_USERNAME', 'freshveg');
		define('DB_PASSWORD', 'freshveg');
		define('DB_DATABASE', 'freshveg');

		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

		return $db;
	}
?>