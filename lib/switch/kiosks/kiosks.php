<?php
$role = checkUser($_COOKIE['username']);	
if(!is_numeric(strpos($role,'k'))){
	header("location: kioskcontroller");
}
if(isset($_POST['submitButton'])) {
	switch($_POST['submitButton']) {
		case 'Save':
			$data = array(
				'iPadID' => $_POST['iPadID'],
				'smtpFromEmail' => $_POST['smtpFromEmail'],
				'smtpToEmail' => $_POST['smtpToEmail'],
				'smtpServer' => $_POST['smtpServer'],
				'smtpUserName' => $_POST['smtpUserName'],
				'smtpPassword' => $_POST['smtpPassword'],
				'externalSettingsFile' => $_POST['externalSettingsFile'],
				'description' => $_POST['description'],
				'building'=> $_POST['building'],
				'roomLocation' => $_POST['roomLocation'],
				'settingsShowingOption' => $_POST['settingsShowingOption'],
				'settingsPassCode' => $_POST['settingsPassCode'],
				'customConnectionProblemPage' => $_POST['customConnectionProblemPage'],
				'localSettingsUpdatePeriod' => $_POST['localSettingsUpdatePeriod'],
				'smtpPorts' => $_POST['smtpPorts'],
				'_kp_disableTelLinks_' => $_POST['_kp_disableTelLinks_'],
				'_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_' => $_POST['_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_']
			);
			if($_POST['emailOnPower'] == 'on') {
				$data['emailOnPower'] = 1;
			} else {
				$data['emailOnPower'] = 0;
			}
			if($_POST['smtpRequiresAuth'] == 'on') {
				$data['smtpRequiresAuth'] = 1;
			} else {
				$data['smtpRequiresAuth'] = 0;
			}
			if($_POST['smtpEnableSSL'] == 'on') {
				$data['smtpEnableSSL'] = 1;
			} else {
				$data['smtpEnableSSL'] = 0;
			}
			if($_POST['remoteSettingsEnabled'] == 'on') {
				$data['remoteSettingsEnabled'] = 1;
			} else {
				$data['remoteSettingsEnabled'] = 0;
			}
			if($_POST['showConnectionProblemPage'] == 'on'){
				$data['showConnectionProblemPage'] = 1;
			} else {
				$data['showConnectionProblemPage'] = 0;
			}
			if($_POST['emailOnRemoteSettingsChange'] == 'on'){
				$data['emailOnRemoteSettingsChange'] = 1;
			} else {
				$data['emailOnRemoteSettingsChange'] = 0;
			}
			if($_POST['_kp_disableTelLinks_'] == 'on'){
				$data['_kp_disableTelLinks_'] = 1;
			} else {
				$data['_kp_disableTelLinks_'] = 0;
			}
			if($_POST['_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_'] == 'on'){
				$data['_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_'] = 1;
			} else {
				$data['_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_'] = 0;
			}
			$data['modifiedBy'] = $_COOKIE['username'];
			$data['dateModified'] = date( 'Y-m-d H:i:s', time() );
			
			$wpdb->insert('kiosk',$data);
			break;
		case 'Update':
			$ID = $_POST['ID'];
			$data = array(
				'iPadID' => $_POST['iPadID'],
				'smtpFromEmail' => $_POST['smtpFromEmail'],
				'smtpToEmail' => $_POST['smtpToEmail'],
				'smtpServer' => $_POST['smtpServer'],
				'smtpUserName' => $_POST['smtpUserName'],
				'smtpPassword' => $_POST['smtpPassword'],
				'externalSettingsFile' => $_POST['externalSettingsFile'],
				'description' => $_POST['description'],
				'building'=> $_POST['building'],
				'roomLocation' => $_POST['roomLocation'],
				'settingsShowingOption' => $_POST['settingsShowingOption'],
				'settingsPassCode' => $_POST['settingsPassCode'],
				'customConnectionProblemPage' => $_POST['customConnectionProblemPage'],
				'localSettingsUpdatePeriod' => $_POST['localSettingsUpdatePeriod'],
				'smtpPorts' => $_POST['smtpPorts'],
				'_kp_disableTelLinks_' => $_POST['_kp_disableTelLinks_'],
				'_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_' => $_POST['_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_']
			);
			if($_POST['emailOnPower'] == 'on') {
				$data['emailOnPower'] = 1;
			} else {
				$data['emailOnPower'] = 0;
			}
			if($_POST['smtpRequiresAuth'] == 'on') {
				$data['smtpRequiresAuth'] = 1;
			} else {
				$data['smtpRequiresAuth'] = 0;
			}
			if($_POST['smtpEnableSSL'] == 'on') {
				$data['smtpEnableSSL'] = 1;
			} else {
				$data['smtpEnableSSL'] = 0;
			}
			if($_POST['remoteSettingsEnabled'] == 'on') {
				$data['remoteSettingsEnabled'] = 1;
			} else {
				$data['remoteSettingsEnabled'] = 0;
			}
			if($_POST['showConnectionProblemPage'] == 'on'){
				$data['showConnectionProblemPage'] = 1;
			} else {
				$data['showConnectionProblemPage'] = 0;
			}
			if($_POST['emailOnRemoteSettingsChange'] == 'on'){
				$data['emailOnRemoteSettingsChange'] = 1;
			} else {
				$data['emailOnRemoteSettingsChange'] = 0;
			}
			if($_POST['_kp_disableTelLinks_'] == 'on'){
				$data['_kp_disableTelLinks_'] = 1;
			} else {
				$data['_kp_disableTelLinks_'] = 0;
			}
			if($_POST['_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_'] == 'on'){
				$data['_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_'] = 1;
			} else {
				$data['_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_'] = 0;
			}
			$data['modifiedBy'] = $_COOKIE['username'];
			$data['dateModified'] = date( 'Y-m-d H:i:s', time() );
				
			$wpdb->update('kiosk',$data,array(
				'kiosk_id' => $ID
				));		
			break;
		case 'Delete':
			$ID = $_POST['ID'];
			
			$wpdb->query("DELETE FROM kiosk WHERE kiosk_id = $ID;");
		
			break;	
	}
}




