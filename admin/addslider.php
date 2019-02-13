<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>Add New Slider</h2>
    <?php
        
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                
            $title = mysqli_real_escape_string( $db->link, Format::validation( $_POST['title'] ) );

            $permitted = array( 'jpg', 'jpeg', 'png', 'gif' );
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode( '.', $file_name );
            $file_ext = strtolower( end( $div ) );
            $unique_image = substr( md5( time() ), 0, 10 ) . '.' . $file_ext;
            $uploaded_image = "upload/" . $unique_image;

            if( $title == "" || $file_name == "" ) {
                echo "<span class='error'>Field Must Not be Empty !! </span>";
            // if( $title == "" || $cat == "" || $body == "" || $tags == "" || $author == "" || $file_name == "" ) End here..
            } elseif( $file_size > 1048567 ) {
                echo "<span class='error'>Image Size Must be Less Than 1 MB !! </span>";
            } elseif( in_array( $file_ext, $permitted ) === false ) {
                echo "<span class='error'>Only " . implode( ', ', $permitted ) . " Files are Allowed to Upload !! </span>";
            } else {
                
                //echo "<span class='error'>Field Must Not be Empty !! </span>";
                
                move_uploaded_file( $file_temp, $uploaded_image );
                $insert_slider = "INSERT INTO {$slider_table}( title, image ) VALUES( '{$title}', '{$uploaded_image}' )";
                $slider_inserted = $db->insert( $insert_slider );
                if( $slider_inserted ) {
                    echo "<span class='success'>Slider Added Successfully !! </span>";
                // if( $insert_slider ) End here...
                } else {
                    echo "<span class='error'>Slider Couldn't be Added !! </span>";
                }

            }

        // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
        }

    ?>
            <div class="block">               
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Title..." class="medium" />
                            </td>
                        </tr>
                   
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>

    					<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" value="Add Slider" />
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
