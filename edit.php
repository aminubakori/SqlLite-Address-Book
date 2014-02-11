<?php
	if(!isset($_SESSION)){
		ob_start();
		session_start();
	}
?>
<?php include_once("config/config.php"); ?>
<?php
	if(isset($_GET['id']) && !empty($_GET['id'])) {
		$get_id = sqlite_escape_string(trim(htmlentities($_GET['id'])));
		$dbconnect = sqlite_open(DB, 0666);
		$query = "SELECT * FROM addressbook WHERE id = '$get_id' ";
		$query = sqlite_query($dbconnect,$query);
		if(sqlite_num_rows($query) > 0){
			$rows = sqlite_fetch_array($query, SQLITE_ASSOC);
			$id = $rows['id'];
			$name = $rows['name'];
			$email = $rows['email'];
			$p_number = $rows['p_number'];
			$address = $rows['address'];
		}else {
			$_SESSION['error'] = "Unable to edit contact.";
			header("Location:".Base_Url."/home");
		}
	}else {
		$_SESSION['error'] = "Unable to edit contact.";
		header("Location:".Base_Url."/home");
	}
?>
<!doctype html>
<html>
	<head>
		<link rel="stylesheet" href="<?php echo Base_Url; ?>/css/bootstrap.css">
		<script type="text/javascript" src="<?php echo Base_Url; ?>/js/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="<?php echo Base_Url; ?>/js/bootstrap.js"></script>
		<style type="text/css">
			footer {
				margin-top: 20px;
			}
		</style>
		<link href="<?php echo Base_Url; ?>/ico/favicon.png" rel="shortcut icon">
		<title>Edit Contact - Sqlite Address Book</title>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-inverse" role="navigation">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo Base_Url; ?>/home">Sqlite Address Book</a>
				</div>
			</nav>
		</header>

		<section class="container">
	    	<a href="<?php echo Base_Url; ?>/home"><button class="btn btn-success"><i class="glyphicon glyphicon-book"></i> All Contacts</button></a>

	    	<h2>Edit Contact</h2>

	    	<?php
	    		if(isset($_SESSION['error'])){
	    			echo "<div class='alert alert-warning fade in'>
					        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
					        <strong>Error!</strong> ".$_SESSION['error'].".
					      </div>";
					unset($_SESSION['error']);
	    		}
	    	?>
	    	<form action="<?php echo Base_Url; ?>/edit_exec.php" method="post">
				<div class="form-group">
					<label for="name">Name</label>
					<input class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $name; ?>" type="text">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $email; ?>" type="text">
				</div>
				<div class="form-group">
					<label for="p_number">Phone Number</label>
					<input class="form-control" id="p_number" name="p_number" placeholder="Enter Phone Number" value="<?php echo $p_number; ?>" type="text">
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<textarea class="form-control" id="address" name="address" placeholder="Enter Address"><?php echo $address; ?></textarea>
				</div>
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<button type="submit" name="submit" class="btn btn-success btn-block">Edit</button>
	    	</form>
		</section>

	    <footer>
	    	
	    </footer>
	</body>
</html>