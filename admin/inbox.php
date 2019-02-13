<?php include 'inc/adminheader.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
    
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Inbox</h2>
<?php
	
	if( isset( $_GET['seenid'] ) ) {
		$seenid = $_GET['seenid'];
		$update_query = "UPDATE {$contact_table} 
                        SET 
                        status = '1' 
                        WHERE id = '{$seenid}'";

        $update_row = $db->update( $update_query );
        if( $update_row ) {
            echo "<span class='success'>Message Sent in Seen Box !!</span>";
        // if( $update_row ) End here...
        } else {
            echo "<span class='error'>Message Couldn't be Send in the Seen Box !!</span>";
        }
	// if( isset( $_GET['seenid'] ) ) End here..
	}

?>
            <div class="block">        
                <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php
    
    $msg_query    = "SELECT * FROM {$contact_table} WHERE status = '0' ORDER BY id DESC";
    $get_messages = $db->select( $msg_query );
    if( $get_messages ) {
        $i = 0;
        while( $result = $get_messages->fetch_assoc() ) {
        $i++;
?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname']; ?> <?php echo $result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo Format::textShorten( $result['body'], 60 ); ?></td>
							<td><?php echo Format::formatDate( $result['date'] ); ?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> || 
								<a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> || 
								<a onclick="return confirm( 'Are You Sure to Move this To Seen Box.. ?' ); " href="?seenid=<?php echo $result['id']; ?>">Seen</a>
							</td>
						</tr> <!-- /.odd gradeX -->
<?php } } ?>
					</tbody>
			    </table> <!-- /.data .display .datatable -->
           </div> <!-- /.block -->
        </div> <!-- /.box .round .first .grid -->
        <div class="box round first grid">
            <h2>Seen Messages</h2>
<?php
	
	if( isset( $_GET['unseenid'] ) ) {
		$unseenid = $_GET['unseenid'];
		$update_query = "UPDATE {$contact_table} 
                        SET 
                        status = '0' 
                        WHERE id = '{$unseenid}'";

        $update_row = $db->update( $update_query );
        if( $update_row ) {
            echo "<span class='success'>Message Marked as Unseen !!</span>";
        // if( $update_row ) End here...
        } else {
            echo "<span class='error'>Message Couldn't be Marked as Unseen !!</span>";
        }
	// if( isset( $_GET['unseenid'] ) ) End here..
	}

	if( isset( $_GET['delid'] ) ) {
		$delid = $_GET['delid'];
		$del_query = "DELETE FROM {$contact_table} WHERE id = '{$delid}'";

        $delete_row = $db->update( $del_query );
        if( $delete_row ) {
            echo "<span class='success'>Message Deleted SuccessFully !!</span>";
        // if( $delete_row ) End here...
        } else {
            echo "<span class='error'>Message Couldn't be Deleted !!</span>";
        }
	// if( isset( $_GET['delid'] ) ) End here..
	} 
?>
            <div class="block">        
                <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php
    
    $msg_query    = "SELECT * FROM {$contact_table} WHERE status = '1' ORDER BY id DESC";
    $get_messages = $db->select( $msg_query );
    if( $get_messages ) {
        $i = 0;
        while( $result = $get_messages->fetch_assoc() ) {
        $i++;
?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname']; ?> <?php echo $result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo Format::textShorten( $result['body'], 60 ); ?></td>
							<td><?php echo Format::formatDate( $result['date'] ); ?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
								<a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> ||
								<a onclick="return confirm( 'Are You Sure to Make this Unseen.. ?' ); " href="?unseenid=<?php echo $result['id']; ?>">Unseen</a> ||
								<a onclick="return confirm( 'Are You Sure to Delete Message.. ?' ); " href="?delid=<?php echo $result['id']; ?>">Delete</a>
							</td>
						</tr> <!-- /.odd gradeX -->
<?php } } ?>
					</tbody>
			    </table> <!-- /.data .display .datatable -->
           </div> <!-- /.block -->
        </div> <!-- /.box .round .first .grid -->
    </div> <!-- /.grid_10 -->
<script type="text/javascript">
$(document).ready(function () {
    setupLeftMenu();

    $('.datatable').dataTable();
    setSidebarHeight();


});
</script>
<?php include 'inc/adminfooter.php'; ?>
