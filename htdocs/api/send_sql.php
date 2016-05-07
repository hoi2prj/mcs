<?php
	function send_sql($sql) {
		// サーバ接続
		$con = mysql_connect("localhost","root","") or die("接続失敗");

		// データベースを選択
		mysql_select_db('test',$con) or die("DBがありません");

		// 文字化け防止のおまじない
		$strsql = "SET CHARACTER SET UTF8";
		mysql_query($strsql,$con);

		// SQLの実行
		$res = mysql_query($sql,$con);

		// 接続をクローズ
		mysql_close($con);

		return $res;
	}
?>
