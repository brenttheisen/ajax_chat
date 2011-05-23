<?php
require_once '../lib/ajax_chat.php';

$db = getConnection();
$username = trim($_REQUEST['username']);
$password = $_REQUEST['password'];
$password2 = $_REQUEST['password2'];

$errors = array();
if(userExists($db, $username)) {
	$errors[] = 'Username already exists.';
}
if(strlen($username) < 4) {
    $errors[] = 'Username must be at least 4 characters long.';
}
if(strlen($password) < 4) {
    $errors[] = 'Password must be at least 4 characters long.';
} else if($password != $password2) {
    $errors[] = 'Password and Confirm Password must match.' . $password . ' ' . $password2;
}

if(count($errors) > 0) {
?>
Please fix the following errors:
<ul>
<?php foreach($errors as $error) { ?>
<li><?php echo $error?></li>
<?php } ?>
</ul>
<script type="text/javascript">
new Effect.Highlight("messages", {});
</script>
<?php 
} else { 
	$password_hash = sha1($password);
	$id = createUser($db, $username, $password);
?>
<script type="text/application">
window.location='chat.php';
</script>
<?php
}
mysql_close($db);
?>
