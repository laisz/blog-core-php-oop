<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
    
<?php

    if( ! isset( $_GET['pageid'] ) && $_GET['pageid'] == null ) {
        echo "<script>window.location = 'index.php'; </script>";
        //header( "Location: catlist.php" );
    // if( ! isset( $_GET['pageid'] ) && $_GET['pageid'] == null ) End here...
    } else {
        $pageid = $_GET['pageid'];
    }

?>
    <style>
        
        .actiondel{
            margin-left: 10px;

        }
        .actiondel a {
            background: #DDDDDD;
            border: 1px solid #ddd;
            color: #444;
            cursor: pointer;
            font-size: 20px;
            padding: 2px 10px;
            font-weight: normal;
        }

    </style>
    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>Edit Page</h2>
    <?php
        
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                
            $name = mysqli_real_escape_string( $db->link, $_POST['name'] );
            $body = mysqli_real_escape_string( $db->link, $_POST['body'] );

            if( $name == "" || $body == "" ) {
                echo "<span class='error'>Field Must Not be Empty !! </span>";
            // if( $name == "" || $body == "" || $body == "" || $tags == "" || $author == "" || $file_name == "" ) End here..
            } else {
                
                $update_page = "UPDATE {$page_table} 
                                SET 
                                name     = '{$name}', 
                                body     = '{$body}' 
                                WHERE id = '{$pageid}'";
                $page_updated = $db->update( $update_page );
                if( $page_updated ) {
                    echo "<span class='success'>Page Updated Successfully !! </span>";
                // if( $page_updated ) End here...
                } else {
                    echo "<span class='error'>Page Couldn't be Updated !! </span>";
                }

            }

        // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
        }

    ?>
            <div class="block">               
    <?php
                            
        $select_page = "SELECT * FROM {$page_table} WHERE id = '{$pageid}'";
        $get_page = $db->select( $select_page );
        if( $get_page ) {
            while( $result = $get_page->fetch_assoc() ) {

    ?>
                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                   
                    
                        <tr>
                            <td>
                                <label>Date Picker</label>
                            </td>
                            <td>
                                <input type="text" id="date-picker" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Body</label>
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
                                <input type="submit" name="submit" Value="Update Page" />
                                <span class="actiondel"><a onclick="return confirm( 'Are You Sure to Delete?' ); " href="deletepage.php?delpageid=<?php echo $result['id']; ?>">Delete</a></span>
                            </td>
                        </tr>
                    </table> <!-- /.form -->
                </form>

<?php   }   } ?>

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
