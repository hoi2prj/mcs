<?php
  //POSTデータ処理
  if ($_SERVER['REQUEST_METHOD']==='GET'){
    $event_id = $_GET['id'];
  }
  //DB関連
  require_once("./send_sql.php");
  $sql_event = "SELECT * FROM event WHERE event_id = $event_id";
  $res_event = send_sql($sql_event);

?>

<html>
<head>
<meta http-equiv=content-type content="text/html; charset=UTF-8">
<title>調整ちゃん</title>
</head>
<body>
  <?php
  while ($event = mysql_fetch_array($res_event)) {
		print $event['event_name']." ".$event['comment']."<br>";
	}
  ?>
</body>
</html>
