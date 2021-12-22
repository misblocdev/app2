<?php
include_once('./_common.php');
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
if (!$member['mb_id']) alert('잘못된 접근입니다.', '/');

$now = time();
$my_id = $member['mb_id'];
$cnt_rc = 0;

// 추천회원 세기
$sql_rc = " select count(*) cnt from g5_member where mb_recommend = '{$my_id}' ";
$row_rc = sql_fetch($sql_rc);
$cnt_rc = $row_rc['cnt'];

$my_gop = 1;

if($cnt_rc > 29) $my_gop = 4;
else if($cnt_rc > 19) $my_gop = 3;
else if($cnt_rc > 9) $my_gop = 2;
else if($cnt_rc > 5) $my_gop = 1.5;
else if($cnt_rc > 1) $my_gop = 1 + (0.1 * $cnt_rc);

$mining_point = (int)($config['cf_7'] * $my_gop);

$g5['title'] = '포인트 채굴';

if($member['mb_mine'] != 0 && time() > $member['mb_mine']){
	
	insert_point($my_id, $mining_point, ''.$my_id.'님 포인트 획득 '.G5_TIME_YMDHIS.'' , '@mining', $member['mb_id'], G5_TIME_YMDHIS);

	//$sql = " update {$g5['member_table']} set mb_mine = 0 where mb_id = '{$my_id}' ";
	$sql = " update {$g5['member_table']} set mb_mine = ({$now} + 86400) where mb_id = '{$my_id}' ";
	sql_query($sql);

	alert($mining_point.'P가 지급되었습니다. 새 채굴을 시작합니다.');

} else if($member['mb_mine'] != 0 && time() < $member['mb_mine']) {

	alert('현재 채굴중입니다.');

} else if($member['mb_mine'] == 0) {

	$sql = " update {$g5['member_table']} set mb_mine = ({$now} + 86400) where mb_id = '{$my_id}' ";
	sql_query($sql);

	alert('포인트 채굴을 시작합니다.');

}