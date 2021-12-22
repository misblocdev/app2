<?php
include_once('./munjin.head.php');

if(!$denid || !$date || !$time) {
	alert('잘못된 접근입니다.');
}
?>

<style>
</style>

<div id="allwrap">
	<div id="munjinWrap">
		<h2 class="munjin_logo"><img src="/images/hd_logo.png" alt="로고"></h2>
		<div class="munjin_step">
			<div class="on_step"></div>
			<div class="off_step"></div>
		</div>
		<div class="munjin_back">
			<a href="javascript:history.back();"><img src="/images/munjin_back.png" alt="뒤로가기"></a>
		</div>
		<div class="munjin_box">
			<div class="munjin_type_wrap">
				<p>문진표 작성을 위해 <br/>진료 할 예약을 선택해 주세요.</p>
				<div class="munjin_btn">
					<a href="./munjin_type01.php?denid=<?php echo $den_id;?>&date=<?php echo $rsv_date;?>&time=<?php echo $rsv_time;?>">일반예약</a>
					<a href="./munjin_type02.php?denid=<?php echo $den_id;?>&date=<?php echo $rsv_date;?>&time=<?php echo $rsv_time;?>">교정예약</a>
				</div>
				<div class="munjin_before">
					<a href="javascript:;" class="pastform">이전 예약 문진표 사용할게요</a>
				</div>
			</div>
		</div>
	</div>

	<div class="pastpop">
		<div class="pastpopwrap">
			<?php 
			$sql_mj = " select DISTINCT dental_id, munjin_id, munjin_type from munjin where mb_id = '{$member['mb_id']}' ";
			$result_mj = sql_query($sql_mj);
			$total_mj = sql_num_rows($result_mj);

			if($total_mj > 0) { ?>
			<h3>이전 예약 병원 리스트</h3>
			<div class="munjinchk">
				<?php 
				for($i = 0 ; $munjin = sql_fetch_array($result_mj) ; $i++) {
				$dental = sql_fetch(" select * from g5_write_dental where wr_code = '{$munjin['dental_id']}' ");
				?>
				<input type="radio" value="<?php echo $munjin['munjin_id']?>" id="chkchk<?php echo $i+1?>" data-type="<?php echo $munjin['munjin_type'];?>" name="chkchk_list" class="selec_chk"><label for="chkchk<?php echo $i+1?>"><span></span><?php echo $dental['wr_subject']?></label>
				<?php }?>
			</div>
			<div class="pastpop_btn">
				<a class="aa1" href="javascript:;" onclick="useMunjin();">문진표 사용하기<img src="/images/pastpop_1.png" alt=""></a>
				<a class="aa2" href="javascript:;" onclick="editMunjin();">문진표 수정하기<img src="/images/pastpop_2.png" alt=""></a>
			</div>
			<?php } else { ?>
			<div class="no_munjin">
				<span>이전 등록된 문진표가 없습니다.</span>
			</div>
			<?php }?>
			<a href="javascript:;" class="close_pop"><img src="/images/close_pop.png" alt="팝업 닫기"></a>
		</div>
	</div>

	<div id="munjinResult">
	</div>

</div>

<script>
$("body").on("click",".pastform",function(){
	$(".pastpop").show();
});

// 예약하기 팝업 닫기
$(document).mouseup(function (e){
	var container = $(".pastpop");
	if( container.has(e.target).length === 0) {
		container.hide();
		$("input[name=chkchk_list]").prop('checked', false);
	}
});

// 예약하기 팝업 닫기
$('.close_pop').click(function(){
	$(".pastpop").hide();
	$("input[name=chkchk_list]").prop('checked', false);
});

function useMunjin() {
	var id = '<?php echo $denid;?>';
	var num = $("input[name=chkchk_list]:checked").val();
	var rdate = '<?php echo $date;?>';
	var rtime = '<?php echo $time;?>';

	$.ajax({
		url: "./munjin_update.php",
		type: "POST",
		data: {
			denid : id,
			munjinid : num,
			rdate : rdate,
			rtime : rtime,
		},
		success: function(msg){
			$("#munjinResult").html(msg).show();					
		}
	});
}

function editMunjin() {
	var num = $("input[name=chkchk_list]:checked").val();
	var type = $("input[name=chkchk_list]:checked").data('type');
	if(type == '일반') {
		location.href = './munjin_type01.php?denid=<?php echo $den_id;?>&date=<?php echo $rsv_date;?>&time=<?php echo $rsv_time;?>&munjinid='+num+'';
	} else {
		location.href = './munjin_type02.php?denid=<?php echo $den_id;?>&date=<?php echo $rsv_date;?>&time=<?php echo $rsv_time;?>&munjinid='+num+'';	
	}
}

// 문진표 완료 팝업 닫기
$('#munjinResult').click(function(){
	location.href = '<?php echo G5_URL?>/reservation_update.php?denid=<?php echo $denid?>&date=<?php echo $date?>&time=<?php echo $time?>';
});

</script>

<?php 
include_once('./munjin.tail.php');