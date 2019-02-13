<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
<?php
    if( ! isset( $_GET['editpostid'] ) && $_GET['editpostid'] == null ) {
        echo "<script>window.location = 'postlist.php'; </script>";
        //header( "Location: postlist.php" );
    // if( ! isset( $_GET['editpostid'] ) && $_GET['postlist'] == null ) End here...
    } else {
        if( preg_match( '/[^0-9]/', $_GET['editpostid'] ) ) {
            echo "<script>window.location = 'postlist.php'; </script>";
        } else {
            $postid = (int) $_GET['editpostid'];
        }
        
    }
?>

    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>Update Post</h2>
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

            if( $title == "" || $cat == "" || $body == "" || $tags == "" || $author == "" || $userid == "" ) {
                echo "<span class='error'>Field Must Not be Empty !! </span>";
            // if( $title == "" || $cat == "" || $body == "" || $tags == "" || $author == "" || $userid == "" ) End here..
            } else {

                if( ! empty( $file_name ) ) {
                    
                    if( $file_size > 1048567 ) {
                        echo "<span class='error'>Image Size Must be Less Than 1 MB !! </span>";
                    } elseif( in_array( $file_ext, $permitted ) === false ) {
                        echo "<span class='error'>Only " . implode( ', ', $permitted ) . " Files are Allowed to Upload !! </span>";
                    } else {

                        $getpost = "SELECT * FROM {$post_table} WHERE id = '{$postid}'";
                        $getpost_image = $db->select( $getpost );
                        if( $getpost_image ) {
                            while( $delimage = $getpost_image->fetch_assoc() ) {
                                $dellink = $delimage['image'];
                                unlink( $dellink );
                            }
                        // if( $getpost_image ) End here...
                        }

                        move_uploaded_file( $file_temp, $uploaded_image );
                        $update_query = "UPDATE {$post_table}
                                        SET
                                        cat      = '{$cat}',
                                        title    = '{$title}',
                                        body     = '{$body}',
                                        image    = '{$uploaded_image}',
                                        author   = '{$author}',
                                        tags     = '{$tags}', 
                                        userid   = '{$userid}'
                                        WHERE id = '{$postid}'";
                        $updated = $db->update( $update_query );
                        if( $updated ) {
                            echo "<span class='success'>Post Updated Successfully !! </span>";
                        // if( $update_query ) End here...
                        } else {
                            echo "<span class='error'>Post Couldn't be Updated !! </span>";
                        }

                    }

                // if( ! empty( $file_name ) ) End here...
                } else {
                    
                    $update_query = "UPDATE {$post_table}
                                    SET
                                    cat      = '{$cat}',
                                    title    = '{$title}',
                                    body     = '{$body}',
                                    author   = '{$author}',
                                    tags     = '{$tags}', 
                                    userid   = '{$userid}'
                                    WHERE id = '{$postid}'";
                    $updated = $db->update( $update_query );
                    if( $updated ) {
                        echo "<span class='success'>Post Updated Successfully !! </span>";
                    // if( $update_query ) End here...
                    } else {
                        echo "<span class='error'>Post Couldn't be Updated !! </span>";
                    }

                }
            // If Not Empty...
            }

        // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
        }

    ?>
            <div class="block">               
    <?php
        
        $select_query = "SELECT * FROM {$post_table} WHERE id = '{$postid}' ORDER BY id DESC";
        $selected = $db->select( $select_query );
        if( $selected ) {
            while( $postresult = $selected->fetch_assoc() ) {

    ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $postresult['title']; ?>" class="medium" />
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
                                     <option 
                                <?php if( $postresult['cat'] == $result['id'] ) { ?>
                                  selected="selected" 
                                <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
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
                                <img src="<?php echo $postresult['image']; ?>" height="50px" width="100px" /><br>
                                <input type="file" value="<?php echo $postresult['image']; ?>" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $postresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $postresult['tags']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $postresult['author']; ?>" class="medium" />
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
