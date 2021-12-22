<?php
ini_set("session.cache_expire", 1);
?>
<!-- 일반 마이페이지 -->
<!-- 마이페이지 시작 { -->
<style>
#recommend_link{overflow:hidden;width:1px;height:1px;font-size:1px;outline:none;border:none;position:absolute;top:0;left:0;margin:0;padding:0;}

/* 마이페이지 포인트스왑 */
.view_pop {display: none;position: fixed;width: 100%;height: 100%;top: 0;left: 0;z-index: 999;background: #fff;}
.view_pop_wrap {width:500px; margin: 0 auto; padding: 50px 0px;position: relative;}
.view_wrap {display: none;}

.view_term{margin-top: 60px;}
.view_cls {position: absolute;left: 0;top: 30px;}
.point_box{text-align: center; width:100%; height:150px; border-radius:10px; background:#f4f4f4; margin-bottom: 40px;}
.point_box_title{padding-top: 30px; margin-bottom: 10px; font-size: 21px;}
.mypoint{font-size: 45px;}

.swap{margin-bottom: 30px;}
.swap h2, .wallet h2{font-size: 25px; margin-bottom: 7px;}
#wr_2, #wr_3{width:500px; height:60px; font-size: 24px;}
.submitbtn{width:100%; background:#777dee; font-size: 24px; color:white; font-weight: 500;}
.btn_submit{display: block; height:90px; text-align: center; line-height: 90px; margin:0 auto;}

.top_content{margin-bottom: 30px; position: relative;}
#smb_my_act{position: absolute; bottom:0px; right:0;}
.my_button{text-align:left;}
.mypage_button{text-align: center; line-height:60px; display:inline-block; width:160px; height:60px; border-radius:15px; font-weight: bold; font-size: 20px;}
.mypage_button img{padding-bottom:8px; padding-left: 10px; width:30px;}
.upbtn{background:#d6d9f8; color:#6a77fa; margin-right: 20px;}
.checkbtn{background:#7c87f2; color:#fff;}
.checkbtn img {width: 34px;padding-bottom: 6px;}

.pointbox{overflow: hidden; width:100%; height:120px; margin-bottom: 40px; background:#fff; border:1px solid #ccc;}
.pbbox{float:left;}
.pointbox h4{font-size: 24px;}
.pointbox h4.pbtxt1{margin-bottom: 10px; font-size: 20px;}
.pointbox h4.pbtxt2{color:#7c87f2;}
.pointbox h4 span{color:black;}
.pointbox h3{float:right; line-height: 74px; padding-right: 40px;}
.pointbox .pbb a{display:block; padding:23px 0 0 40px; overflow: hidden; height: 120px;}
.pb1{float:left; width:50%; height:120px; border-right:1px solid #ccc;}
.pb2{float:left; width:50%; height:120px;}

@media only screen and (max-width: 1280px) {
/* 마이페이지 포인트스왑 */
.view_pop {width: 100%;height: 100%;top: 0;left: 0;background: #fff;}
.view_pop_wrap {width:39.0625vw; margin: 0 auto; padding: 3.9063vw 0.0000vw;}
.view_wrap {}

.view_term{margin-top: 4.6875vw;}
.view_cls {left: 0;top: 2.3438vw;}
.point_box{ width:100%; height:11.7188vw; border-radius:0.7813vw; background:#f4f4f4; margin-bottom: 3.1250vw;}
.point_box_title{padding-top: 2.3438vw; margin-bottom: 0.7813vw; font-size: 1.6406vw;}
.mypoint{font-size: 3.5156vw;}

.swap{margin-bottom: 2.3438vw;}
.swap h2, .wallet h2{font-size: 1.9531vw; margin-bottom: 0.5469vw;}
#wr_2, #wr_3{width:39.0625vw; height:4.6875vw; font-size: 1.8750vw;}
.submitbtn{width:100%; background:#777dee; font-size: 2.3438vw;  }
.btn_submit{ height:7.0313vw;  line-height: 7.0313vw;}


.top_content{margin-bottom: 2.3438vw; }
#smb_my_act{ bottom:0.0000vw; right:0;}
.my_button{}
.mypage_button{ line-height:4.6875vw;  width:12.5000vw; height:4.6875vw; border-radius:1.1719vw;  font-size: 1.5625vw;}
.mypage_button img{padding-bottom:0.6250vw; padding-left: 0.7813vw; width:2.3438vw;}
.upbtn{background:#d6d9f8;  margin-right: 1.5625vw;}
.checkbtn{background:#7c87f2; }
.checkbtn img {width: 2.6563vw;padding-bottom: 0.4688vw;}

.pointbox{ width:100%; height:9.3750vw; margin-bottom: 3.1250vw; background:#fff; border:0.0781vw solid #ebebeb;}
.pbbox{}
.pointbox h4{font-size: 1.8750vw;}
.pointbox h4.pbtxt1{margin-bottom: 0.7813vw; font-size: 1.5625vw;}
.pointbox h4.pbtxt2{}
.pointbox h4 span{}
.pointbox h3{ line-height: 5.7813vw; padding-right: 3.1250vw;}
.pointbox .pbb a{ padding:1.7969vw 0 0 3.1250vw;  height: 9.3750vw;}
.pb1{ width:50%; height:9.3750vw; border-right:0.0781vw solid #ebebeb;}
.pb2{ width:50%; height:9.3750vw;}
}

@media only screen and (max-width: 768px) {
/* 마이페이지 포인트스왑 */
.view_pop_wrap {width:100%; margin: 0 auto; padding: 50px 0;}

.view_term{margin-top: 60px;}
.view_cls {position: absolute;left: 8.7240vw;top: 30px;}
.point_box{text-align: center; width:80.7292vw; height:150px; margin:0 auto; border-radius:10px; background:#f4f4f4; margin-bottom: 40px;}
.point_box_title{padding-top: 30px; margin-bottom: 10px; font-size: 21px;}
.mypoint{font-size: 45px;}

.swap, .wallet{margin: 0 auto 30px; width:80.7292vw;}
.swap h2, .wallet h2{font-size: 25px; margin-bottom: 7px;}
#wr_2, #wr_3{width:80.7292vw; height:60px; font-size: 24px; }
.submitbtn{width:100%; background:#777dee; font-size: 28px; color:white; font-weight: 500;}
.btn_submit{display: block; height:90px; text-align: center; line-height: 90px;}


.top_content{margin-bottom: 15vw; }
#smb_my_act{ bottom:-11vw; right:0;}
.my_button{}
.mypage_button{ line-height:13.0208vw;  width:48%; height:13.0208vw; border-radius:1.9531vw;  font-size: 5vw;}
.mypage_button img{padding-bottom:1.3021vw; padding-left: 2vw; width:6.5vw;}
.upbtn{background:#d6d9f8; color:#6a77fa; margin-right: 3%;}
.checkbtn{background:#7c87f2; color:#fff;}
.checkbtn img {width: 7.2563vw;padding-bottom: 0.8688vw;}

.pointbox{ width:100%; height:18.2292vw; margin-bottom: 5.2083vw; background:#fff; border:0.1302vw solid #ccc;}
.pbbox{}
.pointbox h4{font-size: 3.6458vw;}
.pointbox h4.pbtxt1{margin-bottom: 1.3021vw; font-size: 3.1250vw;}
.pointbox h4.pbtxt2{}
.pointbox h4 span{}
.pointbox h3{ line-height: 8.3333vw; padding-right: 5.2083vw;}
.pointbox .pbb a{ padding:3.5807vw 0 0 5.2083vw;  height: 18.2292vw;}
.pb1{ width:50%; height:18.2292vw; border-right:0.1302vw solid #ccc;}
.pb2{ width:50%; height:18.2292vw;}
}
</style>


<input type="text" value="<?php echo G5_BBS_URL.'/register.php?rec='.$member['mb_id']; ?>" id="recommend_link">
<div id="smb_my">
	<div class="inner">
	<h1><span><?php echo $member['mb_name'];?>님,</span> 안녕하세요.</h1>
    <!-- 회원정보 개요 시작 { -->
	<div class="top_content">
		<div class="my_button">
			<a href="javascript:;" class="mypage_button upbtn">친구추천<img src="/images/share.png" alt="친구추천"></a>
			<a href="javascript:;" class="mypage_button checkbtn">출석체크<img src="/images/check.png" alt="출석체크"></a>
		</div>
		<div id="smb_my_act">
			<ul>
				<?php if ($is_admin == 'super') { ?><li><a href="<?php echo G5_ADMIN_URL; ?>/" class="btn_admin">관리자</a></li><?php } ?>
				<!-- <li><a href="<?php echo G5_BBS_URL; ?>/memo.php" target="_blank" class="win_memo btn01">쪽지함</a></li> -->
				<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn01 btn_pp">회원정보수정</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn01">로그아웃</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" onclick="return member_leave();" class="btn01">회원탈퇴</a></li>
			</ul>
		</div>
	</div>

	<div class="pointbox">
		<div class="pb1 pbb"><a class="exchange" href="javascript:;"><div class="pbbox"><h4 class="pbtxt1">POINT</h4><h4 class="pbtxt2">교환하기</h4></div><h3><img src="/images/right_arrow.png" alt=""></h3></a></div>
		<div class="pb2 pbb"><a href="<?php echo G5_URL; ?>/point_mining.php"><div class="pbbox"><h4 class="pbtxt1">MSB<h4 class="pbtxt2">1234<span>P</span></h4></div><h3><img src="/images/right_arrow.png" alt=""></h3></a></div>
	</div>
		<form name="fwrite" id="fwrite" action="/bbs/write_update.php" onsubmit="return qk_submit(this);" method="post" autocomplete="off" style="">
		<input type="hidden" value="point_wallet" name="bo_table">
		<input type="hidden" value="1" name="wr_10">
		<input type="hidden" value="포인트 스왑 신청" name="wr_subject">
		<input type="hidden" value="포인트 스왑 신청" name="wr_content">
		<div class="view_pop">
			<div class="view_pop_wrap">
				<div class="view_cls"><img src="/images/back.png" alt="창 닫기"></div>
				<div class="view_term view_wrap">
					<div class="point_box">
						<h3 class="point_box_title">나의 보유포인트</h3>
						<h1 class="mypoint"><?php echo number_format($member['mb_point']) ?></h1>
					</div>
					<div class="swap">
						<h2>스왑 포인트</h2>
						<label for="wr_2" class="sound_only">스왑 포인트</label>
						<input type="text" name="wr_2" value="" id="wr_2" class="frm_input" placeholder="0000">
					</div>
					<div class="wallet">
						<h2>나의 지갑주소</h2>
						<label for="wr_3" class="sound_only">나의 지갑주소</label>
						<input type="text" name="wr_3" value="" id="wr_3" class="frm_input" placeholder="주소를 입력해 주세요">
					</div>
					<div class="submitbtn" style="margin-top:60px;">
						<input type="submit" value="신청하기" id="btn_submit" accesskey="s" class="btn_submit btn">
					</div>
				</div>
			</div>
		</div>
		</form>
		<script>
		// 약관창 열기
		$(".exchange").on("click", function(){
			$(".view_pop").show();
			$(".view_term").show();
			popupOpen = true;
			window.history.pushState("forward", null, "");
		});

		// 약관창 닫기
		$('.view_cls, .cls_btn').click(function(){
			$('.view_pop').hide();
			$(".view_term").hide();
			$(".view_private").hide();
			popupOpen = false;
			window.history.back();
		});
		</script>

    <section id="smb_my_ov">
        <h2>회원정보 개요</h2>
        <strong class="my_ov_name"><?php echo get_member_profile_img($member['mb_id']); ?> <?php echo $member['mb_name']; ?></strong>
        <dl class="cou_pt">
            <dt>보유포인트</dt>
            <dd><a href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank" class="win_point"><?php echo number_format($member['mb_point']); ?></a> P</dd>
            <!-- <dt>보유쿠폰</dt>
            <dd><a href="<?php echo G5_SHOP_URL; ?>/coupon.php" target="_blank" class="win_coupon"><?php echo number_format($cp_count); ?></a></dd> -->
        </dl>
        

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

    <!-- 내가 예약한 내역 { -->
    <section id="smb_my_reservation" class="smb_my_section">
        <h2 style="color: #7c87f2;">내가 예약한 내역</h2>
		<div id="reservation"><?php include_once(G5_PATH.'/mypage1.reservation.php'); ?></div>
    </section>
    <!-- } 내가 예약한 -->
	
    <!-- 내가 본 최근 치과 이벤트 시작 { -->
    <section id="smb_my_event" class="smb_my_section">
        <h2>내가 본 최근 치과 이벤트</h2>
		<div class="smb_my_event_list">
			<div class="event_list swiper-container">
			<?php
			//오늘본 이벤트 데이터
			function get_view_today_event($is_cache=false)
			{
				global $g5;
				
				$tv_idx_ev = get_session("ss_tv_idx_ev");

				if( !$tv_idx_ev ){
					return array();
				}

				static $cache_ev = array();

				if( $is_cache && !empty($cache_ev) ){
					return $cache_ev;
				}

				for ($i=1;$i<=$tv_idx_ev;$i++){

					$tv_wr_idx_ev = $tv_idx_ev - ($i - 1);
					$tv_wr_id_ev = get_session("ss_tv_ev[$tv_wr_idx_ev]");

					$rowx_ev = sql_fetch(' select * from g5_write_event where wr_id = "'.$tv_wr_id_ev.'" ');
					if(!$rowx_ev['wr_id'])
						continue;
					
					$key = $rowx_ev['wr_id'];

					$cache_ev[$key] = $rowx_ev;
				}

				return $cache_ev;
			}

			//오늘본상품 갯수 출력
			function get_view_today_event_count()
			{
				$tv_datas_ev = get_view_today_event(true);

				return count($tv_datas_ev);
			}

			$tv_datas_ev = get_view_today_event(true);

			//echo get_view_today_event_count();
			?>
			<?php if ($tv_datas_ev) { // 오늘 본 이벤트가 1개라도 있을 때 ?>
			<?php
			$tv_tot_count_ev = 0;
			$k = 0;
			$i = 1;
			foreach($tv_datas_ev as $rowx_ev)
			{
				if($tv_tot_count_ev > 2)
					continue;

				if(!$rowx_ev['wr_id'])
					continue;
				
				$tv_wr_id_ev = $rowx_ev['wr_id'];
				$thumb = get_list_thumbnail('event', $tv_wr_id_ev, 385, 236, false, false, 'center', false, '80/0.5/3');

				if ($tv_tot_count_ev == 0) echo '<div class="swiper-wrapper">'.PHP_EOL;
				echo '<div class="swiper-slide">'.PHP_EOL;
				echo '<div class="gall_href">';
				echo '<a href="'.get_pretty_url('event', $tv_wr_id_ev).'">';
				echo '<img src="'.$thumb['src'].'" alt="'.$rowx_ev['wr_subject'].'">'.PHP_EOL;
				echo '</a>'.PHP_EOL;
				echo '</div>'.PHP_EOL;
				echo '<div class="gall_text_href">';
				if($rowx_ev['wr_2'] < G5_TIME_YMD){ 
				echo '<span style="background:#aaaaaa;">종료</span>';
				} else {
				echo '<span style="background:#777dee;">진행중</span>';
				}
				echo '<p><a href="'.get_pretty_url('event', $tv_wr_id_ev).'">';
				echo $rowx_ev['wr_subject'].PHP_EOL;
				echo '</a></p>';
				echo '</div>'.PHP_EOL;
				echo '<div class="gall_date">이벤트 기간 : '.PHP_EOL;
				echo $rowx_ev['wr_1'].' ~ '.$rowx_ev['wr_2'].PHP_EOL;
				echo '</div>'.PHP_EOL;
				echo '</div>'.PHP_EOL;

				$tv_tot_count_ev++;
				$i++;
			}
			if ($tv_tot_count_ev > 0) echo '</div>'.PHP_EOL;
			?>
			<?php } else { // 오늘 본 이벤트가 없을 때 ?>

			<p class="li_empty">내가 본 최근 치과 이벤트가 없습니다.</p>

			<?php } ?>
			</div>

			<!-- If we need navigation buttons -->
			<div class="swiper-button-prev event-prev show768"></div>
			<div class="swiper-button-next event-next show768"></div>
		</div>
        <div class="smb_my_more">
            <a href="<?php echo G5_URL?>/event.php">더보기</a>
        </div>
    </section>
	<script>
	const swiper = new Swiper('.event_list', {
	  speed: 400,
	  slidesPerView: 'auto',
	  autoHeight: 'true',
	  allowTouchMove: false,
	  navigation: {
			nextEl: '.event-next',
			prevEl: '.event-prev',
	  },
	  breakpoints: {
		// when window width is >= 320px
		320: {
			allowTouchMove: true,
		},
		// when window width is >= 768px
		768: {
			allowTouchMove: true,
		}
	  }
	});
	</script>
    <!-- } 내가 본 최근 치과 이벤트 끝 -->

    <!-- 내가 본 최근 치과 리스트 시작 { -->
    <section id="smb_my_dental" class="smb_my_section">
        <h2>내가 본 최근 치과 리스트</h2>
		<div class="smb_my_dental_list">
		<?php
		//오늘본 이벤트 데이터
		function get_view_today_dental($is_cache=false)
		{
			global $g5;
			
			$tv_idx_dt = get_session("ss_tv_idx_dt");

			if( !$tv_idx_dt ){
				return array();
			}

			static $cache_dt = array();

			if( $is_cache && !empty($cache_dt) ){
				return $cache_dt;
			}

			for ($i=1;$i<=$tv_idx_dt;$i++){

				$tv_wr_idx_dt = $tv_idx_dt - ($i - 1);
				$tv_wr_id_dt = get_session("ss_tv_dt[$tv_wr_idx_dt]");

				$rowx_dt = sql_fetch(' select * from g5_write_dental where wr_id = "'.$tv_wr_id_dt.'" ');
				if(!$rowx_dt['wr_id'])
					continue;
				
				$key = $rowx_dt['wr_id'];

				$cache_dt[$key] = $rowx_dt;
			}

			return $cache_dt;
		}

		//오늘본상품 갯수 출력
		function get_view_today_dental_count()
		{
			$tv_datas_dt = get_view_today_dental(true);

			return count($tv_datas_dt);
		}

		$tv_datas_dt = get_view_today_dental(true);

		//echo get_view_today_event_count();
		?>
		<?php if ($tv_datas_dt) { // 오늘 본 이벤트가 1개라도 있을 때 ?>
		<?php
		$tv_tot_count_dt = 0;
		$k = 0;
		$i = 1;
		foreach($tv_datas_dt as $rowx_dt)
		{
			if($tv_tot_count_dt > 3)
				continue;

			if(!$rowx_dt['wr_id'])
				continue;
			
			$tv_wr_id_dt = $rowx_dt['wr_id'];
			$dental = sql_fetch(' select * from g5_write_dental where wr_id = "'.$tv_wr_id_dt.'" order by wr_id desc ');
			$thumb = get_list_thumbnail('dental', $tv_wr_id_dt, 385, 236, false, false, 'center', false, '80/0.5/3');
			$href = get_pretty_url('dental', $tv_wr_id_dt).'&den_id='.$dental['wr_code'];

			if ($tv_tot_count_dt == 0) echo '<ul class="clearfix">'.PHP_EOL;
			echo '<li class="gall_li">';
			echo '<div class="gall_info">';
			echo '<div class="dental_name"><a href="'.$href.'">'.$dental['wr_subject'].'</a></div>';
			echo '<div class="dental_info">';
			echo '<dl class="clearfix">';
			echo '<dt>평 일</dt>';
			echo '<dd>'.$dental['wr_3'].'</dd>';
			if( $dental['wr_6'] ) {
			echo '<dt>점 심</dt>';
			echo '<dd>'.$dental['wr_6'].'</dd>';				
			}
			if( $dental['wr_4'] ) {
			$day_array = explode('|', $dental['wr_4']);
			if(count($day_array) > 1) {
			$nigthTime = implode(' / ', $day_array);
			} else {
			$nigthTime = $day_array[0].' 요 일';
			}
			echo '<dt>'.$nigthTime.'</dt>';
			echo '<dd>'.$dental['wr_5'].'</dd>';
			}
			if( $dental['wr_7'] ) {
			echo '<dt>토 요 일</dt>';
			echo '<dd>'.$dental['wr_7'].'</dd>	';					
			}
			echo '<dt class="addr">주 소</dt>';
			$addr = $dental['wr_2'].' '.$dental['wr_2_1'];			
			echo '<dd>'.$addr.'</dd>';
			echo '</dl>';
			echo '</div>';
			if($dental['wr_10'] == 1) {
			echo '<div class="dental_franchisee"><img src="/images/icon_franc.png" alt="가맹업"></div>';
			}
			echo '</div>';
			echo '<div class="gall_img">';
			echo '<a href="'.$href.'" class="simple_text_g">';
			$thumb = get_list_thumbnail('dental', $dental['wr_id'], 220, 230, false, true);
			if($thumb['src']) {
			$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="220" style="border:0px solid #dcdcdc;" height="230">';
			} else {
			$img_content = '<div><p style="padding:10px;">No Image</p></div>';
			}
			echo $img_content;
			echo '</a>';
			echo '</div>';
			echo '</li>';

			$tv_tot_count_dt++;
			$i++;
		}
		if ($tv_tot_count_dt > 0) echo '</ul>'.PHP_EOL;
		?>
		<?php } else { // 오늘 본 이벤트가 없을 때 ?>

		<p class="li_empty">내가 본 최근 치과가 없습니다.</p>

		<?php } ?>
        </div>
        <div class="smb_my_more">
            <a href="<?php echo G5_URL?>/dental_cate1.php">더보기</a>
        </div>
    </section>
    <!-- } 내가 본 최근 치과 리스트 끝 -->

    <!-- 내가 작성한 후기 리스트 시작 { -->
    <section id="smb_my_review" class="smb_my_section">
        <h2>내가 작성한 후기 리스트</h2>
		<div id="review"><?php include_once(G5_PATH.'/mypage1.review.php'); ?></div>

        <div class="smb_my_more">
            <a href="<?php echo G5_URL?>/reviewlist.php">더보기</a>
        </div>
    </section>
    <!-- } 내가 작성한 후기 리스트 끝 -->

    <!-- 내가 문의한 리스트 시작 {
    <section id="smb_my_inquiry" class="smb_my_section">
        <h2>내가 문의한 리스트</h2>

        <div class="smb_my_more">
            <a href="">더보기</a>
        </div>
    </section>
    } 내가 문의한 리스트 끝 -->

	</div>
</div>

<script>
function member_leave()
{
    return confirm('정말 회원에서 탈퇴 하시겠습니까?')
}

$(function(){
	$('.upbtn').click(function(){
		var urlbox = $('#recommend_link');

		urlbox.select();
		document.execCommand( 'Copy' );
		alert( 'URL이 복사되었습니다.' );
	});
});
</script>
<!-- } 마이페이지 끝 -->