<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.php');
?>

<style>
.sc {position: relative;min-height:490px;}
.Symptom_1 > li {position:absolute;width: 386px;border-radius: 22px;border: 1px solid #ebebeb;overflow: hidden;
-webkit-box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.1);
-moz-box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.1);
box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.1);}
.Symptom_1 > li:nth-child(3n) {left: 814px;}
.Symptom_1 > li:nth-child(3n-1) {left: 407px;}
.Symptom_1 > li:nth-child(3n-2) {left: 0;}
.Symptom_1 > li:nth-child(-n+12) {top: 360px;}
.Symptom_1 > li:nth-child(-n+9) {top: 240px;}
.Symptom_1 > li:nth-child(-n+6) {top: 120px;}
.Symptom_1 > li:nth-child(-n+3) {top: 0;}
.Symptom_1 > li > a {display: block;width: 100%;height: 88px;line-height: 88px;padding-left: 30px;font-size: 20px;font-weight: 500;position: relative;}
.Symptom_1 > li > a:after {content: '';display: block;clear: both;width: 20px;height: 20px;background: url(/images/symptom_arr.png) no-repeat 50% 50%;background-size: 11px;position: absolute;top: 50%;right: 36px;transform: translateY(-50%) rotate(0);transition: all 0.4s ease;}
.Symptom_1 > li.on > a:after {transform: translateY(-50%) rotate(90deg);}
.Symptom_2 {display: none;background: #fff;padding: 0px 22px;position: relative;z-index: 5;}
.Symptom_2 ul {border-top: 1px solid #ebebeb;padding: 15px 0 20px;}
.Symptom_2 li a {display: block;font-size: 17px;height: 32px;line-height: 32px;font-weight: 300;padding-left: 20px;position: relative;letter-spacing: -0.07em;}
.Symptom_2 li a:after {content: '';display: block;clear: both;width: 5px;height: 5px;background: #777dee;border-radius: 50%;position: absolute;left: 6px;top: 14px;}

/* 반응형 css */
@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

.sc {min-height:38.2813vw;}
.Symptom_1 > li {width: 30.1563vw;border-radius: 1.7188vw;}
.Symptom_1 > li:nth-child(3n) {left: 63.5938vw;}
.Symptom_1 > li:nth-child(3n-1) {left: 31.7969vw;}
.Symptom_1 > li:nth-child(3n-2) {left: 0;}
.Symptom_1 > li:nth-child(-n+12) {top: 28.1250vw;}
.Symptom_1 > li:nth-child(-n+9) {top: 18.7500vw;}
.Symptom_1 > li:nth-child(-n+6) {top: 9.3750vw;}
.Symptom_1 > li:nth-child(-n+3) {top: 0;}
.Symptom_1 > li > a {height: 6.8750vw;line-height: 6.8750vw;padding-left: 2.3438vw;font-size: 1.5625vw;}
.Symptom_1 > li > a:after {width: 1.5625vw;height: 1.5625vw;background-size: 0.8594vw;top: 50%;right: 2.8125vw;}
.Symptom_2 {padding: 0.0000vw 1.7188vw;}
.Symptom_2 ul {padding: 1.1719vw 0 1.5625vw;}
.Symptom_2 li a {font-size: 1.3281vw;height: 2.5000vw;line-height: 2.5000vw;padding-left: 1.5625vw;}
.Symptom_2 li a:after {width: 0.3906vw;height: 0.3906vw;left: 0.4688vw;top: 1.0938vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

.sc {position: relative;min-height:101.5625vw;}
.Symptom_1 > li {position:absolute;width: 45.5729vw;border-radius: 4.5573vw;}
.Symptom_1 > li:nth-child(3n) {left: 0;}
.Symptom_1 > li:nth-child(3n-1) {left: 0;}
.Symptom_1 > li:nth-child(3n-2) {left: 0;}
.Symptom_1 > li:nth-child(-n+12) {top: 0;}
.Symptom_1 > li:nth-child(-n+9) {top: 0;}
.Symptom_1 > li:nth-child(-n+6) {top: 0;}
.Symptom_1 > li:nth-child(-n+3) {top: 0;}
.Symptom_1 > li:nth-child(2n) {left: 0;}
.Symptom_1 > li:nth-child(2n-1) {left: 48.1771vw;}
.Symptom_1 > li:nth-child(-n+12) {top: 78.1250vw;}
.Symptom_1 > li:nth-child(-n+10) {top: 62.5000vw;}
.Symptom_1 > li:nth-child(-n+8) {top: 46.8750vw;}
.Symptom_1 > li:nth-child(-n+6) {top: 31.2500vw;}
.Symptom_1 > li:nth-child(-n+4) {top: 15.6250vw;}
.Symptom_1 > li:nth-child(-n+2) {top: 0;}
.Symptom_1 > li > a {height: 12.7604vw;line-height: 12.7604vw;padding-left: 4.1667vw;font-size: 3.1250vw;}
.Symptom_1 > li > a.line_2 {line-height: 1.3;padding-top: 2.0833vw;}
.Symptom_1 > li > a:after {width: 3.1250vw;height: 3.1250vw;background-size: 1.7188vw;right: 3.9063vw;}
.Symptom_2 {padding: 0.0000vw 2.8646vw;}
.Symptom_2 ul {padding: 1.9531vw 0 2.6042vw;}
.Symptom_2 li {margin: 1.3021vw 0;}
.Symptom_2 li a {font-size: 3.1250vw;height: auto;line-height: 3.6458vw;padding-left: 3.1250vw;-ms-word-break: keep-all;word-break: keep-all;}
.Symptom_2 li a:after {width: 0.9115vw;height: 0.9115vw;left: 0.7813vw;top: 1.4323vw;}

}
</style>

<div class="sub_content">
	<div class="inner">
		<div class="sub_title">치과찾기</div>
		<div class="sub_nav sub_nav_4">
			<ul class="clearfix">
				<li><a href="<?php echo G5_URL;?>/dental_cate3.php">지도<span class="hide768">로 </span>찾기</a></li>
				<li><a href="<?php echo G5_URL;?>/dental_cate1.php">분야<span class="hide768">로 </span>찾기</a></li>
				<li><a href="<?php echo G5_URL;?>/dental_cate2.php">지역<span class="hide768">으로 </span>찾기</a></li>
				<li class="on"><a href="<?php echo G5_URL;?>/dental_cate4.php">증상<span class="hide768">으로 </span>찾기</a></li>
			</ul>
		</div>
		<div class="sc">
			<ul class="Symptom_1 clearfix">
				<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=일반진료&ct=4">스케일링 하고 싶어요.</a></li>
				<li><a href="javascript:;">이가 시리고 아파요.</a>
					<div class="Symptom_2">
						<ul>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=일반진료&ct=4">이가 시려요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=일반진료&ct=4">양치할 때 불편해요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=신경치료+일반진료&ct=4">뜨겁거나 차가운 물을 마시면 불편해요.</a></li>
						</ul>
					</div>
				</li>
				<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=기본진료+일반진료&ct=4">충치가 있어요.</a></li>
				<li><a href="javascript:;">잇몸이 붓고 아파요.</a>
					<div class="Symptom_2">
						<ul>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=잇몸치료&ct=4">잇몸이 부었어요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=잇몸치료+신경치료&ct=4">씹을 때 아파요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=잇몸치료&ct=4">잇몸에서 피가나요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=잇몸치료&ct=4">이가 흔들려요.</a></li>
						</ul>
					</div>
				</li>
				<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=사랑니발치&ct=4">사랑니를 빼고 싶어요.</a></li>
				<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=일반진료+심미보철&ct=4">이가 깨졌어요.</a></li>
				<li><a href="javascript:;">이가 삐뚤삐뚤해요.</a>
					<div class="Symptom_2">
						<ul>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=교정진료+라미네이트+심미보철&ct=4">이 사이가 점점 벌어져요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=교정진료+라미네이트&ct=4">이가 가지런하지 않아요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=투명교정+설측교정&ct=4">남들에게 잘 안 보이는 교정하고 싶어요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=부분교정+라미네이트&ct=4">앞니만 고르게 하고 싶어요.</a></li>
						</ul>
					</div>
				</li>
				<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=미백진료&ct=4">이를 하얗게 하고 싶어요.</a></li>
				<li><a href="javascript:;" class="line_2">틀니 및 임플란트 상담이<br class="show768"> 필요해요.</a>
					<div class="Symptom_2">
						<ul>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=임플란트&ct=4">임플란트 상담이 필요해요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=디지털임플란트&ct=4">디지털(네비게이션) 임플란트 치료를 받고 싶어요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=임플란트&ct=4">임플란트 한 부위가 불편해요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=틀니치료&ct=4">틀니를 하고 싶어요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=수면진정치료&ct=4">수면임플란트 하고 싶어요.</a></li>
						</ul>
					</div>
				</li>
				<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=턱관절치료&ct=4">턱이 불편해요.</a></li>
				<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=어린이치료&ct=4">어린이 치료가 필요해요.</a></li>
				<li><a href="javascript:;">양악수술 하고 싶어요.</a>
					<div class="Symptom_2">
						<ul>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=사각턱수술&ct=4">아래턱이 크고 많이 튀어 나왔어요.</a></li>
							<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_11&stx=양악수술+안면윤곽술&ct=4">턱을 갸름하게 하고 싶어요.</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>

<script>
$('.Symptom_1 > li').on('click', function(){
	if($(this).find('.Symptom_2').length != 0) {
		$(this).toggleClass('on').find('.Symptom_2').slideToggle();
	}
})
</script>

<?php
include_once(G5_PATH.'/tail.php');