<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>Add New Page</h2>
    <?php
        
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                
            $name = mysqli_real_escape_string( $db->link, $_POST['name'] );
            $body = mysqli_real_escape_string( $db->link, $_POST['body'] );

            if( $name == "" || $body == "" ) {
                echo "<span class='error'>Field Must Not be Empty !! </span>";
            // if( $name == "" || $body == "" || $body == "" || $tags == "" || $author == "" || $file_name == "" ) End here..
            } else {
                
                $insert_query = "INSERT INTO {$page_table}( name, body ) VALUES( '$name', '$body' )";
                $inserted = $db->insert( $insert_query );
                if( $inserted ) {
                    echo "<span class='success'>Page Created Successfully !! </span>";
                // if( $insert_query ) End here...
                } else {
                    echo "<span class='error'>Page Couldn't be Created !! </span>";
                }

            }

        // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
        }

    ?>
            <div class="block">               
                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Name..." class="medium" />
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
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
    					<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table> <!-- /.form -->
                </form>
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
