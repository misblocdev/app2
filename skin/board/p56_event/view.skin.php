<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<style>
input, textarea {
   -webkit-appearance: none;
   -webkit-border-radius: 0;
}
.event_title {text-align: center;font-size: 50px;font-weight: bold;color: #000;margin-bottom: 90px;}
.event_title strong {color: #777dee;}

.write_head { width:200px;text-align:center; color:#000000; font-size:16px; font-weight:bold; background-color: #f9f9f9; border-right:1px solid #d7d7d7; border-bottom:1px solid #d7d7d7; }
.write_body { background-color: #ffffff;  border-right:1px solid #d7d7d7; border-bottom:1px solid #d7d7d7; padding:11px 5px 11px 20px; font-size:16px}
.write_body2 { background-color: #ffffff; width:200px; padding:11px 0 11px 20px; border-right:1px solid #d7d7d7; border-bottom:1px solid #d7d7d7; font-size:16px}
.write_contents { background-color: #ffffff; border-bottom:1px solid #d7d7d7; padding:10px; font-size:16px}
.field { border:1px solid #ccc;  }
#p_n_datetime{text-align:right; display:block;float:right; padding-right:10px;}
#writeContents{font-family:"나눔고딕", "Nanum Gothic", "맑은 고딕", "Malgun Gothic";}

#bo_v_con { font-size: 15px; }

/* 반응형 css */
@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

.event_title {font-size: 3.9063vw;margin-bottom: 7.0313vw;}

#bo_v_con {font-size: 1.1719vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

.event_title {font-size: 6.7708vw;margin-bottom: 10.4167vw;}

.write_contents { padding:1.3021vw; font-size:3.1250vw}

#bo_v_con { font-size: 3.1250vw; }

}
</style>

<!-- 게시물 읽기 시작 { -->
<!-- <div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>-->

<div class="event_title"><?php echo cut_str(get_text($view['wr_subject']), 70);?></div>

<article id="bo_v" style="width:<?php echo $width; ?>">
    <header>
        <!-- <h1 id="bo_v_title">
            <?php
            //if ($category_name) echo $view['ca_name'].' | '; // 분류 출력 끝
            //echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
            ?>
        </h1> -->
    </header>

    <section id="bo_v_info" style="display: none;">
    	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td height="2" bgcolor="#777777" colspan="4"></td></tr>
    <tr>
		<td class="write_head" style="border-left:1px solid #dbdbdb;">제목</td>
		<td class="write_body"><?php
            //if ($category_name) echo $view['ca_name'].' | '; // 분류 출력 끝
            echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
            ?></td>
		<td class="write_head">글쓴이</td>
		<td class="write_body2"><?php echo $view['wr_name'] ?></td>
	</tr>
    
     <tr>
		<td class="write_head" style="border-left:1px solid #dbdbdb;">이벤트기간</td>
		<td class="write_body"><?php echo $view['wr_1'] ?> ~ <?php echo $view['wr_2'] ?></td>
		<td class="write_head">작성일</td>
		<td class="write_body2"><?php echo date("y-m-d", strtotime($view['wr_datetime'])) ?></td>
	</tr>
	
</table>
      
    </section>

    <?php
    if ($view['file']['count']) {
        $cnt = 0;
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
     ?>

    <?php if($cnt) { ?>
    <!-- 첨부파일 시작 { -->
    <section id="bo_v_file">
        <h2>첨부파일</h2>
        <ul>
        <?php
        // 가변 파일
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                    <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                    <?php echo $view['file'][$i]['bf_content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                </a>
                <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>
                <span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 첨부파일 끝 -->
    <?php } ?>

    <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top" style="display:none;">
        <?php
        ob_start();
         ?>
        <?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
           
        </ul>
        <?php } ?>

        <ul class="bo_v_com">
			<?php 
			if($den_id) {
				$list_href = "./board.php?bo_table=$bo_table".$qstr."&den_id=".$den_id;			
			} else if($locate){
				$list_href = "./board.php?bo_table=$bo_table".$qstr."&locate=".$locate;
			} else {
				$row = sql_fetch(" select * from g5_write_dental where wr_code = '{$view['wr_4']}' ");
				$list_href = "./board.php?bo_table=dental&wr_id=".$row['wr_id']."&den_id=".$view['wr_4'];			
			}
			?>
            <?php if ($update_href) { ?><li><span class="jbutton large black"><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></span></li><?php } ?>
            <?php if ($delete_href) { ?><li><span class="jbutton large black"><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></span></li><?php } ?>
          <!--   <?php if ($copy_href) { ?><li><span class="jbutton large black"><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></span></li><?php } ?>
            <?php if ($move_href) { ?><li><span class="jbutton large black"><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></span></li><?php } ?> -->
            <!-- <?php if ($search_href) { ?><li><span class="jbutton large black"><a href="<?php echo $search_href ?>" class="btn_b01">검색</a></span></li><?php } ?> -->
              <li><span class="jbutton large black"><a href="<?php echo $list_href ?>" class="btn_b01"><i class="fa fa-list" aria-hidden="true"></i> 목록</a></span></li>
	<!-- 		  <li><span class="jbutton large black"><a href="/index.php" class="btn_b01">돌아가기</a></span></li>
			              <?php if ($reply_href) { ?><li><span class="jbutton large black"><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></span></li><?php } ?> -->
            <?php if ($write_href) { ?><li><span class="jbutton large black"><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></span></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

    <section id="bo_v_atc" class="clearfix">
        <h2 id="bo_v_atc_title">본문</h2>
		
        <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                if ($view['file'][$i]['view']) {
                    //echo $view['file'][$i]['view'];
                    echo get_view_thumbnail($view['file'][$i]['view']);
                }
            }

            echo "</div>\n";
        }
         ?>

<style>
#bo_v_con {width:1000px; margin:0 auto; text-align: center; border-top:2px solid #777dee;}
.tt{text-align: left; padding-left: 30px; background:#f2f3fb; float:left; width:200px; border-bottom:1px solid #d1d1d1; height:60px; padding-top: 15px; font-size: 18px; color:#474747; letter-spacing: -0.04em; font-weight:500;}
.inquiry_box{height:60px; border-bottom:1px solid #d1d1d1;}
.inquiry_box input{padding-left:10px; margin-left: 20px; float:left; height:40px; margin-top: 10px; width:760px;font-size: 16px;}
.inquiry_box:after{clear:both; display:block; content:'';}
.main_submit{margin-top: 50px; background:#777dee; color:white; font-size:20px; font-weight:bold; border: none; border-radius:50px; width:240px; height:70px;}

@media only screen and (max-width: 1280px) { /* viewport width : 1280 */
#bo_v_con {width:78.1250vw; margin:0 auto;}
.tt{ padding-left: 2.3438vw; background:#f2f3fb;  width:15.6250vw; border-bottom:0.0781vw solid #d1d1d1; height:4.6875vw; padding-top: 1.1719vw; font-size: 1.4063vw;  letter-spacing: -0.04em; }
.inquiry_box{height:4.6875vw; border-bottom:0.0781vw solid #d1d1d1;}
.inquiry_box input{padding-left:0.7813vw; margin-left: 1.5625vw;  height:3.1250vw; margin-top: 0.7813vw; width:59.3750vw;font-size: 1.2500vw;}
.inquiry_box:after{clear:both;  }
.main_submit{margin-top: 3.9063vw; background:#777dee;  font-size:1.5625vw;  border: none; border-radius:3.9063vw; width:18.7500vw; height:5.4688vw;}
}

@media only screen and (max-width: 768px) { /* viewport width : 768 */
#bo_v_con {width:100%; margin:0 auto;  border-top:0.2604vw solid #777dee;}
.tt{ padding-left: 2.6042vw; background:#f2f3fb;  width:25%; border-bottom:0.1302vw solid #d1d1d1; height:13.0208vw; padding-top: 3.6458vw; font-size: 3.3854vw;  letter-spacing: -0.04em; }
.inquiry_box{height:13.0208vw; border-bottom:0.1302vw solid #d1d1d1;}
.inquiry_box input{margin-left: 2.6042vw;  height:9.1146vw; margin-top: 1.9531vw; width:68%;font-size: 2.8646vw;}
.inquiry_box:after{clear:both;  }
.main_submit{margin-top: 6.5104vw; background:#777dee;  font-size:3.9063vw;  border: none; border-radius:6.5104vw; width:100%; height:11.7188vw;}
}
</style>
		<?php //if($view['wr_2'] >= G5_TIME_YMD) {?>
        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con">	
			<form id="fwrite_quick" style="" action="/bbs/write_update.php" method="post" class="clearfix" onsubmit="return qk_submit(this);">
				<input type="hidden" value="request" name="bo_table">
				<input type="hidden" value="<?php echo $view['wr_subject'];?> 이벤트신청" name="wr_subject">
				<input type="hidden" value="<?php echo $view['wr_4'] ?>" name="wr_10">
				<input type="hidden" value="<?php echo $view['wr_id'] ?>" name="wr_2">
				<input type="hidden" value="내용" name="wr_content">
				<div class="inquiry_box inquiry_box01">
					<p class="tt">이름</p>
					<label for="wr_name_quick" class="sound_only">이름</label>
					<input type="text" name="wr_name" value="<?php echo $member['mb_name'] ? $member['mb_name'] : '';?>" id="wr_name_quick" required placeholder="이름" size="10" maxlength="20" class="frm_input">
				</div>
				<div class="inquiry_box inquiry_box02">
					<p class="tt">연락처</p>	
					<label for="wr_1_quick" class="sound_only">연락처</label>
					<input type="text" name="wr_1" value="<?php echo $member['mb_hp'] ? $member['mb_hp'] : '';?>" id="wr_1_quick" required placeholder="연락처" size="15" maxlength="20" class="frm_input">
				</div> 
				<div class="send_box">
					<input type="submit" value="예약하기" class="main_submit">
				</div>
			</form>
		</div>
		<?php //}?>
        <?php //echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
        <!-- } 본문 내용 끝 -->

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>

        <!-- 스크랩 추천 비추천 시작 { -->
        <?php if ($scrap_href || $good_href || $nogood_href) { ?>
        <div id="bo_v_act" style="">
           <!--  <?php if ($scrap_href) { ?><a href="<?php echo $scrap_href;  ?>" target="_blank" class="btn_b01" onclick="win_scrap(this.href); return false;">스크랩</a><?php } ?>-->
            <?php if ($good_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" class="btn_b01">추천 <strong><?php echo number_format($view['wr_good']) ?></strong></a>
                <b id="bo_v_act_good"></b>
            </span>
            <?php } ?>
            <?php if ($nogood_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="btn_b01">비추천  <strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
                <b id="bo_v_act_nogood"></b>
            </span>
            <?php } ?>
        </div>
        <?php } else {
            if($board['bo_use_good'] || $board['bo_use_nogood']) {
        ?>
        <div id="bo_v_act">
            <?php if($board['bo_use_good']) { ?><span>추천 <strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
            <?php if($board['bo_use_nogood']) { ?><span>비추천 <strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
        </div>
        <?php
            }
        }
        ?>
        <!-- } 스크랩 추천 비추천 끝 -->
    </section>

    <?php
    //include_once(G5_SNS_PATH."/view.sns.skin.php");
    ?>

    <?php
    // 코멘트 입출력
    //include_once('./view_comment.php');
     ?>
     
     <div id="bottom_p_n" style="display: none;">

<?
 // 윗글을 얻음
$sql = " select wr_id, wr_subject, wr_datetime from $write_table where wr_is_comment = 0 and wr_num = '$write[wr_num]' and wr_reply < '$write[wr_reply]' $sql_search order by wr_num desc, wr_reply desc limit 1 ";
$prev = sql_fetch($sql);
// 위의 쿼리문으로 값을 얻지 못했다면
if (!$prev['wr_id'])     {
	$sql = " select wr_id, wr_subject, wr_datetime from $write_table where wr_is_comment = 0 and wr_num < '$write[wr_num]' $sql_search order by wr_num desc, wr_reply desc limit 1 ";
	$prev = sql_fetch($sql);
}

// 아래글을 얻음
$sql = " select wr_id, wr_subject, wr_datetime from $write_table where wr_is_comment = 0 and wr_num = '$write[wr_num]' and wr_reply > '$write[wr_reply]' $sql_search order by wr_num, wr_reply limit 1 ";
$next = sql_fetch($sql);
// 위의 쿼리문으로 값을 얻지 못했다면
if (!$next['wr_id']) {
	$sql = " select wr_id, wr_subject, wr_datetime from $write_table where wr_is_comment = 0 and wr_num > '$write[wr_num]' $sql_search order by wr_num, wr_reply limit 1 ";
	$next = sql_fetch($sql);
}
?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td height="1" bgcolor="#d2d2d2" colspan="4"></td></tr>
    <tr>
		<td class="write_head" style="border-left:1px solid #dbdbdb;">이전글</td>
		<td class="write_body"> 
		<? if ($prev_href) { 
		$prev_wr_subject = get_text(cut_str($prev['wr_subject'], 100));
		$prev_wr_datetime = substr($prev['wr_datetime'],0,10);
		echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\">$prev_wr_subject</a>&nbsp;<span id='p_n_datetime'>$prev_wr_datetime</span>"; 
		}else{ 
		echo"이전글이 없습니다."; 
		}?></td>
		
	</tr>
    
     <tr>
		<td class="write_head" style="border-left:1px solid #dbdbdb;">다음글</td>
		<td class="write_body"><? if ($next_href) { 
		$next_wr_subject = get_text(cut_str($next['wr_subject'], 100));
		$next_wr_datetime = substr($next['wr_datetime'],0,10);
		echo "<a href=\"$next_href\" title=\"$next_wr_subject\">$next_wr_subject</a>&nbsp;<span id='p_n_datetime'>$next_wr_datetime</span>"; 
		}else{ 
		echo"다음글이 없습니다."; 
		}?></td>
		
	</tr>
	
	
</table>

</div>

    <!-- 링크 버튼 시작 { -->
    <div id="bo_v_bot">
        <?php echo $link_buttons ?>
    </div>
    <!-- } 링크 버튼 끝 -->

</article>
<!-- } 게시판 읽기 끝 -->

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->