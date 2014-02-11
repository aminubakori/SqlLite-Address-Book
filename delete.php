<?php
	if(!isset($_SESSION)){
		ob_start();
		session_start();
	}
?>
<?php include_once("config/config.php"); ?>
<?php
	if(isset($_GET['id']) && !empty($_GET['id'])) {
		$id = sqlite_escape_string(trim(htmlentities($_GET['id'])));

		$dbconnect = sqlite_open(DB, 0666);
		$query = "DELETE FROM addressbook WHERE id = '$id' ";
		$query = sqlite_exec($dbconnect, $query);
		sqlite_close($dbconnect);
		if($query) {
			$_SESSION['success'] = "Contact successfully deleted.";
			header("Location:".Base_Url."/home");
		}else {
			$_SESSION['error'] = "Unable to delete contact this time.";
			header("Location:".Base_Url."/home");
		}

	}else {
		$_SESSION['error'] = "Unable to delete contact this time.";
		header("Location:".Base_Url."/home");
	}
?>