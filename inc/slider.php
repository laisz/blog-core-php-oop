<div class="slidersection templete clear">
        <div id="slider">
<?php 
	$slider_query = "SELECT * FROM {$slider_table} ORDER BY id ASC LIMIT 5";
	$slider_selected = $db->select( $slider_query );
	if( $slider_selected ) {
		while( $result = $slider_selected->fetch_assoc() ) {
?>
            <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="Slider Image" title="<?php echo $result['title']; ?>" /></a>
<?php } } ?>
        </div> <!-- /.slider -->

</div>