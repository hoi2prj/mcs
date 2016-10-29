<?php
//イベント系変数の定義
$event_name = '';
$place = '';
$comment = '';
$event_id = '';
//candi系変数の定義
$candi_item ='';
$candi_id = '';

//GETデータ処理
  if ($_SERVER['REQUEST_METHOD']==='GET'){
    $event_id = $_GET['id'];
  }

//DB関連
  require_once("./Pdodb.php");
//インスタンス生成
  $db = new Pdodb();

  $sql_event = "SELECT * FROM event WHERE event_id = '$event_id'";
//  $sql_candi = "SELECT * FROM candi WHERE event_id = '$event_id'";
  $sql_party_status = "select ps.candi_id, c.item, count(ps.prop = 1 or null) as maru, count(ps.prop = 2 or null) as sankaku, count(ps.prop = 3 or null) as batsu from party_status as ps inner join candi as c on ps.event_id = c.event_id and ps.candi_id = c.candi_id where ps.event_id = '$event_id' group by ps.candi_id";

  //イベントデータ参照
  $res_event = $db->SendSql($sql_event);

  if ($res_event != FALSE){
      while ($event = $res_event->fetch_assoc()) {
        $event_name = $event['event_name'];
        $place = $event['place'];
        $comment = $event['comment'];
      }
  } else {
    die('query error');
  }
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
  <?php
    print $event_name;
  ?>
</p>

<!-- 日時表示 -->
<h2 id="heading2">日時</h2>
<table class="tableview">
  <tbody>
  <tr>
    <th>候補</th>
    <th>◯</th>
    <th>△</th>
    <th>☓</th>
  </tr>
<?php
      //日時データ参照
//  $res_candi = $db->SendSql($sql_candi);
//      while ($candi = $res_candi->fetch_assoc()) {
//        $candi_item = $candi['item'];
//        $candi_id = $candi['candi_id'];

      //データ参照
  $res_party_status = $db->SendSql($sql_party_status);
      while ($party = $res_party_status->fetch_assoc()) {
        $party_item = $party['item'];
        $party_maru = $party['maru'];
        $party_sankaku = $party['sankaku'];
        $party_batsu = $party['batsu'];

echo <<< EOM
      <tr>
      <td>{$party_item}</td>
      <td>{$party_maru}</td>
      <td>{$party_sankaku}</td>
      <td>{$party_batsu}</td>
      </tr>
EOM;
      }
  ?>
  </tbody>
</table>


<h2 id="heading2">場所</h2>
<p>
  <?php
  print $place;
  ?>
</p>

<p>
<h2 id="heading2">コメント</h2>
  <?php
  print $comment;
  ?>
</p>

<p>
  <input type="button" value="参加登録" onClick="location.href='./regist_party.php?id=<?php echo $event_id ?>'">
</p>

<p>
  <input type="button" value="イベント編集" onClick="location.href='./edit_event.php?id=<?php echo $event_id ?>'">
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
