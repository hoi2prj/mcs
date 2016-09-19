<?php
  $event_name = '';
  $place = '';
  $comment = '';
  $event_id = '';

  //GETデータ処理
  if ($_SERVER['REQUEST_METHOD']==='GET'){
    $event_id = $_GET['id'];
    //DB関連
    require_once("./Pdodb.php");
    $sql_event = "SELECT * FROM event WHERE event_id = '$event_id'";

    //インスタンス生成
    $db = new Pdodb();

    //イベントデータ参照
    $res_event = $db->SendSql($sql_event);

    if ($res_event != FALSE){
        while ($event = $res_event->fetch_assoc()) {
          $event_name = $event['event_name'];
          $place = $event['place'];
          $comment = $event['comment'];
          //日時を取り出す処理も今後必要
          //$party_prop =$event['party_prop']
        }
    } else {
      die('query error');
    }
  }
  //POSTデータ処理
  elseif ($_SERVER['REQUEST_METHOD']==='POST'){

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

<script>
$(function() {
  $("#datepicker").datepicker({
  // 日付が選択された時、日付をテキストフィールドへセット
  onSelect: function(dateText, inst) {
      document.getElementById("date_val").value += dateText + "\n";
    }
  });
});
</script>

</head>
<body>
<div id="page">
<header id="header">
<h1>調整さんの妹</h1>
<p class="siteName">調整ちゃん</p>
</header>
<div id="content">
<div id="main">
<h2 id="heading2">イベント</h2>
<p>
<form action="./edit_event.php" method="post">
<textarea id="event" name="event_name" cols="40" rows="4" maxlength="20" placeholder="イベント名を入力してください"></textarea>
</p>

<h2 id="heading2">日時</h2>

<! javascriptからテキストに値を持ってくる>
<!<script type="text/javascript" src="../js/test.js" charset="utf-8" async="async"><!/script>
<!document.フォーム名.テキストボックス名.value>

<div id="datepicker"/>
<p><textarea name="item" cols="40" rows="4" maxlength="20" placeholder="日時を入力してください" id="date_val"/></textarea></p>
</div>

<! javascript カレンダー>

<p>
<h2 id="heading2">場所</h2>
<p>
<textarea id="place" name="place" cols="40" rows="4" maxlength="20" placeholder="場所を入力してください"></textarea>
</p>

<h2 id="heading2">コメント</h2>
<textarea id="comment" name="comment" cols="40" rows="4" maxlength="30" placeholder="コメントを入力してください"></textarea>
</p>

<p>
  <input type="submit" value="編集完了">
</p>
</form>

</div><!-- end main -->



</div><!-- end contents -->
<div class="clear"></div>

<footer id="footer">
<p><center>Copyright &copy; 2016 <a href="http://hoi2.club/">調整ちゃん</a></center></p>
</footer>
</div><!-- end wrapper -->
</body>
</html>
