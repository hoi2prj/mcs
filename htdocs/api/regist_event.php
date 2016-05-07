<?php
  require "./send_sql.php";
  $sql = "select * from table1";
  $item = send_sql($sql);
?>

<html>
<head>
<meta http-equiv=content-type content="text/html; charset=UTF-8">
<title>PHPtest</title>
</head>
<body>
  <<?php
    foreach ($item as $key => $val) {
      print $key." ".$val"<br>";
    }
  ?>
</body>
</html>
