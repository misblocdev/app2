<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

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

//$write_pages = get_paging2($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."page=");
if ($den_id) {
$write_pages = get_paging($config['cf_write_pages'], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&den_id=".$den_id."page=");
} else {
$write_pages = get_paging($config['cf_write_pages'], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&locate=".$locate."page=");
}

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

.event_title {text-align: center;font-size: 50px;font-weight: bold;color: #000;margin-bottom: 90px;}
.event_title strong {color: #777dee;}

/* 반응형 css */
@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

.event_title {font-size: 3.9063vw;margin-bottom: 7.0313vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

.event_title {font-size: 6.7708vw;margin-bottom: 10.4167vw;}

}
</style>

<?php if($sca) { ?>
<div class="event_title"><strong>“<?php echo $locate;?>”</strong> 지역에서 <br class="show768"/>진행하는 <strong>“<?php echo $sca;?>”</strong> 이벤트</div>
<?php } else if ($den_id) { ?>
<div class="event_title">병원 이벤트 관리</div>
<?php }?>

<!-- 게시판 목록 시작 { -->
<div id="bo_gall">

    <?php if ($is_category) { ?>
    <!-- <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav> -->
    <?php } ?>


     <!-- 게시판 페이지 정보 및 버튼 시작 { -->
   <!-- <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>-->
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk">
        <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
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

			if($den_id) {
				$list_url = "./board.php?bo_table=$bo_table".$qstr."&wr_id=".$list[$i]['wr_id']."&den_id=".$den_id;			
			} else {
				$list_url = "./board.php?bo_table=$bo_table".$qstr."&wr_id=".$list[$i]['wr_id']."&locate=".$locate;
			}
         ?>
        <li class="gall_li <?php if ($wr_id == $list[$i]['wr_id']) { ?>gall_now<?php } ?>" style="">
            <div class="gall_chk">
            	<?php if ($is_checkbox) { ?>
            	<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
            	<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            	<?php } ?>
            	<span class="sound_only">
            	    <?php
            	    if ($wr_id == $list[$i]['wr_id'])
            	        echo "<span class=\"bo_current\">열람중</span>";
            	    else
            	        echo $list[$i]['num'];
            	     ?>
            	</span>
            </div>
            <div class="gall_con">
                <div class="gall_href">
                    <a href="<?php echo $list_url ?>">
                    <?php
                    if ($list[$i]['is_notice']) { // 공지사항  ?>
                        <strong style="width:<?php echo $board['bo_gallery_width'] ?>px;height:<?php echo $board['bo_gallery_height'] ?>px">공지</strong>
                    <?php } else {
                        $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'],false,true);

                        if($thumb['src']) {
                            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
                        } else {
                            $img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
                        }

                        echo $img_content;
                    }
                     ?>
                    </a>
                </div>
				<div class="gall_text_href">
					<?php if($list[$i]['wr_2'] < G5_TIME_YMD){ ?>
					<span style="background:#aaaaaa;">종료</span>
					<?php } else { ?>
					<span style="background:#777dee;">진행중</span>
					<?php } ?>
					<p><a href="<?php echo $list_url ?>"><?php echo $list[$i]['wr_subject'];?></a></p>
				</div>
                <div class="gall_date">이벤트 기간 : <?php echo $list[$i]['wr_1'];?> ~ <?php echo $list[$i]['wr_2'];?></div>
            </div>
        </li>
        <?php } ?>
        <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
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

<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch" style="display: none;">
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
        <!-- <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option> -->
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <!-- <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option> -->
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input" size="15" maxlength="15">
    <span class="jbutton large black" style="margin-left:1px;  vertical-align:bottom;"><input type="submit" class="width_j" id="btn_submit" value="검색"></span>
    </form>
    </div>
</fieldset>
<!-- } 게시판 검색 끝 -->



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
