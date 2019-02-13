<?php
	
	if( isset( $_GET['pageid'] ) ) {
		$pageid = $_GET['pageid'];
		$title_query = "SELECT * FROM {$page_table} WHERE id = {$pageid}";
		$get_title = $db->select( $title_query );
		
		if( $get_title ) {
			while( $result = $get_title->fetch_assoc() ) {
?>
	
	<title><?php echo $result['name']; ?>-<?php echo TITLE; ?></title>
	
<?php 
			// while( $result = $get_title->fetch_assoc() ) End here...
			}
		// if( $get_title ) End here...	
		}
	// if( isset( $_GET['pageid'] ) ) End here...
	} elseif( isset( $_GET['id'] ) ) {
		$postid = $_GET['id'];
		$post_title_query = "SELECT * FROM {$post_table} WHERE id = {$postid}";
		$get_post_title = $db->select( $post_title_query );
		
		if( $get_post_title ) {
			while( $result = $get_post_title->fetch_assoc() ) {
?>
	
	<title><?php echo $result['title']; ?>-<?php echo TITLE; ?></title>

<?php } } } else { ?>

	<title><?php echo Format::title(); ?>-<?php echo TITLE; ?></title>

<?php } ?>
	
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
<?php
	if( isset( $_GET['id'] ) ) {
		$keyword = $_GET['id'];
		$query = "SELECT * FROM {$post_table} WHERE id = '{$keyword}'";
		$get_keys = $db->select( $query );
		if( $get_keys ) {
			while( $result = $get_keys->fetch_assoc() ) {
?>
	<meta name="keywords" content="<?php echo $result['tags']; ?>">
	<meta name="author" content="<?php echo $result['author']; ?>">

<?php } } } else { ?>
	
	<meta name="keywords" content="<?php echo KEYWORDS; ?>">

<?php } ?>