<div class="sidebar clear">		
	
	<div class="samesidebar clear">
		<h2>Categories</h2>
		
		<ul>
		
	<?php

		$cat_query = "SELECT * FROM {$cat_table}";
		$category = $db->select( $cat_query );

		if( $category ) {
			//$catid = null;	
			// we need to initialize $catid here, otherwise its scope will finished inside first while loop... 
			// instead we could run the second if-else condition and while loop inside the First while Loop..
			// but here we gonna do both..
			while( $cat_result = $category->fetch_assoc() ) {

	?>

			<li><a href="posts.php?category=<?php echo $cat_result['id']; ?>"><?php echo $cat_result['name']; ?></a></li>

	<?php } ?>
	<?php } else { ?>
			
			<li>No Category Created !! </li>

	<?php } ?>

		</ul>

	</div> <!-- /.samesidebar .clear -->
	
	<div class="samesidebar clear">
		
		<h2>Latest articles</h2>
<?php
	
	$lat_query = "SELECT * FROM {$post_table} LIMIT 5";
	$latest = $db->select( $lat_query );
	if( $latest ){
		while( $latest_post = $latest->fetch_assoc() ) {


?>

		<div class="popular clear">
			<h3><a href="post.php?id=<?php echo $latest_post['id']; ?>"><?php echo $latest_post['title']; ?></a></h3>
			<a href="post.php?id=<?php echo $latest_post['id']; ?>"><img src="admin/<?php echo $latest_post['image']; ?>" alt="post image"/></a>
			<?php echo Format::textShorten( $latest_post['body'], 100 ); ?>
		</div> <!-- .popular .clear -->
<?php } ?>
<?php } else { ?>
		<div class="popular clear">
			<p>No Latest Post Found !!</p>
		</div> <!-- .popular .clear -->
<?php } ?>
	</div> <!-- /.samesidebar .clear -->

</div> <!-- /.sidebar .clear -->