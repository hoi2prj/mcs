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
  $sql_event = "INSERT INTO ccdb.event(event_name, place, comment)
          VALUES($event_name, $place, $comment)";

  $sql_candi = "INSERT INTO ccdb.candi(item)
          VALUES($item)";

  //インスタンス生成
  $db = new Pdodb();

  //イベントデータ挿入
  $db->SendSql($sql_event);

  //候補データ挿入
  $db->SendSql($sql_candi);
?>
