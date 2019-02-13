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
    $post_table = "tbl_post";

?>

<?php
    
    if( ! isset( $_GET['delpostid'] ) && $_GET['delpostid'] == null ) {
        echo "<script>window.location = 'postlist.php'; </script>";
        //header( "Location: postlist.php" );
    // if( ! isset( $_GET['delpostid'] ) && $_GET['delpostid'] == null ) End here...
    } else {
        
        if( preg_match( '/[^0-9]/', $_GET['delpostid'] ) ) {
            echo "<script>window.location = 'index.php'; </script>";
        } else {

            $postid = (int) $_GET['delpostid'];
            $getallpost = "SELECT * FROM {$post_table} WHERE id = '{$postid}'";
            $getdata = $db->select( $getallpost );
            if( $getdata ) {
                while( $delimage = $getdata->fetch_assoc() ) {
                    $dellink = $delimage['image'];
                    unlink( $dellink );
                }
            // if( $getdata ) End here...
            }

            $delquery = "DELETE FROM {$post_table} WHERE id = '{$postid}'";
            $deleted = $db->delete( $delquery );
            
            if( $deleted ) {
                echo "<script>alert( 'Data Deleted SuccessFully.' ); </script>";
                echo "<script>window.location = 'postlist.php'; </script>";
            // if( $deleted ) End here...
            } else {
                echo "<script>alert( 'Data Couldn't be Deleted.' ); </script>";
                echo "<script>window.location = 'postlist.php'; </script>";
            }
        }
    }

?>