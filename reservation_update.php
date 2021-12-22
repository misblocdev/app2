<?php
include_once('./_common.php');

if(!$denid || !$date || !$time){
	alert("잘못된 접근입니다.");
}

$sql_d = " select * from g5_write_dental where wr_code = '{$denid}' ";
$dental = sql_fetch($sql_d);

// 예약 등록
sql_query(" insert into reser (dental_id,dental_name,mb_id,mb_name,wr_date,wr_time,wr_datetime,etc) VALUES ('{$denid}', '{$dental['wr_subject']}', '{$member['mb_id']}', '{$member['mb_name']}', '{$date}', '{$time}','".G5_TIME_YMDHIS."','예약') ");

// 예약 등록 포인트 지급(월 1회)
$mb = get_member($member['mb_id']);
if($mb['mb_reserve_log'] != date('Y-m')){
	insert_point($mb['mb_id'], 200, '예약 완료 포인트', '@passive', $mb['mb_id'], date('Y-m').' 예약 완료 포인트');
	sql_query(" update g5_member set mb_reserve_log = '".date('Y-m')."' where mb_id = '{$member['mb_id']}' ");
	$msg = '
	<div class="reserve_result_wrap reserve_result_point">
		<h4>병원 예약해 주셔서 감사합니다.</h4>
		<p>축하합니다! 예약으로 포인트가 지급되었습니다. <br/>아나파톡으로 예약 해주시는 분에 한하여 <br/>예약 포인트는 월 1회 제공됩니다.</p>
		<div class="reserve_result_btn">
			<a href="/" class="go_home">메인으로</a>
			<a href="/bbs/mypage.php">예약확인</a>
		</div>
	</div>';
} else {
	$msg = '
	<div class="reserve_result_wrap">
		<h4>병원 예약해 주셔서 감사합니다.</h4>
		<p>예약 내역은 마이페이지에서 확인하실 수 있습니다.</p>
		<div class="reserve_result_btn">
			<a href="/" class="go_home">메인으로</a>
			<a href="/bbs/mypage.php">예약확인</a>
		</div>
	</div>';
}

include_once(G5_PATH.'/head.php');
?>

<style>
.reserve_result_wrap {text-align: center;}
.reserve_result_point {background: url(/images/reserve_point.png) no-repeat 50% 0px #fff;background-size: 500px;padding: 350px 20px 95px;}
.reserve_result_wrap h4 {text-align: center;font-size: 20px;font-weight: 400;margin-bottom: 20px;}
.reserve_result_wrap p {text-align: center;font-size: 16px;font-weight: 300;line-height: 24px;}
.reserve_result_btn {text-align: center;font-size: 0;margin-top: 60px;}
.reserve_result_btn a {display: inline-block;width: 140px;height: 50px;line-height: 50px;margin: 0 5px;font-size: 16px;border-radius: 5px;color: #fff;background: #aaa;}
.reserve_result_btn a.go_home {background: #777dee;} 

/* 반응형 css */
@media only screen and (max-width: 720px) { /* viewport width : 720 */

.reserve_result_wrap {}
.reserve_result_point {background: url(/images/reserve_point.png) no-repeat 50% 0.0000vw #fff;background-size: 69.4444vw;padding: 48.6111vw 2.7778vw 13.1944vw;}
.reserve_result_wrap h4 {font-size: 2.7778vw;margin-bottom: 2.7778vw;}
.reserve_result_wrap p {font-size: 2.2222vw;line-height: 3.3333vw;}
.reserve_result_btn {font-size: 0;margin-top: 8.3333vw;}
.reserve_result_btn a {width: 19.4444vw;height: 6.9444vw;line-height: 6.9444vw;margin: 0 0.6944vw;font-size: 2.2222vw;border-radius: 0.6944vw;background: #aaa;}
.reserve_result_btn a.go_home {background: #777dee;} 

}
</style>

<div class="sub_content">
	<div class="inner">
		<div class="reserve_result">
		<?php echo $msg;?>
		</div>
	</div>
</div>

<?php
include_once(G5_PATH.'/tail.php');
?>