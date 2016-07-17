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


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<title>調整ちゃん | イベント参照</title>
<meta name="description" content="ホイホイするでーい" />
<meta name="keywords" content="<調整ちゃん,予定" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
<![endif]-->
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
<label for="event">乙彼ちゃん。社畜ども</label><br>
  <?php
  while ($event = mysql_fetch_array($res_event)) {
    print $event['event_name'];
  }
  ?>
</p>

<h2 id="heading2">日時</h2>
<div id="datepicker"/>
</div>



<h2 id="heading2">場所</h2>
<p>
<label for="place">場所だお</label><br>
  <?php
  while ($event = mysql_fetch_array($res_event)) {
    print $event['place'];
  }
  ?>
</p>

<p>
<h2 id="heading2">コメント</h2>
  <?php
  while ($event = mysql_fetch_array($res_event)) {
    print $event['comment'];
  }
  ?>
</p>


<p>
  <input type="submit">
</p>
</form>

</div><!-- end main -->
</div><!-- end contents -->

<div class="clear"></div>

<footer id="footer">
<p>Copyright &copy; 2016 <a href="http://html5.imedia-web.net/">調整ちゃん</a> - Design by <a href="http://html5.imedia-web.net/" title="html5入門" target="_blank">html5</a></p>
<p id="pageTop" class="pageTop"><a href="#page">Let's go to TOP pageeeeee</a></p>
</footer>
</div><!-- end wrapper -->
</body>
</html>
