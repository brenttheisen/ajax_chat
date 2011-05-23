<?php

require_once '../lib/ajax_chat.php';

$db = getConnection();
if($_SESSION['user_id'] == null) {
?>
<script type="text/javascript">
window.location='index.php';
</script>
<?php
} else {
	postMessage($db, $_SESSION['user_id'], $_REQUEST['message']);
}
mysql_close($db);
?>
