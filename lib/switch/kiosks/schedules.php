<?php
$role = checkUser($_COOKIE['username']);	
if(!is_numeric(strpos($role,'d'))){
	header("location: kioskcontroller");
}
if(isset($_POST['submitButton'])) {
	switch($_POST['submitButton']) {
		case 'Save':
			$data = array(
				'kiosk_id' => $_POST['kioskID'],
				'application_id' => $_POST['applicationID'],
				'frequency' => $_POST['frequency'],
				'month' => $_POST['month'],
				'day' => $_POST['day'],
				'date' => $_POST['date'],
				'hour' => $_POST['hour'],
				'minute' => $_POST['minute']
			);
			$data['createdBy'] = $_COOKIE['username'];
			$data['modifiedBy'] = $_COOKIE['username'];
			$data['createTimestamp'] = date( 'Y-m-d H:i:s', time() );
			$data['modifiedTimestamp'] = date( 'Y-m-d H:i:s', time() );
			
			$wpdb->insert('kiosk_application_schedule',$data);
			
			break;
		case 'Update':
			$ID = $_POST['ID'];
			$data = array(
				'kiosk_id' => $_POST['kioskID'],
				'application_id' => $_POST['applicationID'],
				'frequency' => $_POST['frequency'],
				'month' => $_POST['month'],
				'day' => $_POST['day'],
				'date' => $_POST['date'],
				'hour' => $_POST['hour'],
				'minute' => $_POST['minute']
			);
			
			$data['modifiedBy'] = $_COOKIE['username'];
				
			$wpdb->update('kiosk_application_schedule',$data,array(
				'kiosk_application_schedule_id' => $ID
				));
			
			
			break;
		case 'Delete':
			$ID = $_POST['ID'];
			
			$wpdb->query("DELETE FROM kiosk_application_schedule WHERE kiosk_application_schedule_id = $ID;");
			break;	
	}
}




$sql = "SELECT kas.*, 
  k.description AS kioskDescription, 
  k.building, 
  k.roomLocation, 
  a.description AS applicationDescription, 
  k.iPadID
FROM kiosk_application_schedule kas
	INNER JOIN kiosk k ON k.kiosk_id = kas.kiosk_id
	INNER JOIN application a ON a.application_id = kas.application_id
	ORDER BY frequency, day, date, hour, minute, building, iPadID, roomLocation";
$schedules = $wpdb->get_results($sql,ARRAY_A);

