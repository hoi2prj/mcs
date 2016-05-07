<?php
  require_once("./send_sql.php");
  $sql = "select * from table1";
  $res = send_sql($sql);
?>

<html>
<head>
<meta http-equiv=content-type content="text/html; charset=UTF-8">
<title>PHPtest</title>
</head>
<body>
  <<?php
  while ($item = mysql_fetch_array($res)) {
		print $item[0]." ".$item[1]."<br>";
	}
  ?>
</body>
</html>
