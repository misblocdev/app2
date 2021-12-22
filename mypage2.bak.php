<!-- 기업 마이페이지 -->
<!-- 마이페이지 시작 { -->

<?php
$sql_dent = " select * from g5_write_dental where wr_code = '".$member['mb_3']."' ";
$row_dent = sql_fetch($sql_dent);

$board = get_board_db('dental', true);
$write_dent = get_write('g5_write_dental', $row_dent['wr_id']);
$dental = get_view($write_dent, $board, '');

if($row_dent['wr_id']) {
$dent_href = short_url_clean(G5_BBS_URL.'/write.php?w=u&amp;bo_table='.$board['bo_table'].'&amp;wr_id='.$row_dent['wr_id'].'&amp;den_id='.$row_dent['wr_code']);
} else {
$dent_href = get_pretty_url($board['bo_table']);
}
?>

<div id="smb_my">
	<div class="inner">
	<h1><span><?php echo $member['mb_name'];?>님,</span> 안녕하세요.</h1>
    <!-- 회원정보 개요 시작 { -->
    <section id="smb_my_ov">
        <h2>회원정보 개요</h2>
        <strong class="my_ov_name"><?php echo ($member['mb_1'] ? $member['mb_1'] : $member['mb_name']); ?></strong>
        <!-- <dl class="cou_pt">
            <dt>보유포인트</dt>
            <dd><a href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank" class="win_point"><?php echo number_format($member['mb_point']); ?></a> 점</dd>
            <dt>보유쿠폰</dt>
            <dd><a href="<?php echo G5_SHOP_URL; ?>/coupon.php" target="_blank" class="win_coupon"><?php echo number_format($cp_count); ?></a></dd>
        </dl> -->
        <div id="smb_my_act">
            <ul>
                <?php if ($is_admin == 'super') { ?><li><a href="<?php echo G5_ADMIN_URL; ?>/" class="btn_admin">관리자</a></li><?php } ?>
                <!-- <li><a href="<?php echo G5_BBS_URL; ?>/memo.php" target="_blank" class="win_memo btn01">쪽지함</a></li> -->
                <li><a href="<?php echo $dent_href;?>" class="btn01 btn_pp">치과정보 등록/수정</a></li>
                <li><a href="" class="btn01 btn_pp">전문치과정보입력</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn01">회원정보수정</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" onclick="return member_leave();" class="btn01">회원탈퇴</a></li>
            </ul>
        </div>

        <dl class="op_area">
            <dt>연락처</dt>
            <dd><?php echo ($member['mb_hp'] ? $member['mb_hp'] : '미등록'); ?></dd>
            <dt>E-Mail</dt>
            <dd><?php echo ($member['mb_email'] ? $member['mb_email'] : '미등록'); ?></dd>
            <dt>최종접속일시</dt>
            <dd><?php echo $member['mb_today_login']; ?></dd>
            <dt>회원가입일시</dt>
            <dd><?php echo $member['mb_datetime']; ?></dd>
            <dt id="smb_my_ovaddt">주소</dt>
            <dd id="smb_my_ovaddd"><?php echo sprintf("(%s%s)", $member['mb_zip1'], $member['mb_zip2']).' '.print_address($member['mb_addr1'], $member['mb_addr2'], $member['mb_addr3'], $member['mb_addr_jibeon']); ?></dd>
        </dl>
        <div class="my_ov_btn"><button type="button" class="btn_op_area"><i class="fa fa-caret-up" aria-hidden="true"></i><span class="sound_only">상세정보 보기</span></button></div>

    </section>
    <script>
    
        $(".btn_op_area").on("click", function() {
            $(".op_area").toggle();
            $(".fa-caret-up").toggleClass("fa-caret-down")
        });

    </script>
    <!-- } 회원정보 개요 끝 -->
	<?php if($row_dent['wr_id']) { ?>
    <div class="dental_info_wrap clearfix">
		<div class="dental_info_left">
			<div class="dental_introduce"><?php echo $dental['wr_content'];?></div>
			<div class="dental_cate">
				<dl class="clearfix">
					<dt><b>전문분야</b> <span>ㅣ</span></dt>
					<dd><?php echo implode(', ', explode('|', $dental['ca_name']));?></dd>
				</dl>
			</div>
			<div class="dental_detail">
				<dl class="clearfix">
					<dt>주소</dt>
					<?php 
					$addr = $dental['wr_2'].' '.$dental['wr_2_1'];
					?>
					<dd><?php echo $addr;?></dd>
					<dt>운영시간</dt>
					<dd>
						<span>평 일</span> : <?php echo $dental['wr_3'];?> <br/>

						<?php if( $dental['wr_6'] ) { ?>
						<span>점 심</span> : <?php echo $dental['wr_6'];?> <br/>						
						<?php } ?>

						<?php if( $dental['wr_4'] ) { 
						$day_array = explode('|', $dental['wr_4']);
						if(count($day_array) > 1) {
							$nigthTime = implode(' / ', $day_array);
						} else {
							$nigthTime = $day_array[0].'요일';
						}
						?>
						<span><?php echo $nigthTime;?></span> : <?php echo $dental['wr_5'];?> <br/>
						<?php } ?>

						<?php if( $dental['wr_7'] ) { ?>
						<span>토 요 일</span> : <?php echo $dental['wr_7'];?>						
						<?php } ?>
					</dd>
					<dt>연락처</dt>
					<dd><?php echo $dental['wr_8'];?><?php if($dental['wr_9'] == 1) { echo ' / 주차시설 완비';} ?></dd>
				</dl>
			</div>
		</div>
		<div class="dental_info_right">
			<?php
			// 파일 출력
			$v_img_count = count($dental['file']);
			if($v_img_count) {
				echo "<div id=\"bo_v_img\">\n";

				for ($i=1; $i<=1; $i++) {
					if ($dental['file'][$i]['view']) {
						//echo $dental['file'][$i]['view'];
						echo get_view_thumbnail($dental['file'][$i]['view']);
					}
				}

				echo "</div>\n";
			}
			?>
			<div class="dentist clearfix">
				<div class="dentist_name"><?php echo $dental['wr_1'];?> 원장님</div>
				<?php if($dental['wr_12']) { ?>
				<div class="dentist_btn"><a href="javascript:;">이력보기</a></div>
				<?php } ?>			
			</div>
			<?php if($dental['wr_12']) { ?>
			<div class="antecedents">
				<?php echo get_text($dental['wr_12'],1,false);?>
			</div>
			<?php } ?>
		</div>
	</div>

	<div class="dental_img">
		<div class="gallery-wrap">
			<!-- Slider main container -->
			<div class="swiper-container gall-container">
				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">
				<!-- Slides --> 
				<?php
				// 파일 출력
				$v_img_count = count($dental['file']);
				if($v_img_count) {

					for ($i=2; $i<=count($dental['file']) - 2; $i++) {
						if ($dental['file'][$i]['view']) {
							//echo $dental['file'][$i]['view'];
							echo '<div class="swiper-slide">'.strip_tags(get_view_thumbnail($dental['file'][$i]['view']), '<img>').'</div>';
						}
					}
				}
				?>
				</div>
			</div>

			<!-- If we need navigation buttons -->
			<div class="swiper-button-prev gall-prev"></div>
			<div class="swiper-button-next gall-next"></div>
		</div>
	</div>

	<div class="dental_review">
		<h2>진료후기</h2>
		<div id="review"><?php include_once(G5_PATH.'/review.php'); ?></div>		
	</div>

	<div class="dental_event">
		<h2>이벤트</h2>
		<div class="event_wrap">
			<div class="event_list swiper-container">
				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">				
				<?php 
				//$sql_ev = ' select * from g5_write_event where wr_4 = "'.$den_id.'" ';
				$sql_ev = ' select * from g5_write_event where wr_4 = "0" ';
				//echo $sql_ev;
				$result_ev = sql_query($sql_ev);
				$total_ev = sql_num_rows($result_ev);

				for($i = 0 ; $event = sql_fetch_array($result_ev) ; $i++){
					$thumb = get_list_thumbnail('event', $event['wr_id'], 385, 236, false, false, 'center', false, '80/0.5/3');
					?>
					<div class="swiper-slide">
						<div class="gall_href">
							<a href="<?php echo get_pretty_url('event', $event['wr_id'])?>&den_id=<?php echo $den_id;?>"><img src="<?php echo $thumb['src']?>" alt="<?php echo $event['wr_subject'];?>"></a>
						</div>
						<div class="gall_text_href">
							<?php if($event['wr_2'] < G5_TIME_YMD){ ?>
							<span style="background:#aaaaaa;">종료</span>
							<?php } else { ?>
							<span style="background:#777dee;">진행중</span>
							<?php } ?>
							<p><a href="<?php echo get_pretty_url('event')?>"><?php echo $event['wr_subject'];?></a></p>
						</div>
						<div class="gall_date">이벤트 기간 : <?php echo $event['wr_1'];?> ~ <?php echo $event['wr_2'];?></div>
					</div>
				<?php } 

				if($total_ev == 0) { ?>
					<div class="empty_list">등록된 이벤트가 없습니다.</div>
				<?php }
				?>
				</div>
			</div>

			<!-- If we need navigation buttons -->
			<div class="swiper-button-prev event-prev"></div>
			<div class="swiper-button-next event-next"></div>
		</div>
		<div class="event_btn"><a href="<?php echo G5_BBS_URL?>/write.php?bo_table=event">이벤트 등록</a></div>
	</div>

	<script>
	const swiper = new Swiper('.gall-container', {
	  speed: 400,
	  slidesPerView: 'auto',
	  autoHeight: 'true',
	  navigation: {
		nextEl: '.gall-next',
		prevEl: '.gall-prev',
	  },
	});

	const swiper2 = new Swiper('.event_list', {
	  speed: 400,
	  slidesPerView: 'auto',
	  autoHeight: 'true',
	  navigation: {
		nextEl: '.event-next',
		prevEl: '.event-prev',
	  },
	});
	</script>

	<?php } else { ?>
	<div class="no_dental">치과정보를 등록해주세요.</div>
	<?php } ?>
</div>

<script>
function member_leave()
{
    return confirm('정말 회원에서 탈퇴 하시겠습니까?')
}
</script>
<!-- } 마이페이지 끝 -->