<?php include 'inc/header.php'; ?>
<?php

	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		$firstname = $lastname = $email = $body = "";
		$error = array();
		//$msg = "";

		if( empty( $_POST['firstname'] ) ) {
			Format::setErrors( "errfname", "FirstName Must Not Be Empty !!" );
		// if( empty( $_POST['firstname'] ) ) End here...
		}

		if( empty( $_POST['lastname'] ) ) {
			Format::setErrors( "errlname", "LastName Must Not Be Empty !!" );
		// elseif( empty( $_POST['lastname'] ) ) End here...
		} 

		if( empty( $_POST['email'] ) ) {
			Format::setErrors( "erremail", "Email Must Not Be Empty !!" );
		// elseif( empty( $_POST['email'] ) ) End here...
		}

		

		if( empty( $_POST['body'] ) ) {
			Format::setErrors( "msgempty", "Message Must not be Empty!!" );
		// elseif( empty( $_POST['lastname'] ) ) End here...
		}

		if( ! empty( $_POST['firstname'] ) && ! empty( $_POST['lastname'] ) && ! empty( $_POST['email'] ) && ! empty( $_POST['body'] ) ) {
			
			$firstname = mysqli_real_escape_string( $db->link, Format::validation( $_POST['firstname'] ) );
			$lastname = mysqli_real_escape_string( $db->link, Format::validation( $_POST['lastname'] ) );
			
			if( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) {
				Format::setErrors( "erremail", "Email Not Valid !!" );
			// elseif( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) End here...
			} else {
				$email = mysqli_real_escape_string( $db->link, Format::validation( $_POST['email'] ) );
				$body = mysqli_real_escape_string( $db->link, Format::validation( $_POST['body'] ) );

				$insert_query = "INSERT INTO {$contact_table}( firstname, lastname, email, body ) VALUES( '$firstname', '$lastname', '$email', '$body' )";
		        $inserted = $db->insert( $insert_query );
		        if( $inserted ) {
		            $msg = "Message Sent SuccessFully !!";
		        // if( $inserted ) End here...
		        } else {
		            $error[] = "Message Couldn't be Send !!";
		        }
			}

		}

	// if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
	}
?>
<style>
	.errmsg{

		color: red;
		float: left;
		font-style: italic;
		font-size: 10px;
	}
</style>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			
			<div class="about">
				<h2>Contact us</h2>
				<?php
					
					if( isset( $error ) ) {
						
						foreach( $error as $err ) {
							echo "<span style='color:red'>" . $err . "</span>";
						// foreach( $error as $err ) End here...
						}

					// if( isset( $error ) )  End here...
					}

					if( isset( $msg ) ) {
						echo "<span style='color:green'>" . $msg . "</span>";
					// if( isset( $msg ) ) End here...
					}
				?>
				<form action="" method="post">
					<table>
						<tr>
							<td>Your First Name:</td>
							<td>
							<span class="errmsg"><?php echo Format::getErrors( "errfname" ); ?></span>
							<input type="text" name="firstname" placeholder="Enter first name"/>
							</td>
						</tr>
						<tr>
							<td>Your Last Name:</td>
							<td>
							<span class="errmsg"><?php echo Format::getErrors( "errlname" ); ?></span>
							<input type="text" name="lastname" placeholder="Enter Last name"/>
							</td>
						</tr>
						
						<tr>
							<td>Your Email Address:</td>
							<td>
							<span class="errmsg"><?php echo Format::getErrors( "erremail" ); ?></span>
							<input type="text" name="email" placeholder="Enter Email Address"/>
							</td>
						</tr>
						<tr>
							<td>Your Message:</td>
							<td>
							<span class="errmsg"><?php echo Format::getErrors( "msgempty" ); ?></span>
							<textarea name="body"></textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>

							<input type="submit" name="submit" value="Submit"/>
							</td>
						</tr>
					</table>
				</form>				
			</div> <!-- /.about -->

		</div> <!-- /.maincontent .clear -->

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>