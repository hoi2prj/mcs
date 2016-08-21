<?php
	class Pdodb {
		// 実行結果
		public $resultData;
		// エラーメッセージ
		public $ErrorMessage;

		function SendSql($sql) {
			try {
				error_log("SQL入力: ".$sql);

				// サーバ接続
				$con = mysql_connect("127.0.0.1","root","");
				// データベースを選択
				mysql_select_db('ccdb',$con);

				// 文字化け防止のおまじない
				$strsql = "SET CHARACTER SET UTF8";
				mysql_query($strsql,$con);

				// SQLの実行
				$resultData = mysql_query($sql,$con);
				error_log("SQL出力: ".var_dump($resultData));

				// 接続をクローズ
				mysql_close($con);

				return TRUE;
			} catch (Exception $e) {
				$ErrorMessage = $e->getMessage();
				error_log($e->getMessage());
				return FALSE;
			}
		}
	}
?>
