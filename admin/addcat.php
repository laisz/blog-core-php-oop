<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
<?php
    
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

        $getcat = Format::validation( $_POST['name'] );
        $getcat = mysqli_real_escape_string( $db->link, $getcat );

        if( empty( $getcat ) ) {
            echo "<span class='error'>Field Must Not Be Empty !!</span>";
        //  if( empty( $getcat ) ) End here...
        } else {
            //echo "<span class='success'>Success !! </span>" . $getcat . "<br>";
            $query = "INSERT INTO {$cat_table}( name ) VALUES ( '$getcat' )";
            $category = $db->insert( $query );
            if( $category ) {
                echo "<span class='success'>Category Inserted Successfully !!</span>";
            // if( $category ) End here...
            } else {
                echo "<span class='error'>Category Couldn't be Inserted !!</span>";
            }
        }

    // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...    
    }

?>
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" name="name" autocomplete="off" maxlength="32" placeholder="Enter Category Name..." class="medium" />
                                </td>
                            </tr>
    						<tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div> <!-- /.block .copyblock -->
            </div>
        </div>
<?php include 'inc/adminfooter.php'; ?>
