<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
        
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">
<?php
    
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        
        $fb  = mysqli_real_escape_string( $db->link, Format::validation( $_POST['fb'] ) );
        $tw  = mysqli_real_escape_string( $db->link, Format::validation( $_POST['tw'] ) );
        $inn = mysqli_real_escape_string( $db->link, Format::validation( $_POST['inn'] ) );
        $gp  = mysqli_real_escape_string( $db->link, Format::validation( $_POST['gp'] ) ); 

        if( $fb == "" || $tw == "" || $inn == "" || $gp == "" ) {
             echo "<span class='error'>Field Must Not be Empty !! </span>";
        // if( $fb == "" || $tw == "" || $inn == "" || $gp == "" ) End here...
        } else {
            $update_query = "UPDATE {$social_table}
                            SET
                            fb       = '{$fb}',
                            tw       = '{$tw}',
                            inn      = '{$inn}',
                            gp       = '{$gp}'
                            WHERE id = '1'";
            $updated = $db->update( $update_query );
            if( $updated ) {
                echo "<span class='success'>Social Data Updated Successfully !! </span>";
            // if( $update_query ) End here...
            } else {
                echo "<span class='error'>Social Data Couldn't be Updated !! </span>";
            }

        }
    // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
    }

    $select_social = "SELECT * FROM {$social_table} WHERE id = '1'";
    $social = $db->select( $select_social );
    if( $social ) {
        while( $result = $social->fetch_assoc() ) {

?>              
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>
                                    <label>Facebook</label>
                                </td>
                                <td>
                                    <input type="text" name="fb" value="<?php echo $result['fb']; ?>" class="medium" />
                                </td>
                            </tr>
    						 <tr>
                                <td>
                                    <label>Twitter</label>
                                </td>
                                <td>
                                    <input type="text" name="tw" value="<?php echo $result['tw']; ?>" class="medium" />
                                </td>
                            </tr>
    						
    						 <tr>
                                <td>
                                    <label>LinkedIn</label>
                                </td>
                                <td>
                                    <input type="text" name="inn" value="<?php echo $result['inn']; ?>" class="medium" />
                                </td>
                            </tr>
    						
    						 <tr>
                                <td>
                                    <label>Google Plus</label>
                                </td>
                                <td>
                                    <input type="text" name="gp" value="<?php echo $result['gp']; ?>" class="medium" />
                                </td>
                            </tr>
    						
    						 <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table> <!-- /.form -->
                    </form>
<?php }   } ?>
                </div> <!-- /.block -->
            </div> <!-- /.box .round .first .grid -->
        </div> <!-- /.grid_10 -->

<?php include 'inc/adminfooter.php'; ?>
