<?php
	function send_sql($sql) {
		$res = "";
		// サーバ接続
		$con = mysql_connect("127.0.0.1","root","") or die('error_connect');
		// データベースを選択
		mysql_select_db('ccdb',$con) or die('error_select_db');

		// 文字化け防止のおまじない
		$strsql = "SET CHARACTER SET UTF8";
		mysql_query($strsql,$con);

		// SQLの実行
		$res = mysql_query($sql,$con) or die('error_exec');

		// 接続をクローズ
		mysql_close($con);
		return $res;
	}
?>
