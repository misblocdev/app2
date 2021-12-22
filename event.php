<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.php');
?>

<style>
.sc_mo {display: none;}
.sc_location {float: left;width: 200px;border-right: 1px solid #f1f1f1;}
.sc_locat_h {font-size: 20px;font-weight: bold;margin-bottom: 8px;}
.sc_location li a {display: block;width: 100%;font-size: 24px;font-weight: bold;color: #cfcfcf;line-height: 60px;}
.sc_location li.on a {color: #777dee;}
.sc_cate {float: left;margin-left: 45px;}
.sc_cate_list {margin-top: 22px;}
.sc_cate_list li {margin-bottom: 15px;}
.sc_cate_list li a {display: block;width: 140px;height: 45px;line-height: 45px;text-align: center;background: #ebebeb;color: #000000;font-size: 17px;font-weight: 100;transition: all 0.3s ease;}
.sc_cate_list li:hover a {background: #b3b6f7;color: #fff;font-weight: 400;}

/* 반응형 css */
@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

.sc_location {width: 15.6250vw;}
.sc_locat_h {font-size: 1.5625vw;margin-bottom: 0.6250vw;}
.sc_location li a {font-size: 1.8750vw;line-height: 4.6875vw;}
.sc_cate {margin-left: 3.5156vw;}
.sc_cate_list {margin-top: 1.7188vw;}
.sc_cate_list li {margin-bottom: 1.1719vw;}
.sc_cate_list li a {width: 10.9375vw;height: 3.5156vw;line-height: 3.5156vw;font-size: 1.3281vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

.sc_pc {display: none;}
.sc_mo {display: block;}
.m_location {border-top: 0.1302vw solid #ebebeb;}
.m_location dt {}
.m_location dt a {display: block;width: 100%;line-height: 19.5313vw;font-size: 5.4688vw;color: #cfcfcf;font-weight: bold;padding-left: 7.8125vw;}
.m_location dt.on a {color: #777dee;}
.m_location dd {display: none;padding: 1.5625vw 0;border-top: 0.1302vw solid #ebebeb;border-bottom: 0.1302vw solid #ebebeb;}
.m_location dd a {display: block;width: 100%;line-height: 13.2813vw;font-size: 3.6458vw;color: #000;padding-left: 13.0208vw;}

}
</style>

<div class="sub_content">
	<div class="inner">
		<div class="sub_title">이벤트</div>
		<div class="sc">
			<!-- sc_pc { -->
			<div class="sc_pc clearfix">
				<div class="sc_location">
					<div class="sc_locat_h">지역</div>
					<ul>
						<li class="on"><a href="javascript:;" onclick="selectLocation('서울', '서울')">서울</a></li>
						<li><a href="javascript:;" onclick="selectLocation('부산', '부산')">부산</a></li>
						<li><a href="javascript:;" onclick="selectLocation('대구', '대구')">대구</a></li>
						<li><a href="javascript:;" onclick="selectLocation('인천', '인천')">인천</a></li>
						<li><a href="javascript:;" onclick="selectLocation('광주', '광주')">광주</a></li>
						<li><a href="javascript:;" onclick="selectLocation('대전', '대전')">대전</a></li>
						<li><a href="javascript:;" onclick="selectLocation('울산', '울산')">울산</a></li>
						<li><a href="javascript:;" onclick="selectLocation('경기', '경기')">경기도</a></li>
						<li><a href="javascript:;" onclick="selectLocation('강원', '강원')">강원도</a></li>
						<li><a href="javascript:;" onclick="selectLocation('충청도', '충북+충남')">충청도</a></li>
						<li><a href="javascript:;" onclick="selectLocation('전라도', '전북+전남')">전라도</a></li>
						<li><a href="javascript:;" onclick="selectLocation('경상도', '경북+경남')">경상도</a></li>
						<li><a href="javascript:;" onclick="selectLocation('제주도', '제주특별자치도')">제주도</a></li>
						<li><a href="javascript:;" onclick="selectLocation('세종특별자치시', '세종특별자치시')">세종특별자치시</a></li>
					</ul>
				</div>
				<div class="sc_cate">
					<div class="sc_locat_h">분야</div>
					<div class="sc_cate_list">
						<?php
						$event = get_board_db('event', true);
						//echo $board['bo_category_list'];
						$cate = explode('|', $event['bo_category_list']);
						?>
						<ul>
						<?php 
						for($i = 0 ; $i < count($cate) ; $i++) { ?>
							<li><a href="<?php echo get_pretty_url('event');?>&sca=<?php echo $cate[$i]?>&sop=or&sfl=wr_3&stx=서울&locate=서울"><?php echo $cate[$i]?></a></li>
						<?php }
						?>
						</ul>
					</div>
				</div>
			</div>
			<!-- } sc_pc -->

			<!-- sc_mo { -->
			<div class="sc_mo">
				<div class="m_location">
					<dl>
						<dt><a href="javascript:;" onclick="mobileLocation('서울', '서울', 0)">서울</a></dt>
						<dd class="cate_0 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('부산', '부산', 1)">부산</a></dt>
						<dd class="cate_1 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('대구', '대구', 2)">대구</a></dt>
						<dd class="cate_2 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('인천', '인천', 3)">인천</a></dt>
						<dd class="cate_3 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('광주', '광주', 4)">광주</a></dt>
						<dd class="cate_4 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('대전', '대전', 5)">대전</a></dt>
						<dd class="cate_5 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('울산', '울산', 6)">울산</a></dt>
						<dd class="cate_6 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('경기', '경기', 7)">경기도</a></dt>
						<dd class="cate_7 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('강원', '강원', 8)">강원도</a></dt>
						<dd class="cate_8 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('충청도', '충북+충남', 9)">충청도</a></dt>
						<dd class="cate_9 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('전라도', '전북+전남', 10)">전라도</a></dt>
						<dd class="cate_10 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('경상도', '경북+경남', 11)">경상도</a></dt>
						<dd class="cate_11 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('제주도', '제주특별자치도', 12)">제주도</a></dt>
						<dd class="cate_12 m_cate"></dd>
						<dt><a href="javascript:;" onclick="mobileLocation('세종특별자치시', '세종특별자치시', 13)">세종특별자치시</a></dt>
						<dd class="cate_13 m_cate"></dd>
					</dl>
				</div>
			</div>
			<!-- } sc_mo -->
		</div>
	</div>
</div>

<script>
$('.sc_location li').on('click', function(){
	$('.sc_location li').removeClass('on');
	$(this).addClass('on');
})

function selectLocation(loca1, loca2){
	$.ajax({
		url : "/ajax.location.php",
		type: "POST",
		data : {
			"loca1" : loca1,
			"loca2" : loca2,
		},
		async: false,
		success: function(msg) {
		  $(".sc_cate_list").html(msg);
		},error: function(request,status,error){
		  alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
		}
	})
}

$('.m_location dt').on('click', function(){
	$('.m_location dt').not(this).removeClass('on').next().slideUp();
	$(this).addClass('on').next().slideToggle();
})

function mobileLocation(loca1, loca2, num){
	$.ajax({
		url : "/m.ajax.location.php",
		type: "POST",
		data : {
			"loca1" : loca1,
			"loca2" : loca2,
		},
		async: false,
		success: function(msg) {
		  //$(".m_cate").empty();
		  $(".cate_" + num).html(msg);
		},error: function(request,status,error){
		  alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
		}
	})
}
</script>

<?php
include_once(G5_PATH.'/tail.php');