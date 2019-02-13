<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
<?php
    if( ! isset( $_GET['viewpostid'] ) && $_GET['viewpostid'] == null ) {
        echo "<script>window.location = 'postlist.php'; </script>";
        //header( "Location: postlist.php" );
    // if( ! isset( $_GET['viewpostid'] ) && $_GET['postlist'] == null ) End here...
    } else {
        $viewpostid = $_GET['viewpostid'];
        if( preg_match( '/[^0-9]/', $_GET['viewpostid'] ) ) {
            echo "<script>window.location = 'postlist.php'; </script>";
        } else {
            $viewpostid = (int) $_GET['viewpostid'];
            $viewpostid = mysqli_real_escape_string( $db->link, Format::validation( $viewpostid ) );
        }
    }
?>

    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>Update Post</h2>
    <?php
        


        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                
            echo "<script>window.location = 'postlist.php'; </script>";

        // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
        }

    ?>
            <div class="block">               
    <?php
        
        $select_query = "SELECT * FROM {$post_table} WHERE id = '{$viewpostid}' ORDER BY id DESC";
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
                                <input type="text" name="title" readonly value="<?php echo $postresult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" readonly name="cat">
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
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo Format::formatDate( $postresult['date'] ); ?>" />
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
                                <textarea class="tinymce" readonly name="body">
                                    <?php echo $postresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" readonly value="<?php echo $postresult['tags']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly name="author" value="<?php echo $postresult['author']; ?>" class="medium" />
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
