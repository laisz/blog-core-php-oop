<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
    
    <style>
        
        .leftside {
           float: left;
           width: 70%;
        }

        .rightside {
            float: left;
            width: 20%;
        }

        .rightside img {
            height: 160px;
            width: 170px;
        }

    </style>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Site Title and Description</h2>
<?php

    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            
        $title = mysqli_real_escape_string( $db->link, Format::validation( $_POST['title'] ) );
        $slogan = mysqli_real_escape_string( $db->link, Format::validation( $_POST['slogan'] ) );

        $permitted = array( 'jpg', 'jpeg', 'png', 'gif' );
        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_temp = $_FILES['logo']['tmp_name'];

        $div = explode( '.', $file_name );
        $file_ext = strtolower( end( $div ) );
        $same_name = 'logo' . '.' . $file_ext;
        $uploaded_image = "upload/" . $same_name;

        if( $title == "" || $slogan == "" ) {
            echo "<span class='error'>Field Must Not be Empty !! </span>";
        // if( $title == "" || $slogan == "" || $logo == "" ) End here..
        } else {

            if( ! empty( $file_name ) ) {
                
                if( $file_size > 1048567 ) {
                    echo "<span class='error'>Image Size Must be Less Than 1 MB !! </span>";
                } elseif( in_array( $file_ext, $permitted ) === false ) {
                    echo "<span class='error'>Only " . implode( ', ', $permitted ) . " Files are Allowed to Upload !! </span>";
                } else {

                    move_uploaded_file( $file_temp, $uploaded_image );
                    $update_query = "UPDATE {$title_slogan}
                                    SET
                                    title       = '{$title}',
                                    slogan      = '{$slogan}',
                                    logo        = '{$uploaded_image}'
                                    WHERE id    = '1'";
                    $updated = $db->update( $update_query );
                    if( $updated ) {
                        echo "<span class='success'>Data Updated Successfully !! </span>";
                    // if( $update_query ) End here...
                    } else {
                        echo "<span class='error'>Data Couldn't be Updated !! </span>";
                    }

                }

            // if( ! empty( $file_name ) ) End here...
            } else {
                
                $update_query = "UPDATE {$title_slogan}
                                SET
                                title    = '{$title}',
                                slogan   = '{$slogan}'
                                WHERE id = '1'";
                $updated = $db->update( $update_query );
                if( $updated ) {
                    echo "<span class='success'>Data Updated Successfully !! </span>";
                // if( $update_query ) End here...
                } else {
                    echo "<span class='error'>Data Couldn't be Updated !! </span>";
                }
            // If Logo Empty...
            }
        // If Not Empty...
        }
    // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...
    }

?>
            <div class="block sloginblock">

<?php
    
    $select_query = "SELECT * FROM {$title_slogan} WHERE id = '1'";
    $blog_title = $db->select( $select_query );
    if( $blog_title ) {
        while( $result = $blog_title->fetch_assoc() ) {

?>               
                <div class="leftside">
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">					
                            <tr>
                                <td>
                                    <label>Website Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
                                </td>
                            </tr>
    						<tr>
                                <td>
                                    <label>Website Slogan</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $result['slogan']; ?>" name="slogan" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Upload Logo</label>
                                </td>
                                <td>
                                    <input type="file" name="logo" />
                                </td>
                            </tr>
    						<tr>
                                <td>
                                </td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table> <!-- /.form -->
                    </form>
                </div> <!-- /.leftside -->
                <div class="rightside">
                    <img src="<?php echo $result['logo']; ?>" alt="Logo" title="present logo" />
                    Logo
                </div> <!-- /.rightside -->
<?php
        }
    }
?>
            </div> <!-- /.block sloginblock -->
        </div> <!-- /.box .round .first .grid -->
    </div> <!-- /.grid_10 -->

<?php include 'inc/adminfooter.php'; ?>
