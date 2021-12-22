<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php'); 

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 3;
if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;
// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<script src="<?php echo $board_skin_url ?>/jquery.corner.js"></script> <!-- jquery 자주하는질문 원 적용 -->

<script type="text/javascript">
// 코너 버튼 적용
$(window).load(function() {
	
		$("span.td_ask").corner(); // Q 아이콘
		$("span.td_answer").corner(); // A 아이콘	

});
</script>


<?php
//========================================================
// 페이지 변경시 필요한 소스 시작~!!!!!!!!!!!!!!

function get_paging2($write_pages, $cur_page, $total_page, $url, $add="")
{
	global $board_skin_url;
    $str = "<ul class='pagenation'>";
    if ($cur_page > 1) {
        $str .= "<li><a href='".$url."' class='btn'><img src='{$board_skin_url}/img/btn_firstly.gif' alt='처음' /></a></li>";
        //$str .= "[<a href='" . $url . ($cur_page-1) . "'>이전</a>]";
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= "<li><a href='" . $url . ($start_page-1) . "{$add}' class='btn'><img src='{$board_skin_url}/img/btn_prev.gif' alt='이전' /></a></li>";

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= "<li><a href='$url$k{$add}'><span>$k</span></a></li>";
            else
                $str .= "<li class='on'><a href='$url$k{$add}'><b>$k</b></a></li>";
        }
    }

    if ($total_page > $end_page) $str .= " <li><a href='" . $url . ($end_page+1) . "{$add}' class='btn'><img src='{$board_skin_url}/img/btn_next.gif' alt='다음으로' /></a></li>";

    if ($cur_page < $total_page) {
        //$str .= "[<a href='$url" . ($cur_page+1) . "'>다음</a>]";
        $str .= "<li><a href='$url$total_page{$add}' class='btn'><img src='{$board_skin_url}/img/btn_lastly.gif' alt='마지막으로' /></a></li>";
    }
    $str .= "</ul>";

    return $str;
}

//$write_pages = get_paging2($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=");

?>

