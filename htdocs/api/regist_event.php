<?php
  //POSTデータ処理
  if ($_SERVER['REQUEST_METHOD']==='POST'){
    $event_name = $_POST['event_name'];
    $place = $_POST['place'];
    $comment = $_POST['comment'];
    $item = $_POST['item'];
  }
  //DB関連
  require_once("./Pdodb.php");
  $event_id = md5(uniqid(rand()));
  var_dump($event_id);

  $sql_event = "INSERT INTO ccdb.event(event_name, place, comment,event_id) VALUES('$event_name','$place','$comment','$event_id')";

  $sql_candi = "INSERT INTO ccdb.candi(item, candi_id, event_id) VALUES('$item','36','$event_id')";

  //インスタンス生成
  $db = new Pdodb();

  //イベントデータ挿入
  $db->SendSql($sql_event);

  //候補データ挿入
  $db->SendSql($sql_candi);

  $url = './event.php'.'?id='.$event_id;
  header("Location: {$url}");
  exit;

?>
