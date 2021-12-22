<?php
include_once('./_common.php');


if((!$_POST['wr_date'] && !$_POST['times5']) || !$_POST['wr_date1'] || !$member['mb_id'] || $member['mb_level']!=="3"){

alert("잘못된 접근입니다.");

}

$yoil = array("일","월","화","수","목","금","토");

$times = "";
if(count($_POST['times5'])>0){
	for($i=0;$i<count($_POST['times5']);$i++){
		if($times==""){
			$times = $_POST['times5'][$i];
		}else{
			$times .= "|".$_POST['times5'][$i];
		}
	}
}

if($_POST['w'] == ''){

	if($_POST['allday']){

		// 전체 적용
		$yoildate = $_POST['wr_date1'];
		for($i = 0 ; $i < 1000 ; $i++) {
			sql_query(" insert into basic_set2 (mb_id,mb_name,wr_date,wr_times,wr_datetime) VALUES ('".$member['mb_id']."','".$member['mb_name']."','".$yoildate."','".$times."','".G5_TIME_YMDHIS."') ");
			$yoildate = date("Y-m-d", strtotime($yoildate."+1 week"));
		}
		
		alert($yoil[date('w', strtotime($_POST['wr_date1']))]."요일 시간 세팅되었습니다.");

	} else {

		if($_POST['wr_date']){

			//휴무
			sql_query(" insert into basic_set2 (mb_id,mb_name,wr_date,wr_datetime,etc) VALUES ('".$member['mb_id']."','".$member['mb_name']."','".$_POST['wr_date1']."','".G5_TIME_YMDHIS."','휴무') ");
			
			alert("휴무 처리되었습니다.");

		} else {

			sql_query(" insert into basic_set2 (mb_id,mb_name,wr_date,wr_times,wr_datetime) VALUES ('".$member['mb_id']."','".$member['mb_name']."','".$_POST['wr_date1']."','".$times."','".G5_TIME_YMDHIS."') ");

			alert($_POST['wr_date1']." 시간 셋팅되었습니다.");

		}

	}

} else if($_POST['w'] == 'u') {

	if($_POST['allday']){

		// 전체 적용
		$yoildate = $_POST['wr_date1'];
		for($i = 0 ; $i < 1000 ; $i++) {
			$is_yoil = sql_fetch(" select * from basic_set2 where mb_id = '".$member['mb_id']."' and wr_date = '{$yoildate}' ");
			if($is_yoil['wr_times']){
				sql_query(" update basic_set2 set wr_times = '".$times."', wr_datetime = '".G5_TIME_YMDHIS."', etc = '' where mb_id = '".$member['mb_id']."' and wr_date = '{$yoildate}' ");			
			} else {
				sql_query(" insert into basic_set2 (mb_id,mb_name,wr_date,wr_times,wr_datetime) VALUES ('".$member['mb_id']."','".$member['mb_name']."','".$yoildate."','".$times."','".G5_TIME_YMDHIS."') ");
			}
			$yoildate = date("Y-m-d", strtotime($yoildate."+1 week"));
		}
		
		alert($yoil[date('w', strtotime($_POST['wr_date1']))]."요일 시간 세팅되었습니다.");

	} else {

		if($_POST['wr_date']){

			//휴무
			sql_query(" UPDATE basic_set2 set wr_times = '', wr_datetime = '".G5_TIME_YMDHIS."', etc = '휴무' where mb_id='".$member['mb_id']."' and wr_date='".$_POST['wr_date1']."' ");
			
			alert("휴무 처리되었습니다.");

		} else {

			sql_query(" UPDATE `basic_set2` SET `wr_times` = '{$times}', wr_datetime = '".G5_TIME_YMDHIS."', etc = '' where mb_id='".$member['mb_id']."' and wr_date='".$_POST['wr_date1']."' ");

			alert($_POST['wr_date1']." 시간 수정되었습니다.");

		}

	}

}
?>