<?php
include_once('./_common.php');

if (!$is_member)
    goto_url(G5_BBS_URL."/login.php?url=".urlencode(G5_SHOP_URL."/mypage.php"));

$g5['title'] = '예약 목록';

add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/mypage_resv.css">', 5);

include_once(G5_PATH.'/head.php');
?>

<div class="sub_content">
	<div class="inner">
		<div class="calender_wr">
			<a href="javascript:;" class="llbbtt">
				<img src="/images/left_gaja2433.jpg" alt="">
			</a>
			<a href="javascript:;" class="rrbbtt">
				<img src="/images/right_gaja2433.jpg" alt="">
			</a>
			<div id="yyayya" class="height_jojul_y" style="height:auto;margin-bottom:20px;">

			</div>
			<div class="resv_manage">
				<a href="<?php echo G5_URL?>/m6_date.php?den_id=<?php echo $den_id?>">예약 일정 관리</a>
			</div>
		</div>
		<h4 class="resv_title">예약현황 리스트</h4>
		<div id="resv_wrap">
			<p>조회할 날짜를 선택하세요.</p>
		</div>
	</div>
</div>

<script>
$(function(){

	var kk = 0;
		
	$.ajax({
		url: "<?php echo G5_URL?>/resv_chk_ajax.php",
		type: "POST",
		data: {kk:'0'},
		success: function(msg){
			$("#yyayya").html(msg);		
		}
	});

	$("body").on("click",".rrbbtt",function(){

		$(".ajax2").html('');
		$(".wr_time").val('');
		kk++;

		$.ajax({
			url: "<?php echo G5_URL?>/resv_chk_ajax.php",
			type: "POST",
			data: {kk:kk},
			success: function(msg){
				$("#yyayya").html(msg);
			}
		});
	});

	$("body").on("click",".llbbtt",function(){
		
		$(".ajax2").html('');
		$(".wr_time").val('');
		kk--;

		$.ajax({
			url: "<?php echo G5_URL?>/resv_chk_ajax.php",
			type: "POST",
			data: {kk:kk},
			success: function(msg){
				$("#yyayya").html(msg);
			}
		});
	});
});
</script>

<?php
include_once(G5_PATH."/tail.php");