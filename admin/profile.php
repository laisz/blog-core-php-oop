<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<?php
    
    $userid   = Session::get( 'userid' );
    $userrole = Session::get( 'userrole' );

?>
    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>Update Post</h2>
    <?php
        


        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                
            $name = mysqli_real_escape_string( $db->link, $_POST['name'] );
            $username = mysqli_real_escape_string( $db->link, $_POST['username'] );
            $email = mysqli_real_escape_string( $db->link,  $_POST['email'] );
            $details = mysqli_real_escape_string( $db->link,  $_POST['details'] );

            if( $name == "" || $username == "" || $email == "" || $details == "" ) {
                echo "<span class='error'>Field Must Not be Empty !! </span>";
            // if( $title == "" || $cat == "" || $body == "" || $tags == "" || $author == "" ) End here..
            } else {
                    
                $update_user = "UPDATE {$user_table}
                                SET
                                name      = '{$name}',
                                username  = '{$username}',
                                email     = '{$email}',
                                details   = '{$details}' 
                                WHERE id  = '{$userid}'";
                $user_updated = $db->update( $update_user );
                if( $user_updated ) {
                    echo "<span class='success'>User Data Updated Successfully !! </span>";
                // if( $update_user ) End here...
                } else {
                    echo "<span class='error'>User Data Couldn't be Updated !! </span>";
                }
            }

        // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
        }

    ?>
            <div class="block">               
    <?php
        
        $select_user = "SELECT * FROM {$user_table} WHERE id = '{$userid}' AND role = '{$userrole}' ORDER BY id DESC";
        $user_selected = $db->select( $select_user );
        if( $user_selected ) {
            while( $getuser = $user_selected->fetch_assoc() ) {

    ?>
                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $getuser['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $getuser['username']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $getuser['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details">
                                    <?php echo $getuser['details']; ?>
                                </textarea>
                            </td>
                        </tr>
    					<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" value="Update" />
                            </td>
                        </tr>
                    </table> <!-- /.form -->
                </form>
    <?php } } ?>
            </div> <!-- /.block -->
        </div> <!-- /.box .round .first .grid -->
    </div> <!-- /.grid_10 -->
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/adminfooter.php'; ?>
