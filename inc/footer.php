</div> <!-- /.contentsection .contemplete .clear -->

	<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
<?php
    $footer_query = "SELECT * FROM {$footer_table} WHERE id = '1'";
    $footer_select = $db->select( $footer_query );
    if( $footer_select ) {
        while( $result = $footer_select->fetch_assoc() ) {
?>
	  <p>&copy; <?php echo $result['note']; ?> <?php echo date( 'Y' ); ?></p>

<?php } } ?>

	</div>
	<div class="fixedicon clear">
<?php
    
    $select_social = "SELECT * FROM {$social_table} WHERE id = '1'";
    $get_social = $db->select( $select_social );
    if( $get_social ) {
        while( $result = $get_social->fetch_assoc() ) {

?> 		
		<a href="<?php echo $result['fb']; ?>"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $result['tw']; ?>"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $result['inn']; ?>"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $result['gp']; ?>"><img src="images/gl.png" alt="GooglePlus"/></a>

<?php } } ?>

	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>