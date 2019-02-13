<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Themes</h2>
               <div class="block copyblock"> 
<?php
    
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

        $theme = mysqli_real_escape_string( $db->link, $_POST['theme'] );

        $update_query = "UPDATE {$theme_table} 
                        SET theme = '{$theme}' 
                        WHERE id = '1'";

        $update_row = $db->update( $update_query );
        if( $update_row ) {
            echo "<span class='success'>Theme Updated Successfully !!</span>";
        // if( $update_row ) End here...
        } else {
            echo "<span class='error'>Theme Couldn't be Updated !!</span>";
        }

    // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...    
    }

?>

<?php
    
    $select_theme  = "SELECT * FROM {$theme_table} WHERE id = '1'";
    $theme_selected = $db->select( $select_theme );
    if( $theme_selected ) {
        while( $result = $theme_selected->fetch_assoc() ) {

?>
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="radio" <?php if( $result['theme'] == 'default' ) { echo "checked"; } ?> name="theme" value="default"/> Default
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" <?php if( $result['theme'] == 'green' ) { echo "checked"; } ?> name="theme" value="green"/> Green
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" <?php if( $result['theme'] == 'red' ) { echo "checked"; } ?> name="theme" value="red"/> Red
                                </td>
                            </tr>
    						<tr> 
                                <td>
                                    <input type="submit" name="submit" value="Change" />
                                </td>
                            </tr>
                        </table>
                    </form>
<?php } } ?>
                </div> <!-- /.block .copyblock -->
            </div>
        </div>
<?php include 'inc/adminfooter.php'; ?>
