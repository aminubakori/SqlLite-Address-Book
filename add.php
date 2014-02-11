<?php
	if(!isset($_SESSION)){
		ob_start();
		session_start();
	}
?>
<?php include_once("config/config.php"); ?>
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
		<title>Add New Contact - Sqlite Address Book</title>
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

	    	<h2>Add New Contact</h2>

	    	<?php
	    		if(isset($_SESSION['error'])){
	    			echo "<div class='alert alert-warning fade in'>
					        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
					        <strong>Error!</strong> ".$_SESSION['error'].".
					      </div>";
					unset($_SESSION['error']);
	    		}
	    	?>
	    	<form action="<?php echo Base_Url; ?>/add_exec.php" method="post">
				<div class="form-group">
					<label for="name">Name</label>
					<input class="form-control" id="name" name="name" placeholder="Enter name" type="text">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input class="form-control" id="email" name="email" placeholder="Enter email" type="text">
				</div>
				<div class="form-group">
					<label for="p_number">Phone Number</label>
					<input class="form-control" id="p_number" name="p_number" placeholder="Enter Phone Number" type="text">
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<textarea class="form-control" id="address" name="address" placeholder="Enter Address"></textarea>
				</div>
				<button type="submit" name="submit" class="btn btn-success btn-block">Submit</button>
	    	</form>
		</section>

	    <footer>
	    	
	    </footer>
	</body>
</html>