<?php
$wr_2 = $_POST['wr_2'];
$wr_2_1 = $_POST['wr_2_1'];
$wr_11 = $_POST['wr_11']; // 증상
$wr_12 = $_POST['wr_12']; // 원장님 이력
$wr_13 = $_POST['wr_13']; // 병원/약국구분

$sql = " update $write_table
			set wr_2 = '".$wr_2."',
			wr_2_1 = '".$wr_2_1."',
			wr_11 = '".$wr_11."',
			wr_12 = '".$wr_12."',
			wr_13 = '".$wr_13."'
		 where wr_id = ".$wr_id." ";
sql_query($sql);
?>