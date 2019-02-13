<?php include 'inc/header.php'; ?>

<?php
	
	if( ! isset( $_GET['id'] ) || $_GET['id'] == null ) {
		header( "Location: 404.php" );
		exit();
	// if( ! isset( $_GET['id'] ) || $_GET['id'] == null ) End here...
	} else {
		if( preg_match( '/[^0-9]/', $_GET['id'] ) ) {
			header( "Location: 404.php" );
			exit();
		} else {
			$id = (int) $_GET['id'];
			$id = mysqli_real_escape_string( $db->link, Format::validation( $id ) );
		}
	}
	
	//echo "id No: " . $id;
	//var_dump( $id );

?>

	<div class="contentsection contemplete clear">
		
		<div class="maincontent clear">
			<div class="about">
				
				<?php

					$query = "SELECT * FROM {$post_table} WHERE id = '{$id}'";
					$select_query = $db->select( $query );
					if( $select_query ) {
						//$catid = null;	
						// we need to initialize $catid here, otherwise its scope will finished inside first while loop... 
						// instead we could run the second if-else condition and while loop inside the First while Loop..
						// but here we gonna do both..
						while( $post = $select_query->fetch_assoc() ) {

				?>

				<h2><?php echo $post['title']; ?></h2>
				
				<h4><?php echo Format::formatDate( $post['date'] ); ?>, By <a href="posts2.php?authid=<?php echo $post['userid']; ?>"><?php echo $post['author']; ?></a></h4>
				
				<img src="admin/<?php echo $post['image']; ?>" alt="MyImage"/>
				
				<?php echo $post['body']; ?>

				<div class="relatedpost clear">
					<h2>Related articles</h2>
				<?php

					$catid = $post['cat'];
					//echo $catid;
					$queryrelated = "SELECT * FROM {$post_table} WHERE cat = '{$catid}' ORDER BY rand() LIMIT 6";	// this will bring the posts randomly bcoz of using rand() function ...
					$relatedpost = $db->select( $queryrelated );
					if( $relatedpost ) {
						while( $rel_post = $relatedpost->fetch_assoc() ) {


				?>

					
					<a href="post.php?id=<?php echo $rel_post['id']; ?>">
						<img src="admin/<?php echo $rel_post['image']; ?>" alt="post image"/>
					</a>

				<?php 		
						} // while( $rel_post = $relatedpost->fetch_assoc() ) End here...

					// if( $relatedpost ) End here..
					} else {
						echo "No Related Post Available <br>";
					}
				?>

				</div> <!-- /.relatedpost .clear -->

				<?php
						} // while( $post = $select_query->fetch_assoc() ) End here..

					// if( $select_query ) End here...
					} else {
						header( "Location: 404.php" );
						exit();
					}

				?>

			</div> <!-- /.about -->
		</div> <!-- /.maincontent .clear -->

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>
