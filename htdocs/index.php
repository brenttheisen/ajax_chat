<?php
require_once '../lib/ajax_chat.php';

$db = getConnection();
if($_SESSION['user_id'] != null) {
	header('Location: chat.php');
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"; "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<title>Ajax Chat - Login</title>
<style type="text/css">
div.row {
  clear: both;
  width: 250px;
  padding-top: 3px;
}

div.row label {
  float: left;
  width: 100px;
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
<h1>Login</h1>
<a href="create_account.php">Create an account</a>
<div id="messages" style="color: red; margin-bottom: 10px; margin-top: 10px;"></div>
<form action="login_submit.php" method="post" onsubmit="new Ajax.Updater('messages', 'login_submit.php', {asynchronous:true, evalScripts:true, parameters:Form.serialize(this)}); return false;">
<div class="row">
<label for="username">Username:</label>
<span class="field"><input type="text" name="username" size="10"/></span>
</div>
<div class="row">
<label for="password">Password:</label>
<span class="field"><input type="password" name="password" size="10"/></span>
</div>
<div class="row"/>
<br/>
<input type="submit" value="Login"/>
</form>
</div>

</body>  
</html>

<?php 
}
mysql_close($db); 
?>
  