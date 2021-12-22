<?php
include_once('./_common.php');

if($_POST['franchisee'] == 1) {
	$franchisee = $_POST['franchisee'];
} else {
	$franchisee = '';
}

if($is_member) {
$locate = explode(' ', $member['mb_addr1']);
//echo $locate[0];
$sql = ' select * from g5_write_dental where ca_name <> "" and wr_2 like "'.$locate[0].'%" and wr_10 = "'.$franchisee.'" ';
} else {
$sql = ' select * from g5_write_dental where ca_name <> "" and wr_10 = "'.$franchisee.'" ';
}

if(sql_num_rows(sql_query($sql)) == 0){
	$sql = ' select * from g5_write_dental where ca_name <> "" and wr_10 = "'.$franchisee.'" ';								
}

$result = sql_query($sql);
$total = sql_num_rows($result);
$quotient = sprintf('%d', $total / 4);
$rest = $total % 4;
if($rest) {
	$num2 = $quotient + 1;
} else {
	$num2 = $quotient;
}
?>
<div class="swiper-container mc02-container swiper-container-<?php echo $franchisee?>">
	<div class="mc02_wrapper swiper-wrapper">
	<?php
	for($i = 0 ; $i < $num2 ; $i++) { ?>
		<div class=" swiper-slide clearfix">
			<ul class="clearfix">
			<?php
			$limit = 'limit '.($i * 4).', 4';

			if($is_member) {
			$locate = explode(' ', $member['mb_addr1']);
			//echo $locate[0];
			$sql_dental = ' select * from g5_write_dental where ca_name <> "" and wr_2 like "'.$locate[0].'%" and wr_10 = "'.$franchisee.'" order by wr_id desc '.$limit.' ';
			} else {
			$sql_dental = ' select * from g5_write_dental where ca_name <> "" and wr_10 = "'.$franchisee.'" order by wr_id desc '.$limit.' ';
			}

			if(sql_num_rows(sql_query($sql_dental)) == 0){
				$sql_dental = ' select * from g5_write_dental where ca_name <> "" and wr_10 = "'.$franchisee.'" order by wr_id desc '.$limit.' ';								
			}

			$result_dental = sql_query($sql_dental);
			$total_dental = sql_num_rows($result_dental);

			for($j = 0 ; $dental = sql_fetch_array($result_dental) ; $j++) {
				$href = get_pretty_url('dental', $dental['wr_id']).'&den_id='.$dental['wr_code'];
			?>
				<li class="gall_li">
					<div class="gall_info">
						<div class="dental_name"><a href="<?php echo $href; ?>"><?php echo $dental['wr_subject'] ?></a></div>
						<div class="dental_info">
							<dl class="clearfix">
								<dt>평 일</dt>
								<dd><?php echo $dental['wr_3'];?></dd>

								<?php if( $dental['wr_6'] ) { ?>
								<dt>점 심</dt>
								<dd><?php echo $dental['wr_6'];?></dd>						
								<?php } ?>

								<?php if( $dental['wr_4'] ) { 
								$day_array = explode('|', $dental['wr_4']);
								if(count($day_array) > 1) {
									$nigthTime = implode(' / ', $day_array);
								} else {
									$nigthTime = $day_array[0].' 요 일';
								}
								?>
								<dt><?php echo $nigthTime;?></dt>
								<dd><?php echo $dental['wr_5'];?></dd>
								<?php } ?>

								<?php if( $dental['wr_7'] ) { ?>
								<dt>토 요 일</dt>
								<dd><?php echo $dental['wr_7'];?></dd>						
								<?php } ?>

								<dt class="addr">주 소</dt>
								<?php 
								$addr = $dental['wr_2'].' '.$dental['wr_2_1'];
								?>
								<dd><?php echo $addr;?></dd>
							</dl>
						</div>
						<?php if($dental['wr_10'] == 1) { ?>
						<div class="dental_franchisee"><img src="/images/icon_franc.png" alt="가맹업"></div>
						<?php } ?>
					</div>
					<div class="gall_img">
						<a href="<?php echo $href ?>" class="simple_text_g">
						<?php				
						$thumb = get_list_thumbnail('dental', $dental['wr_id'], 220, 230, false, true);

						if($thumb['src']) {
							$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="220" style="border:0px solid #dcdcdc;" height="230">';
						} else {
							$img_content = '<div><p style="padding:10px;">No Image</p></div>';
						}

						echo $img_content;
						?>
						</a>
					</div>
				</li>
			<?php }

			if($total_dental == 0) { ?>
				<li class="empty_list">등록된 병원이 없습니다.</li>
			<?php }
			?>
			</ul>								
		</div>
	<?php } ?>							
	</div>							
</div>

<script>
const denSwiper = new Swiper('.swiper-container-<?php echo $franchisee?>', {
  speed: 400,
  spaceBetween: 20,
  navigation: {
	nextEl: '.mc02-next',
	prevEl: '.mc02-prev',
  },
  breakpoints: {
	// when window width is >= 320px
	320: {
	  spaceBetween: 20,
	},

	// when window width is >= 768px
	769: {
	  spaceBetween: 20,
	}
  },
});
</script>