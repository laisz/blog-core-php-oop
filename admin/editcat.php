<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<?php
    
    if( ! isset( $_GET['catid'] ) && $_GET['catid'] == null ) {
        echo "<script>window.location = 'catlist.php'; </script>";
        //header( "Location: catlist.php" );
    // if( ! isset( $_GET['catid'] ) && $_GET['catid'] == null ) End here...
    } else {
        
        if( preg_match( '/[^0-9]/', $_GET['catid'] ) ) {
            echo "<script>window.location = 'catlist.php'; </script>";
        } else {
            $id = (int) $_GET['catid'];
            $id = mysqli_real_escape_string( $db->link, Format::validation( $id ) );
        }
    }

?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
<?php
    
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

        $getcat = $_POST['name'];
        $getcat = Format::validation( $_POST['name'] );
        $getcat = mysqli_real_escape_string( $db->link, $getcat );

        if( empty( $getcat ) ) {
            echo "<span class='error'>Field Must Not Be Empty !!</span>";
        //  if( empty( $getcat ) ) End here...
        } else {
            //echo "<span class='success'>Success !! </span>" . $getcat . "<br>";
            
            $update_query = "UPDATE {$cat_table} 
                            SET name = '{$getcat}' 
                            WHERE id = '{$id}'";

            $update_row = $db->update( $update_query );
            if( $update_row ) {
                echo "<span class='success'>Category Updated Successfully !!</span>";
            // if( $update_row ) End here...
            } else {
                echo "<span class='error'>Category Couldn't be Updated !!</span>";
            }
        }

    // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...    
    }

?>

<?php
    
    $select_query  = "SELECT * FROM {$cat_table} WHERE id = '{$id}' ORDER BY id DESC";
    $cat = $db->select( $select_query );
    if( $cat ) {
        while( $result = $cat->fetch_assoc() ) {

?>
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                                </td>
                            </tr>
    						<tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>
<?php
        // while( $result = $cat->fetch_assoc() ) End here...
        }
    //  if( $cat ) End here...
    }

?>
                </div> <!-- /.block .copyblock -->
            </div>
        </div>
<?php include 'inc/adminfooter.php'; ?>
