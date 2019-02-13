<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
						<thead>
							<tr>
								<th width="2%">Serial</th>
								<th width="15%">Post Title</th>
								<th width="20%">Description</th>
								<th width="3%">Category</th>
								<th width="15%">Image</th>
								<th width="10%">Author</th>
								<th width="10%">Tags</th>
								<th width="10%">Dates</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
	<?php

		$join_query = 	"SELECT {$post_table}.*, {$cat_table}.name 
						FROM {$post_table} INNER JOIN {$cat_table} 
						ON {$post_table}.cat = {$cat_table}.id 
						ORDER BY {$post_table}.title DESC";
		$selected = $db->select( $join_query );
		if( $selected ) {
			$i = 0;
			while( $result = $selected->fetch_assoc() ) {
			$i++;
	?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><a href="editpost.php?editpostid=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></td>
								<td><?php echo Format::textShorten( Format::validation( $result['body'] ), 35 ); ?></td>
								<td><?php echo $result['name']; ?></td>
								<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px" /></td>
								<td><?php echo $result['author']; ?></td>
								<td><?php echo $result['tags']; ?></td>
								<td><?php echo Format::formatDate( $result['date'] ); ?></td>
								<td>
									<a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>">View</a>

						<?php if( Session::get( 'userid' ) == $result['userid'] || Session::get( 'userrole' ) == '0' ) { ?>

									||
									<a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a> 
									||
									<a onclick="return confirm( 'Are You Sure To Delete?' );" href="deletepost.php?delpostid=<?php echo $result['id']; ?>">Delete</a>
						
						<?php } ?>

								</td>
							</tr> <!-- /.odd gradeX -->
	<?php
			// if( $selected ) End here...
			}
		// while( $result = $selected->fetch_assoc() ) End  here...
		}
	?>
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
