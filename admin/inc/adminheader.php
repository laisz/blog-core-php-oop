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
    $cat_table = "tbl_category";
    $user_table = "tbl_user";
    $title_slogan = "tbl_title_slogan";
    $social_table = "tbl_social";
    $footer_table = "tbl_footer";
    $page_table = "tbl_page";
    $contact_table = "tbl_contact";
    $theme_table = "tbl_theme";
    $slider_table = "tbl_slider";

?>

<?php

    if( isset( $_GET['action'] ) && $_GET['action'] == "logout" ) {
        Session::destroy();
    // if( isset( $_GET['action'] ) && $_GET['action'] == "logout" ) End here...
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    
    <link href="css/fancy-button/fancy-button.css" rel="stylesheet" type="text/css" />
    <!--Jquery UI CSS-->
    <link href="css/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->

    <?php include 'jq_extra_for_addpost.php'; ?>


    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/livelogo.png" alt="Logo" />
				</div> <!-- /.floatleft .logo -->
				<div class="floatleft middle">
					<h1>Training with live project</h1>
					<p>www.trainingwithliveproject.com</p>
				</div> <!-- /.floatleft .middle -->
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" />
                    </div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo Session::get( 'username' ); ?></li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul> <!-- /.inline-ul .floatleft -->
                    </div> <!-- /.floatleft .marginleft10 -->
                </div> <!-- /.floatright -->
                <div class="clear">
                </div> <!-- /.clear -->
            </div> <!-- /#branding -->
        </div> <!-- /.grid_12 .header-repeat -->
        <div class="clear">
        </div> <!-- /.clear -->
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-dashboard"><a href="theme.php"><span>Theme</span></a> </li>
                <li class="ic-form-style"><a href="profile.php"><span>User Profile</span></a></li>
				<li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
				<li class="ic-grid-tables"><a href="inbox.php"><span>Inbox
                    <?php
    
                        $msg_query    = "SELECT * FROM {$contact_table} WHERE status = '0' ORDER BY id DESC";
                        $get_msg = $db->select( $msg_query );
                        if( $get_msg ) {
                            $count = mysqli_num_rows( $get_msg );
                            echo "(" . $count . ")";
                        } else {
                            echo "(0)";
                        }
                    ?>
                </span></a></li>
                
        <?php if( Session::get( 'userrole' ) == '0' ) { ?>
                <li class="ic-charts"><a href="adduser.php"><span>Add User</span></a></li>
        <?php } ?>
                <li class="ic-charts"><a href="userlist.php"><span>User List</span></a></li>
                <li class="ic-charts"><a href="postlist.php"><span>Visit Website</span></a></li>
            </ul> <!-- /.nav main -->
        </div> <!-- /.grid_12 -->
        <div class="clear">
        </div> <!-- /.clear -->
        