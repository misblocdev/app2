<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.php');

$den_id = $_GET['den_id'];
$dental = sql_fetch("select * from g5_write_dental where wr_code='".$den_id."'");
?>

<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>
<style>
#yyayya{width:100%;position:relative;height:500px;/* border:2px solid #ddd; border-radius:15px !important; */}
.cal_calendar{width:100%;height:380px;}

#yyayya22{width:826px;position:absolute;left:184px;top:74px;height:600px;border:2px solid #ddd; border-radius:15px !important;background:#f9f9f9;}

.txtzone{font-size: 13px;margin:24px 0;line-height: 24px;}

.posir{position: relative;}
.posir img{width:30px;position: absolute;left:5px;top:50%;margin-top: -15px;}

table{}
table.cal_calendar{padding:0px;margin:0 auto;border-collapse:collapse;border-spacing:0;}
table.cal_calendar th{width:36px;font-size:11px;padding:17px 3px;border:1px solid #fff;color:#000;}
table.cal_calendar td{text-align:center;margin:0 0px;padding:2px;border:1px solid #fff;line-height:24px;height: 50px;}
/*table.cal_calendar td.on{color:#fff !important;background:url(/shop/images/bbbggg.jpg) no-repeat center;background-size:50px}
*/
/* td.cal_today span{background:red;color:#fff;border-radius:50%;padding:0 5px} */

.cal_days_bef_aft{color:#5a779e;opacity:0.3;}

#cal_body > tr:nth-child(1) > th{padding:0px 0;color:#777dee;font-size: 700px;font-size: 20px;height:30px;}
#cal_body > tr:nth-child(1) > td{padding:0px 0;height:30px;}

table.cal_calendar th{font-size:16px;}
table.cal_calendar td{font-size:14px;vertical-align: top;}
.cal_d_weeks th{background: #fff;}

table.cal_calendar tbody tr:nth-child(1) th{border:none !important;}

table.cal_calendar tr td:nth-child(1) {color: #ff2d2d;}
table.cal_calendar tr td:nth-child(7) {color: #264cb8;}

table.cal_calendar tr td:nth-child(1) a{color: #ff2d2d;}
table.cal_calendar tr td:nth-child(7) a{color: #264cb8;}

table.cal_calendar tr td:nth-child(1) span{color: #ff2d2d;}
table.cal_calendar tr td:nth-child(7) span{color: #264cb8;}

table.cal_calendar tr td{text-align:left;vertical-align:top;}
table.cal_calendar tr td div.list{margin-bottom:5px;height:30px;line-height:30px;font-size:14px;text-align:center;width:100%;background:#999;color:#fff;}
table.cal_calendar tr td div.list span{color:#333;} 

table.cal_calendar tr td div.list a{color:#333;display:block;width:100%;height:100%;}
table.cal_calendar tr td div.list.on a{color:#fff;}
table.cal_calendar tr td div.list.on{height:30px;line-height:30px;font-size:14px;text-align:center;width:100%;background:#262745;color:#fff;}

table.cal_calendar th.ttt{color:#ff2d2d;}
table.cal_calendar th.tttt{color:#264cb8;}

.llbbtt{position:absolute;left:24%;top:0px;z-index:33;}
.rrbbtt{position:absolute;right:24%;top:0px;z-index:33;}

div.overfx{overflow-x:scroll;width: 100%;margin: 0 auto;}
div.display_table{width: 700px;display: table;border-collapse:collapse;table-layout: fixed;}
.display_table div.tbr{display: table-row;}
.display_table div.tbc{display: table-cell;}
.display_table div.tbc.th{text-align: center;font-size: 14px;padding: 10px 5px;border:1px solid #555;
background: #3c8dd4;color:#fff;}
.display_table div.tbc.td{text-align: center;font-size: 14px;padding: 10px 5px;border:1px solid #555}

.display_table div.tbc.th.th1{width:23%}
.display_table div.tbc.th.th2{width:11%}
.display_table div.tbc.th.th3{width:11%}
.display_table div.tbc.th.th4{width:11%}
.display_table div.tbc.th.th5{width:11%}
.display_table div.tbc.th.th6{width:11%}
.display_table div.tbc.th.th7{width:11%}
.display_table div.tbc.th.th8{width:11%}

.display_table div.tbc.td select{width:80%;}

.display_table div select{display: none;}

div.display_table1{width: 100%;display: table;border-collapse:collapse;table-layout: fixed;margin-top: 23px;}
.display_table1 div.tbr{display: table-row;}
.display_table1 div.tbc{display: table-cell;}
.display_table1 div.tbc.th{text-align: center;font-size: 14px;padding: 10px 10px;border:1px solid #555;width: 25%;
background: #3c8dd4;color:#fff;vertical-align: middle;}
.display_table1 div.tbc.td{text-align: left;font-size: 14px;padding: 10px 10px;border:1px solid #555;width: 75%;}

.pravacydiv textarea{width: 100%;border-top:none;padding:10px;font-size: 14px;min-height: 180px;}

.bt_box{width: 100%;text-align: center;height: 40px;margin-top: 30px;}
.bt_box a{display: inline-block;width: 130px;height:40px;margin:0 10px;font-size: 14px;}
.bt_box a.ok_bt{border:1px solid #3c8dd4;background: #3c8dd4;color:#fff;text-align: center;line-height: 38px;}
.bt_box a.can_bt{border:1px solid #999;color:#999;text-align: center;line-height: 38px;}
.bt_box a.select_ok_bt{border:1px solid #3c8dd4;background: #3c8dd4;color:#fff;text-align: center;line-height:38px;}

input{outline:none !important;height:36px;border:1px solid #555;width: 100%;padding: 10px;}

input#idid,input#idid2{width: 20px;height: 20px;}


select{outline:none !important;height:36px;border:1px solid #555;}
textarea{outline:none !important}
.cursor_p{cursor:pointer}
.cursor_p.on{color:#fff;background: #555;}

.display_table1 div textarea{width: 100%;height:100px;padding: 10px;}
.cred{color: red;line-height: 20px;}
.date_click{display: block;width: 30px;background: #fff;color: #000;font-size: 14px;margin: 0 auto;text-align: center;height: 30px;line-height: 28px;border-radius:30px;}
.date_click.on{display: block;width: 30px;background: #777dee;color: #fff;font-size: 14px;margin: 0 auto;text-align: center;height: 30px;line-height: 28px;border-radius:30px;}

.titles{line-height: 28px;}
.windo_mak{display: none;position: absolute;left: 0;top: 0;width: 100%;height: 100%;background: #fff;opacity:0.5}

.yeyak{display: block;width: auto;background: #419ceb;color: #fff;font-size: 14px;margin: 0 auto;text-align: center;padding:10px 8px;border-radius:8px;}
.yeyak{display: block;width: auto;background: #f29e54;color: #fff;font-size: 14px;margin: 0 auto;text-align: center;padding:10px 8px;border-radius:8px;margin-top: 3px;}

.out_date_click{display: block;width: auto;background: #555;color: #fff;font-size: 14px;margin: 0 auto;text-align: center;padding:10px 8px;border-radius:8px;}
.ojh{display: block;width: auto;background: #fff;color: #555;font-size: 14px;margin: 0 auto;text-align: center;padding:9px 8px;border-radius:8px;border:1px solid #555;margin-bottom: 3px;}

.s_ok_divtt{font-size: 13px !important;}
.s_ok_divtt br{display:none}
.s_ok_divtt .mospan{display: block;}

.mospan4{display: block;}

.sub_title2 {font-size: 24px;margin-bottom: 10px;}

.yeyak_jui{}
.yeyak_jui li{padding-left:20px; position:relative; margin-bottom:10px;}
.yeyak_jui li:before{content:'*'; padding:0 5px; position:absolute; top:0; left:0; height:16px; line-height:16px; height:1em; line-height:1em;}

.title_p1{font-size: 24px;font-weight: 500;margin-bottom: 10px;}
.title_p2{font-size: 26px;font-weight: 500;}

span.chch{display: block;width: 30px;background: #fff;color: #000;font-size: 14px;margin: 0 auto;text-align: center;height: 30px;line-height: 28px;border-radius:30px;opacity:0.3}

.manager_swipe{}
.manager_swipe .swiper-wrapper{}
.manager_swipe .swiper-slide{background-color:#fff;height:45px;width: 160px;}
.manager_swipe .swiper-slide a{display:block;width:85%;height:45px;background: #ddd;color: #000;font-size: 16px;font-weight: 500;text-align: center;line-height: 45px;border-radius:30px;float: left;margin-right: 0;}
.manager_swipe .swiper-slide a.on{background: #000;color: #fff;}
.manager_swipe .swiper-slide a.ondra4{background: #000;color: #fff;}
.resv_btn {margin-top: 40px;text-align: center;}
.resv_btn a {color:#fff;background: #777dee;height:40px;line-height: 40px;text-align: center;font-size: 16px;font-weight: 500;display: inline-block;width:180px;margin: 0 5px;border-radius:5px;}

.rsv_pop {display: none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.3);z-index: 999;}
.rsv_pop .rsv_pop_wrap {width: 600px;position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);background: #fff;padding: 80px 20px;border-radius: 15px;}
.rsv_pop .rsv_pop_wrap h3 {text-align: center;font-size: 30px;color: #777dee;font-family: 'S-CoreDream-8Heavy';}
.rsv_pop .rsv_pop_wrap h3:after {content: '';display: block;clear: both;width: 220px;height: 218px;background: url(/images/munjin_pop_img.png) no-repeat 50% 50%;background-size: 220px;margin: 40px auto 30px;}
.rsv_pop .rsv_pop_wrap li {font-size: 18px;line-height: 32px;padding-left: 50px;font-weight: 300;}
.rsv_pop .rsv_pop_wrap p {width: 100%;text-align: center;height: 100px;line-height: 100px;background: #f1f2fd;border-radius: 15px;font-size: 20px;margin: 25px 0 40px;}
.rsv_pop .rsv_pop_wrap .rsv_pop_btn {text-align: center;font-size: 0;}
.rsv_pop .rsv_pop_wrap .rsv_pop_btn a {display: inline-block;width: 240px;height: 80px;line-height: 80px;text-align: center;font-size: 22px;font-weight: bold;margin: 0 10px;border-radius: 12px;background: #777dee;color: #fff;}
.rsv_pop .rsv_pop_wrap .rsv_pop_btn a:nth-child(2) {background: #d6d9f8;color: #6a77fa;}
.rsv_pop .close_rsv_pop {position: absolute;right: 30px;top: 35px;}
.rsv_pop .close_rsv_pop img {width: 28px;}

/* 반응형 css */
@media only screen and (max-width: 768px) { /* viewport width : 768 */

.rsv_pop .rsv_pop_wrap {width: 88.5417vw;padding: 14.3229vw 2.6042vw;border-radius: 1.9531vw;}
.rsv_pop .rsv_pop_wrap h3 {font-size: 4.5573vw;}
.rsv_pop .rsv_pop_wrap h3:after {width: 34.8958vw;height: 34.6354vw;background: url(/images/munjin_pop_img.png) no-repeat 50% 50%;background-size: 34.8958vw;margin: 9.7656vw auto 5.2083vw;}
.rsv_pop .rsv_pop_wrap li {font-size: 2.9948vw;line-height: 5.2083vw;padding-left: 6.5104vw;}
.rsv_pop .rsv_pop_wrap p {height: 15.6250vw;line-height: 15.6250vw;border-radius: 1.9531vw;font-size: 3.2552vw;margin: 5.8594vw 0 7.8125vw;}
.rsv_pop .rsv_pop_wrap .rsv_pop_btn a {width: 37.7604vw;height: 13.0208vw;line-height: 13.0208vw;font-size: 3.9063vw;margin: 0 1.3021vw;border-radius: 1.5625vw;}
.rsv_pop .close_rsv_pop {right: 2.6042vw;top: 5.2083vw;}
.rsv_pop .close_rsv_pop img {width: 4.1667vw;}

}
</style>

<div class="sub_content">
	<div class="inner">
		<p class="sub_title">예약하기</p>
		<div class="sub_title2">날짜선택하기</div>

		<div class="showhide" style="display:block"><!-- 달력 -->
			<div class="" style="position: relative;">
				<a href="javascript:;" class="llbbtt" style="display:none;">
					<img src="/images/left_gaja2433.jpg" alt="">
				</a>
				<a href="javascript:;" class="rrbbtt">
					<img src="/images/right_gaja2433.jpg" alt="">
				</a>
				
				<div id="yyayya" class="height_jojul_y">

				</div>
			   
			</div>
		</div>

		<div class="ajax2">
			
		</div>

		<form action="<?php echo G5_URL?>/reservation_update.php" method="post" id="this_form" style="display:none">
			<input type="text" name="wr_date" value="" class="wr_date"><!-- 날짜 -->
			<input type="text" name="wr_time" value="" class="wr_time"><!-- 시간 -->
			<input type="text" name="mb_id" value="<?php echo $member['mb_id'];?>" class="mb_id"><!-- 회원아이디 -->	
			<input type="text" name="mb_name" value="<?php echo $member['mb_name'];?>" class="mb_name"><!-- 회원이름 -->
			<input type="text" name="dental_id" value="<?php echo $den_id;?>" class="den_id"><!-- 병원 id -->
			<input type="text" name="dental_name" value="<?php echo $dental['wr_subject'];?>" class="dental_name"><!-- 병원명 -->


			<div id="select_div" style="display:block"><!-- 선택 -->				

			</div>

		</form>

		<div class="rsv_pop">
			<div class="rsv_pop_wrap">
				<h3>문진표 작성을 시작하겠습니까?</h3>
				<ul>
					<li><b>·</b> 문진표 내 작성한 내용은 예약한 병원에 자료로 제공됩니다.</li>
					<li><b>·</b> 문진 작성 내용에 따라 맞춤화된 정보와 소식을 전해드립니다.</li>
				</ul>
				<p> 문진표 작성 시 300포인트가 지급됩니다. (연 1회)</p>
				<div class="rsv_pop_btn">
					<a href="javascript:;" onclick="go_munjin(); return false;">문진표 작성하기</a>
					<a href="javascript:;" onclick="rsv_only(); return false;">예약만 할래요</a>
				</div>
				<a href="javascript:;" class="close_rsv_pop"><img src="/images/close_pop.png" alt="팝업 닫기"></a>
			</div>
		</div>
	</div>
</div>

<script>

	var mbmb = "<?php echo $member['mb_id'];?>";
	var upup = "<?php echo $dental['mb_id'];?>";

	var kk = 0;
	
	$.ajax({
		url: "<?php echo G5_URL?>/chw_ajax_1.php",
		type: "POST",
		data: {kk:'0',cpid:upup},
		success: function(msg){
		 
			$("#yyayya").html(msg);					

		}
	});	
	
	$("body").on("click",".date_click",function(){

		$(".wr_time").val('');
		if(mbmb==""){
			alert("로그인후 이용해주세요");
			return false;
		}

		var datess = $(this).data("date");
		$(".date_click").removeClass("on");
		$(this).addClass("on");
		
		$.ajax({
			url: "<?php echo G5_URL?>/chw_ajax_2.php",
			type: "POST",
			data: {kk:datess,cpid:upup},
			success: function(msg){
			 
				$(".ajax2").html(msg);					

			}
		});

		var offset = $(".height_jojul_y").offset();
		var scro = $(window).scrollTop();
		$("html,body").animate({
			'scrollTop':offset.top+'px'
		},300)

		$(".wr_date").val(datess);	
	})
	
	$("body").on("click",".ondra",function(){
		$(".ondra").removeClass("on");
		$(this).addClass("on");		
		var datess1 = $(this).data("dates");		
		$(".wr_time").val(datess1);
	})

	$("body").on("click",".sbsbsb",function(){
		var data1 = $(".wr_date").val();
		var data2 = $(".wr_time").val();
		if(!data1){
			alert("날짜를 선택해주세요.");
			return false;
		}
		if(!data2){
			alert("시간을 선택해주세요.");
			return false;
		}
		//console.log('날짜 : '+data1+', 시간 : '+data2);
		$(".rsv_pop").show();
	})
						
	// 예약하기 팝업 닫기
	$(document).mouseup(function (e){
		var container = $(".rsv_pop");
		if( container.has(e.target).length === 0) {
		container.hide();
		}
	});

	// 예약하기 팝업 닫기
	$('.close_rsv_pop').click(function(){
		$(".rsv_pop").hide();
	});

	$("body").on("click",".rrbbtt",function(){
		if(kk==0){
			$(".llbbtt").show();
		}
		$(".ajax2").html('');
		$(".wr_time").val('');
		kk = kk+1;

		$.ajax({
			url: "<?php echo G5_URL?>/chw_ajax_1.php",
			type: "POST",
			data: {kk:kk,cpid:upup},
			success: function(msg){
			 
				$("#yyayya").html(msg);					

			}
		});	
	})

	$("body").on("click",".llbbtt",function(){
		if(kk==1){
			$(".llbbtt").hide();
		}
		
		$(".ajax2").html('');
		$(".wr_time").val('');
		kk = kk-1;

		$.ajax({
			url: "<?php echo G5_URL?>/chw_ajax_1.php",
			type: "POST",
			data: {kk:kk,cpid:upup},
			success: function(msg){
			 
				$("#yyayya").html(msg);					

			}
		});	
	})
	
	function rsv_only() {
		var rsv_date = $(".wr_date").val();
		var rsv_time = $(".wr_time").val();
		
		/*var conf = confirm(data1+" "+data2+" 에 예약하시겠습니까?");
		if(conf==true){
			$("#this_form").submit();
		}*/
		location.href = '<?php echo G5_URL?>/reservation_update.php?denid=<?php echo $den_id?>&date='+rsv_date+'&time='+rsv_time+'';
	}

	function go_munjin() {
		var rsv_date = $(".wr_date").val();
		var rsv_time = $(".wr_time").val();
		
		location.href = '<?php echo G5_URL?>/munjin/munjin_type.php?denid=<?php echo $den_id?>&date='+rsv_date+'&time='+rsv_time+'';
	}
</script>


<?php
include_once(G5_PATH.'/tail.php');
?>