<?php
include_once('./_common.php');
add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/butterfly.css">', 10);

if(!$is_member) alert('로그인하세요.', G5_BBS_URL.'/login.php?url='.$urlencode);

$my_id = $member['mb_id'];
$my_mining = $config['cf_7'];
$my_gop = 1;

// 추천회원 세기
$sql_rc = " select count(*) cnt from g5_member where mb_recommend = '{$my_id}' ";
$row_rc = sql_fetch($sql_rc);
$cnt_rc = $row_rc['cnt'];

// 추천회원 불러오기
$sql_rcc = " select * from g5_member where mb_recommend = '{$my_id}' order by mb_no desc ";
$result_rcc = sql_query($sql_rcc);
$row_rcc = sql_fetch($sql_rcc);

if($cnt_rc > 29) $my_gop = 4;
else if($cnt_rc > 19) $my_gop = 3;
else if($cnt_rc > 9) $my_gop = 2;
else if($cnt_rc > 5) $my_gop = 1.5;
else if($cnt_rc > 1) $my_gop = 1 + (0.1 * $cnt_rc);

$remainPerc = 0;

if(time() < $member['mb_mine']) { 
	$remaintime = $member['mb_mine'] - time();
	$remainPerc = 1 - $remaintime / 86400;
} else if(time() >= $member['mb_mine'] && $member['mb_mine'] != 0) {
	$remainPerc = 1;
}

$g5['title'] = '포인트 채굴';
include_once(G5_PATH.'/_head.php');
?>

