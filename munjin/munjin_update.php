<?php
include_once('../common.php');

$den_id = isset($_POST['denid']) ? $_POST['denid'] : '';
$munjin_id = isset($_POST['munjinid']) ? $_POST['munjinid'] : '';
$rdate = isset($_POST['rdate']) ? $_POST['rdate'] : '';
$rtime = isset($_POST['rtime']) ? $_POST['rtime'] : '';

if($munjin_id) { // 이전 문진표 사용

$sql_m = " select * from munjin where munjin_id = '{$munjin_id}' ";
//echo $sql;
$munjin = sql_fetch($sql_m);

$sql_d = " select * from g5_write_dental where wr_code = '{$den_id}' ";
$dental = sql_fetch($sql_d);

if($den_id != $munjin['dental_id']) { // 같은 병원이 아닐때

// 문진표 등록
sql_query(" insert into munjin (`munjin_type`, `dental_id`, `mb_id`, `munjin_name`, `munjin_birth`, `munjin_phone`, `munjin_sex`, `munjin_addr`, `q01`, `q02`, `q02_sub`, `q03`, `q03_sub`, `q04`, `q04_sub`, `q05`, `q05_sub`, `q06`, `q07`, `q08`, `q09`, `q09_sub`, `q10`, `q11`, `q12`, `q13`, `insurance`, `insurance_1`, `insurance_1_sub`, `insurance_2`) values ('{$munjin['munjin_type']}', '{$den_id}', '{$munjin['mb_id']}', '{$munjin['munjin_name']}', '{$munjin['munjin_birth']}', '{$munjin['munjin_phone']}', '{$munjin['munjin_sex']}', '{$munjin['munjin_addr']}', '{$munjin['q01']}', '{$munjin['q02']}', '{$munjin['q02_sub']}', '{$munjin['q03']}', '{$munjin['q03_sub']}', '{$munjin['q04']}', '{$munjin['q04_sub']}', '{$munjin['q05']}', '{$munjin['q05_sub']}', '{$munjin['q06']}', '{$munjin['q07']}', '{$munjin['q08']}', '{$munjin['q09']}', '{$munjin['q09_sub']}', '{$munjin['q10']}', '{$munjin['q11']}', '{$munjin['q12']}', '{$munjin['q13']}', '{$munjin['insurance']}', '{$munjin['insurance_1']}', '{$munjin['insurance_1_sub']}', '{$munjin['insurance_2']}') ");

}

$munid = $munjin_id;

} else { // 새로 작성 or 이전 문진표 수정

$sql_m = " select * from munjin where dental_id = '{$den_id}' and mb_id = '{$member['mb_id']}' ";
//echo $sql;
$munjin = sql_fetch($sql_m);

$munjin_type = $_POST['munjin_type'];
$munjin_name = $_POST['munjin_name'];
$munjin_phone = $_POST['munjin_phone'];
$munjin_sex = $_POST['munjin_sex'];
$munjin_addr = $_POST['munjin_addr'];
$q01 = $_POST['q01'];
$q02 = $_POST['q02'];
$q02_sub = isset($_POST['q02_sub']) ? $_POST['q02_sub'] : '';
$q03 = $_POST['q03'];
$q03_sub = isset($_POST['q03_sub']) ? $_POST['q03_sub'] : '';
$q04 = $_POST['q04'];
$q04_sub = isset($_POST['q04_sub']) ? $_POST['q04_sub'] : '';
$q05 = $_POST['q05'];
$q05_sub = isset($_POST['q05_sub']) ? $_POST['q05_sub'] : '';
$q06 = $_POST['q06'];
$q07 = $_POST['q07'];
$q08 = isset($_POST['q08']) ? $_POST['q08'] : '';
$q09 = isset($_POST['q09']) ? $_POST['q09'] : '';
$q10 = isset($_POST['q10']) ? $_POST['q10'] : '';
$q11 = isset($_POST['q11']) ? $_POST['q11'] : '';
$q12 = isset($_POST['q12']) ? $_POST['q12'] : '';
$q13 = isset($_POST['q13']) ? $_POST['q13'] : '';
$insurance = $_POST['insurance'];
$insurance_1 = isset($_POST['insurance_1']) ? $_POST['insurance_1'] : '';
$insurance_1_sub = isset($_POST['insurance_1_sub']) ? $_POST['insurance_1_sub'] : '';
$insurance_2 = isset($_POST['insurance_2']) ? $_POST['insurance_2'] : '';

if($munjin['munjin_id'] && $munjin['munjin_type'] == $munjin_type) { // 같은 병원일때 업데이트

// 문진표 수정
sql_query(" update munjin set `munjin_type` = '{$munjin_type}', `dental_id` = '{$den_id}', `mb_id` = '{$member['mb_id']}', `munjin_name` = '{$munjin_name}', `munjin_birth` = '{$munjin_birth}', `munjin_phone` = '{$munjin_phone}', `munjin_sex` = '{$munjin_sex}', `munjin_addr` = '{$munjin_addr}', `q01` = '{$q01}', `q02` = '{$q02}', `q02_sub` = '{$q02_sub}', `q03` = '{$q03}', `q03_sub` = '{$q03_sub}', `q04` = '{$q04}', `q04_sub` = '{$q04_sub}', `q05` = '{$q05}', `q05_sub` = '{$q05_sub}', `q06` = '{$q06}', `q07` = '{$q07}', `q08` = '{$q08}', `q09` = '{$q09}', `q10` = '{$q10}', `q11` = '{$q11}', `q12` = '{$q12}', `q13` = '{$q13}', `insurance` = '{$insurance}', `insurance_1` = '{$insurance_1}', `insurance_1_sub` = '{$insurance_1_sub}', `insurance_2` = '{$insurance_2}' where munjin_id = '{$munjin['munjin_id']}' ");

$munid = $munjin['munjin_id'];

} else {

// 문진표 등록
sql_query(" insert into munjin (`munjin_type`, `dental_id`, `mb_id`, `munjin_name`, `munjin_birth`, `munjin_phone`, `munjin_sex`, `munjin_addr`, `q01`, `q02`, `q02_sub`, `q03`, `q03_sub`, `q04`, `q04_sub`, `q05`, `q05_sub`, `q06`, `q07`, `q08`, `q09`, `q10`, `q11`, `q12`, `q13`, `insurance`, `insurance_1`, `insurance_1_sub`, `insurance_2`) values ('{$munjin_type}', '{$den_id}', '{$member['mb_id']}', '{$munjin_name}', '{$munjin_birth}', '{$munjin_phone}', '{$munjin_sex}', '{$munjin_addr}', '{$q01}', '{$q02}', '{$q02_sub}', '{$q03}', '{$q03_sub}', '{$q04}', '{$q04_sub}', '{$q05}', '{$q05_sub}', '{$q06}', '{$q07}', '{$q08}', '{$q09}', '{$q10}', '{$q11}', '{$q12}', '{$q13}', '{$insurance}', '{$insurance_1}', '{$insurance_1_sub}', '{$insurance_2}') ");

$mun = sql_fetch(" select * from g5_munjin where `munjin_type` = '{$munjin_type}' and `dental_id` = '{$den_id}' and mb_id = '{$member['mb_id']}' ");

}

}

