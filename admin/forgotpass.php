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
<title>Recover Password</title>
	<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		
		<?php

			if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				
				if( empty( $_POST['email'] ) ) {
					echo "<span class='error'>Field Must Not Be Empty !! </span>";
				// if( empty( $_POST['email'] ) ) End here...
				} else {
					
					if( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) {
						echo "<span class='error'>Email Not Valid !! </span>";
					// if( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) End here...
					} else {

						$email = mysqli_real_escape_string( $db->link, Format::validation( $_POST['email'] ) );
						$query = "SELECT * FROM {$user_table} WHERE email = '{$email}' LIMIT 1";

						$mailcheck = $db->select( $query );
						
						if( $mailcheck != false ) {
							
							while( $value = $mailcheck->fetch_assoc() ) {
								$userid = $value['id'];
								$username = $value['username'];
							}

							$text		= substr( $username, 0, 3 );
							$rand 		= rand( 10000, 99999 );
							$newpass 	= "{$text}{$rand}";
							//echo "NewPass = " . $newpass;
							$password 	= md5( $newpass );
							$update_query = "UPDATE {$user_table}
											SET
											password = '{$password}'
											WHERE id = '{$userid}'";

							$updated_row = $db->update( $update_query );

							if( $updated_row ) {
								$to = "{$email}";
								$from = "dark-room.dev@mail.com";
								$subject = "Your New Password";
								$message = "Your Username is " . $username . " And Password is " . $newpass;
								$headers = "From: {$from}\n";
								$headers .= 'MIME-Version 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$send_mail = mail( $to, $subject, $message, $headers );
								
								if( $send_mail ) {
									echo "<span class='success'>Please Check Your Email For New Password !! </span>";
								} else {
									echo "<span class='error'>Mail Couldn't Be Send !! </span>";
								}

							} else {
								echo "<span class='error'>Ooops !! Somthing Went Wrong !! </span>";
							}

						// if( $mailcheck != false ) End here...
						} else {
							echo "<span class='error'>Email Not Exists !! Register Here. </span>";
						}

					}

				}

			// if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
			}

		?>

		<form action="" method="post">
			<h1>Recover Password</h1>
			<div>
				<input type="text" placeholder="Enter Your Valid Email Address" required="" name="email"/>
			</div>
			<div>
				<input type="submit" name="send_mail" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Forgot Password?</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>