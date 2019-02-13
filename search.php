<?php include 'inc/header.php'; ?>

<?php
	
	$search_data = mysqli_real_escape_string( $db->link, Format::validation( $_POST['search'] ) );
	if( ! isset( $search_data ) || $search_data == null ) {
		header( "Location: 404.php" );
		exit();
	// if( ! isset( $_POST['search'] ) || $_POST['search'] == null ) End here...
	} else {
		$search = $search_data;
	}

?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
<?php
	
	
	$query = "SELECT * FROM {$post_table} WHERE title LIKE '%{$search}%' OR body LIKE '%{$search}%'";
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

<?php 	} ?>	<!-- while( $data = $select_query->fetch_asscoc() ) Loop End here... -->

<?php } else { ?> <!-- if( $select_query ) End here... -->
		
		<p>Data Not Found !! </p>

<?php } ?>

	</div> <!-- /.maincontent .clear -->
		
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>