// 문진표 작성 포인트 지급(연 1회)
$mb = get_member($member['mb_id']);
if($mb['mb_munjin_log'] != date('Y')){
	insert_point($member['mb_id'], 300, '문진표 작성 포인트', '@passive', $member['mb_id'], date('Y').' 문진표 작성 포인트');
	sql_query(" update g5_member set mb_munjin_log = '".date('Y')."' where mb_id = '{$member['mb_id']}' ");
	$msg = '
	<div class="munjin_result_wrap munjin_result_point">
		<h4>문진표 작성해주셔서 감사합니다.</h4>
		<p>축하합니다! 문진표 작성으로 포인트가 지급되었습니다.<br/>더 나은 서비스를 제공하기 위해 노력하겠습니다.</p>
		<a href="'.G5_URL.'/reservation_update.php?denid='.$denid.'&date='.$rdate.'&time='.$rtime.'" class="close_pop"><img src="/images/close_pop.png" alt="팝업 닫기"></a>
	</div>';
} else {
	$msg = '
	<div class="munjin_result_wrap">
		<h4>문진표 작성해주셔서 감사합니다.</h4>
		<p>더 나은 서비스를 제공하기 위해 노력하겠습니다.</p>
		<a href="'.G5_URL.'/reservation_update.php?denid='.$denid.'&date='.$rdate.'&time='.$rtime.'" class="close_pop"><img src="/images/close_pop.png" alt="팝업 닫기"></a>
	</div>';
}

echo $msg;