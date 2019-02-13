<?php 
    include '../lib/Session.php';
    Session::checkSession();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>

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
    
    $post_table   = "tbl_post";
    $cat_table    = "tbl_category";
    $user_table   = "tbl_user";
    $title_slogan = "tbl_title_slogan";
    $social_table = "tbl_social";
    $footer_table = "tbl_footer";
    $page_table   = "tbl_page";

?>

<?php

    if( isset( $_GET['action'] ) && $_GET['action'] == "logout" ) {
        Session::destroy();
    // if( isset( $_GET['action'] ) && $_GET['action'] == "logout" ) End here...
    }

?>

<?php
    
    if( ! isset( $_GET['delpageid'] ) && $_GET['delpageid'] == null ) {
        echo "<script>window.location = 'index.php'; </script>";
        //header( "Location: postlist.php" );
    // if( ! isset( $_GET['delpageid'] ) && $_GET['delpageid'] == null ) End here...
    } else {
        $delpageid = $_GET['delpageid'];

        $delquery = "DELETE FROM {$page_table} WHERE id = '{$delpageid}'";
        $deleted = $db->delete( $delquery );
        
        if( $deleted ) {
            echo "<script>alert( 'Page Deleted SuccessFully.' ); </script>";
            echo "<script>window.location = 'index.php'; </script>";
        // if( $deleted ) End here...
        } else {
            echo "<script>alert( 'Page Couldn't be Deleted.' ); </script>";
            echo "<script>window.location = 'index.php'; </script>";
        }

    }

?>