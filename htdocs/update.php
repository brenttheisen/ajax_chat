<?php

require_once '../lib/ajax_chat.php';
$db = getConnection();

$last_msg_id = 0;
if($_REQUEST['last_msg_id'] != null) {
	$last_msg_id = $_REQUEST['last_msg_id'];
}

$messages = updateMessages($db, $last_msg_id);
?>
new Array(
<?php
$first = true;
foreach($messages as $message)
{
	if(!$first) {
		echo ", ";
	} else {
		$first = false;
	}
?>
{ id: <?php echo $message['id'] ?>, username: '<?php echo addslashes($message['username']) ?>', message: '<?php echo addslashes($message['message']) ?>', create_time: '<?php echo $message['create_time'] ?>' }
<?php } ?>
);

<?php
mysql_close($db); 
?>
