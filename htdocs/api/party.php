<?php
  //GETデータ処理
  if ($_SERVER['REQUEST_METHOD']==='GET'){
    $event_id = $_GET['id'];
  }
  //DB関連
  require_once("./send_sql.php");
  $sql_event = "SELECT * FROM event WHERE event_id = $event_id";
  $res_event = send_sql($sql_event);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<title>調整ちゃん</title>
<meta name="description" content="ホイホイするでーい" />
<meta name="keywords" content="<調整ちゃん,予定" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
<![endif]-->

//jQueryの使用 カレンダー
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
<h2 id="heading2">イベント</h2>
<p>
<form action="../api/edit_party.php" method="post">

    <?php
    while ($event = mysql_fetch_array($res_event)) {
  		print $event['event_name']." ".$event['comment']."<br>";
  	}
    ?>

<textarea id="event" name="event_name" cols="40" rows="4" maxlength="20" placeholder="情報入力してください"></textarea>
</p>

<h2 id="heading2">日時</h2>


<div id="datepicker"/>
<br/>
</div>

<h2 id="heading2">場所</h2>
<p>
</p>


<h2 id="heading2">コメント</h2>
</p>

<p>
  <input type="submit">
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
