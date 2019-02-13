<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<?php
    
    if( ! isset( $_GET['userid'] ) && $_GET['userid'] == null ) {
        echo "<script>window.location = 'userlist.php'; </script>";
        //header( "Location: catlist.php" );
    // if( ! isset( $_GET['userid'] ) && $_GET['userid'] == null ) End here...
    } else {
        $userid = $_GET['userid'];
    }

?>
    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>User Details</h2>
    <?php
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
           echo "<script>window.location = 'userlist.php'; </script>";
        // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
        }
    ?>
            <div class="block">               
    <?php
        
        $select_user = "SELECT * FROM {$user_table} WHERE id = '{$userid}' ORDER BY id DESC";
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
                                <input type="text" name="name" readonly  value="<?php echo $getuser['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" readonly  value="<?php echo $getuser['username']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" readonly  value="<?php echo $getuser['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details" readonly >
                                    <?php echo $getuser['details']; ?>
                                </textarea>
                            </td>
                        </tr>
    					<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" value="Back To UserList" />
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
