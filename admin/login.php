<?php 
	include '../lib/Session.php';
	Session::checkLogin();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>

<?php
	
	$db = new Database();
	//$fm = new Format();

	$post_table = "tbl_post";
	$cat_table = "tbl_category";
	$user_table = "tbl_user";
	$title_slogan = "tbl_title_slogan";

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		
		<?php

			if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				
				$username = Format::validation( $_POST['username'] );
				$password = Format::validation( md5( $_POST['password'] ) );

				$username = mysqli_real_escape_string( $db->link, $username );
				$password = mysqli_real_escape_string( $db->link, $password );

				$query = "SELECT * FROM {$user_table} WHERE username = '$username' AND password = '$password'";

				$result = $db->select( $query );
				
				if( $result != false ) {
					//$value = mysqli_fetch_array( $result );
					$value = $result->fetch_assoc();
					Session::set( "login", true );
					Session::set( "username", $value['username'] );
					Session::set( "userid", $value['id'] );
					Session::set( "userrole", $value['role'] );
					header( "Location: index.php" );

				// if( $result != false ) End here...
				} else {
					echo "<span class='error'>UserName And Password Not Matched !! </span>";
				}

			// if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
			}

		?>

		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgotpass.php">Forgot Password?</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>