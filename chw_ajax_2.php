<?php
include_once('./_common.php');
$cpid = $_POST['cpid'];
$kk = $_POST['kk'];
$sqlss = sql_fetch("select * from basic_set where mb_id='".$cpid."'");
$sql2 = sql_fetch("select * from basic_set2 where mb_id='".$cpid."' and wr_date='".$kk."'");


$sql3 = sql_query("select * from reser where dental_id='".$cpid."' and wr_date='".$kk."' and wr_time<>'' ");
$sql3num = sql_num_rows($sql3);

if($sql3num>0){
	$soldout = "";
	for($i=0;$row=sql_fetch_array($sql3);$i++){
		
		if($soldout==""){
			$soldout = $row['wr_time'];
		}else{
			$soldout .= "|".$row['wr_time'];
		}
	
	}
}


?>
<div class="content">
	<div class="sub_title2">예약가능시간</div>
</div>

<div class="swiper-container hot_manager manager_swipe">

<ul class="swiper-wrapper">
	<?php 
	if(!$sqlss['mb_id']){ ?>
	<li class="swiper-slide width100" style="">
		<a href="javascript:;" style="width:100%">
			가능 시간이 없습니다.
		</a>
	</li>
	<?php }else{ // 기본 세팅이 있으면
		$kas = "";
		if($sql2['mb_id']){ // 개별 세팅이 있으면 시간 저장
			$kas = explode("|",$sql2['wr_times']);	
		}
		
		if($kas==""){ // 개별 세팅이 없으면
			$kassoo = 0;
			$dot = explode("|",$sqlss['times']); // 가능한 시간대
			for($k=0;$k<count($dot);$k++){
				$outs = 1;
				if($dot[$k]=='1'){
					$tos = "01:00";
				}else if($dot[$k]=='2'){
					$tos = "02:00";
				}else if($dot[$k]=='3'){
					$tos = "03:00";
				}else if($dot[$k]=='4'){
					$tos = "04:00";
				}else if($dot[$k]=='5'){
					$tos = "05:00";
				}else if($dot[$k]=='6'){
					$tos = "06:00";
				}else if($dot[$k]=='7'){
					$tos = "07:00";
				}else if($dot[$k]=='8'){
					$tos = "08:00";
				}else if($dot[$k]=='9'){
					$tos = "09:00";
				}else if($dot[$k]=='10'){
					$tos = "10:00";
				}else if($dot[$k]=='11'){
					$tos = "11:00";
				}else if($dot[$k]=='12'){
					$tos = "12:00";
				}else if($dot[$k]=='13'){
					$tos = "13:00";
				}else if($dot[$k]=='14'){
					$tos = "14:00";
				}else if($dot[$k]=='15'){
					$tos = "15:00";
				}else if($dot[$k]=='16'){
					$tos = "16:00";
				}else if($dot[$k]=='17'){
					$tos = "17:00";
				}else if($dot[$k]=='18'){
					$tos = "18:00";
				}else if($dot[$k]=='19'){
					$tos = "19:00";
				}else if($dot[$k]=='20'){
					$tos = "20:00";
				}else if($dot[$k]=='21'){
					$tos = "21:00";
				}else if($dot[$k]=='22'){
					$tos = "22:00";
				}else if($dot[$k]=='23'){
					$tos = "23:00";
				}else if($dot[$k]=='24'){
					$tos = "24:00";
				}

				if(strpos($soldout, $tos) !== false) { // 예약된 시간이라면
					$outs = 2;					
				}
				
				
	?>
	<li class="swiper-slide">
		<?php if($outs==2){ // 예약 된거
			$kassoo = $kassoo+1;
		?>
		<a href="javascript:;" class="ondra4">
			<strike><?php echo $tos?></strike>
		</a>
		<?php }else{ // 예약 안된거 ?>
		<a href="javascript:;" data-dates="<?php echo $tos?>" class="ondra">
			<?php echo $tos?>
		</a>
		<?php }?>
	</li>
	<?php }
		if(count($dot)==$kassoo){ // 전체 마감
			$all = 1;
		}
	
	}else{ // 개별 세팅이 있으면
		$kassoo = 0;
		for($k=0;$k<count($kas);$k++){
			$outs = 1;
			if($kas[$k]=='1'){
				$tos = "01:00";
			}else if($kas[$k]=='2'){
				$tos = "02:00";
			}else if($kas[$k]=='3'){
				$tos = "03:00";
			}else if($kas[$k]=='4'){
				$tos = "04:00";
			}else if($kas[$k]=='5'){
				$tos = "05:00";
			}else if($kas[$k]=='6'){
				$tos = "06:00";
			}else if($kas[$k]=='7'){
				$tos = "07:00";
			}else if($kas[$k]=='8'){
				$tos = "08:00";
			}else if($kas[$k]=='9'){
				$tos = "09:00";
			}else if($kas[$k]=='10'){
				$tos = "10:00";
			}else if($kas[$k]=='11'){
				$tos = "11:00";
			}else if($kas[$k]=='12'){
				$tos = "12:00";
			}else if($kas[$k]=='13'){
				$tos = "13:00";
			}else if($kas[$k]=='14'){
				$tos = "14:00";
			}else if($kas[$k]=='15'){
				$tos = "15:00";
			}else if($kas[$k]=='16'){
				$tos = "16:00";
			}else if($kas[$k]=='17'){
				$tos = "17:00";
			}else if($kas[$k]=='18'){
				$tos = "18:00";
			}else if($kas[$k]=='19'){
				$tos = "19:00";
			}else if($kas[$k]=='20'){
				$tos = "20:00";
			}else if($kas[$k]=='21'){
				$tos = "21:00";
			}else if($kas[$k]=='22'){
				$tos = "22:00";
			}else if($kas[$k]=='23'){
				$tos = "23:00";
			}else if($kas[$k]=='24'){
				$tos = "24:00";
			}
			if(strpos($soldout, $tos) !== false) {
				$outs = 2;					
			}
	?>
	
	<li class="swiper-slide">
		<?php if($outs==2){
			$kassoo = $kassoo+1;
		?>
		<a href="javascript:;" class="ondra4">
			<strike><?php echo $tos?></strike>
		</a>
		<?php }else{?>
		<a href="javascript:;" data-dates="<?php echo $tos?>" class="ondra">
			<?php echo $tos?>
		</a>
		<?php }?>
	</li>


	<?php
	}
		if(count($kas)==$kassoo){ // 전체 마감
			$all = 1;
		}
	}
	}?>
	
</ul>
</div>

<?php if($all==1){?>
<div class="content">
	<a href="javascript:;" class="sbsbsb8" style="background:#555;color:#fff">예약불가</a>
</div>
<?php }else{?>
<div class="content resv_btn">
	<a href="javascript:;" class="sbsbsb">예약하기</a>
</div>
<?php }?>

<!-- <script>
const hotSwiper = new Swiper('.hot_manager', {
	slidesPerView: 4,
	speed: 400,
	spaceBetween: 10,
});
</script> -->
<script>
var swiper = new Swiper(".hot_manager", {
slidesPerView: 'auto',
spaceBetween: 0,
});
</script>