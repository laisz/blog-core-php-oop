<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">

<!-- Pagination Start -->

<?php
	
	$per_page = 3;
	if( isset( $_GET['page'] ) ) {
		$page = ( $_GET['page'] <= 0 ) ? 1 : mysqli_real_escape_string( $db->link, Format::validation( (int) $_GET['page'] ) );
	// if( isset( $_GET['page'] ) ) End here...
	} else {
		$page = 1;
	}
	
	//echo "Page No: " . $page;
	//var_dump( $page );

	$start_from = ( $page - 1 ) * $per_page;

?>

<!-- Pagination End -->

<?php
	
	
	$query = "SELECT * FROM {$post_table} ORDER BY id DESC LIMIT {$start_from}, {$per_page}";
	$select_query = $db->select( $query );
	
	if( $select_query ) {
		//echo "cool";
		while( $data = $select_query->fetch_assoc() ) {

?>

		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $data['id']; ?>"><?php echo $data['title']; ?></a></h2>
			<h4><?php echo Format::formatDate( $data['date'] ); ?>, By <a href="posts2.php?authid=<?php echo $data['userid']; ?>"><?php echo $data['author']; ?></a></h4>
			<a href="post.php?id=<?php echo $data['id']; ?>"><img src="admin/<?php echo $data['image']; ?>" alt="post image"/></a>
			
			<?php echo Format::textShorten( $data['body'], 300 ); ?>

			<div class="readmore clear">
				<a href="post.php?id=<?php echo $data['id']; ?>">Read More</a>
			</div> <!-- /.readmore .clear -->
		</div> <!-- /.samepost .clear -->

<?php } ?>	<!-- while( $data = $select_query->fetch_asscoc() ) Loop End here... -->

<!-- Pagination Start -->

<?php  
	
	$query 	= "SELECT * FROM {$post_table}";
	$result = $db->select( $query );
	$total_rows = mysqli_num_rows( $result );
	//$total_rows_another_way = $result->num_rows;
	$total_pages = ceil( $total_rows / $per_page );

	// if( $result->num_rows > 0 ) {
	// 	//echo $result->num_rows . "<br>";
	// }

	//echo $total_rows;


	echo "<span class='pagination'><a href='index.php?page=1'>" . 'First Page' . "</a>";

	for( $i = 1; $i <= $total_pages; $i++ ) {
		echo "<a href='index.php?page=" . $i . "'> " . $i . " </a>";
	}

	echo "<a href='index.php?page=" . $total_pages . "'>" . 'Last Page' . "</a></span>"; 

 ?>

<!-- Pagination End -->

<?php 
	// if( $select_query ) End here...
	} else { 
		header( "Location: 404.php" );
		exit();
	} 

?>

	</div> <!-- /.maincontent .clear -->
		
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>