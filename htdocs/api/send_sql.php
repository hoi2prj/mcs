<?php
	function send_sql($sql) {
		$res = "";
		try {
			// サーバ接続
			$con = mysql_connect("127.0.0.1","root","");

			// データベースを選択
			mysql_select_db('ccdb',$con);

			// 文字化け防止のおまじない
			$strsql = "SET CHARACTER SET UTF8";
			mysql_query($strsql,$con);

			// SQLの実行
			$res = mysql_query($sql,$con);

			// 接続をクローズ
			mysql_close($con);
		} catch(Exception $e) {
			throw new Exception($e->getMessage());
		}
		return $res;
	}
?>
