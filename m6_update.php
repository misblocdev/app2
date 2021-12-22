<?php
include_once('./_common.php');


if(!$_POST['yoil'] || !$_POST['times'] || !$member['mb_id'] || $member['mb_level']!=="3"){

alert("잘못된 접근입니다.");

}
$yoils = "";
if(count($_POST['yoil'])>0){
	for($i=0;$i<count($_POST['yoil']);$i++){
		if($yoils==""){
			$yoils = $_POST['yoil'][$i];
		}else{
			$yoils .= "|".$_POST['yoil'][$i];
		}
	}
}
$times = "";
if(count($_POST['times'])>0){
	for($i=0;$i<count($_POST['times']);$i++){
		if($times==""){
			$times = $_POST['times'][$i];
		}else{
			$times .= "|".$_POST['times'][$i];
		}
	}
}

$sqlss = sql_fetch("select * from basic_set where mb_id='".$member['mb_id']."'");
if($sqlss['mb_id']){

sql_query("update basic_set set mb_name='".$member['mb_name']."', yoil='".$yoils."',times='".$times."',etc='".G5_TIME_YMDHIS."' where mb_id='".$member['mb_id']."'");

}else{

sql_query("insert into basic_set (mb_id,mb_name,yoil,times,wr_datetime) VALUES ('".$member['mb_id']."','".$member['mb_name']."','".$yoils."','".$times."','".G5_TIME_YMDHIS."')");

}

alert("셋팅되었습니다.");

?>