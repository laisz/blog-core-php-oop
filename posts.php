<?php include 'inc/header.php'; ?>

<?php
	
	if( ! isset( $_GET['category'] ) || $_GET['category'] == null ) {
		header( "Location: 404.php" );
		exit();
	// if( ! isset( $_GET['category'] ) || $_GET['category'] == null ) End here...
	} else {
		if( preg_match( '/[^0-9]/', $_GET['category'] ) ) {
			header( "Location: 404.php" );
			exit();
		} else {
			$category = (int) $_GET['category'];
			$category = mysqli_real_escape_string( $db->link, Format::validation( $category ) );
		}
	}

?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
<?php
	
	
	$query = "SELECT * FROM {$post_table} WHERE cat = {$category}";
	$select_query = $db->select( $query );
	
	if( $select_query ) {
		//echo "cool";
		while( $data = $select_query->fetch_assoc() ) {

?>
		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $data['id']; ?>"><?php echo $data['title']; ?></a></h2>
			<h4><?php echo Format::formatDate( $data['date'] ); ?>, By <a href="posts2.php?authid=<?php echo $data['userid']; ?>"><?php echo $data['author']; ?></a></h4>
			<a href="#"><img src="admin/<?php echo $data['image']; ?>" alt="post image"/></a>
			
			<?php echo Format::textShorten( $data['body'], 300 ); ?>

			<div class="readmore clear">
				<a href="post.php?id=<?php echo $data['id']; ?>">Read More</a>
			</div> <!-- /.readmore .clear -->
		</div> <!-- /.samepost .clear -->

<?php } ?>	<!-- while( $data = $select_query->fetch_asscoc() ) Loop End here... -->

<?php } else { ?> <!-- if( $select_query ) End here... -->
		<h2>No Posts Available in this Category !! </h2>
<?php } ?>		


	</div> <!-- /.maincontent .clear -->
		
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>