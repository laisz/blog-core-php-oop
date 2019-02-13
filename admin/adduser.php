<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
<?php
    if( ! Session::get( 'userrole' ) == '0' ) {
        //header( "Location: index.php" );
        //exit();
        echo "<script>window.location = 'index.php'; </script>";
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
<?php
    
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        
        $username = mysqli_real_escape_string( $db->link, Format::validation( $_POST['username'] ) );
        $password = mysqli_real_escape_string( $db->link, Format::validation( md5( $_POST['password'] ) ) );
        $email    = mysqli_real_escape_string( $db->link, Format::validation( $_POST['email'] ) );
        $role     = mysqli_real_escape_string( $db->link, Format::validation( $_POST['role'] ) );

        if( empty( $_POST['username'] ) || empty( $_POST['password'] ) || empty( $_POST['email'] ) || empty( $_POST['role'] ) ) {
            echo "<span class='error'>Field Must Not Be Empty !!</span>";
        //  if( empty( $getcat ) ) End here...
        } else {
            //echo "<span class='success'>Success !! </span>" . $getcat . "<br>";

            $mailquery = "SELECT * FROM {$user_table} WHERE email = '{$email}'";
            $mailcheck = $db->select( $mailquery );
            if( $mailcheck != false ) {
                echo "<span class='error'>Email Already Exists !!</span>";
            // if( $mailcheck != false ) End here...
            } elseif( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) {
                echo "<span class='error'>Email Not Valid !!</span>";
            // elseif( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) End here...
            } else {

                $user_query = "INSERT INTO {$user_table}( username, password, email, role ) VALUES ( '{$username}', '{$password}', '{$email}', '{$role}' )";
                $add_user = $db->insert( $user_query );
                if( $add_user ) {
                    echo "<span class='success'>User Added SuccessFully !!</span>";
                // if( $add_user ) End here...
                } else {
                    echo "<span class='error'>User Couldn't Be Added !!</span>";
                }
            }
            
        }

    // if( $_SERVER['REQUEST_METHOD'] == 'POST' ) End here...    
    }

?>
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>
                                    <label>Username</label>
                                </td>
                                <td>
                                    <input type="text" name="username" autocomplete="off" maxlength="32" placeholder="Enter UserName..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Password</label>
                                </td>
                                <td>
                                    <input type="text" name="password" autocomplete="off" maxlength="32" placeholder="Enter Password..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>E-Mail</label>
                                </td>
                                <td>
                                    <input type="text" name="email" autocomplete="off" maxlength="32" placeholder="Enter Email..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Role</label>
                                </td>
                                <td>
                                    <select id="select" name="role">
                                        <option>Select User Role</option>
                                        <option value="0">Admin</option>
                                        <option value="1">Author</option>
                                        <option value="2">Editor</option>
                                    </select>
                                </td>
                            </tr>
    						<tr> 
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Add User" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div> <!-- /.block .copyblock -->
            </div>
        </div>
<?php include 'inc/adminfooter.php'; ?>
