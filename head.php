<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

run_event('pre_head');

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/head.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>
<link rel="stylesheet" href="/js/swiper/swiper.min.css" />
<script src="/js/swiper/swiper.min.js"></script>

<?php if (strpos($_SERVER['HTTP_USER_AGENT'],'iPhone') !== false) { ?>
<style>
@media only screen and (max-width: 768px){ /* viewport width : 768 */

#captcha #captcha_img {
    height: 7.8125vw;
	margin-top: 0.5104vw;
}
#captcha #captcha_key {
    margin: 0 0 0 0.6510vw;
    padding: 0 0.6510vw;
    width: 22.1354vw;
    height: 7.8125vw;
    font-size: 3.6458vw;
    border-radius: 0.3906vw;    
	margin-top: 0.5104vw;
}
#captcha #captcha_reload {width: 7.8125vw; height: 7.8125vw; margin-top: 0.5104vw; background-size: 7.8125vw; background-position: 0 -7.8125vw;}
#captcha #captcha_mp3 {width: 7.8125vw; height: 7.8125vw; margin-top: 0.5104vw; background-size: 7.8125vw; }

}

</style>
<?php } ?>

<?php if (defined("_INDEX_")) { ?>
<!-- <div id="fullpage"> -->
<div class="intro section">
	<div class="intro_wrap">
		<div class="intro_txt coreEB">
		<span>원하는 진료를 한번에!</span>
		치과 고민은 이제 끝<br/>
		<strong>"아나파톡"</strong>에서<br/>
		"맞춤형 진료"를
		</div>
		<div class="intro_btn" style="display:none;">
			<ul class="clearfix">
				<!-- <li><a href="https://apps.apple.com/kr/app/%EC%95%84%EB%82%98%ED%8C%8C%ED%86%A1/id1579000239"><img src="/images/logo_apple.png" alt="Apple Store"></a></li> -->
				<li><a href="https://play.google.com/store/apps/details?id=com.moden7.anapatalk"><img src="/images/logo_play.png" alt="Google Play"></a></li>
			</ul>
		</div>
	</div>
</div>

<!-- <div class="full_wrap section fp-auto-height"> -->
<?php }?>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php 
	$mAgent = array("iPhone","iPod","Android","Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony" );
	$chkMobile = false;
	for($i=0; $i<sizeof($mAgent); $i++){
		if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
			$chkMobile = true;
			break;
		}
	}

	if(defined('_INDEX_')) { // index에서만 실행

		if($chkMobile){
			include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
		}else{
			include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
		}
	} ?>

    <!-- <div id="hd_wrapper"> -->
	<div id="hd_top">
		<div class="inner">
			<div id="logo">
				<a href="<?php echo G5_URL ?>"><img src="/images/hd_logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
			</div>

			<button type="button" id="gnb_open" class="hd_opener"><img src="/images/hd_menu.png" alt="메뉴열기"></button>

			<ul class="hd_login hide768">        
				<?php if ($is_member) {  
				if($member['mb_10'] == 1) {
					$mypage = G5_BBS_URL.'/mypage.php?den_id='.$member['mb_3'];
				} else {
					$mypage = G5_BBS_URL.'/mypage.php';
				}
				?>
				<?php if ($is_admin) {  ?>
				<li class="tnb_admin"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>" style="color: red;font-weight: 500;">관리자</a></li>
				<?php }  ?>
				<li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
				<li><a href="<?php echo $mypage ?>">마이페이지</a></li>
				<li><a href="" class="hd_find">치과찾기</a></li>
				<?php } else {  ?>
				<li><a href="<?php echo G5_BBS_URL ?>/login.php?url=<?php echo $_SERVER['REQUEST_URI'];?>">로그인</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
				<li><a href="<?php echo G5_URL;?>/dental_cate3.php" class="hd_find">치과찾기</a></li>
				<?php }  ?>
			</ul>

			<div class="m_hd_sch show768">
				<button type="button" id="sch_open" class="sch_opener"><img src="/images/m_btn_sch.png" alt="검색 열기"></button>
				<div class="hd_sch_wr m_sch">
					<div id="hd_sch">
						<h2 class="sound_only">사이트 내 전체검색</h2>
						<form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/board.php" onsubmit="return fsearchbox_submit(this);" method="get">
						<input type="hidden" name="bo_table" value="dental">
						<input type="hidden" name="sfl" value="wr_subject">
						<input type="hidden" name="sop" value="and">
						<input type="text" name="stx" id="sch_stx" maxlength="20" placeholder="치과 검색">
						<button type="submit" id="sch_submit" value="검색"><img src="/images/btn_sch.png" alt="검색"></button>
						</form>

						<script>
						function fsearchbox_submit(f)
						{
							if (f.stx.value.length < 2) {
								alert("검색어는 두글자 이상 입력하십시오.");
								f.stx.select();
								f.stx.focus();
								return false;
							}

							// 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
							var cnt = 0;
							for (var i=0; i<f.stx.value.length; i++) {
								if (f.stx.value.charAt(i) == ' ')
									cnt++;
							}

							if (cnt > 1) {
								alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
								f.stx.select();
								f.stx.focus();
								return false;
							}

							return true;
						}
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="gnb" class="hd_div">
		<button type="button" id="gnb_close" class="hd_closer"><img src="/images/hd_menu_close.png" alt="메뉴닫기"></button>
		
		<div class="gnb_logo"><img src="/images/hd_logo.png" alt="<?php echo $config['cf_title']; ?>"></div>
		
		<div class="gnb_login">
			<ul class="clearfix">
				<?php if ($is_member) {  
				if($member['mb_10'] == 1) {
					$mypage = G5_BBS_URL.'/mypage.php?den_id='.$member['mb_3'];
				} else {
					$mypage = G5_BBS_URL.'/mypage.php';
				}
				?>
				<?php if ($is_admin) {  ?>
				<li class="tnb_admin"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>" style="color: red;font-weight: 500;">관리자</a></li>
				<li class="tnb_admin"><a href="<?php echo G5_URL; ?>/wallet/index.html" style="color: red;font-weight: 500;">지갑</a></li>
				<?php }  ?>
				<li class="logout"><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
				<li class="regist"><a href="<?php echo $mypage ?>">마이페이지</a></li>
				<?php } else {  ?>
				<li class="login"><a href="<?php echo G5_BBS_URL ?>/login.php?url=<?php echo $_SERVER['REQUEST_URI'];?>">로그인</a></li>
				<li class="regist"><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
				<?php }  ?>
			</ul>
		</div>

		<ul class="gnb_1">
			<!-- <li><a href="javascript:;">아나파톡</a>
				<ul class="gnb_2">
					<li><a href=""></a></li>
				</ul>
			</li> -->
			<li><a href="<?php echo G5_URL;?>/dental_cate3.php">치과찾기</a></li>
			<li><a href="<?php echo G5_URL;?>/event.php">이벤트</a></li>
			<li><a href="<?php echo G5_URL;?>/reviewlist.php">치과후기</a></li>
			<li><a href="<?php echo get_pretty_url('info');?>">치과정보</a></li>
			<li><a href="<?php echo G5_URL;?>/contact_us.php">오시는 길</a></li>
		</ul>
	</div>
	<div class="gnb_bg"></div>

	<div id="hd_bottom" class="hide768">  
		<div class="inner">  
			<div class="hd_bot_left">
				<ul class="clearfix">
					<!-- <li><a href="">간단한<br/>진료상담</a></li> -->
					<li><a href="<?php echo G5_URL;?>/dental_cate3.php">가까운<br/>치과검색</a></li>
					<li><a href="<?php echo G5_URL;?>/reviewlist.php">다양한<br/>리얼후기</a></li>
				</ul>
			</div>

			<div class="hd_sch_wr">
				<fieldset id="hd_sch">
					<legend>사이트 내 전체검색</legend>
					<form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/board.php" onsubmit="return fsearchbox_submit(this);">
					<input type="hidden" name="bo_table" value="dental">
					<input type="hidden" name="sfl" value="wr_subject">
					<input type="hidden" name="sop" value="and">
					<label for="sch_stx" class="sound_only">검색어 필수</label>
					<input type="text" name="stx" id="sch_stx" maxlength="20" placeholder="치과 검색">
					<button type="submit" id="sch_submit" value="검색"><img src="/images/btn_sch.png" alt="검색"></button>
					</form>

					<script>
					function fsearchbox_submit(f)
					{
						if (f.stx.value.length < 2) {
							alert("검색어는 두글자 이상 입력하십시오.");
							f.stx.select();
							f.stx.focus();
							return false;
						}

						// 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
						var cnt = 0;
						for (var i=0; i<f.stx.value.length; i++) {
							if (f.stx.value.charAt(i) == ' ')
								cnt++;
						}

						if (cnt > 1) {
							alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
							f.stx.select();
							f.stx.focus();
							return false;
						}

						return true;
					}
					</script>
				</fieldset>
					
				<?php //echo popular(); // 인기검색어, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?>
			</div>

			<div class="hd_bot_right">
			<?php 
			$sql_hdbn = ' select * from g5_write_banner where ca_name = "header" ';
			$row_hdbn = sql_fetch($sql_hdbn);

			$thumb_bn = get_list_thumbnail('banner', $row_hdbn['wr_id'], 275, 60, false, false, 'center', false, '80/0.5/3');
			?>
				<?php if($row_hdbn['wr_link1']) { ?><a href=""><?php } ?><img src="<?php echo $thumb_bn['src'];?>" alt="<?php echo $row_hdbn['wr_subject'];?>"><?php if($row_hdbn['wr_link1']) { ?></a><?php } ?>
			</div>
		</div>
    </div>
    <!-- </div> -->
