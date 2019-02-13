<?php include 'inc/header.php'; ?>
<?php

    if( ! isset( $_GET['pageid'] ) && $_GET['pageid'] == null ) {
        echo "<script>window.location = '404.php'; </script>";
        //header( "Location: catlist.php" );
    // if( ! isset( $_GET['pageid'] ) && $_GET['pageid'] == null ) End here...
    } else {
        
        if( preg_match( '/[^0-9]/', $_GET['pageid'] ) ) {
            echo "<script>window.location = '404.php'; </script>";
        } else {
            $pageid = (int) $_GET['pageid'];
            $pageid = mysqli_real_escape_string( $db->link, Format::validation( $pageid ) );
        }
    }

?>

<?php
                        
    $select_page = "SELECT * FROM {$page_table} WHERE id = '{$pageid}'";
    $get_page = $db->select( $select_page );
    if( $get_page ) {
        while( $result = $get_page->fetch_assoc() ) {
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			
			<div class="about">
				<h2><?php echo $result['name']; ?></h2>
				<?php echo $result['body']; ?>
			</div> <!-- /.about -->

		</div> <!-- /.maincontent .clear -->
		
<?php } } else { header( "Location: 404.php" ); } ?>

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>