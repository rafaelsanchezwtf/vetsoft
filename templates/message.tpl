<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/dialog.css">
<script src="js/dialog.js"></script>
</head>
<body>
<div id="dialogoverlay"></div>
<div id="dialogbox">
  <div>
    <div id="dialogboxhead"></div>
    <table id="t01" width="100%" border="0" cellpadding="0" cellspacing="5">
		<tr>
		<td width="10%"><i class="fa fa-{$msg_icon} fa-3x"></td><td width="90%"><div id="dialogboxbody"></div></td>
		</tr>		
	</table>
    <div id="dialogboxfoot"></div>
  </div>
</div>
&nbsp
<script type="text/javascript">Alert.render("{$msg_type}","{$msg_content}","{$msg_dir}")</script>
</body>
</html>