</div>
<!-- } 상단 끝 -->

<script>
//상단고정
$( document ).ready( function() {
    var jbOffset = $( '#hd' ).offset();
    $( window ).scroll( function() {
        if ( $( document ).scrollTop() > jbOffset.top ) {
            $( '#hd' ).addClass( 'fixed' );
        }
        else {
            $( '#hd' ).removeClass( 'fixed' );
        }
    });
});

$(function () {
	$(".hd_opener").on("click", function() {
		var $this = $(this);
		var $hd_layer = $(".hd_div");

		if($hd_layer.is(":visible")) {
			$hd_layer.hide();
			$('.gnb_bg').hide();
			$(".gnb_1 > li").removeClass('on');
			$(".gnb_1 > li").find('.gnb_2').hide();
		} else {
			var $hd_layer2 = $(".hd_div:visible");
			$hd_layer2.hide();

			$hd_layer.show();
			$('.gnb_bg').show();
		}
	});

	$(".hd_closer").on("click", function() {
		var idx = $(".hd_closer").index($(this));
		$(".hd_div:visible").hide();
		$('.gnb_bg').hide();
		$(".gnb_1 > li").removeClass('on');
		$(".gnb_1 > li").find('.gnb_2').hide();
	});

	$(".gnb_bg").on("click", function(){
		$(".hd_div:visible").hide();
		$('.gnb_bg').hide();
		$(".gnb_1 > li").removeClass('on');
		$(".gnb_1 > li").find('.gnb_2').hide();
	});

	$(".gnb_1 > li").on("click", function(){
		if($(this).find('.gnb_2').length) {
			$(".gnb_1 > li").not(this).removeClass('on');
			$(this).toggleClass('on');
			$(".gnb_1 > li").not(this).find('.gnb_2').slideUp();
			$(this).find('.gnb_2').slideToggle();
		}
	})

	$(".sch_opener").on('click', function(){
		$(".m_sch").toggle();
	})
});
</script>
<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper" class="">

<?php if($bo_table || $co_id) { ?>
<div class="bo_content">
	<div class="inner">

	<?php if($bo_table == 'notice') {
	$on = 0;
	include_once(G5_PATH.'/include/sn_center.php');
	}?>

	<?php if($bo_table == 'faq') {
	$on = 1;
	include_once(G5_PATH.'/include/sn_center.php');
	}?>

	<?php if($co_id == 'provision') {
	$on = 2;
	include_once(G5_PATH.'/include/sn_center.php');
	}?>

	<?php if($co_id == 'privacy') {
	$on = 3;
	include_once(G5_PATH.'/include/sn_center.php');
	}?>

<?php } ?>