$days = array(1=>'Sun',2=>'Mon',3=>'Tue',4=>'Wed',5=>'Thu',6=>'Fri',7=>'Sat');
$months = array(1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
$hours = array(0=>'Midnight',1=>'1a',2=>'2a',3=>'3a',4=>'4a',5=>'5a',6=>'6a',7=>'7a',8=>'8a',9=>'9a',10=>'10a',11=>'11a',
				12=>'Noon',13=>'1p',14=>'2p',15=>'3p',16=>'4p',17=>'5p',18=>'6p',19=>'7p',20=>'8p',21=>'9p',22=>'10p',23=>'11p');
$frequencies = array('w'=>'Weekly','m'=>'Monthly','d'=>'Daily','q'=>'Quarterly','y'=>'Yearly');

foreach($schedules as $schedule) {
	extract($schedule);
	$appsOut .= <<<EOT
<tr>
	<td>$iPadID - $kioskDescription <br> $roomLocation</td>
	<td>$applicationDescription</td>
	<td>$frequencies[$frequency]</td>
	<td>$months[$month]</td>
	<td>$days[$day]</td>
	<td>$date</td>
	<td>$hours[$hour]</td>
	<td>$minute</td>
	<td>$modifiedBy</td>
	<td><a class="copyLink" dbID="$kiosk_application_schedule_id" style="cursor:pointer">Copy</a> <a class="editLink" dbID="$kiosk_application_schedule_id" style="cursor:pointer">Edit</a> <a class="deleteLink" dbID="$kiosk_application_schedule_id" style="cursor:pointer">Delete</a></td>
</tr>	
EOT;
	
}



?>

<h2>Add/Edit Schedule</h2>
<form action="kioskcontroller?page=schedules" method="post" class="form-horizontal">
	<fieldset class="form-group">
    	<legend>Schedules</legend>
            	<label for="kioskID" class="control-label col-xs-4">Kiosk</label>
            	<div class="col-xs-8"><select name="kioskID" id="kioskID">
                	<option selected />
<?php  
	$sql = "SELECT kiosk_id, iPadID, description, roomLocation, building FROM kiosk ORDER BY building, iPadID";
	$kiosks = $wpdb->get_results($sql,ARRAY_A);
	foreach($kiosks AS $kiosk) {
		extract($kiosk);
?>
					<option value="<?php echo($kiosk_id); ?>"><?php echo($iPadID.' - '.$description.' - '.$roomLocation.' - '.$building); ?></option>
<?php	
	}
?>
                </select></div>
           
            	<label for="applicationID" class="control-label col-xs-4">Application</label>
            	<div class="col-xs-8"><select name="applicationID" id="applicationID">
                	<option selected />
<?php  
	$sql = "SELECT application_id, description FROM application";
	$applications = $wpdb->get_results($sql,ARRAY_A);
	foreach($applications AS $application) {
		extract($application);
?>
					<option value="<?php echo($application_id); ?>"><?php echo($description); ?></option>
<?php	
	}
?>
                </select></div>
          
            	<label for="frequency" class="control-label col-xs-4">Frequency</label>
                <div class="col-xs-8"><select name="frequency" id="frequency">
                	<option selected />
                	<option value="d">Daily</option>
                    <option value="w">Weekly</option>
                    <option value="m">Monthly</option>
                    <option value="q">Quarterly</option>
                    <option value="y">Yearly</option>
                </select></div>
           
            	<label for="month" class="control-label col-xs-4">Month</label>
                <div class="col-xs-8"><select name="month" id="month">
                	<option selected />
                	<option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select></div>
            
            	<label for="day" class="control-label col-xs-4">Day</label>
                <div class="col-xs-8"><select name="day" id="day">
               	  <option selected />
                	<option value="1">Sunday</option>
                    <option value="2">Monday</option>
                    <option value="3">Tuesday</option>
                    <option value="4">Wednesday</option>
                    <option value="5">Thursday</option>
                    <option value="6">Friday</option>
                    <option value="7">Saturday</option>
                </select></div>
            <label for="date" class="control-label col-xs-4">Day of the Month</label><div class="col-xs-8"><input type="text" name="date" id="date" /></div>
           	  <label for="hour" class="control-label col-xs-4">Hour</label>
          <div class="col-xs-8"><select name="hour" id="hour">
                	<option selected />
                    <option value="0">Midnight</option>
                	<option value="1">1a</option>
                    <option value="2">2a</option>
                    <option value="3">3a</option>
                    <option value="4">4a</option>
                    <option value="5">5a</option>
                    <option value="6">6a</option>
                    <option value="7">7a</option>
                    <option value="8">8a</option>
                    <option value="9">9a</option>
                    <option value="10">10a</option>
                    <option value="11">11a</option>
                    <option value="12">Noon</option>
                    <option value="13">1p</option>
            		<option value="14">2p</option>
                    <option value="15">3p</option>
                    <option value="16">4p</option>
                    <option value="17">5p</option>
                    <option value="18">6p</option>
                    <option value="19">7p</option>
                    <option value="20">8p</option>
                    <option value="21">9p</option>
                    <option value="22">10p</option>
                    <option value="23">11p</option>
                </select></div>
            <label for="minute" class="control-label col-xs-4">Minute of the Hour</label><div class="col-xs-8"><input type="text" name="minute" id="minute" /></div>
    </fieldset>
    <input type="hidden" value="" name="ID" id="ID" />
    <input type="reset" value="Cancel" id="reset" class="btn" /> <input type="submit" value="Save" id="submitButton" name="submitButton" class="btn btn-primary" />
</form>

<h2>Defined Schedules</h2>
<table border="1" class="table">
	<tr>
		<td>Kiosk</td><td>Application</td><td>Frequency</td><td>Month</td><td>Day</td><td>Date</td><td>Hour</td><td>Minute</td><td>Modified By</td><td>Actions</td>
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
			$j.getJSON('scheduledetails',
				{
					ID: curID
				},
				function(data){
					if(isUndefined(data)){
						return false;	
					}
					$j('#kioskID').val(data[0].kiosk_id);
					$j('#applicationID').val(data[0].application_id);
					$j('#frequency').val(data[0].frequency);
					$j('#month').val(data[0].month);
					$j('#day').val(data[0].day);
					$j('#date').val(data[0].date);
					$j('#hour').val(data[0].hour);
					$j('#minute').val(data[0].minute);
				});
			});
		
		$j('.editLink').click(function(){
			var curID = $j(this).attr('dbID');
			$j.getJSON('scheduledetails',
				{
					ID: curID
				},
				function(data){
					if(isUndefined(data)){
						return false;	
					}
					$j('#kioskID').val(data[0].kiosk_id);
					$j('#applicationID').val(data[0].application_id);
					$j('#frequency').val(data[0].frequency);
					$j('#month').val(data[0].month);
					$j('#day').val(data[0].day);
					$j('#date').val(data[0].date);
					$j('#hour').val(data[0].hour);
					$j('#minute').val(data[0].minute);
					$j('#ID').val(data[0].kiosk_application_schedule_id);
					$j('#submitButton').val('Update');
				});
		});
		
		$j('.deleteLink').click(function(){
			$j('#ID').val($j(this).attr('dbID'));
			$j('#submitButton').val('Delete');
			if(confirm("Are you sure you want to delete this schedule?")){
				$j('#submitButton').click();
			}
			return false;
		});
	});


</script>
