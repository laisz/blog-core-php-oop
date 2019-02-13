<?php 
    include '../lib/Session.php';
    Session::checkSession();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>

<?php
    
    $db = new Database();
    //$fm = new Format();
?>

<?php
    
    // Code for Cache Control , using this not to holding the Cache..
    // instructed to use it in admin headers only...
    header( "Cache-Control: no-cache, must-revalidate" );
    header( "Pragma: no-cache" );
    header( "Expires: Sat, 26 Jul 1997 05:00:00 GMT" );
    header( "Cache-Control: max-age=2592000" );

?>

<?php
    $slider_table = "tbl_slider";
?>

<?php
    
    if( ! isset( $_GET['delid'] ) && $_GET['delid'] == null ) {
        echo "<script>window.location = 'sliderlist.php'; </script>";
        //header( "Location: sliderlist.php" );
    // if( ! isset( $_GET['delid'] ) && $_GET['delid'] == null ) End here...
    } else {
        $delid = $_GET['delid'];
        $getslider = "SELECT * FROM {$slider_table} WHERE id = '{$delid}'";
        $getslider_image = $db->select( $getslider );
        if( $getslider_image ) {
            while( $delimage = $getslider_image->fetch_assoc() ) {
                $dellink = $delimage['image'];
                unlink( $dellink );
            }
        // if( $getslider_image ) End here...
        }

        $delquery = "DELETE FROM {$slider_table} WHERE id = '{$delid}'";
        $deleted = $db->delete( $delquery );
        
        if( $deleted ) {
            echo "<script>alert( 'Slider Data Deleted SuccessFully.' ); </script>";
            echo "<script>window.location = 'sliderlist.php'; </script>";
        // if( $deleted ) End here...
        } else {
            echo "<script>alert( 'Slider Data Couldn't be Deleted.' ); </script>";
            echo "<script>window.location = 'sliderlist.php'; </script>";
        }

    }

?>