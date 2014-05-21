<?php
$role = checkUser($_COOKIE['username']);	
if(!is_numeric(strpos($role,'s'))){
	header("location: kioskcontroller");
}
if(isset($_POST['submitButton'])) {
	switch($_POST['submitButton']) {
		case 'Save':
			$kioskIDs = $_POST['kioskID'];
			$appID = $_POST['appID'];
			$activeTime = strtotime($_POST['activeTime']);
			foreach($kioskIDs AS $kioskID){
			
				$wpdb->insert('kiosk_setting',array(
					'kiosk_id' => $kioskID, 
					'application_id' => $appID, 
					'dateModified' => date( 'Y-m-d H:i:s', time() ),
					'modifiedBy' => $_COOKIE['username'],
					'activeTime' => date( 'Y-m-d H:i:s', $activeTime)));
					
			}
			break;
		case 'Update':
			$kioskIDs = $_POST['kioskID'];
			$appID = $_POST['appID'];
			$activeTime = strtotime($_POST['activeTime']);
			$ID = $_POST['ID'];
			foreach($kioskIDs AS $kioskID){
				$wpdb->update('kiosk_setting',array(
					'kiosk_id' => $kioskID, 
					'application_id' => $appID, 
					'dateModified' => date( 'Y-m-d H:i:s', time() ),
					'modifiedBy' => $_COOKIE['username'],
					'activeTime' => date( 'Y-m-d H:i:s', $activeTime),
					'xmlWritten' => '0'
					),array(
					'ID' => $ID
					));	
			}
			break;
		case 'Delete':
			$ID = $_POST['ID'];
			
			$wpdb->query("DELETE FROM kiosk_setting WHERE kiosk_setting_id = $ID;");
		
			break;	
	}
}


$sql = "CALL getAllCurrentSettings();";

$currentSettings = $wpdb->get_results($sql,ARRAY_A);

//error_log(print_r($wpdb->query('SELECT 1'),true));


$settingsOut = '';

foreach($currentSettings as $settings) {
	extract($settings);
	$settingsOut .= <<<EOT
	<tr>
		<td>$iPadID<br>$building - $roomLocation</td>
		<td>$applicationDescription</td>
		<td>$dateCreated</td>
		<td>$dateModified</td>
		<td>$modifiedBy</td>
		<td>$activeTime</td>
		<td><a class="copyLink" dbID="$kiosk_setting_id" style="cursor:pointer">Copy</a> <a class="editLink" dbID="$kiosk_setting_id" style="cursor:pointer">Edit</a> <a class="deleteLink" dbID="$kiosk_setting_id" style="cursor:pointer">Delete</a></td>
	</tr>
EOT;
}

$sql = "CALL getApplications();";

$apps = $wpdb->get_results($sql,ARRAY_A);
error_log(print_r($wpdb->query('SELECT 1'),true));


foreach($apps as $app) {
	extract($app);
	$appsOut .= "<option value=\"$application_id\">$description - $homePage</option>";	
}

$sql = "SELECT *
FROM kiosk
ORDER BY building;";

$kiosks = $wpdb->get_results($sql,ARRAY_A);
error_log(print_r($wpdb->query('SELECT 1'),true));

foreach($kiosks as $kiosk) {
	extract($kiosk);
	$kiosksOut .= "<option value=\"$kiosk_id\">$building - $iPadID - $description - $roomLocation</option>";
}



?>

<h2>Add New Setting</h2>
<form action="kioskcontroller?page=kioskSettings" method="post" id="mainForm" class="form-horizontal">
  <fieldset class="form-group">
    <legend>General</legend>
    <label for="kioskID" class="control-label col-xs-4">Kiosk</label>
    <div class="col-xs-8">
      <select name="kioskID[]" id="kioskID" multiple="multiple" size="10">
        <option value=""></option>
        <?php echo($kiosksOut); ?>
      </select>
      <p>To select multiple kiosks, please use <em>command</em> (Mac), <em>control</em> (Windows).</p>
    </div>
    <label for="appID" class="control-label col-xs-4">Home Page/Application</label>
    <div class="col-xs-8">
      <select name="appID" id="appID">
        <option value=""></option>
        <?php echo($appsOut); ?>
      </select>
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>Activation</legend>
    <label for="activeTime" class="control-label col-xs-4">Change Kiosk Settings As Of</label>
    <div class="col-xs-8">
      <input type="text" name="activeTime" id="activeTime" class="datetimepicker"/>
    </div>
  </fieldset>
  <input type="hidden" value="" name="ID" id="ID" />
  <input type="reset" value="Cancel" id="reset"  class="btn"/>
  <input type="submit" value="Save" id="submitButton" name="submitButton" class="btn btn-primary" />
</form>
<h2>Current Settings</h2>
<table border="1" class="table">
  <tr>
    <th>iPadID</th>
    <th>Application</th>
    <th>Date Created</th>
    <th>Date Modified</th>
    <th>Modified By</th>
    <th>Active As Of</th>
    <th>Actions</th>
  </tr>
  <?php echo($settingsOut); ?>
</table>
<script type="text/javascript" language="javascript">
function isUndefined(x) {var u; return x === u;}

jQuery.noConflict();
(function( $ ) {
	$(".datetimepicker").datetimepicker({
		showSecond: false,
		timeFormat: 'hh:mm:ss',
		dateFormat: 'yy-mm-dd'
	});
	
	$('.copyLink').click(function(){
		$.getJSON('kiosksettingdetails',
			{
				ID: $(this).attr('dbID')
			},
			function(data){
				if(isUndefined(data)){
					return false;	
				}
				$('#kioskID').val(data[0].kiosk_id);
				$('#appID').val(data[0].application_id);
				$('#activeTime').val(data[0].activeTime);
			});
		});
	
	$('.editLink').click(function(){
		$.getJSON('kiosksettingdetails',
			{
				ID: $(this).attr('dbID')
			},
			function(data){
				if(isUndefined(data)){
					return false;	
				}
				$('#kioskID').val(data[0].kiosk_id);
				$('#appID').val(data[0].application_id);
				$('#activeTime').val(data[0].activeTime);
				$('#ID').val(data[0].kiosk_setting_id);
				$('#submitButton').val('Update');
		});
	});
	
	$('.deleteLink').click(function(){
		$.getJSON('kiosksettingdetails',
			{
				ID: $(this).attr('dbID')
			},
			function(data){
				if(isUndefined(data)){
					return false;	
				}
				$('#kioskID').val(data[0].kiosk_id);
				$('#appID').val(data[0].application_id);
				$('#activeTime').val(data[0].activeTime);
				$('#ID').val(data[0].kiosk_setting_id);
				$('#submitButton').val('Delete');
				if(confirm("Are you sure you want to delete this setting?")){
					$('#submitButton').click();
				}
				return false;
		});
	});
})(jQuery);
</script>