<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
<?php
    
    if( ! isset( $_GET['msgid'] ) && $_GET['msgid'] == null ) {
        echo "<script>window.location = 'inbox.php'; </script>";
        //header( "Location: index.php" );
    // if( ! isset( $_GET['msgid'] ) && $_GET['msgid'] == null ) End here...
    } else {
        $msgid = $_GET['msgid'];
    }

?>    
    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>View Messages</h2>
    <?php
        
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            echo "<script>window.location = 'inbox.php'; </script>";
        // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
        }

    ?>
            <div class="block">               
<?php
    
    $msg_query    = "SELECT * FROM {$contact_table} WHERE id = '{$msgid}'";
    $get_messages = $db->select( $msg_query );
    if( $get_messages ) {
        $i = 0;
        while( $result = $get_messages->fetch_assoc() ) {
        $i++;
?>                
                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly name="name" value="<?php echo $result['firstname'] . ' ' . $result['lastname']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>E-Mail</label>
                            </td>
                            <td>
                                <input type="text" readonly name="name" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                    
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly name="date" value="<?php echo Format::formatDate( $result['date'] ); ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $result['body']; ?>
                                </textarea>
                            </td>
                        </tr>
    					<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table> <!-- /.form -->
                </form>
<?php }  } ?>
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
