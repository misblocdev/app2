<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.sub.php');
?>

<style>
.eventpage {background-image: url('/images/event_bg_txt.png'), url('/images/event_bg_coin.png'), url('/images/event_bg.jpg');background-size: 862px 180px, 316px 257px, 100% 100%; background-position: -28px -10px, 100% 181px, 50% 50%;background-repeat:no-repeat;}
.event_title {text-align: center;font-size: 70px;line-height: 90px;font-family: 'S-CoreDream-1Thin';color: #fff;letter-spacing: 0.15em;padding-top: 80px;margin-bottom: 88px;overflow: hidden;}
.event_title span {display: block;text-transform: uppercase;font-size: 17px;color: #fff;letter-spacing: 1.8em;font-family: 'S-CoreDream-4Regular';position: relative;left: 10px;margin-bottom: 10px;}
.event_title b {font-family: 'S-CoreDream-7ExtraBold';letter-spacing: -0.07em;}

.event_list {padding: 0 42px 84px;}
.event_list li {float: left;width: 522px;height: 370px;margin: 0 18px 36px;background: rgba(0, 0, 0, 0.3);border-radius: 10px;padding: 40px 60px 0;text-align: center;}
.event_num {background: url(/images/event_num_line.png) no-repeat 50% 50%;height: 55px;line-height: 55px;font-size: 18px;color: #1ef5ce;font-family: 'S-CoreDream-7ExtraBold';}
.event_name {font-size: 17px;color: #1ef5ce;letter-spacing: 0.3em;line-height: 1;font-family: 'S-CoreDream-4Regular';margin: 18px 0 15px;}
.event_content {font-size: 26px;color: #fff;line-height: 34px;letter-spacing: -0.09em;font-family: 'S-CoreDream-8Heavy';}
.event_content:after {content: '';display: block;clear: both;width: 1px;height: 26px;background: #1ef5ce;margin: 13px auto 14px;}
.event_detail {font-size: 18px;color: #fff;line-height: 28px;letter-spacing: -0.01em;font-family: 'S-CoreDream-2ExtraLight';}

.event_footer {width: 100%;height: 446px;background: rgba(0, 0, 0, 0.5);padding: 0 50px;}
.event_footer_h {font-size: 26px;color: #fff;line-height: 1;border-bottom: 1px solid rgba(255, 255, 255, 0.2);font-family: 'S-CoreDream-7ExtraBold';padding: 55px 10px 28px;margin-bottom: 30px;}
.event_footer_txt li {font-size: 17px;line-height: 36px;color: #fff;font-family: 'S-CoreDream-2ExtraLight';padding-left: 20px;position: relative;}
.event_footer_txt li:after {content: '';display: block;clear: both;width: 5px;height: 5px;border-radius: 50%;background: #fff;position: absolute;left: 8px;top: 18px;transform: translateY(-50%);}
.event_footer_txt li p {font-size: 15px;letter-spacing: -0.1em;}

/* 반응형 css */
@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

.inner {width: 100%;}
.eventpage {background-size: 67.3438vw 14.0625vw, 24.6875vw 20.0781vw, 100% 100%; background-position: -2.1875vw -0.7813vw, 100% 14.1406vw, 50% 50%;}
.event_title {font-size: 5.4688vw;line-height: 7.0313vw;padding-top: 6.2500vw;margin-bottom: 6.8750vw;}
.event_title span {font-size: 1.3281vw;left: 0.7813vw;margin-bottom: 0.7813vw;}

.event_list {padding: 0 6.4063vw 6.5625vw;}
.event_list li {width: 40.7813vw;height: 28.9063vw;margin: 0 1.4063vw 2.8125vw;border-radius: 0.7813vw;padding: 3.1250vw 4.6875vw 0;}
.event_num {background-size: 31.2500vw;height: 4.2969vw;line-height: 4.2969vw;font-size: 1.4063vw;}
.event_name {font-size: 1.3281vw;margin: 1.4063vw 0 1.1719vw;}
.event_content {font-size: 2.0313vw;line-height: 2.6563vw;}
.event_content:after {width: 0.0781vw;height: 2.0313vw;margin: 1.0156vw auto 1.0938vw;}
.event_detail {font-size: 1.4063vw;line-height: 2.1875vw;}

.event_footer {height: 34.8438vw;padding: 0 7.0313vw;}
.event_footer_h {font-size: 2.0313vw;padding: 4.2969vw 0.7813vw 2.1875vw;margin-bottom: 2.3438vw;}
.event_footer_txt li {font-size: 1.3281vw;line-height: 2.8125vw;padding-left: 1.5625vw;}
.event_footer_txt li:after {width: 0.3906vw;height: 0.3906vw;left: 0.6250vw;top: 1.4063vw;}
.event_footer_txt li p {font-size: 1.1719vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

.eventpage {background-size: 100.0000vw, 41.1458vw 33.4635vw, 100% 100%; background-position: -3.6458vw -1.3021vw, 115% 44.2708vw, 50% 50%;}
.event_title {font-size: 10.4167vw;line-height: 13.0208vw;padding-top: 13.0208vw;margin-bottom: 15.6250vw;}
.event_title span {font-size: 3.1250vw;letter-spacing: 1.2em;left: 1.5625vw;margin-bottom: 1.3021vw;}
.event_title b {letter-spacing: -0.05em;}

.event_list {padding: 0 8.4167vw .9375vw;}
.event_list li {float: none;width: 100%;height: 62.5000vw;margin: 0 0.0000vw 5.2083vw;border-radius: 2.6042vw;padding: 5.2083vw 6.5104vw 0;}
.event_num {background-size: 100%;height: 9.1146vw;line-height: 9.1146vw;font-size: 3.3854vw;}
.event_name {font-size: 3.1250vw;margin: 3.9063vw 0 3.2552vw;letter-spacing: 0.24em;}
.event_content {font-size: 3.9667vw;line-height: 6.2500vw;}
.event_content:after {width: 0.1302vw;height: 4.4271vw;margin: 3.2552vw auto 3.6458vw;}
.event_detail {font-size: 3.3854vw;line-height: 4.4271vw;}

.event_footer {height: 84.9896vw;padding: 0 8.4167vw;}
.event_footer_h {font-size: 4.1667vw;padding: 9.1146vw 1.3021vw 4.5573vw;margin-bottom: 5.2083vw;}
.event_footer_txt li {font-size: 2.6042vw;line-height: 6.2500vw;padding-left: 3.2552vw;}
.event_footer_txt li:after {width: 0.9115vw;height: 0.9115vw;left: 1.0417vw;top: 2.6042vw;transform: translateY(0%);}
.event_footer_txt li p {font-size: 2.0438vw;}

}
</style>

<div class="inner">
	<div class="eventpage">
		<!-- event_title { -->
		<div class="event_title">
			<span>anapatalk event</span>
			아나파톡 2.0 <br/><b>출시 기념 이벤트</b>
		</div>
		<!-- } event_title -->

		<!-- event_list { -->
		<div class="event_list">
			<ul class="clearfix">
				<li>
					<div class="event_num">01</div>
					<div class="event_name">신규회원 가입 이벤트</div>
					<div class="event_content">아나파톡 신규 회원 가입시<br/>300P 지급</div>
					<div class="event_detail">신규회원 가입시 300P 지급</div>
				</li>
				<li>
					<div class="event_num">02</div>
					<div class="event_name">후기 등록 이벤트</div>
					<div class="event_content">병원 진료 후 후기를 등록하시면 100P,<br/>후기에 사진 첨부시100P 지급</div>
					<div class="event_detail">일반 후기 100P,<br/>사진 첨부시100P 추가 지급</div>
				</li>
				<li>
					<div class="event_num">03</div>
					<div class="event_name">가입자,후기 등록자 대상 추첨 이벤트</div>
					<div class="event_content">가입자 10명, 후기 등록자 10명<br/>각 1000P 지급</div>
					<div class="event_detail">가입자 10명, 후기 등록자 10명<br/>각 1000P 지급</div>
				</li>
				<li>
					<div class="event_num">04</div>
					<div class="event_name">제휴병원 스케일링 이벤트</div>
					<div class="event_content">아나파톡 제휴 병원에서 스케일링 받고<br/>진료 영수증을 제출하시면 1600P 지급</div>
					<div class="event_detail">스케일링 받은 진료 영수증을 카카오톡 채널로<br/>제출하시면 1600P 지급</div>
				</li>
			</ul>
		</div>
		<!-- } event_list -->

		<!-- event_footer { -->
		<div class="event_footer">
			<div class="event_footer_h">주의사항</div>
			<div class="event_footer_txt">
				<ul>
					<li>이벤트 기간 : ‘아나파톡’ 출시 후 한달간</li>
					<li>문의채널 : 미스블록 공식 채팅방 또는 <a href="javascript:;" style="color: #fff;">contact@misbloc.io</a></li>
					<li>아나파톡 포인트 정책
						<p>1. 회원 가입시 지급되는 포인트는 일반 회원 대상입니다. <br class="show768"/>(기업 회원은 포인트가 지급되지 않습니다.)</p>
						<p>2. 병원 후기 등록시 지급되는 포인트는 주 1회 작성 후기에 한해 지급됩니다.</p>
						<p>3. 탈퇴 후 재가입시 기존 인증 내역 있으면 가입 포인트는 지급되지 않습니다.</p>
						<p>4. 이벤트로 지급된 포인트는 환불 대상이 아닙니다.</p>
						<p>5. 1P는 10원의 가치를 가집니다.</p>
					</li>
				</ul>
			</div>
		</div>
		<!-- } event_footer -->
	</div>
</div>

<?php
include_once(G5_PATH.'/tail.sub.php');