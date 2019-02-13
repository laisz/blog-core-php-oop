<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
<?php
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        
        $note  = mysqli_real_escape_string( $db->link, Format::validation( $_POST['note'] ) );
        if( $note == "" ) {
             echo "<span class='error'>Field Must Not be Empty !! </span>";
        // if( $note == "" ) End here...
        } else {
            $update_footer = "UPDATE {$footer_table}
                            SET
                            note       = '{$note}'
                            WHERE id = '1'";
            $footer_updated = $db->update( $update_footer );
            if( $footer_updated ) {
                echo "<span class='success'>Copyright Data Updated Successfully !! </span>";
            // if( $update_footer ) End here...
            } else {
                echo "<span class='error'>Copyright Data Couldn't be Updated !! </span>";
            }

        }
    // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
    }
?>
                <div class="block copyblock"> 
<?php
    $footer_query = "SELECT * FROM {$footer_table} WHERE id = '1'";
    $footer_select = $db->select( $footer_query );
    if( $footer_select ) {
        while( $result = $footer_select->fetch_assoc() ) {
?>
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['note']; ?>" name="note" class="large" />
                                </td>
                            </tr>
    						
    						 <tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table> <!-- /.form -->
                    </form>
<?php } } ?>
                </div> <!-- /.block copyblock -->
            </div> <!-- /.box .round .first .grid -->
        </div> <!-- /.grid_10 -->
<?php include 'inc/adminfooter.php'; ?>
