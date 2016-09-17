<?php
  //DB関連
  require_once("./Pdodb.php");

  //インスタンス生成
  $db = new Pdodb();

  //GETデータ処理
  if ($_SERVER['REQUEST_METHOD']==='GET'){
    $event_id = $_GET['id'];
    $sql_event = "SELECT * FROM candi WHERE event_id = '$event_id'";

    //イベントデータ参照
    $res_event = $db->SendSql($sql_event);

    if ($res_event == FALSE){
      die('query error');
    }
  }

  //POSTデータ処理
  elseif ($_SERVER['REQUEST_METHOD']==='POST'){
    $event_id = $_POST['event_id'];
    $party_name = $_POST['party_name'];

    $sql_event = "SELECT auto_increment FROM information_schema.tables WHERE table_name = 'party'";
    $res_event = $db->SendSql($sql_event);
    if ($res_event == FALSE){
      die('query error');
    }
    while ($event = $res_event->fetch_assoc()) {
      $party_id = $event['auto_increment'];
    }

    //データ登録
    $sql_event = "INSERT INTO ccdb.party(party_name) VALUES('$party_name')";
    $res_event = $db->SendSql($sql_event);
    if ($res_event == FALSE){
      die('query error');
    }

    //イベント候補情報取得
    $sql_event = "SELECT * FROM candi WHERE event_id = '$event_id'";
    $res_candi = $db->SendSql($sql_event);
    if ($res_candi == FALSE){
      die('query error');
    }

    while ($event = $res_candi->fetch_assoc()) {
      $candi_id = $event['candi_id'];
      $biko = $_POST['biko'];
      $prop = $_POST[$candi_id];
      $sql_event = "INSERT INTO ccdb.party_status(event_id, candi_id, party_id, biko, prop) VALUES('$event_id', '$candi_id', '$party_id', '$biko', '$prop')";
      $res_event = $db->SendSql($sql_event);
      if ($res_event == FALSE){
        die('query error');
      }
    }

    $url = './event.php'.'?id='.$event_id;
    header("Location: {$url}");
    exit;
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<title>調整ちゃん</title>
<meta name="description" content="調整さんの妹" />
<meta name="keywords" content="<調整ちゃん,予定" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
<![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />


</head>
<body>
<div id="page">
<header id="header">
<h1>調整さんの妹</h1>
<p class="siteName">調整ちゃん</p>
</header>
<div id="content">
<div id="main">
<h2 id="heading2">名前</h2>
<p>
<form action="./regist_party.php" method="post">
<input type="text" name="party_name" maxlength="20">
</p>

<h2 id="heading2">候補選択</h2>
<table class="tableview">
  <tbody>
  <tr>
    <th>候補</th>
    <th>◯</th>
    <th>△</th>
    <th>☓</th>
  </tr>
<?php
  while ($event = $res_event->fetch_assoc()) {
    $item = $event['item'];
    $candi_id = $event['candi_id'];

echo <<< EOM
    <tr>
      <td>{$item}</td>
      <td><input type="radio" name="{$candi_id}" value="1"></td>
      <td><input type="radio" name="{$candi_id}" value="2"></td>
      <td><input type="radio" name="{$candi_id}" value="3"></td>
    </tr>
EOM;
  }
?>
  </tbody>
</table>

<h2 id="heading2">備考</h2>
<textarea name="biko" cols="40" rows="4" maxlength="30" placeholder="備考を入力してください"></textarea>

<input type="hidden" name="event_id" value="<?php echo $event_id ?>">
<p>
  <input type="submit" value="入力完了">
</p>
</form>

</div><!-- end main -->

</div><!-- end contents -->
<div class="clear"></div>

<footer id="footer">
<p><center>Copyright &copy; 2016 <a href="http://html5.imedia-web.net/">調整ちゃん</a> - Design by <a href="./index.html" title="html5入門" target="_blank">html5</a></center></p>
</footer>
</div><!-- end wrapper -->
</body>
</html>
