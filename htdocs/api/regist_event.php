<?php
  //DB関連
  require_once("./send_sql.php");
  $sql = "select * from event";
  $res = send_sql($sql);

  //POSTデータ処理
  if ($_SERVER['REQUEST_METHOD']==='POST'){
    $event = $_POST['event'];
  }
?>

<html>
<head>
<meta http-equiv=content-type content="text/html; charset=UTF-8">
<title>PHPtest</title>
</head>
<body>
  <?php
  while ($item = mysql_fetch_array($res)) {
		print $item[0]." ".$item[1]."<br>";
	}
  echo $event;
  ?>
</body>
</html>
