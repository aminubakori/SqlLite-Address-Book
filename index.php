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
		<title>Sqlite Address Book</title>
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
	    	<h1>Welcome</h1>
	    	<p>This is a small Sqlite Address Book written in PHP and SqlLite.</p>

	    	<a href="<?php echo Base_Url; ?>/add"><button class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Contact</button></a>

	    	<h2>All Contacts</h2>
	    	<?php
	    		if(isset($_SESSION['error'])){
	    			echo "<div class='alert alert-warning fade in'>
					        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
					        <strong>Error!</strong> ".$_SESSION['error'].".
					      </div>";
					unset($_SESSION['error']);
	    		}
	    	?>

	    	<?php
	    		if(isset($_SESSION['success'])){
	    			echo "<div class='alert alert-success fade in'>
					        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
					        <strong>Success!</strong> ".$_SESSION['success'].".
					      </div>";
					unset($_SESSION['success']);
	    		}
	    	?>
		      <table class="table">
		        <thead>
		          <tr>
		            <th>#</th>
		            <th>Name</th>
		            <th>Email</th>
		            <th>Phone Number</th>
		            <th>Address</th>
		            <th> </th>
		          </tr>
		        </thead>
		        <tbody>
		        	<?php
		        		$dbconnect = sqlite_open(DB, 0666);
		        		$query = "SELECT * FROM addressbook";
						$query = sqlite_query($dbconnect,$query);
						if(sqlite_num_rows($query) > 0){
							while($rows = sqlite_fetch_array($query, SQLITE_ASSOC)){
		        	?>
		          <tr>
		            <td><?php echo $rows['id']; ?></td>
		            <td><?php echo $rows['name']; ?></td>
		            <td><?php echo $rows['email']; ?></td>
		            <td><?php echo $rows['p_number']; ?></td>
		            <td><?php echo $rows['address']; ?></td>
		            <td>
		            	<a href="<?php echo Base_Url; ?>/edit/<?php echo $rows['id']; ?>"><button class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></button></a>

		            	<a href="<?php echo Base_Url; ?>/delete/<?php echo $rows['id']; ?>"><button class="btn btn-primary"><i class="glyphicon glyphicon-trash"></i></button></a>
		            </td>
		          </tr>
		          <?php
						}
						sqlite_close($dbconnect);
		          ?>
		        </tbody>
		      </table>
		      		<?php
						}else {
							echo "</tbody>
		      </table><p style='text-align:center;'>No contacts in address book.</p>";
						}

					?>
		</section>

	    <footer>
	    	
	    </footer>
	</body>
</html>