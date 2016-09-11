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
  //インスタンス生成
  $db = new Pdodb();
  //イベントID ランダム生成
  $event_id = md5(uniqid(rand()));

//日時処理
  $cr = array("\r\n","\r");
  $item = str_replace($cr,"\n",$item);
  $item_array = explode("\n",$item);
  $item_array = array_filter($item_array,'strlen');
  $item_array = array_values($item_array);
  foreach ($item_array as $key => $value){
    $sql_candi = "INSERT INTO ccdb.candi(item, candi_id, event_id) VALUES('$value','$key','$event_id')";
    $db->SendSql($sql_candi);
  }


//イベント名、場所、コメント処理
    $sql_event = "INSERT INTO ccdb.event(event_name, place, comment,event_id) VALUES('$event_name','$place','$comment','$event_id')";

//イベントデータ挿入
  $db->SendSql($sql_event);

  $url = './event.php'.'?id='.$event_id;
  header("Location: {$url}");
  exit;

?>
