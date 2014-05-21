#!/usr/bin/php
<?php
//ini_set('display_errors',1);
//$__template = "none";
//set up database connection
$link = mysql_connect('localhost', 'app', 'w00dv@l');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db('app', $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}

//find all the changes that need to be written
$sql = "
/* Weekly Schedules */
INSERT INTO kioskSettings(kioskID, appID, dateCreated, dateModified, modifiedBy, activeTime, xmlWritten)
  SELECT kioskID, applicationID AS appID, NOW() AS dateCreated, NOW() AS dateModified, 'kioskSchedule' as modifiedBy, NOW() AS activeTime, 0 as xmlWritten
  FROM kioskSchedule
  WHERE frequency = 'W'
    AND day = DAYOFWEEK(NOW())
    AND hour = HOUR(NOW())
    AND minute = MINUTE(NOW());
";

$sql2 = "
/* Daily Schedules */
INSERT INTO kioskSettings(kioskID, appID, dateCreated, dateModified, modifiedBy, activeTime, xmlWritten)
  SELECT kioskID, applicationID AS appID, NOW() AS dateCreated, NOW() AS dateModified, 'kioskSchedule' as modifiedBy, NOW() AS activeTime, 0 as xmlWritten
  FROM kioskSchedule
  WHERE frequency = 'D'
    AND hour = HOUR(NOW())
    AND minute = MINUTE(NOW());
";

$sql3 = "
/* Monthly Schedules */
INSERT INTO kioskSettings(kioskID, appID, dateCreated, dateModified, modifiedBy, activeTime, xmlWritten)
  SELECT kioskID, applicationID AS appID, NOW() AS dateCreated, NOW() AS dateModified, 'kioskSchedule' as modifiedBy, NOW() AS activeTime, 0 as xmlWritten
  FROM kioskSchedule
  WHERE frequency = 'M'
    AND date = DAY(NOW())
    AND hour = HOUR(NOW())
    AND minute = MINUTE(NOW());
";

$sql4 = "
/* Annual Schedules */
INSERT INTO kioskSettings(kioskID, appID, dateCreated, dateModified, modifiedBy, activeTime, xmlWritten)
  SELECT kioskID, applicationID AS appID, NOW() AS dateCreated, NOW() AS dateModified, 'kioskSchedule' as modifiedBy, NOW() AS activeTime, 0 as xmlWritten
  FROM kioskSchedule
  WHERE frequency = 'M'
    AND month = MONTH(NOW())
    AND date = DAY(NOW())
    AND hour = HOUR(NOW())
    AND minute = MINUTE(NOW());
";

// Perform Query
$result = mysql_query($sql,$link);

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $sql;
    die($message);
}
// Perform Query
$result = mysql_query($sql2,$link);

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $sql;
    die($message);
}
// Perform Query
$result = mysql_query($sql3,$link);

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $sql;
    die($message);
}
// Perform Query
$result = mysql_query($sql4,$link);

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $sql;
    die($message);
}



mysql_close($link);
?>