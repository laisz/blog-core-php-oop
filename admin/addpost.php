<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>Add New Post</h2>
    <?php
        
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                
            $title = mysqli_real_escape_string( $db->link, Format::validation( $_POST['title'] ) );
            $cat = mysqli_real_escape_string( $db->link, Format::validation( $_POST['cat'] ) );
            $body = mysqli_real_escape_string( $db->link, Format::validation( $_POST['body'] ) );
            $tags = mysqli_real_escape_string( $db->link, Format::validation( $_POST['tags'] ) );
            $author = mysqli_real_escape_string( $db->link, Format::validation( $_POST['author'] ) );
            $userid = mysqli_real_escape_string( $db->link, Format::validation( $_POST['userid'] ) );

            $permitted = array( 'jpg', 'jpeg', 'png', 'gif' );
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode( '.', $file_name );
            $file_ext = strtolower( end( $div ) );
            $unique_image = substr( md5( time() ), 0, 10 ) . '.' . $file_ext;
            $uploaded_image = "upload/" . $unique_image;

            if( $title == "" || $cat == "" || $body == "" || $tags == "" || $author == "" || $userid == "" || $file_name == "" ) {
                echo "<span class='error'>Field Must Not be Empty !! </span>";
            // if( $title == "" || $cat == "" || $body == "" || $tags == "" || $author == "" || $file_name == "" ) End here..
            } elseif( $file_size > 1048567 ) {
                echo "<span class='error'>Image Size Must be Less Than 1 MB !! </span>";
            } elseif( in_array( $file_ext, $permitted ) === false ) {
                echo "<span class='error'>Only " . implode( ', ', $permitted ) . " Files are Allowed to Upload !! </span>";
            } else {
                
                //echo "<span class='error'>Field Must Not be Empty !! </span>";
                
                move_uploaded_file( $file_temp, $uploaded_image );
                $insert_query = "INSERT INTO {$post_table}( cat, title, body, image, author, tags, userid ) VALUES( '$cat', '$title', '$body', '$uploaded_image', '$author', '$tags', '$userid' )";
                $inserted = $db->insert( $insert_query );
                if( $inserted ) {
                    echo "<span class='success'>Post Inserted Successfully !! </span>";
                // if( $insert_query ) End here...
                } else {
                    echo "<span class='error'>Post Couldn't be Inserted !! </span>";
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
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select Category</option>
    <?php
        $query = "SELECT * FROM {$cat_table}";
        $cat = $db->select( $query );
        if( $cat ) {
            while( $result = $cat->fetch_assoc() ) {
    ?>
                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
    <?php } } ?>
                                </select>
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
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter Tags..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo Session::get( 'username' ); ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get( 'userid' ); ?>" class="medium" />
                            </td>
                        </tr>
    					<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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
