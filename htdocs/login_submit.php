<?php 
require_once '../lib/ajax_chat.php';

$db = getConnection();
if(authUser($db, $_REQUEST['username'], $_REQUEST['password'])) {
?>
<script type="text/javascript">
window.location='chat.php';
</script>
<?php } else { ?>
The username and/or password is incorrect.
<script type="text/javascript">
new Effect.Highlight("messages", {});
</script>
<?php 
} 
mysql_close($db);
?>
