<?php
require_once '../lib/ajax_chat.php';

$db = getConnection();
if($_SESSION['user_id'] == null) {
	header('Location: index.php');
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"; "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<title>Ajax Chat</title>
<style type="text/css">
table#messages tr {
	vertical-align: top;
}

td.time {
  width: 200px;
  text-align: right;
  padding: 2px;
}

td.username {
  width: 200px;
  text-align: right;
  font-weight: bold;
  padding: 2px;
  padding-right: 5px;
} 

td.message  {
	width: 300px;
  padding: 2px;
}
</style>
<script src="/javascript/prototype.js" type="text/javascript"></script>
<script src="/javascript/scriptaculous/scriptaculous.js" type="text/javascript"></script>
<script src="/javascript/scriptaculous/effects.js" type="text/javascript"></script>
<script type="text/javascript">
last_msg_id = 0;

function updateRequest() {
	new Ajax.Request('update.php', 
		{ 
			onSuccess: function(transport) { addMessages(eval(transport.responseText)); }, 
			parameters: { last_msg_id: last_msg_id } 
		}
	);
}

function addMessages(messages) {
	if(messages != undefined) {
		for(i = messages.length - 1; i >= 0; i--) {
			message = messages[i];
			element_id = 'message_' + message['id'];
			new Insertion.Top('messages',
				'<tr id="' + element_id + '">' 
				+ '<td class="time">' + message['create_time'] + '</td>'  
				+ '<td class="username">' + message['username'] + ':</td>' 
				+ '<td class="message">' + message['message'] + '</td>' 
				+ '</tr');
			
			new Effect.Highlight(element_id, {});
			if(last_msg_id < parseInt(message['id'])) {
				last_msg_id = parseInt(message['id']);
			}
		}
	}
	
	setTimeout("updateRequest()", 2000);
}

updateRequest();
</script>
</head> 
<body>
<div id="script_updates"></div>
<h1>Ajax Chat</h1>
<div style="padding-bottom: 10px;">
Logged in as: <span style="font-weight: bold;"><?=$_SESSION['username']?></span> [<a href="logout.php">Logout</a>]
</div>
<form action="post.php" method="post" onsubmit="new Ajax.Request('post_submit.php', {asynchronous:true, parameters:Form.serialize(this)}); this.message.value = ''; return false;">
<input type="text" name="message" size="60" maxlength="256"/>
<input type="submit" value="Post"/>
</form>

<table id="messages" cellspacing="0" cellpadding="0"s>
</table>

</body>  
</html>

<?php 
}
mysql_close($db); 
?>
