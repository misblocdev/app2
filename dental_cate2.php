<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.php');
?>

<style>
.sc_mo {display: none;}
.sc_location {float: left;width: 200px;border-right: 1px solid #f1f1f1;}
.sc_location li a {display: block;width: 100%;font-size: 24px;font-weight: bold;color: #cfcfcf;line-height: 60px;}
.sc_location li.on a {color: #777dee;}
.sc_location_2 {float: left;margin-left: 45px;padding-top: 12px;}
.sc_loca_1 > li {display: none;}
.sc_loca_h {font-size: 20px;font-weight: bold;margin-bottom: 8px;}
.sc_loca_list {margin-top: 22px;}
.sc_loca_list li {margin-bottom: 10px;}
.sc_loca_list li a {display: block;font-size: 17px;padding-left: 60px;height: 51px;line-height: 51px;background: url(/images/locate_off.png) no-repeat 0 50%;background-size: 50px;}
.sc_loca_list li:hover a {background: url(/images/locate_on.png) no-repeat 0 50%;background-size: 50px;}

/* 반응형 css */
@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

.sc_location {width: 15.6250vw;}
.sc_location li a {font-size: 1.8750vw;line-height: 4.6875vw;}
.sc_location_2 {margin-left: 3.5156vw;padding-top: 0.9375vw;}
.sc_loca_h {font-size: 1.5625vw;margin-bottom: 0.6250vw;}
.sc_loca_list {margin-top: 1.7188vw;}
.sc_loca_list li {margin-bottom: 0.7813vw;}
.sc_loca_list li a {font-size: 1.3281vw;padding-left: 4.6875vw;height: 3.9844vw;line-height: 3.9844vw;background-size: 3.9063vw;}
.sc_loca_list li:hover a {background-size: 3.9063vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

.sc_pc {display: none;}
.sc_mo {display: block;}
.m_location {border-top: 0.1302vw solid #ebebeb;}
.m_location dt {}
.m_location dt a {display: block;width: 100%;line-height: 15.5313vw;font-size: 3.9063vw;color: #cfcfcf;font-weight: bold;padding-left: 7.8125vw;}
.m_location dt.on a {color: #777dee;}
.m_location dd {display: none;padding: 1.5625vw 0;border-top: 0.1302vw solid #ebebeb;border-bottom: 0.1302vw solid #ebebeb;}
.m_location dd a {display: block;width: 100%;line-height: 13.2813vw;font-size: 3.9063vw;color: #000;padding-left: 13.0208vw;}

}
</style>

<div class="sub_content">
	<div class="inner">
		<div class="sub_title">치과찾기</div>
		<div class="sub_nav sub_nav_4">
			<ul class="clearfix">
				<li><a href="<?php echo G5_URL;?>/dental_cate3.php">지도<span class="hide768">로 </span>찾기</a></li>
				<li><a href="<?php echo G5_URL;?>/dental_cate1.php">분야<span class="hide768">로 </span>찾기</a></li>
				<li class="on"><a href="<?php echo G5_URL;?>/dental_cate2.php">지역<span class="hide768">으로 </span>찾기</a></li>
				<li><a href="<?php echo G5_URL;?>/dental_cate4.php">증상<span class="hide768">으로 </span>찾기</a></li>
			</ul>
		</div>
		<div class="dental_cate_wrap">
			<!-- sc_pc { -->
			<div class="sc_pc clearfix">
				<div class="sc_location">
					<ul>
						<li class="on"><a href="javascript:;">서울</a></li>
						<li><a href="javascript:;">인천/경기</a></li>
						<li><a href="javascript:;">강원도</a></li>
						<li><a href="javascript:;">충청도</a></li>
						<li><a href="javascript:;">전라도</a></li>
						<li><a href="javascript:;">경상도</a></li>
						<li><a href="javascript:;">제주도</a></li>
						<li><a href="javascript:;">세종특별자치시</a></li>
					</ul>
				</div>
				<div class="sc_location_2">
					<ul class="sc_loca_1">
						<li>
							<div class="sc_loca_h">서울 지역</div>
							<div class="sc_loca_list">
								<ul class="sc_loca_2">
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=서초&ct=2">서초</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=강남&ct=2">강남</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=강동+송파&ct=2">강동/송파</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=강서+양천+영등포+구로&ct=2">강서/양천/영등포/구로</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=도봉+강북+성북+노원&ct=2">도봉/강북/성북/노원</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=동대문+성동+광진+중랑&ct=2">동대문/성동/광진/중랑</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=종로+중구+용산&ct=2">종로/중구/용산</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=서대문+마포+은평&ct=2">서대문/마포/은평</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=동작+관악+금천&ct=2">동작/관악/금천</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="sc_loca_h">인천/경기 지역</div>
							<div class="sc_loca_list">
								<ul class="sc_loca_2">
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=인천+부천&ct=2">인천/부천</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=경기&ct=2">경기</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="sc_loca_h">강원도 지역</div>
							<div class="sc_loca_list">
								<ul class="sc_loca_2">
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=춘천시 +강원 &ct=2">춘천/강원</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="sc_loca_h">충청도 지역</div>
							<div class="sc_loca_list">
								<ul class="sc_loca_2">
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=대전 +충남 &ct=2">대전/충남</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=청주시 +충북 &ct=2">청주/충북</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="sc_loca_h">전라도 지역</div>
							<div class="sc_loca_list">
								<ul class="sc_loca_2">
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=광주 +전남 &ct=2">광주/전남</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=전주 +전북 &ct=2">전주/전북</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="sc_loca_h">경상도 지역</div>
							<div class="sc_loca_list">
								<ul class="sc_loca_2">
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=부산 +울산 +경남 &ct=2">부산/울산/경남</a></li>
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=대구 +경북 &ct=2">대구/경북</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="sc_loca_h">제주도 지역</div>
							<div class="sc_loca_list">
								<ul class="sc_loca_2">
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=제주특별자치도&ct=2">제주</a></li>
								</ul>
							</div>
						</li>
						<li>
							<div class="sc_loca_h">세종특별자치시 지역</div>
							<div class="sc_loca_list">
								<ul class="sc_loca_2">
									<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=세종특별자치시&ct=2">세종</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<!-- } sc_pc -->

			<!-- sc_mo { -->
			<div class="sc_mo">
				<div class="m_location">
					<dl>
						<dt><a href="javascript:;">서울</a></dt>
						<dd class="m_loca">
							<ul class="sc_loca_2">
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=서초&ct=2">서초</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=강남&ct=2">강남</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=강동+송파&ct=2">강동/송파</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=강서+양천+영등포+구로&ct=2">강서/양천/영등포/구로</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=도봉+강북+성북+노원&ct=2">도봉/강북/성북/노원</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=동대문+성동+광진+중랑&ct=2">동대문/성동/광진/중랑</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=종로+중구+용산&ct=2">종로/중구/용산</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=서대문+마포+은평&ct=2">서대문/마포/은평</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=동작+관악+금천&ct=2">동작/관악/금천</a></li>
							</ul>
						</dd>
						<dt><a href="javascript:;">인천/경기</a></dt>
						<dd class="m_loca">
							<ul class="sc_loca_2">
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=인천+부천&ct=2">인천/부천</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=경기&ct=2">경기</a></li>
							</ul>
						</dd>
						<dt><a href="javascript:;">강원도</a></dt>
						<dd class="m_loca">
							<ul class="sc_loca_2">
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=춘천시 +강원 &ct=2">춘천/강원</a></li>
							</ul>
						</dd>
						<dt><a href="javascript:;">충청도</a></dt>
						<dd class="m_loca">
							<ul class="sc_loca_2">
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=대전 +충남 &ct=2">대전/충남</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=청주시 +충북 &ct=2">청주/충북</a></li>
							</ul>
						</dd>
						<dt><a href="javascript:;">전라도</a></dt>
						<dd class="m_loca">
							<ul class="sc_loca_2">
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=광주 +전남 &ct=2">광주/전남</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=전주 +전북 &ct=2">전주/전북</a></li>
							</ul>
						</dd>
						<dt><a href="javascript:;">경상도</a></dt>
						<dd class="m_loca">
							<ul class="sc_loca_2">
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=부산 +울산 +경남 &ct=2">부산/울산/경남</a></li>
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=대구 +경북 &ct=2">대구/경북</a></li>
							</ul>
						</dd>
						<dt><a href="javascript:;">제주도</a></dt>
						<dd class="m_loca">
							<ul class="sc_loca_2">
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=제주특별자치도&ct=2">제주</a></li>
							</ul>
						</dd>
						<dt><a href="javascript:;">세종특별자치시</a></dt>
						<dd class="m_loca">
							<ul class="sc_loca_2">
								<li><a href="<?php echo get_pretty_url('dental');?>&sop=or&sfl=wr_2&stx=세종특별자치시&ct=2">세종</a></li>
							</ul>
						</dd>
					</dl>
				</div>
			</div>
			<!-- } sc_mo -->
		</div>
	</div>
</div>

<script>
$('.sc_loca_1 > li').first().show();
$('.sc_location li').on('click', function(){
	var cnt = $(this).index();
	$('.sc_location li').removeClass('on').eq(cnt).addClass('on');
	$('.sc_loca_1 > li').hide().eq(cnt).show();
})

$('.m_location dt').on('click', function(){
	$('.m_location dt').not(this).removeClass('on').next().slideUp();
	$(this).addClass('on').next().slideToggle();
})
</script>

<?php
include_once(G5_PATH.'/tail.php');