<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
						<thead>
							<tr>
								<th>Serial</th>
								<th>Slider Title</th>
								<th>Slider Image</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
	<?php

		$slide_query = 	"SELECT * FROM {$slider_table} ORDER BY id DESC";
		$slide_selected = $db->select( $slide_query );
		if( $slide_selected ) {
			$i = 0;
			while( $result = $slide_selected->fetch_assoc() ) {
			$i++;
	?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['title']; ?></td>
								<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px" /></td>
								<td>
							<?php if( Session::get( 'userrole' ) == '0' ) { ?>
									<a href="editslider.php?sliderid=<?php echo $result['id']; ?>">Edit</a> 
									||
									<a onclick="return confirm( 'Are You Sure To Delete?' );" href="delslider.php?delid=<?php echo $result['id']; ?>">Delete</a>
							<?php } ?>	
								</td>
							</tr> <!-- /.odd gradeX -->
	<?php } } ?>
						</tbody>
					</table> <!-- /.data .display .datatable -->
               	</div> <!-- /.block -->
            </div> <!-- /.box .round .first .grid -->
        </div> <!-- /.grid_10 -->
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/adminfooter.php'; ?>