$sql = "CALL getAllKiosks();";

$kiosks = $wpdb->get_results($sql,ARRAY_A);

foreach($kiosks as $kiosk) {
	extract($kiosk);
	$appsOut .= <<<EOT
<tr>
	<td>$iPadID</td>
	<td>$description</td>
	<td>$building</td>
	<td>$roomLocation</td>
	<td>$dateCreated</td>
	<td>$dateModified</td>
	<td>$modifiedBy</td>
	<td><a class="copyLink" dbID="$kiosk_id" style="cursor:pointer">Copy</a> <a class="editLink" dbID="$kiosk_id" style="cursor:pointer">Edit</a> <a class="deleteLink" dbID="$kiosk_id" style="cursor:pointer">Delete</a></td>
</tr>	
EOT;
	
}



?>

<h2>Add New Kiosk</h2>
<form action="kioskcontroller?page=kiosks" method="post" class="form-horizontal">
  <fieldset class="form-group">
    <legend>Settings Menu</legend>
    <label for="settingsShowingOption" class="control-label col-xs-4">Show Settings In-App</label>
    <div class="col-xs-8">
      <select name="settingsShowingOption" id="settingsShowingOption">
        <option value="0">On App Launch</option>
        <option value="1">Never</option>
        <option value="2">On Touch Gesture and Passcode</option>
      </select>
    </div>
    <label for="settingsPassCode" class="control-label col-xs-4">Passcode</label>
    <div class="col-xs-8">
      <input type="text" name="settingsPassCode" id="settingsPassCode" />
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>General</legend>
    <label for="iPadID" class="control-label col-xs-4">Unique iPad ID</label>
    <div class="col-xs-8">
      <input name="iPadID" id="iPadID" type="text" />
    </div>
    <label for="description" class="control-label col-xs-4">Description</label>
    <div class="col-xs-8">
      <input name="description" id="description" type="text" />
    </div>
    <label for="building" class="control-label col-xs-4">Building</label>
    <div class="col-xs-8">
      <input name="building" id="building" type="text" />
    </div>
    <label for="roomLocation" class="control-label col-xs-4">Room/Location</label>
    <div class="col-xs-8">
      <input name="roomLocation" id="roomLocation" type="text" />
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>Network Access</legend>
    <label for="showConnectionProblemPage" class="control-label col-xs-4">Detect Connection Errors</label>
    <div class="col-xs-8">
      <input type="checkbox" name="showConnectionProblemPage" id="showConnectionProblemPage" checked />
    </div>
    <label for="customConnectionProblemPage" class="control-label col-xs-4">Custom Connection Problem Page</label>
    <div class="col-xs-8">
      <input type="text" name="customConnectionProblemPage" id="customConnectionProblemPage" />
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>Notifications</legend>
    <label for="emailOnPower" class="control-label col-xs-4">Email on Power Supply Change</label>
    <div class="col-xs-8">
      <input type="checkbox" name="emailOnPower" id="emailOnPower" />
    </div>
    <label for="emailOnRemoteSettingsChange" class="control-label col-xs-4">Email on Remote Settings Change</label>
    <div class="col-xs-8">
      <input type="checkbox" name="emailOnRemoteSettingsChange" id="emailOnRemoteSettingsChange" />
    </div>
    <label for="smtpFromEmail" class="control-label col-xs-4">From E-mail</label>
    <div class="col-xs-8">
      <input type="text" name="smtpFromEmail" id="smtpFromEmail" />
    </div>
    <label for="smtpToEmail" class="control-label col-xs-4">To E-mail</label>
    <div class="col-xs-8">
      <input type="text" name="smtpToEmail" id="smtpToEmail" />
    </div>
    <label for="smtpServer" class="control-label col-xs-4">SMTP Server</label>
    <div class="col-xs-8">
      <input type="text" name="smtpServer" id="smtpServer" />
    </div>
    <label for="smtpRequiresAuth" class="control-label col-xs-4">Requires Authentication</label>
    <div class="col-xs-8">
      <input type="checkbox" name="smtpRequiresAuth" id="smtpRequiresAuth" />
    </div>
    <label for="smtpUserName" class="control-label col-xs-4">User Name</label>
    <div class="col-xs-8">
      <input type="text" name="smtpUserName" id="smtpUserName" />
    </div>
    <label for="smtpPassword" class="control-label col-xs-4">Password</label>
    <div class="col-xs-8">
      <input type="text" name="smtpPassword" id="smtpPassword" />
    </div>
    <label for="smtpEnableSSL" class="control-label col-xs-4">Enable SSL</label>
    <div class="col-xs-8">
      <input type="checkbox" name="smtpEnableSSL" id="smtpEnableSSL" />
    </div>
    <label for="smtpPorts" class="control-label col-xs-4">SMTP Ports</label>
    <div class="col-xs-8">
      <input type="text" name="smtpPorts" id="smtpPorts" />
    </div>
  </fieldset>
  <fieldset class="form-group">
    <legend>Remote Settings Control</legend>
    <label for="remoteSettingsEnabled" class="control-label col-xs-4">Enable</label>
    <div class="col-xs-8">
      <input type="checkbox" name="remoteSettingsEnabled" id="remoteSettingsEnabled" checked />
    </div>
    <label for="externalSettingsFile" class="control-label col-xs-4">XML File Location</label>
    <div class="col-xs-8">
      <input type="text" name="externalSettingsFile" id="externalSettingsFile" />
    </div>
    <label for="localSettingsUpdatePeriod" class="control-label col-xs-4">Update Period (minutes)</label>
    <div class="col-xs-8">
      <input type="text" name="localSettingsUpdatePeriod" id="localSettingsUpdatePeriod" />
    </div>
  </fieldset>
  <fieldset class="form-group">
  	<legend>Special Not Included In Menu Settings</legend>
    <label for="_kp_disableTelLinks_" class="control-label col-xs-4">Allow disabling of tel:// links</label>
    <div class="col-xs-8">
      <input type="checkbox" name="_kp_disableTelLinks_" id="_kp_disableTelLinks_" checked />
    </div>
    <label for="_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_" class="control-label col-xs-4">Allow disabling of default callout on touch and hold</label>
    <div class="col-xs-8">
      <input type="checkbox" name="_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_" id="_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_" checked />
    </div>
  </fieldset>
  <input type="hidden" value="" name="ID" id="ID" />
  <input type="reset" value="Cancel" id="reset" class="btn" />
  <input type="submit" value="Save" id="submitButton" name="submitButton" class="btn btn-primary" />
