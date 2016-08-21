<?php
	class Pdodb {
		// 実行結果
		public $resultData = null;
		// エラーメッセージ
		public $ErrorMessage = null;

		function SendSql($sql) {
			try {
				error_log("SQL入力: ".$sql);

				$mysqli = new mysqli("127.0.0.1","root","");

 				if ($mysqli -> connect_errno) {
		 			echo $mysqli -> connect_error;
		 			exit();
 				}

 				$mysqli -> select_db('ccdb');
 				$mysqli -> set_charset("utf-8");
 				$mysqli -> query("set names utf8");

 				$resultData = $mysqli -> query($sql) or die("error");
				ob_start();
				var_dump($resultData);
				error_log("SQL出力: ".ob_get_clean());

 				if (!$resultData) {
		 			$mysqli -> close();
		 			return FALSE;
 				}
/*
 				$resultData = array();
 				while ($row = $result -> fetch_assoc()) {
		 			array_push($resultData, $row);
 				}
*/
 				//$result -> free();
 				$mysqli -> close();

				return $resultData;
			} catch (Exception $e) {
				$ErrorMessage = $e->getMessage();
				error_log($e->getMessage());
				return FALSE;
			}
		}
	}
?>
