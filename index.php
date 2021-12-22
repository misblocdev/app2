<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_PATH.'/head.php');
?>

<!-- main_visual 시작 { -->
<div class="main_visual">
	<div class="main_visual_pc">
	<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
	</div>
	<div class="main_visual_mo">
	<?php echo display_banner_mo('메인', 'mainbanner.10.skin.php'); ?>
	</div>
</div>
<!-- } main_visual 끝 -->

<div class="content">
	
	<!-- mc05 시작 { -->
	<div class="mc05">
		<div class="inner">
			<!-- Slider main container -->
			<div class="swiper-container event-swiper hide768">
				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">
					<?php 
					$sql_mbn = ' select * from g5_write_banner where ca_name = "main" order by wr_id ';
					$result_mbn = sql_query($sql_mbn);
					$row_mbn = sql_fetch($sql_mbn);
					
					for($i = 0 ; $mbn = sql_fetch_array($result_mbn) ; $i++){
					$thumb_mbn = get_list_thumbnail2('banner', $mbn['wr_id'], 1200, 350, false, false, 0, 'center', false, '80/0.5/3');
					?>
					<div class="swiper-slide">
						<a href="<?php echo G5_URL;?>/eventpage.php">
							<img src="<?php echo $thumb_mbn['src'];?>" alt="<?php echo $mbn['wr_subject'];?>">
						</a>
					</div>
					<?php } ?>
				</div>

				<!-- If we need navigation buttons -->
				<div class="swiper-button-prev event-prev"></div>
				<div class="swiper-button-next event-next"></div>
			</div>

			<div class="mc05_mo show768">
				<?php 
				$sql_mbn = ' select * from g5_write_banner where ca_name = "main" order by wr_id ';
				$result_mbn = sql_query($sql_mbn);
				$row_mbn = sql_fetch($sql_mbn);
				
				for($i = 0 ; $mbn = sql_fetch_array($result_mbn) ; $i++){
				$thumb_mbn_m = get_list_thumbnail2('banner', $mbn['wr_id'], 720, 290, false, false, 1, 'center', false, '80/0.5/3');
				?>
				<a href="<?php echo G5_URL;?>/eventpage.php">
					<img src="<?php echo $thumb_mbn_m['src'];?>" alt="<?php echo $mbn['wr_subject'];?>">
				</a>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- } mc05 끝 -->
	
	<!-- mc01 시작 { -->
	<div class="mc01">
		<div class="inner">
			<div class="mc01_h mc_h">내 진료별 이벤트</div>
			<div class="mc01_list">
				<ul class="clearfix">
				<?php 
				$sql_ev = ' select * from g5_write_event order by wr_id desc limit 0, 4 ';
				$result_ev = sql_query($sql_ev);
				$total_ev = sql_num_rows($result_ev);
			
				for($i = 0 ; $event = sql_fetch_array($result_ev) ; $i++) {
					$thumb = get_list_thumbnail('event', $event['wr_id'], 385, 236, false, false, 'center', false, '80/0.5/3');
					?>
					<li>
						<a href="<?php echo get_pretty_url('event', $event['wr_id']);?>">
							<div class="mc01_li_img"><img src="<?php echo $thumb['src']?>" alt="<?php echo $event['wr_subject'];?>"></div>
							<div class="mc01_li_sub"><?php echo $event['wr_subject'];?></div>
						</a>
					</li>
				<?php }
				if($total_ev == 0) { ?>
					<li class="no_list">등록된 이벤트가 없습니다.</li>
				<?php } ?>
				</ul>
			</div>
			<div class="mc01_btn mc_btn"><a href="<?php echo G5_URL."/event.php";?>">전체보기</a></div>
		</div>
	</div>
	<!-- } mc01 끝 -->
	
	<!-- mc02 시작 { -->
	<div class="mc02">
		<div class="inner">
			<div class="mc02_h mc_h">내주변 병원 찾기</div>
			<div class="mc02_tab">
				<ul class="clearfix">
					<li><a href="javascript:;" onclick="mainDental('0')">가까운지역</a></li>
					<li class="on"><a href="javascript:;" onclick="mainDental('1')">아나파톡 가맹점</a></li>
				</ul>
			</div>
			<div class="mc02_list">
				<?php
				if($is_member) {
				//$catelist = explode(' ', $member['mb_1']);
				$locate = explode(' ', $member['mb_addr1']);
				//echo $locate[0];
				$sql = ' select * from g5_write_dental where ca_name <> "" and wr_2 like "'.$locate[0].'%" and wr_10 = "1" ';
				} else {
				$sql = ' select * from g5_write_dental where ca_name <> "" and wr_10 = "1" ';
				}

				if(sql_num_rows(sql_query($sql)) == 0){
					$sql = ' select * from g5_write_dental where ca_name <> "" and wr_10 = "1" ';								
				}

				$result = sql_query($sql);
				$total = sql_num_rows($result);

				$quotient = sprintf('%d', $total / 4);
				$rest = $total % 4;
				if($rest) {
					$num = $quotient + 1;
				} else {
					$num = $quotient;
				}
				?>
				<?php if($num > 1) {?>
				<!-- If we need navigation buttons -->
				<div class="swiper-button-prev mc02-prev"></div>
				<div class="swiper-button-next mc02-next"></div>
				<?php }?>
				<div class="mc02_list_swiper">
					<div class="swiper-container mc02-container swiper-container-0">
						<div class="mc02_wrapper swiper-wrapper">
						<?php
						for($i = 0 ; $i < $num ; $i++) { ?>
							<div class=" swiper-slide clearfix">
								<ul class="clearfix">
								<?php
								$limit = 'limit '.($i * 4).', 4';

								if($is_member) {
								$locate = explode(' ', $member['mb_addr1']);
								//echo $locate[0];
								$sql_dental = ' select * from g5_write_dental where ca_name <> "" and wr_2 like "'.$locate[0].'%" and wr_10 = "1" order by wr_id desc '.$limit.' ';
								} else {
								$sql_dental = ' select * from g5_write_dental where ca_name <> "" and wr_10 = "1" order by wr_id desc '.$limit.' ';
								}

								if(sql_num_rows(sql_query($sql_dental)) == 0){
									$sql_dental = ' select * from g5_write_dental where ca_name <> "" and wr_10 = "1" order by wr_id desc '.$limit.' ';								
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

						<script>
						const denSwiper = new Swiper('.mc02-container', {
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- } mc02 끝 -->
	
	<!-- mc04 시작 { -->
	<div class="mc04">
		<div class="inner">
			<div class="mc04_h mc_h">치과진료 리얼후기</div>
			<div class="mc04_list">
				<ul class="clearfix">
				<?php
				$sql_rv = ' select * from `g5_shop_item_use` where is_confirm = "1" order by is_id desc limit 0, 8 ';
				$result_rv = sql_query($sql_rv);
				$total_rv = sql_num_rows($result_rv);
				$thumbnail_width = 500;

				$sql_den = ' select * from g5_board where bo_table = "dental" ';
				$row_den = sql_fetch($sql_den);
				$den_cate = explode('|', $row_den['bo_category_list']);

				for($i = 0 ; $review = sql_fetch_array($result_rv) ; $i++){

					if($is_admin) {
					$is_name    = get_text($review['is_name']);
					} else {
					$is_name    = mb_substr(get_text($review['is_name']), 0, 1).'**';
					}

					$is_cate    = get_text($review['is_cate']);
					$is_subject = conv_subject($review['is_subject'],50,"…");
					$is_content = get_view_thumbnail(conv_content($review['is_content'], 1), $thumbnail_width);
					$is_time    = substr($review['is_time'], 2, 8);

					$hash = md5($review['is_id'].$review['is_time'].$review['is_ip']);

					$rv_dental = sql_fetch(' select * from g5_write_dental where wr_code = "'.$review['it_id'].'" ');
					//echo ' select * from g5_write_dental where wr_code = "'.$review['it_id'].'" ';

					$num = array_search($is_cate, $den_cate) + 1;

					$rv_img = G5_DATA_PATH.'/review/'.$review['rv_img'];
					$rv_img_exists = run_replace('shop_item_image_exists', (is_file($rv_img) && file_exists($rv_img)));
					$img_tag = run_replace('rv_image_tag', '<img src="'.G5_DATA_URL.'/review/'.$review['rv_img'].'" class="rv_thumb_image" >');
				?>
					<li class="review_li">
						<div class="review_thum">
						<?php
						if($rv_img_exists) {?>
							<?php echo $img_tag; ?>
						<?php } else { ?>	
							<img src="/images/cate_icon_<?php echo $num;?>_on.png" alt="<?php echo $is_cate;?>"> 
						<?php }?>
						</div>
						<div class="review_con">
							<div class="review_dental"><a href="<?php echo get_pretty_url('dental', $rv_dental['wr_id']).'&den_id='.$rv_dental['wr_code']?>"><?php echo $rv_dental['wr_subject']?></a></div>
							<dl class="review_dl clearfix">
								<dt>후기제목</dt>
								<dd class="review_tit"><strong>[ <?php echo $is_cate;?> ]</strong> <?php echo $is_subject; ?></dd>
								<dt>작성자</dt>
								<dd class="dd_name"><?php echo $is_name; ?></dd>
								<!-- <dt>작성 날짜</dt>
								<dd class="dd_date"><?php echo $is_time; ?></dd> -->
							</dl>

							<?php if ($is_admin || $review['mb_id'] == $member['mb_id']) { ?>
							<!-- <div class="review_cmd">
								<a href="<?php echo $review_form."&amp;is_id={$review['is_id']}&amp;w=u"; ?>" class="review_form btn01" onclick="return false;">수정</a>
								<a href="<?php echo $review_formupdate."&amp;is_id={$review['is_id']}&amp;w=d&amp;hash={$hash}"; ?>" class="review_delete btn01">삭제</a>
							</div> -->
							<?php } ?>

							<div class="review_txt"><?php echo strip_tags($is_content); // 사용후기 내용 ?></div>

							<button class="sps_con_<?php echo $i; ?> review_detail"><img src="/images/btn_info.png" alt="내용보기"></button>

							<!-- 사용후기 자세히 시작 -->
							<div class="review_detail_cnt">
								<div class="review_detail_in">
									<h3>진료후기</h3>
									<div class="review_cnt">
										<div class="review_tp_cnt">
											<div class="review_dental"><a href="<?php echo get_pretty_url('dental', $rv_dental['wr_id']).'&den_id='.$rv_dental['wr_code']?>"><?php echo $rv_dental['wr_subject']?></a></div>
											<span><strong>[ <?php echo $is_cate;?> ]</strong> <?php echo get_text($review['is_subject']); ?></span>
											<dl class="sps_dl clearfix">
												<dt class="sound_only">작성자</dt>
												<dd class="dd_name"><?php echo $is_name; ?></dd>
												<!-- <dt class="sound_only">작성 날짜</dt>
												<dd class="dd_date"><?php echo $is_time; ?></dd> -->
												<!-- <dt class="sound_only">작성일</dt>
												<dd><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo substr($row['is_time'],0,10); ?></dd> -->
											</dl>
										</div>
										
										<div id="sps_con_<?php echo $i; ?>" class="review_bt_cnt">
											<?php echo $is_content; // 사용후기 내용 ?>		
											<?php
											if($rv_img_exists) {?>
											<div id="limg<?php echo $i; ?>" class="banner_or_img">
												<?php echo $img_tag; ?>
											</div>
											<?php } ?>					
										</div>
									</div>
									<button class="rd_cls"><span class="sound_only">후기 상세보기 팝업 닫기</span><i class="fa fa-times" aria-hidden="true"></i></button>
								</div>
							</div>
							<!-- 사용후기 자세히 끝 -->
						</div>
					</li>
				<?php }
				?>
				</ul>
			</div>
			<div class="mc04_btn mc_btn">
				<a href="<?php echo G5_URL;?>/reviewlist.php">전체보기</a>
			</div>
		</div>
	</div>
	<!-- } mc04 끝 -->
	
	<!-- mc03 시작 {
	<div class="mc03">
		<div class="inner">
			<div class="mc03_h mc_h line2"><span>아나파톡에서</span>최고의 치과를 만나세요</div>
			<div class="mc03_data">
				<ul class="clearfix">
					<li>
						<span>가입 치과</span>
						<strong>3,862</strong>
					</li>
					<li>
						<span>누적 회원수</span>
						<strong>322,578</strong>
					</li>
					<li>
						<span>총 방문자 수</span>
						<strong>23,587,015</strong>
					</li>
					<li>
						<span>후기 수</span>
						<strong>32,453</strong>
					</li>
				</ul>
			</div>
			<div class="mc03_p">3,000개의 전문적인 치과와<br class="show768"/> 20만명의 실력있는 전문의가 함께 하고 있습니다.</div>
		</div>
	</div>
	} mc03 끝 -->
	
	<!-- mc06 시작 { -->
	<div class="mc06">
		<div class="inner">
			<div class="mc06_h mc_h line2"><span>궁금던 치과치료,</span>전문의가 풀어드립니다</div>
			<div class="mc06_list">
				<ul class="clearfix">
				<?php 
				$sql_info = ' select * from g5_write_info order by wr_id desc limit 0, 4 ';
				$result_info = sql_query($sql_info);
				$total_info = sql_num_rows($result_info);

				for($i = 0 ; $info = sql_fetch_array($result_info) ; $i++){
				$thumb = get_list_thumbnail('info', $info['wr_id'], 124, 124, false, false, 'center', false, '80/0.5/3');
				?>
					<li>
						<div class="mc06_list_img">
							<a href="<?php echo get_pretty_url('info', $info['wr_id'], '&sca='.$info['ca_name']);?>">
								<img src="<?php echo $thumb['src'];?>" alt="<?php echo $info['wr_subject'];?>">
							</a>
						</div>
						<div class="mc06_list_txt">
							<a href="<?php echo get_pretty_url('info', $info['wr_id'], '&sca='.$info['ca_name']);?>" class="mc06_list_tit">
								<strong><?php echo $info['ca_name'] ?></strong> <span>|</span> <?php echo $info['wr_subject'] ?>
							 </a>
							 <div class="mc06_list_con">
							 <?php echo strip_tags($info['wr_content']); ?>
							 </div>
						</div>
						<div class="mc06_list_btn">
							<a href="<?php echo get_pretty_url('info', $info['wr_id'], '&sca='.$info['ca_name']);?>"><img src="/images/btn_info.png" alt="상세보기"></a>
						</div>
					</li>
				<?php }
				?>
				</ul>
			</div>
			<div class="mc06_btn mc_btn">
				<a href="<?php echo get_pretty_url('info');?>">전체보기</a>
			</div>
		</div>
	</div>
	<!-- } mc06 끝 -->

</div>

<script>
jQuery(function($){
	// 사용후기 열기
    $(".review_detail").on("click", function(){
        $(this).parent("div").children(".review_detail_cnt").show();
    });
		
    // 사용후기 닫기
    $(document).mouseup(function (e){
        var container = $(".review_detail_cnt");
        if( container.has(e.target).length === 0)
        container.hide();
    });

    // 후기 상세 글쓰기 닫기
    $('.rd_cls').click(function(){
        $('.review_detail_cnt').hide();
    });
});

$('.mc02_tab li').on('click', function(){
	$('.mc02_tab li').removeClass('on');
	$(this).addClass('on');
})

function mainDental(franchisee){
	$.ajax({
		url : "/ajax.maindental.php",
		type: "POST",
		data : {
			"franchisee" : franchisee,
		},
		async: false,
		success: function(msg) {
		  $(".mc02_list_swiper").html(msg);
		},error: function(request,status,error){
		  alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
		}
	})
}

const eventSwiper = new Swiper('.event-swiper', {
  speed: 800,
  spaceBetween: 0,
  navigation: {
    nextEl: '.event-next',
    prevEl: '.event-prev',
  },  
  autoplay: {
    delay: 3000,
  },
});
</script>

<?php
include_once(G5_PATH.'/tail.php');