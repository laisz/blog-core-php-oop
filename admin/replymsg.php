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
           
           $to       = mysqli_real_escape_string( $db->link, Format::validation( $_POST['toemail'] ) );
           $from     = mysqli_real_escape_string( $db->link, Format::validation( $_POST['fromemail'] ) );
           $subject  = mysqli_real_escape_string( $db->link, Format::validation( $_POST['subject'] ) );
           $message  = mysqli_real_escape_string( $db->link, Format::validation( $_POST['message'] ) );
           $sendmail = mail( $to, $subject, $message, $from );

           if( $sendmail ) {
                echo "<span class='success'>Mail/Message Has Sent SuccessFully.</span>";
            // if( $sendmail ) End here...
           } else {
                echo "<span class='error'>Mail/Message Couldn't be Send.</span>";
           }
        // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
        }

    ?>
            <div class="block">               
<?php
    
    $contact_query    = "SELECT * FROM {$contact_table} WHERE id = '{$msgid}'";
    $get_contact = $db->select( $contact_query );
    if( $get_contact ) {
        $i = 0;
        while( $result = $get_contact->fetch_assoc() ) {
        $i++;
?>                
                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name="toemail" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromemail" placeholder="Please Enter Your E-Mail Address" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="Please Enter Your Subject" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message">
                                    
                                </textarea>
                            </td>
                        </tr>
    					<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
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
