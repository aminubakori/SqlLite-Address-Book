<?php
	if(!isset($_SESSION)){
		ob_start();
		session_start();
	}
?>
<?php include_once("config/config.php"); ?>
<?php
	$dbconnect = sqlite_open(DB, 0666);
	/*Query to add addressbook table*/
	$query = "CREATE TABLE addressbook(id integer PRIMARY KEY, name text NOT NULL, email text NOT NULL, p_number text NOT NULL, address text NOT NULL)";
	$query = sqlite_exec($dbconnect,$query);
	sqlite_close($dbconnect);
	if($query) {
		echo "Done! Redirecting...";
		header("Location:".Base_Url."/home");
	}else {
		echo "Error";
	}
?>