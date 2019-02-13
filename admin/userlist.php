<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
<?php

    if( isset( $_GET['deluser'] ) ) {
        if( preg_match( '/[^0-9]/', $_GET['deluser'] ) ) {
            //header( "Location: index.php" );
            //exit();
            echo "<script>window.location = 'index.php'; </script>";
        } else {
            if( preg_match( '/[^0-9]/', $_GET['deluser'] ) ) {
                echo "<script>window.location = 'index.php'; </script>";
            } else {

                $deluser = (int) $_GET['deluser'];
                $deluser = mysqli_real_escape_string( $db->link, Format::validation( $deluser ) );

                $delquery = "DELETE FROM {$user_table} WHERE id = '{$deluser}'";
                $del_user = $db->delete( $delquery );
                
                if( $del_user ) {
                    //header( "Location: catlist.php" );
                    echo "<span class='success'>User Deleted Successfully !!</span>";
                // if( $del_user ) End here...
                } else {
                    echo "<span class='error'>User Couldn't be Deleted !!</span>";
                }
            }
        }
    // if( isset( $_GET['deluser'] ) ) End here...
    }

?>
                <div class="block">        
                    <table class="data display datatable" id="example">
    					<thead>
    						<tr>
    							<th>Serial No.</th>
    							<th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Details</th>
                                <th>Role</th>
    							<th>Action</th>
    						</tr>
    					</thead>
    					<tbody>
                			
<?php
    $query    = "SELECT * FROM {$user_table} ORDER BY id DESC";
    $category = $db->select( $query );
    if( $category ) {
        $i = 0;
        while( $result = $category->fetch_assoc() ) {
        $i++;
?>
                            			
                            <tr class="odd gradeX">
    							<td><?php echo $i; ?></td>
    							<td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['username']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo Format::textShorten( $result['details'], 40 ); ?></td>
                                <td>
                                    <?php 

                                        if( $result['role'] == '0' ) {
                                            echo 'Admin';
                                        } elseif( $result['role'] == '1' ) {
                                            echo 'Author';
                                        } elseif( $result['role'] == '2' ) {
                                            echo 'Editor';
                                        }
                                    ?>
                                </td>
    							<td>
                                    <a href="viewuser.php?userid=<?php echo $result['id']; ?>">View</a>
                                <?php if( Session::get( 'userrole' ) == '0' ) { ?>
                                    || <a href="edituser.php?userid=<?php echo $result['id']; ?>">Edit</a>
                                    || <a onclick="return confirm( 'Are You Sure to Delete?' );" href="?deluser=<?php echo $result['id']; ?>">Delete</a>
                                <?php } ?>

                                </td>
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


