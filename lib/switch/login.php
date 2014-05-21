<?php
//ini_set('display_errors',1);
$__template = "bootstrap";
if(isset($_POST['username'])) {
	//authenticate and redirect to list of kiosks, or display error on login screen
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(authUser($username,$password)=='authorized') {
		header("location: kioskcontroller");
	} else {
		$error = authUser($username,$password);
	}
}
/*
<style>
body {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
}
fieldset {
	float: left;
	clear: left;
	width: 100%;
	margin: 0 0 1.5em 0;
	padding: 0;
	border:none;
}
legend {
	margin-left: 1em;
	color: #000000;
	font-weight: bold;
}
fieldset ol {
	padding: 1em 1em 0 1em;
	list-style: none;
}
fieldset li {
	float: left;
	clear: left;
	width: 100%;
	padding-bottom: 1em;
}
fieldset.submit {
	float: none;
	width: auto;
	border: 0 none #FFF;
	padding-left: 12em;
}
label {
	color: #000000;
	font-size: 8pt;
	font-weight: normal;
	float: left;
	width: 10em;
	margin-right: 1em;
}
.tightCheckBoxLabel {
	float:none;
	margin-left: 3em;
}
#formWrapper {
	width:525px;
}
textarea {
	height:175px;
	width:350px;
}
input[type=text] {
	width:200px;
}
select {
	width:200px;
}
.hidden {
	display:none;
}
#formWrapper .error {
	border: 1px solid red;
}
#formWrapper label.error, #formWrapper .showRequired, #error {
	color: red;
	float: none;
	margin-left: 1em;
	position: absolute;
	border:none;
}
#formWrapper .showRequired {
	color:inherit
}
</style>
*/
?>
<div id="formWrapper">
	<h2>Login</h2>
	<div id="error"><?php if(isset($error)){echo($error);} ?></div>
    <form id="loginForm" method="post" action="login" class="form-horizontal">
        <fieldset class="form-group">
            <label for="username" class="control-label col-xs-2">Username: </label><div class="col-xs-10"><input name="username" id="username" type="text" /></div>
                <label for="password" class="control-label col-xs-2">Password: </label><div class="col-xs-10"><input name="password" id="password" type="password" /></div>
                <input type="submit" name="submit" id="submit" value="Submit"  class="btn btn-primary" />
        </fieldset>
    </form>
</div>