<?php
	if(!isset($_SESSION)){
		ob_start();
		session_start();
	}
?>
<?php include_once("config/config.php"); ?>
<?php
	if(isset($_POST['submit']) && isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['p_number']) && !empty($_POST['p_number']) && isset($_POST['address']) && !empty($_POST['address'])) {
		$name = sqlite_escape_string(trim(htmlentities($_POST['name'])));
		$email = sqlite_escape_string(trim(htmlentities($_POST['email'])));
		$p_number = sqlite_escape_string(trim(htmlentities($_POST['p_number'])));
		$address = sqlite_escape_string(trim(htmlentities($_POST['address'])));

		$dbconnect = sqlite_open(DB, 0666);
		$query = "INSERT INTO addressbook VALUES(null, '$name', '$email', '$p_number', '$address')";
		$query = sqlite_exec($dbconnect, $query);
		sqlite_close($dbconnect);
		if($query) {
			$_SESSION['success'] = "Contact successfully added.";
			header("Location:".Base_Url."/home");
		}else {
			$_SESSION['error'] = "Unable to add contact this time.";
			header("Location:".Base_Url."/add");
		}

	}else {
		$_SESSION['error'] = "All Fields are Required.";
		header("Location:".Base_Url."/add");
	}
?>