<?php 
	include 'lib/Session.php';
	Session::init();
?>
<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'helpers/Format.php'; ?>

<?php
	
	$db = new Database();
	//$fm = new Format();
?>

<?php
    
    // Code for Cache Control , using this not to holding the Cache..
    
    // header( "Cache-Control: no-cache, must-revalidate" );
    // header( "Pragma: no-cache" );
    // header( "Expires: Sat, 26 Jul 1997 05:00:00 GMT" );
    // header( "Cache-Control: max-age=2592000" );

?>


<?php

	$post_table = "tbl_post";
	$cat_table = "tbl_category";
	$user_table = "tbl_user";
	$title_slogan = "tbl_title_slogan";
	$social_table = "tbl_social";
	$footer_table = "tbl_footer";
	$page_table = "tbl_page";
	$contact_table = "tbl_contact";
	$theme_table = "tbl_theme";
	$slider_table = "tbl_slider";

?>

<!DOCTYPE html>
<html>
<head>
	

	<?php include 'scripts/meta.php'; ?>
	<?php include 'scripts/css.php'; ?>
	<?php include 'scripts/js.php'; ?>

</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
<?php
    
    $select_logo = "SELECT * FROM {$title_slogan} WHERE id = '1'";
    $get_logo = $db->select( $select_logo );
    if( $get_logo ) {
        while( $result = $get_logo->fetch_assoc() ) {

?> 
			<div class="logo">
				<img src="admin/<?php echo $result['logo']; ?>" alt="Logo"/>
				<h2><?php echo $result['title']; ?></h2>
				<p><?php echo $result['slogan']; ?></p>
			</div>
<?php } } ?>
		</a>
		<div class="social clear">
			<div class="icon clear">
<?php
    
    $select_social = "SELECT * FROM {$social_table} WHERE id = '1'";
    $get_social = $db->select( $select_social );
    if( $get_social ) {
        while( $result = $get_social->fetch_assoc() ) {

?> 
				<a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['inn']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
<?php } } ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="post">
				<input type="text" name="search" placeholder="Search here"/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<li><a <?php $path = $_SERVER['SCRIPT_FILENAME']; $currentpage = basename( $path, '.php' ); if( $currentpage == 'index' ) { echo 'id="active"'; } ?> href="index.php">Home</a></li>
		<li><a href="test.php">Test</a></li>

		<?php
                            
            $select_page = "SELECT * FROM {$page_table}";
            $get_page = $db->select( $select_page );
            if( $get_page ) {
                while( $result = $get_page->fetch_assoc() ) {

        ?>
                        
       	<li><a 
       	<?php
       			if( isset( $_GET['pageid'] ) && $_GET['pageid'] == $result['id'] ) {
       				echo 'id="active"';
       			// if( isset( $_GET['pageid'] && $_GET['pageid'] == $result['id'] ) ) End here...
       			}
       	?>
       		href="blogpage.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
                
        <?php } } ?>

		<li><a <?php if( $currentpage == 'contact' ) { echo 'id="active"'; } ?> href="contact.php">Contact</a></li>
	</ul>
</div>