<style>
.graph_zone{position:relative; width:100%; padding:160px 0 160px; background-color:#0779e4; text-align:center;}
.pie-chart{position: relative;display:inline-block;width: 440px;height: 440px;border-radius: 50%;}
span.center{
background:url(/images/tooth_bg.png) no-repeat bottom 20% center / 85% auto;
background-color:#0779e4 ;display:block;position:absolute;top:50%;left:50%; color:#0779e4;
width:420px;height:420px;border-radius:50%;text-align:center;font-size:30px;transform:translate(-50%, -50%);
font-size:24px; font-weight:700; padding-top:175px;
}
span.center div{margin-top: -90px;}
.my_mining{font-weight:500; font-size:32px; display:inline-block; padding:0 40px; margin:10px 0;
height:40px; line-height:36px; color:#fff; border-radius:0 0 20px 20px; background-color:#0779e4; border-top:2px solid #fff;}
.out_wrap{position:absolute; bottom:20px; left:50%; transform:translate(-50%, 50%); z-index:10;}
.go_mining{display:block; width:200px; height:200px; line-height:194px; background-color:#1db8f8; border:3px solid #1db8f8; border-radius:50%; position:relative; overflow:hidden;}
.go_mining > img{width:38.3333%;}
/* .go_mining.off{background-color:#a0a0a0; border-color:#cacaca;} */
.mining_stat{font-size:22px; font-weight:500; color:#939393; margin-top:10px; line-height:1em;}

.info_zone{position:relative; z-index:2; padding:150px 40px 60px; background-color:#fff; border-radius:30px; margin:-30px 0; -webkit-box-shadow: 0px 0px 16px 5px rgba(0,0,0,0.1); -moz-box-shadow: 0px 0px 16px 5px rgba(0,0,0,0.1); box-shadow: 0px 0px 16px 5px rgba(0,0,0,0.1);}
.info_rec{background-color:#323232; width:100%; padding:60px 40px; border-radius:20px; color:#fff; overflow:hidden; position:relative;}
.info_rec > img{position:absolute; top:50%; left:40px; transform:translate(0, -50%); width:95px; height:auto;}
.info_rec .info_txt{float:left; padding-left:120px; letter-spacing:-0.06em;}
.info_rec .info_txt h6{font-size:34px;}
.info_rec .info_txt p{font-size:26px; font-weight:300;}
.info_rec .info_txt p strong{color:#1db8f8; text-decoration:underline;}

.rec_zone{width:100%; padding:100px 0 80px; background-color:#f2f2f2;}
.rec_zone h5{margin-left:40px; font-size:32px; font-weight:700; height:40px; line-height:36px; border-left:10px solid #1db8f8; padding-left:10px;}
.rec_list{padding:0 40px;margin-top:40px;overflow:hidden;}
.rec_list li{width:20%; float:left;text-align:center;padding:0 2%; margin-bottom:20px;}
.rec_list li img{width:100%; display:block; border-radius:50%; margin-bottom:10px; background-color:#fff;}
.rec_list li span{display:block; font-size:20px; font-weight:700; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
.rec_zone p{margin-top:40px; font-size:20px; text-align:center;}

@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

.graph_zone{position:relative; width:100%; padding:12.5000vw 0 12.5000vw; background-color:#0779e4; text-align:center;}
.pie-chart{position: relative;display:inline-block;width: 34.3750vw;height: 34.3750vw;border-radius: 50%;}
span.center{
background:url(/images/tooth_bg.png) no-repeat bottom 20% center / 85% auto;
background-color:#0779e4 ;display:block;position:absolute;top:50%;left:50%; color:#0779e4;
width:32.8125vw;height:32.8125vw;border-radius:50%;text-align:center;font-size:2.3438vw;transform:translate(-50%, -50%);
font-size:1.8750vw; font-weight:700; padding-top:13.6719vw;
}
span.center div{margin-top: -7.0313vw;}
.my_mining{font-weight:500; font-size:2.5000vw; display:inline-block; padding:0 3.1250vw; margin:0.7813vw 0;
height:3.1250vw; line-height:2.8125vw; color:#fff; border-radius:0 0 1.5625vw 1.5625vw; background-color:#0779e4; border-top:0.1563vw solid #fff;}
.out_wrap{position:absolute; bottom:1.5625vw; left:50%; transform:translate(-50%, 50%); z-index:10;}
.go_mining{display:block; width:15.6250vw; height:15.6250vw; line-height:15.1563vw; background-color:#1db8f8; border:0.2344vw solid #1db8f8; border-radius:50%; position:relative; overflow:hidden;}
.go_mining > img{width:38.3333%;}
/* .go_mining.off{background-color:#a0a0a0; border-color:#cacaca;} */
.mining_stat{font-size:1.7188vw; font-weight:500; color:#939393; margin-top:0.7813vw; line-height:1em;}

.info_zone{position:relative; z-index:2; padding:11.7188vw 3.1250vw 4.6875vw; background-color:#fff; border-radius:2.3438vw; margin:-2.3438vw 0; -webkit-box-shadow: 0.0000vw 0.0000vw 1.2500vw 0.3906vw rgba(0,0,0,0.1); -moz-box-shadow: 0.0000vw 0.0000vw 1.2500vw 0.3906vw rgba(0,0,0,0.1); box-shadow: 0.0000vw 0.0000vw 1.2500vw 0.3906vw rgba(0,0,0,0.1);}
.info_rec{background-color:#323232; width:100%; padding:4.6875vw 3.1250vw; border-radius:1.5625vw; color:#fff; overflow:hidden; position:relative;}
.info_rec > img{position:absolute; top:50%; left:3.1250vw; transform:translate(0, -50%); width:7.4219vw; height:auto;}
.info_rec .info_txt{float:left; padding-left:9.3750vw; letter-spacing:-0.06em;}
.info_rec .info_txt h6{font-size:2.6563vw;}
.info_rec .info_txt p{font-size:2.0313vw; font-weight:300;}
.info_rec .info_txt p strong{color:#1db8f8; text-decoration:underline;}

.rec_zone{width:100%; padding:7.8125vw 0 6.2500vw; background-color:#f2f2f2;}
.rec_zone h5{margin-left:3.1250vw; font-size:2.5000vw; font-weight:700; height:3.1250vw; line-height:2.8125vw; border-left:0.7813vw solid #1db8f8; padding-left:0.7813vw;}
.rec_list{padding:0 3.1250vw;margin-top:3.1250vw;overflow:hidden;}
.rec_list li{width:20%; float:left;text-align:center;padding:0 2%; margin-bottom:1.5625vw;}
.rec_list li img{width:100%; display:block; border-radius:50%; margin-bottom:0.7813vw; background-color:#fff;}
.rec_list li span{display:block; font-size:1.5625vw; font-weight:700; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
.rec_zone p{margin-top:3.1250vw; font-size:1.5625vw; text-align:center;}

}

@media only screen and (max-width: 720px) { /* viewport width : 720 */
.point_wrap .inner {width: 100vw;}
.graph_zone{padding:22.2222vw 0 22.2222vw;}
.pie-chart{width: 61.1111vw;height: 61.1111vw;}
span.center{width:58.3333vw;height:58.3333vw;font-size:4.1667vw;font-size:3.3333vw;padding-top:24.3056vw;}
span.center div{margin-top: -12.5000vw;}
.my_mining{font-size:4.4444vw; padding:0 5.5556vw; margin:1.3889vw 0;height:5.5556vw; line-height:5vw; border-radius:0 0 2.7778vw 2.7778vw;}
.out_wrap{bottom:2.7778vw;}
.go_mining{width:27.7778vw; height:27.7778vw; line-height:26.9444vw; border:0.4167vw solid #1db8f8;}
.mining_stat{font-size:3.0556vw; margin-top:1.3889vw;}

.info_zone{padding:20.8333vw 5.5556vw 8.3333vw; border-radius:4.1667vw; margin:-4.1667vw 0; -webkit-box-shadow: 0 0 2.2222vw 0.6944vw rgba(0,0,0,0.1); -moz-box-shadow: 0 0 2.2222vw 0.6944vw rgba(0,0,0,0.1); box-shadow: 0 0 2.2222vw 0.6944vw rgba(0,0,0,0.1);}
.info_rec{width:100%; padding:8.3333vw 5.5556vw; border-radius:2.7778vw;}
.info_rec > img{left:5vw; width:10vw; height:auto;}
.info_rec .info_txt{float:right; padding-left:1.3889vw;}
.info_rec .info_txt h6{font-size:4.7222vw;}
.info_rec .info_txt p{font-size:3.6111vw;}

.rec_zone{padding:13.8889vw 0 11.1111vw;}
.rec_zone h5{margin-left:5.5556vw; font-size:4.4444vw; height:5.5556vw; line-height:5.0000vw; padding-left:1.3889vw;}
.rec_list{padding:0 5.5556vw;margin-top:5.5556vw;}
.rec_list li{margin-bottom:2.7778vw}
.rec_list li img{margin-bottom:1.3889vw;}
.rec_list li span{font-size:2.7778vw;}
.rec_zone p{margin-top:5.5556vw; font-size:2.7778vw;}
}
</style>
<div class="point_wrap">
<div class="inner">
<div class="graph_zone">

	<div class="pie-chart" style="background:conic-gradient(#1df0f8 0% <?php echo intval($remainPerc * 100) ; ?>%, #ebebeb <?php echo intval($remainPerc * 100) ; ?>% 100%);">
		<span class="center">
		<div>
			<p class="txt1">지급 포인트</p>
			<p class="my_mining"><?php echo $my_mining * $my_gop; ?></p>
			<p class="txt2"><small>×</small> <?php echo $my_gop; ?></p>
			<p><i class="fa fa-users" aria-hidden="true"></i> <?php echo $cnt_rc; ?></p>
		</div>
		</span>
	</div>
	
	<div class="out_wrap">
		<?php if(!$is_member || ($member['mb_mine'] != 0 && time() < $member['mb_mine'])) { ?>
		<a href="javascript:alert('채굴중입니다.');" class="go_mining off">
			<img src="/images/logo_btn.png" alt="채굴중">
		</a>
		<?php } else if($member['mb_mine'] == 0) { ?>
		<a href="<?php echo G5_URL; ?>/mining_update.php" class="go_mining"><img src="/images/logo_btn.png" alt="채굴가능"></a>
		<?php } else { ?>
		<a href="<?php echo G5_URL; ?>/mining_update.php" class="go_mining"><img src="/images/logo_btn.png" alt="포인트받기"></a>
		<?php } ?>

		<p class="mining_stat">
		<?php if($member['mb_mine'] == 0) { ?>
			<span>시작하기</span>
		<?php } else if($member['mb_mine'] != 0) { ?>
			<i class="fa fa-clock-o" aria-hidden="true"></i>
			<span id="id_span_timer"><?php if(time() < $member['mb_mine']) echo getTimeFromSeconds($remaintime); else echo '완료'; ?></span>
		<?php } ?>
		</p>
	</div>

</div>
<div class="info_zone">
	<div class="info_rec">
		<img src="/images/rec_icon.png" alt="">
		<div class="info_txt">
			<h6>포인트 획득 꿀팁</h6>
			<p>친구들을 초대하고 최대 <strong>4배</strong>를 더 받으세요.</p>
		</div>
	</div>
</div>
<div class="rec_zone">
	<h5>추천인 명단</h5>
	<?php if($cnt_rc > 0) { ?>
	<ul class="rec_list">
		<?php for($i = 0; $rcc = sql_fetch_array($result_rcc) ; $i++) { ?>
		<li><?php echo get_member_profile_img($rcc['mb_id']); ?><span><?php echo $rcc['mb_id']; ?></span></li>
		<?php } ?>
	</ul>
	<?php } else { ?>
	<p>추천인이 없습니다.</p>
	<?php } ?>
</div>
</div>
</div>

<?php if(time() < $member['mb_mine']) { ?>
<script>
var seconds = <?php echo $remaintime; ?>;


function numberPad(n) {
	n = n + '';
	return n.length >= 2 ? n : new Array(2 - n.length + 1).join('0') + n;
}

function count_down_timer() {
	var hour = parseInt((seconds)/3600);
	var tmp = (seconds) % 3600;
	var min = parseInt((tmp)/60);
	var sec = seconds%60;

	if(seconds > 0){
		seconds--;
		$("#id_span_timer").html(numberPad(hour)+":"+ numberPad(min)+":" + numberPad(sec));
	} else if(seconds == 0) {
		window.location.reload();
	} else {
		$("#id_span_timer").html("완료");
	}
}

setInterval(count_down_timer, 1000);
</script>
<?php } ?>

<?php
include_once(G5_PATH.'/_tail.php');