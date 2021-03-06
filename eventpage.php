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

/* ????????? css */
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
			???????????? 2.0 <br/><b>?????? ?????? ?????????</b>
		</div>
		<!-- } event_title -->

		<!-- event_list { -->
		<div class="event_list">
			<ul class="clearfix">
				<li>
					<div class="event_num">01</div>
					<div class="event_name">???????????? ?????? ?????????</div>
					<div class="event_content">???????????? ?????? ?????? ?????????<br/>300P ??????</div>
					<div class="event_detail">???????????? ????????? 300P ??????</div>
				</li>
				<li>
					<div class="event_num">02</div>
					<div class="event_name">?????? ?????? ?????????</div>
					<div class="event_content">?????? ?????? ??? ????????? ??????????????? 100P,<br/>????????? ?????? ?????????100P ??????</div>
					<div class="event_detail">?????? ?????? 100P,<br/>?????? ?????????100P ?????? ??????</div>
				</li>
				<li>
					<div class="event_num">03</div>
					<div class="event_name">?????????,?????? ????????? ?????? ?????? ?????????</div>
					<div class="event_content">????????? 10???, ?????? ????????? 10???<br/>??? 1000P ??????</div>
					<div class="event_detail">????????? 10???, ?????? ????????? 10???<br/>??? 1000P ??????</div>
				</li>
				<li>
					<div class="event_num">04</div>
					<div class="event_name">???????????? ???????????? ?????????</div>
					<div class="event_content">???????????? ?????? ???????????? ???????????? ??????<br/>?????? ???????????? ??????????????? 1600P ??????</div>
					<div class="event_detail">???????????? ?????? ?????? ???????????? ???????????? ?????????<br/>??????????????? 1600P ??????</div>
				</li>
			</ul>
		</div>
		<!-- } event_list -->

		<!-- event_footer { -->
		<div class="event_footer">
			<div class="event_footer_h">????????????</div>
			<div class="event_footer_txt">
				<ul>
					<li>????????? ?????? : ?????????????????? ?????? ??? ?????????</li>
					<li>???????????? : ???????????? ?????? ????????? ?????? <a href="javascript:;" style="color: #fff;">contact@misbloc.io</a></li>
					<li>???????????? ????????? ??????
						<p>1. ?????? ????????? ???????????? ???????????? ?????? ?????? ???????????????. <br class="show768"/>(?????? ????????? ???????????? ???????????? ????????????.)</p>
						<p>2. ?????? ?????? ????????? ???????????? ???????????? ??? 1??? ?????? ????????? ?????? ???????????????.</p>
						<p>3. ?????? ??? ???????????? ?????? ?????? ?????? ????????? ?????? ???????????? ???????????? ????????????.</p>
						<p>4. ???????????? ????????? ???????????? ?????? ????????? ????????????.</p>
						<p>5. 1P??? 10?????? ????????? ????????????.</p>
					</li>
				</ul>
			</div>
		</div>
		<!-- } event_footer -->
	</div>
</div>

<?php
include_once(G5_PATH.'/tail.sub.php');