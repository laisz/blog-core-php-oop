<?php include 'inc/header.php'; ?>

	<div class="contentsection contemplete clear">
		
		<div class="maincontent clear">
<?php
	if( isset( $_GET['msg'] ) ) {
		$msg = $_GET['msg'];
		echo $msg;
	}
?>
			<div class="about">
				<div class="notfound">
    				<p><span>404</span> Not Found</p>
    			</div> <!-- /.notfound -->
	        </div> <!-- /.about -->
		</div> <!-- /.maincontent .clear -->
		
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>