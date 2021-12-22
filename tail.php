<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/tail.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/tail.php');
    return;
}
?>

<?php if($bo_table || $co_id) { ?>
	</div>
</div>
<?php } ?>

</div>
<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->
<div id="ft">
	<div id="ft_link">
		<div class="inner">
			<a href="<?php echo get_pretty_url('content', 'provision'); ?>">이용약관</a>
			<a href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보처리방침</a>
		</div>
	</div>

    <div id="ft_wr" class="inner">
		<div id="ft_notice">
        	<h2>공지사항</h2>
			<div class="ft_notice_list">
				<ul>
				<?php 
				$sql_nt = ' select * from g5_write_notice order by wr_id desc limit 0, 3 ';
				$result_nt = sql_query($sql_nt);

				for($i = 0 ; $notice = sql_fetch_array($result_nt) ; $i++) { ?>
					<li><a href="<?php echo get_pretty_url('notice', $notice['wr_id'])?>"><?php echo $notice['wr_subject'];?></a></li>
				<?php } ?>
				</ul>
			</div>
		</div>
        <div id="ft_company">
        	<h2>고객센터</h2>
			<div class="ft_tel">
				<ul class="clearfix">
					<!-- <li><span>Tel. </span><strong>02-1677-5477</strong></li> -->
					<li><span>E-mail. </span><strong>contact@misbloc.io</strong></li>
					<li><a href="http://pf.kakao.com/_QBBFs" target="blank"><img src="/images/addkakao.png" alt="카카오톡 채널추가"></a></li>
				</ul>
			</div>
	        <p class="ft_info">
	        	아나파톡(미스블록)    <span>|</span>   대표 : 김도희   <span>|</span>   사업자등록번호 : 706-86-01552 <br/>
				<!-- TEL : 02-1677-5477   <span>|</span>  -->  FAX : 02-553-9778   <span>|</span>   E-mail : contact@misbloc.io <br/>
				주소 : 서울특별시 강남구 테헤란로 25길 7, 7층(역삼동 창성재단빌딩)
			</p>
			<div id="ft_copy">COPYRIGHT &copy; <b>2021 아나파톡.</b> ALL RIGHTS RESERVED.</div>
	    </div>
    </div>
    <!-- <div id="ft_catch"><img src="<?php echo G5_IMG_URL; ?>/ft_logo.png" alt="<?php echo G5_VERSION ?>"></div> -->

    <!-- <button type="button" id="top_btn">
    	<i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span>
    </button>
    <script>
    $(function() {
        $("#top_btn").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });
    });
    </script> -->
</div>

<?php if (defined("_INDEX_")) { ?>
<!-- </div>
</div> -->

<script>
$( document ).ready( function() {
	var swc = 0;
    var jbOffset = $( '#hd' ).offset();

	if ( $( document ).scrollTop() == 0 ) {
		swc = 0;
	} else {
		swc = 1;	
	}

	setTimeout(slideToHead, 3000);

	function slideToHead() {
		if(swc == 0) {
		$("html, body").animate({scrollTop:jbOffset.top}, 800);
		swc = 1;
		} else {
		
		}
	}

	$( window ).scroll( function() {
		if ( $( document ).scrollTop() == 0 ) {
			setTimeout(slideToHead, 3000);
			swc = 0;
		}
		else {
			clearTimeout(slideToHead);
			swc = 1;
		}
	});

	console.log(swc);
});
</script>
<?php } ?>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");