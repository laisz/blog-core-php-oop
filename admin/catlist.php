<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
<?php

    if( isset( $_GET['delcat'] ) ) {
        
        if( preg_match( '/[^0-9]/', $_GET['delcat'] ) ) {
            echo "<script>window.location = 'index.php'; </script>";
        } else {
            
            $delid = (int) $_GET['delcat'];
            $delid = mysqli_real_escape_string( $db->link, Format::validation( $delid ) );

            $delquery = "DELETE FROM {$cat_table} WHERE id = '{$delid}'";
            $del_row = $db->delete( $delquery );
            
            if( $del_row ) {
                //header( "Location: catlist.php" );
                echo "<span class='success'>Category Deleted Successfully !!</span>";
            // if( $del_row ) End here...
            } else {
                echo "<span class='error'>Category Couldn't be Deleted !!</span>";
            }
        }

    // if( isset( $_GET['delcat'] ) ) End here...
    }

?>
                <div class="block">        
                    <table class="data display datatable" id="example">
    					<thead>
    						<tr>
    							<th>Serial No.</th>
    							<th>Category Name</th>
    							<th>Action</th>
    						</tr>
    					</thead>
    					<tbody>
                			
<?php
    $query    = "SELECT * FROM {$cat_table} ORDER BY id DESC";
    $category = $db->select( $query );
    if( $category ) {
        $i = 0;
        while( $result = $category->fetch_assoc() ) {
        $i++;
?>
                            			
                            <tr class="odd gradeX">
    							<td><?php echo $i; ?></td>
    							<td><?php echo $result['name']; ?></td>
    							<td><a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> || <a onclick="return confirm( 'Are You Sure to Delete?' );" href="?delcat=<?php echo $result['id']; ?>">Delete</a></td>
    						</tr> <!-- /.odd gradeX -->
                
<?php
        // while( $result = $category->fetch_assoc() ) End here..
        }
    //  if( $categoey ) End here...
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