</form>
<h2>Defined Kiosks</h2>
<table border="1" class="table">
  <tr>
    <th>iPad ID</th>
    <th>Description</th>
    <th>Building</th>
    <th>Room/Location</th>
    <th>Date Created</th>
    <th>Date Modified</th>
    <th>Modified By</th>
    <th>Actions</th>
  </tr>
  <?php echo($appsOut); ?>
</table>
<script type="text/javascript" language="javascript">
	function isUndefined(x) {var u; return x === u;}

	var $j = jQuery.noConflict();
	
	$j(function() {
		$j(".datetimepicker").datetimepicker({
			showSecond: false,
			timeFormat: 'hh:mm:ss',
			dateFormat: 'yy-mm-dd'
		});
		
		$j('.copyLink').click(function(){
			var curID = $j(this).attr('dbID');
			$j.getJSON('kioskdetails',
				{
					ID: curID
				},
				function(data){
					if(isUndefined(data)){
						return false;	
					}
					if(data[0].emailOnPower == '1'){
						$j('#emailOnPower').attr('checked',true);
					} else {
						$j('#emailOnPower').attr('checked',false);
					}
					if(data[0].requiresAuth =='1'){
						$j('#requiresAuth').attr('checked',true);
					} else {
						$j('#requiresAuth').attr('checked',false);
					}
					if(data[0].smtpEnableSSL =='1'){
						$j('#smtpEnableSSL').attr('checked',true);
					} else {
						$j('#smtpEnableSSL').attr('checked',false);
					}
					if(data[0].remoteSettingsEnabled =='1'){
						$j('#remoteSettingsEnabled').attr('checked',true);
					} else {
						$j('#remoteSettingsEnabled').attr('checked',false);
					}
					if(data[0].showConnectionProblemPage =='1'){
						$j('#showConnectionProblemPage').attr('checked',true);
					} else {
						$j('#showConnectionProblemPage').attr('checked',false);
					}
					if(data[0].emailOnRemoteSettingsChange =='1'){
						$j('#emailOnRemoteSettingsChange').attr('checked',true);
					} else {
						$j('#emailOnRemoteSettingsChange').attr('checked',false);
					}
					if(data[0]._kp_disableTelLinks_ =='1'){
						$j('#_kp_disableTelLinks_').attr('checked',true);
					} else {
						$j('#_kp_disableTelLinks_').attr('checked',false);
					}
					if(data[0]._kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_ =='1'){
						$j('#_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_').attr('checked',true);
					} else {
						$j('#_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_').attr('checked',false);
					}
					$j('#iPadID').val(data[0].iPadID);
					$j('#smtpFromEmail').val(data[0].smtpFromEmail);
					$j('#smtpToEmail').val(data[0].smtpToEmail);
					$j('#smtpServer').val(data[0].smtpServer);
					$j('#smtpUserName').val(data[0].smtpUserName);
					$j('#smtpPassword').val(data[0].smtpPassword);
					$j('#externalSettingsFile').val(data[0].externalSettingsFile);
					$j('#description').val(data[0].description);
					$j('#building').val(data[0].building);
					$j('#roomLocation').val(data[0].roomLocation);
					$j('#settingsShowingOption').val(data[0].settingsShowingOption);
					$j('#settingsPassCode').val(data[0].settingsPassCode);
					$j('#customConnectionProblemPage').val(data[0].customConnectionProblemPage);
					$j('#localSettingsUpdatePeriod').val(data[0].localSettingsUpdatePeriod);
					$j('#smtpPorts').val(data[0].smtpPorts);
				});
			});
		
		$j('.editLink').click(function(){
			var curID = $j(this).attr('dbID');
			$j.getJSON('kioskdetails',
				{
					ID: curID
				},
				function(data){
					if(isUndefined(data)){
						return false;	
					}
					if(data[0].emailOnPower == '1'){
						$j('#emailOnPower').attr('checked',true);
					} else {
						$j('#emailOnPower').attr('checked',false);
					}
					if(data[0].requiresAuth =='1'){
						$j('#requiresAuth').attr('checked',true);
					} else {
						$j('#requiresAuth').attr('checked',false);
					}
					if(data[0].smtpEnableSSL =='1'){
						$j('#smtpEnableSSL').attr('checked',true);
					} else {
						$j('#smtpEnableSSL').attr('checked',false);
					}
					if(data[0].remoteSettingsEnabled =='1'){
						$j('#remoteSettingsEnabled').attr('checked',true);
					} else {
						$j('#remoteSettingsEnabled').attr('checked',false);
					}
					if(data[0].showConnectionProblemPage =='1'){
						$j('#showConnectionProblemPage').attr('checked',true);
					} else {
						$j('#showConnectionProblemPage').attr('checked',false);
					}
					if(data[0].emailOnRemoteSettingsChange =='1'){
						$j('#emailOnRemoteSettingsChange').attr('checked',true);
					} else {
						$j('#emailOnRemoteSettingsChange').attr('checked',false);
					}
					if(data[0]._kp_disableTelLinks_ =='1'){
						$j('#_kp_disableTelLinks_').attr('checked',true);
					} else {
						$j('#_kp_disableTelLinks_').attr('checked',false);
					}
					if(data[0]._kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_ =='1'){
						$j('#_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_').attr('checked',true);
					} else {
						$j('#_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_').attr('checked',false);
					}
					$j('#iPadID').val(data[0].iPadID);
					$j('#smtpFromEmail').val(data[0].smtpFromEmail);
					$j('#smtpToEmail').val(data[0].smtpToEmail);
					$j('#smtpServer').val(data[0].smtpServer);
					$j('#smtpUserName').val(data[0].smtpUserName);
					$j('#smtpPassword').val(data[0].smtpPassword);
					$j('#externalSettingsFile').val(data[0].externalSettingsFile);
					$j('#description').val(data[0].description);
					$j('#building').val(data[0].building);
					$j('#roomLocation').val(data[0].roomLocation);
					$j('#settingsShowingOption').val(data[0].settingsShowingOption);
					$j('#settingsPassCode').val(data[0].settingsPassCode);
					$j('#customConnectionProblemPage').val(data[0].customConnectionProblemPage);
					$j('#localSettingsUpdatePeriod').val(data[0].localSettingsUpdatePeriod);
					$j('#smtpPorts').val(data[0].smtpPorts);
					$j('#ID').val(data[0].kiosk_id);
					$j('#submitButton').val('Update');
				});
		});
		
		$j('.deleteLink').click(function(){
			var curID = $j(this).attr('dbID');
			$j.getJSON('kioskdetails',
				{
					ID: curID
				},
				function(data){
					if(isUndefined(data)){
						return false;	
					}
					$j('#ID').val(data[0].kiosk_id);
					$j('#submitButton').val('Delete');
					if(confirm("Are you sure you want to delete this kiosk?")){
						$j('#submitButton').click();
					}
					return false;
			});
		});
	});


</script>