<style>
/* pagenation */
.pagenation             {padding:0; text-align:center; margin: 30px 0;}
.pagenation li           {display:inline; padding:7px 0; border:1px solid #b6b6b6; margin:0 3px;}

.pagenation li a          {color:#424242; padding:0px 10px;}
.pagenation li a img      {vertical-align:middle;}
.pagenation li:hover        {background:#f8f8f8;}

.pagenation li.on          {background:#777777 ; border:1px solid #777777;}
.pagenation li.on a         {color:#ffffff;}
</style>

<style>
.faq{font-size:14px;border-top: 2px solid #777dee;}
.faq .hgroup{position:relative;margin:0 0 10px 0;*zoom:1 }
.faq .hgroup .trigger{overflow:visible;position:absolute;top:50%;right:0;margin:-7px 0 0 0;padding:0;border:0;background:none;font-size:12px;cursor:pointer}
.faq ul{margin:0;padding:0;list-style:none}
.faq .q{position:relative;display:table;width:100%;min-height:78px;background-image:url(<?php echo $board_skin_url ?>/img/q_img01.png);background-position:20px 50%;background-repeat:no-repeat;margin:0;padding:0;
	 }
.faq a {
	margin: 0; padding: 0;
}
.faq {
	line-height: 1em;
}
.faq .first{margin:0;border-top:1px solid #ccc;  }
.faq .q a.trigger{display:table-cell;vertical-align:middle;padding:0 4% 0 65px; line-height:1.7em;color:#5e5e5e;  text-align:left; font-size:14px; word-break:keep-all;letter-spacing:-0.5px;
background-image:url(<?php echo $board_skin_url ?>/img/q_on.jpg);background-position:99% center;background-repeat:no-repeat;border-bottom:1px solid #c1c1c1;
}
.faq .hide .q a.trigger{color:#5e5e5e;    
background-image:url(<?php echo $board_skin_url ?>/img/q_off.jpg);background-position:99% center;background-repeat:no-repeat;
}
.faq .q a.trigger:link{color:#5e5e5e; font-weight:bold;}
.faq .q a.trigger:hover,
.faq .q a.trigger:active,
.faq .q a.trigger:focus{color:#5e5e5e ; }


.faq .a{margin:0;padding:20px 4% 20px 65px ;line-height:1.5em;
}
#jeon_com1 {background:url(<?php echo $board_skin_url ?>/img/q_a_bg01.png) 0 0 no-repeat;background-position:20px 16px;  background-color:#f8f8f8; /* background-position:top; */ display:block; border-top:0px solid #c1c1c1; border-bottom:1px solid #c1c1c1; display: none;}
#jeon_com1 .new_con {line-height:1.8em;word-break:keep-all;color:#5e5e5e;font-size:14px; }

.my_btn01 {display:inline-block;width:34px;line-height:24px;border:1px solid #aaa;background:#fff;text-align:center;font-size:12px;}

</style>
<style>


@media (max-width: 1199px) {


.faq .q a.trigger {padding:0 6% 0 55px;}
.faq .q {background-position:10px 10px}
#jeon_com1 {background-position:10px 10px}
.faq .a {padding:20px 4% 20px 55px ;}
}
@media (max-width: 1024px) {
 }
@media (max-width: 767px) {


.faq .q a.trigger {padding:15px 9% 15px 55px;}
.faq .a {padding:20px 4% 20px 55px ;}
 }
@media (max-width: 460px) {
.faq .q a.trigger {padding:15px 11.5% 15px 55px;}

}
</style>
<!-- <h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>-->

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">




	<!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
	<div class="new_cate03">
        <ul class="">
            <?php echo $category_option ?>
        </ul>
	</div>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->

    <!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch" style="display:none">
    <legend>게시물 검색</legend>

    <div>
    <form name="fsearch" style="text-align:left;"method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input" size="15" maxlength="15">
    <span class="jbutton large black" style="margin-left:1px;  vertical-align:bottom;"><input type="submit" class="width_j2" id="btn_submit" value="검색"></span>
    </form>
    </div>
</fieldset>
<!-- } 게시판 검색 끝 -->


    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

<div class="tbl_head01 tbl_wrap">
	
  

<div class="faq">
	<!--
	<div class="hgroup">
		<h2>FAQ</h2>
		<button type="button" class="trigger"><span>답변 모두 여닫기</span></button>
	</div>
	-->
	<ul>
    <!-- 제목 -->
    <form name="fboardlist" method="post">
    <input type='hidden' name='bo_table' value='<?=$bo_table?>'>
    <input type='hidden' name='sfl'  value='<?=$sfl?>'>
    <input type='hidden' name='stx'  value='<?=$stx?>'>
    <input type='hidden' name='spt'  value='<?=$spt?>'>
    <input type='hidden' name='page' value='<?=$page?>'>
    <input type='hidden' name='sw'   value=''>
    <? 
    for ($i=0; $i<count($list); $i++) { 
        $bg = $i%2 ? 0 : 1;
    ?>
	<li class="article hide">
		<p class="q <? if ($i == 0 ) echo "first";?>">
			<a href="#a<?=$list[$i][num]?>" class="trigger">
				<?php if ($is_category && $list[$i]['ca_name']) {	?>[<?echo $list[$i]['ca_name'] ;?>]<?}?><?=$list[$i]['subject']?>
			</a>
		</p>
        
       
        
		<div class="a" id="jeon_com1" style="overflow:hidden; ">
      	    <?
				// 파일 정보 불러오기
				$file = get_file($bo_table, $list[$i]['wr_id']);
				?>
                  <?

				
				// 파일
				for($j=0; $j<$file["count"]; $j++){
					if(!$file[$j]['image_type']){
						echo $table_head;

					}	
					if($j == $file["count"]-1)
						echo "";
				}
				
				//이미지
    			for($j=0; $j<$file["count"]; $j++){
					if($file[$j]['image_type']){
						echo $file[$j]['view']."<br>";
					}	
				}
				
				// 내용
				
				?>
			<div class="new_con">
				<?=cut_str(conv_content($list[$i]['wr_content'], 2),100000);?>
			</div>
        <? if (($member['mb_id'] && ($member['mb_id'] == $write['mb_id'])) || $is_admin) { ?>

			<br>

			<?php
			set_session("ss_delete_token", $token = uniqid(time())); 
			?>
			<a class="my_btn01" href="<?php echo G5_URL ?>/bbs/write.php?bo_table=<?=$bo_table?>&w=u&wr_id=<?=$list[$i]['wr_id']?>">수정</a>
			<a class="my_btn01" href="javascript:del('./delete.php?bo_table=<?=$bo_table?>&wr_id=<?=$list[$i]['wr_id']?>&page=&token=<?=$token?>');">
			삭제</a>
		 <? } ?>
		
		</div>
	</li>
    <? } // end for ?>

    <? if (count($list) == 0) { echo "
	<li class=\"article hide\">
		<div class=\"q\"><a href=\"#a1\" class=\"trigger\">게시물이 없습니다.</a></div>
		<div class=\"a\" style=\"overflow:hidden; height:40px; padding-top:10px; margin-top:0px; padding-bottom:10px; margin-bottom:0px;\">등록된 게시물이 없습니다.</div>
	</li>"; } ?>
    </form>
	</ul>
</div>  
    
    
</div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <!-- <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>-->
        </ul>
        <?php } ?>
        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($admin_href) { ?><li><span class="jbutton large black"><a href="<?php echo $admin_href ?>">관리자</a></span></li><?php } ?>
            <?php if ($list_href) { ?><li><span class="jbutton large black"><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></span></li><?php } ?>
            <?php if ($write_href) { ?><li><span class="jbutton large black"><a href="<?php echo $write_href ?>" class="width_j">글쓰기</a></span></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>



<script type="text/javascript">
jQuery(function(){
	
	var article = $('.faq .article');
	article.addClass('hide');
	article.find('.a').slideUp(100);
	
	$('.faq .article .trigger').click(function(){
		var myArticle = $(this).parents('.article:first');
		if(myArticle.hasClass('hide')){
			article.addClass('hide').removeClass('show'); // 아코디언 효과를 원치 않으면 이 라인을 지우세요
			article.find('.a').slideUp(100); // 아코디언 효과를 원치 않으면 이 라인을 지우세요
			myArticle.removeClass('hide').addClass('show');
			myArticle.find('.a').slideDown(200);
		} else {
			myArticle.removeClass('show').addClass('hide');
			myArticle.find('.a').slideUp(200);
		}
	});
	
	$('.faq .hgroup .trigger').click(function(){
		var hidden = $('.faq .article.hide').length;
		if(hidden > 0){
			article.removeClass('hide').addClass('show');
			article.find('.a').slideDown(200);
		} else {
			article.removeClass('show').addClass('hide');
			article.find('.a').slideUp(200);
		}
	});
	
});
</script>
<script type="text/javascript">
if ('<?=$sca?>') document.fcategory.sca.value = '<?=$sca?>';
if ('<?=$stx?>') {
    document.fsearch.sfl.value = '<?=$sfl?>';

    if ('<?=$sop?>' == 'and') 
        document.fsearch.sop[0].checked = true;

    if ('<?=$sop?>' == 'or')
        document.fsearch.sop[1].checked = true;
} else {
    document.fsearch.sop[0].checked = true;
}
</script>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
	
	// 이미지 리사이즈
    $(".contentBox").viewimageresize();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->

<!-- 펼쳐지는 스크립트-->
<script>
var old_i; // 전에 클릭했던 글의 번호값 저장 
function view(i) { // 답변 표시여부 조정하는 js함수
	if (old_i==i) {
		var mode=document.getElementById('view_'+i).style.display;
		if (mode=='inline') document.getElementById('view_'+i).style.display='none';
		else document.getElementById('view_'+i).style.display='inline';
	}
	else {
		if (old_i) document.getElementById('view_'+old_i).style.display='none';
		document.getElementById('view_'+i).style.display='inline';
	}
	old_i=i;
}
</script> 
