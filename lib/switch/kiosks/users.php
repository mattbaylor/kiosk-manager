<?php
$role = checkUser($_COOKIE['username']);	
if(!is_numeric(strpos($role,'u'))){
	header("location: kioskcontroller");
}
if(isset($_POST['submitButton'])) {
	switch($_POST['submitButton']) {
		case 'Save':
			$authorized_user_id = $_POST['authorized_user_id'];
			$username = $_POST['username'];
			$role = implode($_POST['roles']);
				$wpdb->insert('authorized_users',array( 
					'username' => $username,
					'role' => $role, 
					'dateModified' => date( 'Y-m-d H:i:s', time() ),
					'modifiedBy' => $_COOKIE['username']
				));
			break;
		case 'Update':
			$authorized_user_id = $_POST['authorized_user_id'];
			$username = $_POST['username'];
			$role = implode($_POST['roles']);
			$wpdb->update('authorized_users',array(
				'authorized_user_id' => $authorized_user_id, 
				'username' => $username,
				'role' => $role, 
				'dateModified' => date( 'Y-m-d H:i:s', time() ),
				'modifiedBy' => $_COOKIE['username'],
				),array(
				'authorized_user_id' => $authorized_user_id
				));	
			break;
		case 'Delete':
			$authorized_user_id = $_POST['authorized_user_id'];
			
			$wpdb->query("DELETE FROM authorized_users WHERE authorized_user_id = $authorized_user_id;");
		
			break;	
	}
}


$sql = "CALL getUsers();";

$users = $wpdb->get_results($sql,ARRAY_A);

//error_log(print_r($wpdb->query('SELECT 1'),true));


$usersOut = '';

foreach($users as $user) {
	extract($user);
	$usersOut .= <<<EOT
	<tr>
		<td>$username</td>
		<td>$role</td>
		<td>$dateModified</td>
		<td>$modifiedBy</td>
		<td><a class="copyLink" dbID="$authorized_user_id" style="cursor:pointer">Copy</a> <a class="editLink" dbID="$authorized_user_id" style="cursor:pointer">Edit</a> <a class="deleteLink" dbID="$authorized_user_id" style="cursor:pointer">Delete</a></td>
	</tr>
EOT;
}
?>

<h2>Add/Edit User</h2>
<form action="kioskcontroller?page=users" method="post" id="mainForm" class="form-horizontal">
  <fieldset class="form-group">
    <legend>Users</legend>
    <label for="username" class="control-label col-xs-4">Username</label>
    <div class="col-xs-8">
      <input type="text" name="username" id="username" class=""/>
    </div>
    <label for"role" class="control-label col-xs-4">Role</label>
    <div class="col-xs-8">
      <select name="roles[]" id="role" multiple="multiple" size="6">
        <option value=""></option>
        <option value="s">Manage Applications on Kiosks</option>
        <option value="k">Manage Kiosks</option>
        <option value="p">Manage Applications</option>
        <option value="d">Manage Schedules</option>
        <option value="u">Manage Users</option>
      </select>
    </div>
  </fieldset>
  <input type="hidden" value="" name="authorized_user_id" id="authorized_user_id" />
  <input type="reset" value="Cancel" id="reset"  class="btn"/>
  <input type="submit" value="Save" id="submitButton" name="submitButton" class="btn btn-primary" />
</form>
<h2>Current Users</h2>
<table border="1" class="table">
  <tr>
    <th>Username</th>
    <th>Role</th>
    <th>Date Modified</th>
    <th>Modified By</th>
    <th>Actions</th>
  </tr>
  <?php echo($usersOut); ?>
</table>
<script type="text/javascript" language="javascript">
function isUndefined(x) {var u; return x === u;}

jQuery.noConflict();
(function( $ ) {
	$('.copyLink').click(function(){
		$.getJSON('userdetails',
			{
				ID: $(this).attr('dbID')
			},
			function(data){
				if(isUndefined(data)){
					return false;	
				}
				$('#username').val(data[0].username);
				$('#role').val(data[0].role);
			});
		});
	
	$('.editLink').click(function(){
		$.getJSON('userdetails',
			{
				ID: $(this).attr('dbID')
			},
			function(data){
				if(isUndefined(data)){
					return false;	
				}
				$('#username').val(data[0].username);
				$('#role').val(data[0].role);
				$('#authorized_user_id').val(data[0].authorized_user_id);
				$('#submitButton').val('Update');
		});
	});
	
	$('.deleteLink').click(function(){
		$.getJSON('userdetails',
			{
				ID: $(this).attr('dbID')
			},
			function(data){
				if(isUndefined(data)){
					return false;	
				}
				$('#username').val(data[0].username);
				$('#role').val(data[0].role);
				$('#authorized_user_id').val(data[0].authorized_user_id);
				$('#submitButton').val('Delete');
				if(confirm("Are you sure you want to delete this user?")){
					$('#submitButton').click();
				}
				return false;
		});
	});
})(jQuery);
</script>