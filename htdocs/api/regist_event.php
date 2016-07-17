<?php
  //POSTデータ処理
  if ($_SERVER['REQUEST_METHOD']==='POST'){
    $event_name = $_POST['event_name'];
    $place = $_POST['place'];
    $comment = $_POST['comment'];
    $item = $_POST['item'];
  }
  //DB関連
  require_once("./send_sql.php");
  $sql_event = "INSERT INTO ccdb.event(event_name, place, comment)
          VALUES($event_name, $place, $comment)";

  $sql_candi = "INSERT INTO ccdb.candi(item)
          VALUES($item)";

  $res_event = "";
  $res_candi = "";
  try {
    $res_event = send_sql($sql_event);
    $res_candi = send_sql($sql_candi);
  } catch (Exception $e) {
    throw new Exception($e->getMessage());
  }
?>

<html>
<head>
<meta http-equiv=content-type content="text/html; charset=UTF-8">
<title>PHPtest</title>
</head>
<body>
  <?php
  while ($test_event = mysql_fetch_array($res_event)) {
		print $test_event[0]." ".$test_event[1]."<br>";
	}
  echo $event_name;


  ?>
</body>
</html>
