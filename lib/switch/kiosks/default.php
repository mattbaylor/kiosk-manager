<?php 
$sql = "CALL getAllCurrentSettings();";


$curSettings = $wpdb->get_results($sql,ARRAY_A);
foreach($curSettings as $row) {
	extract($row);
	$ret .= "<li id=\"$iPadID\"><a href=\"kioskcontroller?page=kioskSettings&iPadID=$iPadID\">$iPadID - $description Currently running: $applicationDescription Since: $activeTime</a></li>";	
}
?>
<h2>Click to manage</h2>
<p>
<ul>
<?php echo($ret); ?>
</ul>
</p>