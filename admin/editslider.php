<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
 <?php
    if( ! isset( $_GET['sliderid'] ) && $_GET['sliderid'] == null ) {
        echo "<script>window.location = 'sliderlist.php'; </script>";
        //header( "Location: sliderlist.php" );
    // if( ! isset( $_GET['sliderid'] ) && $_GET['sliderid'] == null ) End here...
    } else {
        $sliderid = $_GET['sliderid'];
    }
 ?>   
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

        $permitted = array( 'jpg', 'jpeg', 'png', 'gif' );
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode( '.', $file_name );
        $file_ext = strtolower( end( $div ) );
        $unique_image = substr( md5( time() ), 0, 10 ) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;

        if( $title == "" ) {
            echo "<span class='error'>Slider Title Must Not be Empty !! </span>";
        // if( $title == "" || $slogan == "" || $logo == "" ) End here..
        } else {

            if( ! empty( $file_name ) ) {
                
                if( $file_size > 1048567 ) {
                    echo "<span class='error'>Image Size Must be Less Than 1 MB !! </span>";
                } elseif( in_array( $file_ext, $permitted ) === false ) {
                    echo "<span class='error'>Only " . implode( ', ', $permitted ) . " Files are Allowed to Upload !! </span>";
                } else {

                    //$del_image = "DELETE FROM {$slider_table} WHERE id = '{$delpageid}'";
                    //$postid = $_GET['delpostid'];
                    $getslider = "SELECT * FROM {$slider_table} WHERE id = '{$sliderid}'";
                    $getslider_image = $db->select( $getslider );
                    if( $getslider_image ) {
                        while( $delimage = $getslider_image->fetch_assoc() ) {
                            $dellink = $delimage['image'];
                            unlink( $dellink );
                        }
                    // if( $getslider_image ) End here...
                    }

                    move_uploaded_file( $file_temp, $uploaded_image );
                    $update_slider_query = "UPDATE {$slider_table}
                                    SET
                                    title       = '{$title}',
                                    image        = '{$uploaded_image}'
                                    WHERE id    = '{$sliderid}'";
                    $slider_updated = $db->update( $update_slider_query );
                    if( $slider_updated ) {
                        echo "<span class='success'>Slider Data Updated Successfully !! </span>";
                    // if( $update_slider_query ) End here...
                    } else {
                        echo "<span class='error'>Slider Data Couldn't be Updated !! </span>";
                    }

                }

            // if( ! empty( $file_name ) ) End here...
            } else {
                
                $update_slider_query = "UPDATE {$slider_table}
                                SET
                                title       = '{$title}'
                                WHERE id    = '{$sliderid}'";
                $slider_updated = $db->update( $update_slider_query );
                if( $slider_updated ) {
                    echo "<span class='success'>Slider Title Updated Successfully !! </span>";
                // if( $update_slider_query ) End here...
                } else {
                    echo "<span class='error'>Slider Title Couldn't be Updated !! </span>";
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
    
    $select_slider = "SELECT * FROM {$slider_table} WHERE id = '{$sliderid}'";
    $slider_selected = $db->select( $select_slider );
    if( $slider_selected ) {
        while( $result = $slider_selected->fetch_assoc() ) {

?>               
                <div class="leftside">
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">                    
                            <tr>
                                <td>
                                    <label>Slider Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Upload Slider Image</label>
                                </td>
                                <td>
                                    <input type="file" name="image" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <input type="submit" name="submit" value="Updae Slider Data" />
                                </td>
                            </tr>
                        </table> <!-- /.form -->
                    </form>
                </div> <!-- /.leftside -->
                <div class="rightside">
                    <img src="<?php echo $result['image']; ?>" alt="slider_image" title="present Slider Image" />
                    Slider Image
                </div> <!-- /.rightside -->
<?php } } ?>
            </div> <!-- /.block sloginblock -->
        </div> <!-- /.box .round .first .grid -->
    </div> <!-- /.grid_10 -->

<?php include 'inc/adminfooter.php'; ?>
