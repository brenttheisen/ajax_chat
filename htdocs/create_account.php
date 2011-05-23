<?php
require_once '../lib/ajax_chat.php';

$db = getConnection();
if($_COOKIE['username'] != null && userExists($db, $_COOKIE['username'])) {
	header('Location: chat.php');
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"; "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<title>Ajax Chat - Create Account</title>
<style type="text/css">
div.row {
  clear: both;
  width: 400px;
  padding-top: 3px;
}

div.row label {
  float: left;
  width: 200px;
  text-align: right;
}

div.row span.field {
  float: left;
  width: 100px;
  text-align: left;
  padding-left: 10px;
} 
</style>
<script src="/javascript/prototype.js" type="text/javascript"></script>
<script src="/javascript/scriptaculous/scriptaculous.js" type="text/javascript"></script>
<script src="/javascript/scriptaculous/effects.js" type="text/javascript"></script>
</head> 
<body>
<div>
<h1>Create an Account</h1>
<form action="create_account_submit.php" method="post" onsubmit="new Ajax.Updater('messages', 'create_account_submit.php', {asynchronous:true, evalScripts:true, parameters:Form.serialize(this)}); return false;">
<div id="messages" style="color: red; margin-bottom: 10px;"></div>
<div class="row">
<label for="username">Username:</label>
<span class="field"><input type="text" name="username" size="10"/></span>
</div>
<div class="row">
<label for="password">Password:</label>
<span class="field"><input type="password" name="password" size="10"/></span>
</div>
<div class="row">
<label for="password">Confirm Password:</label>
<span class="field"><input type="password" name="password2" size="10"/></span>
</div>
<div class="row" style="padding-top: 10px;"/>
<input type="submit" value="Create Account"/>
</div>
</form>
</div>

</body>  
</html>

<?php 
}
mysql_close($db); 
?>
  