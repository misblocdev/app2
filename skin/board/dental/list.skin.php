<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<?
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

//$write_pages = get_paging2($config['cf_write_pages'], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=");

?>

<style>
/* pagenation */
.pagenation             {padding:0; font-size:12px; text-align:center; }
.pagenation li           {display:inline; padding:7px 0; border:1px solid #b6b6b6; margin:0 3px;}

.pagenation li a          {color:#424242; padding:0px 10px;}
.pagenation li a img      {vertical-align:middle;}
.pagenation li:hover        {background:#f8f8f8;}

.pagenation li.on          {background:#777777 ; border:1px solid #777777;}
.pagenation li.on a         {color:#ffffff;}

#bo_gall .g_date {display: none;}
#bo_gall .gall_text_href {text-align: center;}
#bo_gall .gall_text_href a { color: #878585; font-size: 14px; font-weight: 200;}

#bo_cate {padding: 0;background: none;margin-bottom: 60px;}
#bo_cate li {width: 10%;display: block;float: left;margin: 0;padding: 0 5px;}
#bo_cate li:nth-child(11) {display: none;}
#bo_cate li:nth-child(12) {display: none;}
#bo_cate li a {display: block;font-size: 16px;color: #717171;-ms-word-break: keep-all;word-break: keep-all;padding-top: 125px;background-repeat: no-repeat;background-position: 50% 0;background-size: 110px;text-align: center;transition: all 0.3s ease;}
#bo_cate li:nth-child(1) a {background-image: url(/images/cate_icon_1_off.png);}
#bo_cate li:nth-child(2) a {background-image: url(/images/cate_icon_2_off.png);}
#bo_cate li:nth-child(3) a {background-image: url(/images/cate_icon_3_off.png);}
#bo_cate li:nth-child(4) a {background-image: url(/images/cate_icon_4_off.png);}
#bo_cate li:nth-child(5) a {background-image: url(/images/cate_icon_5_off.png);}
#bo_cate li:nth-child(6) a {background-image: url(/images/cate_icon_6_off.png);}
#bo_cate li:nth-child(7) a {background-image: url(/images/cate_icon_7_off.png);}
#bo_cate li:nth-child(8) a {background-image: url(/images/cate_icon_8_off.png);}
#bo_cate li:nth-child(9) a {background-image: url(/images/cate_icon_9_off.png);}
#bo_cate li:nth-child(10) a {background-image: url(/images/cate_icon_10_off.png);}
#bo_cate li:nth-child(11) a {background-image: url(/images/cate_icon_11_off.png);}
#bo_cate li:nth-child(12) a {background-image: url(/images/cate_icon_12_off.png);}
#bo_cate li:hover a {color: #9599e8;}
#bo_cate li:nth-child(1):hover a {background-image: url(/images/cate_icon_1_on.png);}
#bo_cate li:nth-child(2):hover a {background-image: url(/images/cate_icon_2_on.png);}
#bo_cate li:nth-child(3):hover a {background-image: url(/images/cate_icon_3_on.png);}
#bo_cate li:nth-child(4):hover a {background-image: url(/images/cate_icon_4_on.png);}
#bo_cate li:nth-child(5):hover a {background-image: url(/images/cate_icon_5_on.png);}
#bo_cate li:nth-child(6):hover a {background-image: url(/images/cate_icon_6_on.png);}
#bo_cate li:nth-child(7):hover a {background-image: url(/images/cate_icon_7_on.png);}
#bo_cate li:nth-child(8):hover a {background-image: url(/images/cate_icon_8_on.png);}
#bo_cate li:nth-child(9):hover a {background-image: url(/images/cate_icon_9_on.png);}
#bo_cate li:nth-child(10):hover a {background-image: url(/images/cate_icon_10_on.png);}
#bo_cate li:nth-child(11):hover a {background-image: url(/images/cate_icon_11_on.png);}
#bo_cate li:nth-child(12):hover a {background-image: url(/images/cate_icon_12_on.png);}
#bo_cate li a#bo_cate_on {color: #9599e8;}
#bo_cate li:nth-child(1) a#bo_cate_on {background-image: url(/images/cate_icon_1_on.png);}
#bo_cate li:nth-child(2) a#bo_cate_on {background-image: url(/images/cate_icon_2_on.png);}
#bo_cate li:nth-child(3) a#bo_cate_on {background-image: url(/images/cate_icon_3_on.png);}
#bo_cate li:nth-child(4) a#bo_cate_on {background-image: url(/images/cate_icon_4_on.png);}
#bo_cate li:nth-child(5) a#bo_cate_on {background-image: url(/images/cate_icon_5_on.png);}
#bo_cate li:nth-child(6) a#bo_cate_on {background-image: url(/images/cate_icon_6_on.png);}
#bo_cate li:nth-child(7) a#bo_cate_on {background-image: url(/images/cate_icon_7_on.png);}
#bo_cate li:nth-child(8) a#bo_cate_on {background-image: url(/images/cate_icon_8_on.png);}
#bo_cate li:nth-child(9) a#bo_cate_on {background-image: url(/images/cate_icon_9_on.png);}
#bo_cate li:nth-child(10) a#bo_cate_on {background-image: url(/images/cate_icon_10_on.png);}
#bo_cate li:nth-child(11) a#bo_cate_on {background-image: url(/images/cate_icon_11_on.png);}
#bo_cate li:nth-child(12) a#bo_cate_on {background-image: url(/images/cate_icon_12_on.png);}

/* 반응형 css */
@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

#bo_gall .gall_text_href a {font-size: 1.0938vw;}

#bo_cate {margin-bottom: 4.6875vw;}
#bo_cate li {padding: 0 0.3906vw;}
#bo_cate li a {font-size: 1.2500vw;padding-top: 9.7656vw;background-size: 8.5938vw;background-size: 8.5938vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

#bo_cate {padding: 0;background: none;margin-bottom: 7.8125vw;}
#bo_cate li {width: 20%;padding: 0 0.6510vw;margin-bottom: 2.6042vw;}
#bo_cate li:nth-child(5n+1) {clear: both;}
#bo_cate li:nth-child(n+10) {margin-bottom: 0;}
#bo_cate li a {font-size: 3.1250vw;padding-top: 17.5781vw;background-size: 16.9271vw;}

}

</style>
<!-- <h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>-->

<div class="sub_title">치과찾기</div>
<?php if($ct == 2 || $ct == 4) { ?>
<div class="sub_nav sub_nav_4">
	<ul class="clearfix">
		<li><a href="<?php echo G5_URL;?>/dental_cate3.php">지도<span class="hide768">로 </span>찾기</a></li>
		<li><a href="<?php echo G5_URL;?>/dental_cate1.php">분야<span class="hide768">로 </span>찾기</a></li>
		<li <?php if($ct == 2){?>class="on"<?php }?>><a href="<?php echo G5_URL;?>/dental_cate2.php">지역<span class="hide768">으로 </span>찾기</a></li>
		<li <?php if($ct == 4){?>class="on"<?php }?>><a href="<?php echo G5_URL;?>/dental_cate4.php">증상<span class="hide768">으로 </span>찾기</a></li>
	</ul>
</div>
<?php } ?>

<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">

    <?php if ($is_category && $ct == 1) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul" class="clearfix">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>


    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx" style="display: none;">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk">        
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
		<label for="chkall" class="">현재 페이지 게시물 전체</label>
    </div>
    <?php } ?>
 
    <ul id="gall_ul">
        <?php for ($i=0; $i<count($list); $i++) {
            if($i>0 && ($i % $bo_gallery_cols == 0))
                $style = 'clear:both;';
            else
                $style = '';
            if ($i == 0) $k = 0;
            $k += 1;
            if ($k % $bo_gallery_cols == 0) $style .= "margin:0 !important;";
			
			if ($sca) {
				$is_sca = '&sca='.$sca;
			} else {
				$is_sca = '';
			}

			if ($ct == 2) {
				$href = get_pretty_url($bo_table, $list[$i]['wr_id']).$is_sca.'&den_id='.$list[$i]['wr_code'].'&sop='.$sop.'&sfl='.$sfl.'&stx='.$stx.'&ct='.$ct;
			} else if ($ct == 4) {
				$href = get_pretty_url($bo_table, $list[$i]['wr_id']).$is_sca.'&den_id='.$list[$i]['wr_code'].'&sop='.$sop.'&sfl='.$sfl.'&stx='.$stx.'&ct='.$ct;
			} else {
				$href = get_pretty_url($bo_table, $list[$i]['wr_id']).$is_sca.'&den_id='.$list[$i]['wr_code'].'&ct='.$ct;
			}
         ?>
        <li class="gall_li clearfix <?php if ($wr_id == $list[$i]['wr_id']) { ?>gall_now<?php } ?>">
            <?php if ($is_checkbox) { ?>
			<div class="chk_box">
				<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
				<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
			</div>
            <?php } ?>
            <span class="sound_only">
                <?php
                if ($wr_id == $list[$i]['wr_id'])
                    echo "<span class=\"bo_current\">열람중</span>";
                else
                    echo $list[$i]['num'];
                 ?>
            </span>
			<div class="gall_info">
				<div class="dental_name"><a href="<?php echo $href; ?>"><?php echo $list[$i]['subject'] ?></a></div>
				<div class="dental_info">
					<dl class="clearfix">
						<dt>평 일</dt>
						<dd><?php echo $list[$i]['wr_3'];?></dd>

						<?php if( $list[$i]['wr_6'] ) { ?>
						<dt>점 심</dt>
						<dd><?php echo $list[$i]['wr_6'];?></dd>						
						<?php } ?>

						<?php if( $list[$i]['wr_4'] ) { 
						$day_array = explode('|', $list[$i]['wr_4']);
						if(count($day_array) > 1) {
							$nigthTime = implode(' / ', $day_array);
						} else {
							$nigthTime = $day_array[0].'요일';
						}
						?>
						<dt><?php echo $nigthTime;?></dt>
						<dd><?php echo $list[$i]['wr_5'];?></dd>
						<?php } ?>

						<?php if( $list[$i]['wr_7'] ) { ?>
						<dt>토 요 일</dt>
						<dd><?php echo $list[$i]['wr_7'];?></dd>						
						<?php } ?>

						<dt class="addr">주 소</dt>
						<?php 
						$addr = $list[$i]['wr_2'].' '.$list[$i]['wr_2_1'];
						?>
						<dd><?php echo $addr;?></dd>
					</dl>
				</div>
				<!-- <div class="dental_cate">
					<ul class="clearfix">
					<?php 
					$cate = explode('|', $list[$i]['ca_name']);
					for($j = 0 ; $j < count($cate) ; $j++) {
					?>	
						<li><a href="<?php echo get_pretty_url($bo_table,'','sca='.urlencode($cate[$j]))?>"><?php echo $cate[$j];?></a></li>
					<?php }
					?>
					</ul>
				</div> -->
				<?php if($list[$i]['wr_10'] == 1) { ?>
				<div class="dental_franchisee"><img src="/images/icon_franc.png" alt="가맹업"></div>
				<?php } ?>
			</div>
			<div class="gall_img">
				<a href="<?php echo $href ?>" class="simple_text_g">
				<?php				
				$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);

				if($thumb['src']) {
					$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" style="border:0px solid #dcdcdc;" height="'.$board['bo_gallery_height'].'">';
				} else {
					$img_content = '<div><p style="padding:10px;">No Image</p></div>';
				}

				echo $img_content;
				?>
				</a>
			</div>
        </li>
        <?php } ?>
        <?php if (count($list) == 0) { echo "<li class=\"empty_list\">등록된 치과가 없습니다.</li>"; } ?>
    </ul>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><span class="jbutton large black"><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></span></li>
            <li><span class="jbutton large black"><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></span></li>
            <li><span class="jbutton large black"><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></span></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($admin_href) { ?><li><span class="jbutton large black"><a href="<?php echo $admin_href ?>">관리자</a></span></li><?php } ?>
            <!-- <?php if ($list_href) { ?><li><span class="jbutton large black"><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></span></li><?php } ?> -->
            <?php if ($write_href && $is_admin) { ?><li><span class="jbutton large black"><a href="<?php echo $write_href ?>" class="width_j">글쓰기</a></span></li><?php } ?>
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


<?php if ($ct == 1) { ?>
<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <div>
    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <!-- <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option> -->
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <!-- <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option> -->
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input" size="15" maxlength="15">
    <span class="jbutton large black" style="margin-left:1px;  vertical-align:bottom;"><input type="submit" class="width_j2" id="btn_submit" value="검색"></span>
    </form>
    </div>
</fieldset>
<!-- } 게시판 검색 끝 -->
<?php } ?>


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

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->