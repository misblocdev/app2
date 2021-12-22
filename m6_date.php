<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
$den_id = $_GET['den_id'];
$itemj = sql_fetch("select * from g5_write_dental where wr_code = '".$den_id."' and mb_id='".$member['mb_id']."'");
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
table.cal_calendar td{text-align:center;margin:0 0px;padding:2px;border:1px solid #fff;line-height:24px;height: 50px;font-size:11px;}
/*table.cal_calendar td.on{color:#fff !important;background:url(/shop/images/bbbggg.jpg) no-repeat center;background-size:50px}
*/
/* td.cal_today span{background:red;color:#fff;border-radius:50%;padding:0 5px} */

.cal_days_bef_aft{color:#5a779e;opacity:0.3;}

#cal_body > tr:nth-child(1) > th{padding:0px 0;color:#777dee;font-size: 700px;font-size: 20px;height:30px;}
#cal_body > tr:nth-child(1) > td{padding:0px 0;height:30px;}

table.cal_calendar th{font-size:16px;}
table.cal_calendar td{font-size:14px;vertical-align: top;}
.cal_d_weeks th{background: #fff;}

table.cal_calendar tbody tr:nth-child(1)  th{border:none !important;}

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
.display_table div.tbc.th{text-align: center;font-size: 14px;padding: 10px 5px;border:1px solid #555;background: #3c8dd4;color:#fff;}
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
.display_table1 div.tbc.th{text-align: center;font-size: 14px;padding: 10px 10px;border:1px solid #555;width: 25%;background: #3c8dd4;color:#fff;vertical-align: middle;}
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

.yeyak_jui{}
.yeyak_jui li{padding-left:20px; position:relative; margin-bottom:10px;}
.yeyak_jui li:before{content:'*'; padding:0 5px; position:absolute; top:0; left:0; height:16px; line-height:16px; height:1em; line-height:1em;}

.sub_content .sub_t {margin-bottom: 10px;font-size: 24px;}
.con_wrap {margin-bottom: 20px;}
.con_wrap:after {content: '';display: block;clear: both;}
.con_wrap>div{font-size: 18px;font-weight: 500;color: #000;}

.con_btn {margin: 40px 0;text-align: center;font-size: 0;}
.con_btn a{color:#fff;background: #777dee;height:40px;line-height: 40px;text-align: center;font-size: 16px;font-weight: 500;display: inline-block;width:180px;margin: 0 5px;border-radius:5px}

.title_p1{font-size: 22px;font-weight: 500;}
.title_p2{font-size: 26px;font-weight: 500;}

span.chch{display: block;width: 30px;background: #fff;color: #000;font-size: 14px;margin: 0 auto;text-align: center;height: 30px;line-height: 28px;border-radius:30px;opacity:0.3}

input.checkboxc{width:15px;height:15px;}

.inputdivt{}
.inputdivt>div{float: left;height:20px;margin-bottom: 10px;margin-right: 15px;font-size: 13px;}

.cal_wrap {margin: 80px 0;}

.spanjum{position: absolute;display: block;width:5px;height:5px;background: red;border-radius:5px;left:30%;top:0px;}

.manager_swipe{padding-left:0px; padding-right:0px;width:96% !important;margin: 0 auto;padding:10px 0 20px 0;min-width:320px;max-width:720px;}
.manager_swipe .swiper-wrapper{}
.manager_swipe .swiper-slide{background-color:#fff;height:30px;}
.manager_swipe .swiper-slide a{display:block;width:80%;height:30px;background: #f7f7f7;color: #000;font-size: 14px;font-weight: 500;text-align: center;line-height: 28px;border-radius:30px;float: left;margin-right: 0;}

.manager_swipe .swiper-slide a.on{background: #000;color: #fff;}

.winbox{background: #000;opacity:0.8;position: fixed;left:0;top:0;width:100%;height:100%;z-index:8889}
.setbox{padding:20px;position: fixed;left:50%;top:50%;transform: translate(-50%, -50%);background: #fff;z-index:8890;width:700px;}
.setbox p{font-size: 16px;font-weight: 500;margin-bottom: 15px;}
.setbox .chk_holiday {margin-bottom: 15px;}
.setbox .date_pop_btn {text-align: center;font-size: 0;margin-top: 20px;}
.setbox .date_pop_btn a {display: inline-block;font-size: 14px;padding: 5px 10px;margin: 5px;background: #777dee;color: #fff;}

.selec_chk {position:absolute;top:0;left:0;width:0;height:0;opacity:0;outline:0;z-index:-1;overflow:hidden}
.chk_box {position:relative}
.chk_box input[type="checkbox"] + label {position:relative;padding-left:20px;color:#676e70}
.chk_box input[type="checkbox"] + label:hover{color:#777dee}
.chk_box input[type="checkbox"] + label span {position:absolute;top:2px;left:0;width:15px;height:15px;display:block;margin:0;background:#fff;border:1px solid #aaa;border-radius:3px}
.chk_box input[type="checkbox"]:checked + label {color:#000}
.chk_box input[type="checkbox"]:checked + label span {background:url('../img/chk.png') no-repeat 50% 50% #777dee;border-color:#777dee;border-radius:3px}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

.sub_content .sub_t {margin-bottom: 10px;font-size: 18px;}
.setbox {width: 90%;}

}
</style>

<?php
$mbset = sql_fetch("select * from basic_set where mb_id='".$member['mb_id']."'");
$mbset1 = explode("|",$mbset['yoil']);
$mbset2 = explode("|",$mbset['times']);
?>
<div class="sub_content">
<div class="inner">

<form action="<?php echo G5_URL?>/m6_update.php" method="post" id="ffff">
	<div class="con_wrap">
		<div class="sub_t">기본셋팅(예약가능요일)</div>
	
		<div class="inputdivt">
			<div class="chk_box">
				<input type="checkbox" id="for141" name="yoil[]" <?php echo in_array("월",$mbset1)?"checked":"";?> value="월" class="checkboxc yoils selec_chk">
				<label for="for141"><span></span>월요일</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for242" name="yoil[]" <?php echo in_array("화",$mbset1)?"checked":"";?> value="화" class="checkboxc yoils selec_chk">
				<label for="for242"><span></span>화요일</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for33" name="yoil[]" <?php echo in_array("수",$mbset1)?"checked":"";?> value="수" class="checkboxc yoils selec_chk">
				<label for="for33"><span></span>수요일</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for44" name="yoil[]" <?php echo in_array("목",$mbset1)?"checked":"";?> value="목" class="checkboxc yoils selec_chk">
				<label for="for44"><span></span>목요일</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for55" name="yoil[]" <?php echo in_array("금",$mbset1)?"checked":"";?> value="금" class="checkboxc yoils selec_chk">
				<label for="for55"><span></span>금요일</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for66" name="yoil[]" <?php echo in_array("토",$mbset1)?"checked":"";?> value="토" class="checkboxc yoils selec_chk">
				<label for="for66"><span></span>토요일</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for77" name="yoil[]" <?php echo in_array("일",$mbset1)?"checked":"";?> value="일" class="checkboxc yoils selec_chk">
				<label for="for77"><span></span>일요일</label>
			</div>
			
		</div>
	</div>

	<div class="con_wrap">
		<div class="sub_t">기본셋팅(예약가능시간)</div>

		<div class="inputdivt">
			<div class="chk_box">
				<input type="checkbox" id="for1" name="times[]" <?php echo in_array("1",$mbset2)?"checked":"";?> value="1" class="checkboxc times selec_chk">
				<label for="for1"><span></span>01:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for2" name="times[]" <?php echo in_array("2",$mbset2)?"checked":"";?> value="2" class="checkboxc times selec_chk">
				<label for="for2"><span></span>02:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for3" name="times[]" <?php echo in_array("3",$mbset2)?"checked":"";?> value="3" class="checkboxc times selec_chk">
				<label for="for3"><span></span>03:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for4" name="times[]" <?php echo in_array("4",$mbset2)?"checked":"";?> value="4" class="checkboxc times selec_chk">
				<label for="for4"><span></span>04:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for5" name="times[]" <?php echo in_array("5",$mbset2)?"checked":"";?> value="5" class="checkboxc times selec_chk">
				<label for="for5"><span></span>05:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for6" name="times[]" <?php echo in_array("6",$mbset2)?"checked":"";?> value="6" class="checkboxc times selec_chk">
				<label for="for6"><span></span>06:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for7" name="times[]" <?php echo in_array("7",$mbset2)?"checked":"";?> value="7" class="checkboxc times selec_chk">
				<label for="for7"><span></span>07:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for8" name="times[]" <?php echo in_array("8",$mbset2)?"checked":"";?> value="8" class="checkboxc times selec_chk">
				<label for="for8"><span></span>08:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for9" name="times[]" <?php echo in_array("9",$mbset2)?"checked":"";?> value="9" class="checkboxc times selec_chk">
				<label for="for9"><span></span>09:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for10" name="times[]" <?php echo in_array("10",$mbset2)?"checked":"";?> value="10" class="checkboxc times selec_chk">
				<label for="for10"><span></span>10:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for11" name="times[]" <?php echo in_array("11",$mbset2)?"checked":"";?> value="11" class="checkboxc times selec_chk">
				<label for="for11"><span></span>11:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for12" name="times[]" <?php echo in_array("12",$mbset2)?"checked":"";?> value="12" class="checkboxc times selec_chk">
				<label for="for12"><span></span>12:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for13" name="times[]" <?php echo in_array("13",$mbset2)?"checked":"";?> value="13" class="checkboxc times selec_chk">
				<label for="for13"><span></span>13:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for14" name="times[]" <?php echo in_array("14",$mbset2)?"checked":"";?> value="14" class="checkboxc times selec_chk">
				<label for="for14"><span></span>14:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for15" name="times[]" <?php echo in_array("15",$mbset2)?"checked":"";?>  value="15" class="checkboxc times selec_chk">
				<label for="for15"><span></span>15:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for16" name="times[]" <?php echo in_array("16",$mbset2)?"checked":"";?> value="16" class="checkboxc times selec_chk">
				<label for="for16"><span></span>16:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for17" name="times[]" <?php echo in_array("17",$mbset2)?"checked":"";?> value="17" class="checkboxc times selec_chk">
				<label for="for17"><span></span>17:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for18" name="times[]" <?php echo in_array("18",$mbset2)?"checked":"";?> value="18" class="checkboxc times selec_chk">
				<label for="for18"><span></span>18:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for19" name="times[]" <?php echo in_array("19",$mbset2)?"checked":"";?> value="19" class="checkboxc times selec_chk">
				<label for="for19"><span></span>19:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for20" name="times[]" <?php echo in_array("20",$mbset2)?"checked":"";?> value="20" class="checkboxc times selec_chk">
				<label for="for20"><span></span>20:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for21" name="times[]" <?php echo in_array("21",$mbset2)?"checked":"";?> value="21" class="checkboxc times selec_chk">
				<label for="for21"><span></span>21:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for22" name="times[]" <?php echo in_array("22",$mbset2)?"checked":"";?> value="22" class="checkboxc times selec_chk">
				<label for="for22"><span></span>22:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for23" name="times[]" <?php echo in_array("23",$mbset2)?"checked":"";?> value="23" class="checkboxc times selec_chk">
				<label for="for23"><span></span>23:00</label>
			</div>
			<div class="chk_box">
				<input type="checkbox" id="for24" name="times[]" <?php echo in_array("24",$mbset2)?"checked":"";?> value="24" class="checkboxc times selec_chk">
				<label for="for24"><span></span>24:00</label>
			</div>
		</div>
	</div>

	<div class="con_btn">
		<a href="javascript:;" class="sbsbsb sbsbsb1">기본셋팅저장</a>
		<a href="<?php echo G5_URL?>/mypage_r.php?den_id=<?php echo $member['mb_3']?>" style="background-color:#777">예약리스트</a>
	</div>
</form>

<div class="cal_wrap">
	<div class="sub_t">날짜개별설정</div>
	<div class="chwhold showhide" style="display:block"><!-- 달력 -->
		<div style="min-width:100%;height:auto;background: url(/shop/images/gajimararara_1t.jpg) no-repeat center;">
			<div class="" style="position: relative;">
				<a href="javascript:;" class="llbbtt" style="display:none">
					<img src="/images/left_gaja2433.jpg" alt="">
				</a>
				<a href="javascript:;" class="rrbbtt">
					<img src="/images/right_gaja2433.jpg" alt="">
				</a>
				
				<div id="yyayya" class="height_jojul_y" style="height:auto;margin-bottom:20px;">

				</div>
			   
			</div>
		</div>
	</div>
</div>

<div class="ajax2">
	
</div>

<div class="setbox" style="display: none;">
	
</div>
<div class="winbox" style="display: none;">
	
</div>

<form action="<?php echo G5_URL?>/reservation_update.php" method="post" id="this_form" style="display:none">
	<input type="text" name="wr_date" value="" class="wr_date"><!-- 날짜 -->
	<input type="text" name="wr_time" value="" class="wr_time"><!-- 시간 -->
	<input type="text" name="mb_id" value="<?php echo $member['mb_id'];?>" class="mb_id"><!-- 회원아이디 -->	
	<input type="text" name="mb_name" value="<?php echo $member['mb_name'];?>" class="mb_name"><!-- 회원이름 -->
	<input type="text" name="dental_id" value="<?php echo $company['mb_id'];?>" class="dental_id"><!-- 업체아이디 -->
	<input type="text" name="dental_name" value="<?php echo $company['it_brand'];?>" class="dental_name"><!-- 업체이름 -->

	<div class="chwhold" id="select_div" style="display:block"><!-- 선택 -->

	</div>

</form>

</div>
</div>

<script>
var kk = 0;	

$.ajax({
	url: "<?php echo G5_URL?>/chw_ajax_11.php",
	type: "POST",
	data: {kk:'0'},
	success: function(msg){
	 
		$("#yyayya").html(msg);					

	}
});	

$("body").on("click",".winbox",function(){
	$(".setbox").html('');
	$(".setbox").hide();
	$(".winbox").hide();
})

$("body").on("click",".sbsbsb5",function(){
	$(".setbox").html('');
	$(".setbox").hide();
	$(".winbox").hide();
})	

$("body").on("click",".date_click",function(){
	var tdtd = $(this).data('date');
	$(".setbox").show();
	$(".winbox").show();
		
	$.ajax({
		url: "<?php echo G5_URL?>/chw_ajax_111.php",
		type: "POST",
		data: {td:tdtd},
		success: function(msg){
		 
			$(".setbox").html(msg);					

		}
	});
})

$("body").on("click",".ondra",function(){
	
})

$("body").on("click",".sbsbsb1",function(){
	var yoil = 0;
	var times = 0;
	$(".times").each(function(){
		if($(this).prop("checked")==true){
			times = times+1;
		}
	})
	$(".yoils").each(function(){
		if($(this).prop("checked")==true){
			yoil = yoil+1;
		}
	})
	
	if(yoil>0 && times>0){
		var conff = confirm("저장하시겠습니까?");
		if(conff==true){
			$("#ffff").submit();
		}
	}else{
		alert('날짜 및 시간을 선택해주세요.');
	}
})

$("body").on("click",".times12",function(){
	if($(this).prop('checked')==true){
		$(".times2").prop('checked',false)
	}else{
		//$(".times2").prop('checked',false)
	}
})

$("body").on("click",".times2",function(){
	if($(".times12").prop('checked')==true){
		$(".times2").prop('checked',false)
	}else{
		//$(".times2").prop('checked',false)
	}
})

$("body").on("click",".sbsbsb4",function(){
	var yoilss = "";
	//
	if($(".times12").prop('checked')==false){
		$(".times2").each(function(){
			if($(this).prop("checked")==true){
				yoilss = yoilss+1;
			}
		})
	}else{
		yoilss = 1;	
	}

	if(yoilss>0){
		var conff = confirm("저장하시겠습니까?");
		if(conff==true){
			
			$("#fffff").submit();
		}
	}else{
		alert('휴무 및 시간을 선택해주세요.');
	}
})

$("body").on("click",".rrbbtt",function(){
	//$(".ajax2").html('');
	if(kk==0){
		$(".llbbtt").show();
	}
	kk = kk+1;

	$.ajax({
		url: "<?php echo G5_URL?>/chw_ajax_11.php",
		type: "POST",
		data: {kk:kk},
		success: function(msg){
		 
			$("#yyayya").html(msg);					

		}
	});	
})	

$("body").on("click",".llbbtt",function(){
	//$(".ajax2").html('');
	if(kk==1){
		$(".llbbtt").hide();
	}
	kk = kk-1;

	$.ajax({
		url: "<?php echo G5_URL?>/chw_ajax_11.php",
		type: "POST",
		data: {kk:kk},
		success: function(msg){
		 
			$("#yyayya").html(msg);					

		}
	});	
})
</script>

<?php
include_once(G5_PATH.'/tail.php');