<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<style>
.write_head { width:95px;text-align:center; color:#000000; font-size:11px; font-weight:bold; background-color: #f9f9f9; border-right:1px solid #d7d7d7; border-bottom:1px solid #d7d7d7; font-family:'나눔고딕',Nanum Gothic !important;}
.write_body { background-color: #ffffff;  border-right:1px solid #d7d7d7; border-bottom:1px solid #d7d7d7; padding:11px 5px 11px 20px; font-family:'나눔고딕',Nanum Gothic !important;}
.write_body2 { background-color: #ffffff; width:106px; padding:11px 0 11px 20px; border-right:1px solid #d7d7d7; border-bottom:1px solid #d7d7d7; font-family:'나눔고딕',Nanum Gothic !important;}
.write_contents { background-color: #ffffff; border-bottom:1px solid #d7d7d7; padding:10px; font-family:'나눔고딕',Nanum Gothic !important;}
.field { border:1px solid #ccc; font-family:'나눔고딕',Nanum Gothic !important; }
#p_n_datetime{text-align:right; display:block;float:right; padding-right:10px;}
#writeContents{font-family:"나눔고딕", "Nanum Gothic", "맑은 고딕", "Malgun Gothic";}
#bo_v_info, #bottom_p_n, .sub_bg  {display: none;}
</style>


<!-- 게시물 읽기 시작 { -->
<!-- <div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>-->

<article id="bo_v">
	
	<div class="view_top">
		<div class="dental_name"><?php echo $view['wr_subject'];?></div>
		<ul class="view_top_btn">
			<!-- <?php if($view['wr_link1']) { ?><li><a href="<?php echo $view['wr_link1']?>">문의하기</a></li><?php } ?> -->
			<li><a href="<?php echo G5_BBS_URL?>/write.php?bo_table=inquiry&den_id=<?php echo $den_id;?>">문의하기</a></li>
			<!-- <?php if($view['wr_link2']) { ?><li><a href="<?php echo $view['wr_link2']?>">카톡상담</a></li><?php } ?> -->
			<?php if($is_admin || $member['mb_id'] == 'test') { ?><li><a href="<?php echo G5_URL?>/reservation_s.php?den_id=<?php echo $den_id;?>">예약하기</a></li><?php } ?>
		</ul>
	</div>	

	<div class="dental_info clearfix">
		<div class="dental_info_left">
			<div class="dental_introduce"><?php echo $view['wr_content'];?></div>
			<div class="dental_cate">
				<dl class="clearfix">
					<dt><b>전문분야</b> <span>ㅣ</span></dt>
					<dd><?php echo implode(', ', explode('|', $view['ca_name']));?></dd>
				</dl>
			</div>
			<div class="dental_detail">
				<dl class="clearfix">
					<dt>주소</dt>
					<?php 
					$addr = $view['wr_2'].' '.$view['wr_2_1'];
					?>
					<dd><?php echo $addr;?></dd>
					<dt>운영시간</dt>
					<dd>
						<span>평 일</span> : <?php echo $view['wr_3'];?> <br/>

						<?php if( $view['wr_6'] ) { ?>
						<span>점 심</span> : <?php echo $view['wr_6'];?> <br/>						
						<?php } ?>

						<?php if( $view['wr_4'] ) { 
						$day_array = explode('|', $view['wr_4']);
						if(count($day_array) > 1) {
							$nigthTime = implode(' / ', $day_array);
						} else {
							$nigthTime = $day_array[0].'요일';
						}
						?>
						<span><?php echo $nigthTime;?></span> : <?php echo $view['wr_5'];?> <br/>
						<?php } ?>

						<?php if( $view['wr_7'] ) { ?>
						<span>토 요 일</span> : <?php echo $view['wr_7'];?>						
						<?php } ?>
					</dd>
					<?php if($view['wr_8']) { ?>
					<dt>연락처</dt>
					<dd><?php echo $view['wr_8'];?><?php if($view['wr_9'] == 1) { echo ' / 주차시설 완비';} ?></dd>
					<?php } ?>
				</dl>
			</div>
		</div>
		<?php if($view['file'][1]['view']) {?>
		<div class="dental_info_right">
			<?php
			// 파일 출력
			$v_img_count = count($view['file']);
			if($v_img_count) {
				echo "<div id=\"bo_v_img\">\n";

				for ($i=1; $i<=1; $i++) {
					if ($view['file'][$i]['view']) {
						//echo $view['file'][$i]['view'];
						echo get_view_thumbnail($view['file'][$i]['view']);
					}
				}

				echo "</div>\n";
			}
			?>
			<div class="dentist clearfix">
				<div class="dentist_name"><?php echo $view['wr_1'];?> 원장님</div>
				<?php if($view['wr_12']) { ?>
				<div class="dentist_btn"><a href="javascript:;">이력보기</a></div>
				<?php } ?>			
			</div>
			<?php if($view['wr_12']) { ?>
			<div class="antecedents">
				<?php echo get_text($view['wr_12'],1,false);?>
			</div>
			<?php } ?>
		</div>
		<?php }?>
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
				$v_img_count = count($view['file']);
				if($v_img_count) {

					for ($i=2; $i<=count($view['file']) - 2; $i++) {
						if ($view['file'][$i]['view']) {
							//echo $view['file'][$i]['view'];
							echo '<div class="swiper-slide">'.strip_tags(get_view_thumbnail($view['file'][$i]['view']), '<img>').'</div>';
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

	<?php
	$sql_ev = ' select * from g5_write_event where wr_4 = "'.$den_id.'" ';
	//echo $sql_ev;
	$result_ev = sql_query($sql_ev);
	$total_ev = sql_num_rows($result_ev);	

	if($total_ev > 0) {
	?>
	<div class="dental_event">
		<h2>이벤트</h2>
		<div class="gallery-wrap">
			<div class="event_list swiper-container">
				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">				
				<?php 
				for($i = 0 ; $event = sql_fetch_array($result_ev) ; $i++){
					$thumb = get_list_thumbnail('event', $event['wr_id'], 385, 236, false, false, 'center', false, '80/0.5/3');
					?>
					<div class="swiper-slide">
						<div class="gall_href">
							<a href="<?php echo get_pretty_url('event', $event['wr_id'])?>"><img src="<?php echo $thumb['src']?>" alt="<?php echo $event['wr_subject'];?>"></a>
						</div>
						<div class="gall_text_href">
							<?php if($event['wr_2'] < G5_TIME_YMD){ ?>
							<span style="background:#aaaaaa;">종료</span>
							<?php } else { ?>
							<span style="background:#777dee;">진행중</span>
							<?php } ?>
							<p><a href="<?php echo get_pretty_url('event', $event['wr_id'])?>"><?php echo $event['wr_subject'];?></a></p>
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
		<?php if($member['mb_3'] == $den_id || $is_admin) { ?>
		<div class="event_btn"><a href="<?php echo G5_BBS_URL?>/write.php?bo_table=event">이벤트 등록</a></div>
		<?php } ?>
	</div>
	<?php } ?>

	<div class="dental_addr">
		<div class="dental_addr_h"><?php echo $view['wr_subject'];?>에 오셔서 치료받으세요!</div>
		<div class="dental_addr_wrap clearfix">
			<div class="dental_map">
				<div id="map"></div>
				<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=aa5711f253b77b4ce7e4f5951dfdc8d0&libraries=services,clusterer,drawing"></script>
				<script>
				var geocoder = new kakao.maps.services.Geocoder();

				var callback = function(result, status) {
					if (status === kakao.maps.services.Status.OK) {
						console.log(result);
				
						var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
						mapOption = { 
							center: new kakao.maps.LatLng(result[0].y, result[0].x), // 지도의 중심좌표
							level: 3 // 지도의 확대 레벨
						};

						// 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
						var map = new kakao.maps.Map(mapContainer, mapOption); 
						
						// 마커가 표시될 위치입니다 
						var markerPosition  = new kakao.maps.LatLng(result[0].y, result[0].x); 

						// 마커를 생성합니다
						var marker = new kakao.maps.Marker({
							position: markerPosition
						});

						// 마커가 지도 위에 표시되도록 설정합니다
						marker.setMap(map);
					}
				};
	
				geocoder.addressSearch("<?php echo $view['wr_2']?>", callback);
				</script>
			</div>
			<div class="dental_info2">
				<div class="dental_name2"><?php echo $view['wr_subject'];?></div>
				<div class="dental_detail2">
					<dl class="clearfix">
						<dt>주소 : </dt>
						<dd><?php echo $addr;?></dd>
						<dt>운영시간 &nbsp;</dt>
						<dd>
							<span>평 일</span> : <?php echo $view['wr_3'];?> <br/>

							<?php if( $view['wr_6'] ) { ?>
							<span>점 심</span> : <?php echo $view['wr_6'];?> <br/>
							<?php } ?>

							<?php if( $view['wr_4'] ) { 
							$day_array = explode('|', $view['wr_4']);
							if(count($day_array) > 1) {
								$nigthTime = implode(' / ', $day_array);
							} else {
								$nigthTime = $day_array[0].'요일';
							}
							?>
							<span><?php echo $nigthTime;?></span> : <?php echo $view['wr_5'];?> <br/>
							<?php } ?>

							<?php if( $view['wr_7'] ) { ?>
							<span>토 요 일</span> : <?php echo $view['wr_7'];?>						
							<?php } ?>
						</dd>
						<?php if($view['wr_8']) { ?>
						<dt>연락처 : </dt>
						<dd><?php echo $view['wr_8'];?><?php if($view['wr_9'] == 1) { echo ' / 주차시설 완비';} ?></dd>
						<?php } ?>
					</dl>
				</div>				
			</div>
		</div>
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

	$('.dentist_btn').on('click', function(){
		$('.antecedents').toggle();
	})
	</script>

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
    <!-- <section id="bo_v_file">
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
    </section> -->
    <!-- } 첨부파일 끝 -->
    <?php } ?>

    <?php
    if (implode('', $view['link'])) {
     ?>
     <!-- 관련링크 시작 { -->
    <!-- <section id="bo_v_link">
        <h2>관련링크</h2>
        <ul>
        <?php
        // 링크
        $cnt = 0;
        for ($i=1; $i<=count($view['link']); $i++) {
            if ($view['link'][$i]) {
                $cnt++;
                $link = cut_str($view['link'][$i], 70);
         ?>
            <li>
                <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                    <img src="<?php echo $board_skin_url ?>/img/icon_link.gif" alt="관련링크">
                    <strong><?php echo $link ?></strong>
                </a>
                <span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회 연결</span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section> -->
    <!-- } 관련링크 끝 -->
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
            <?php if ($update_href) { ?><li><span class="jbutton large black"><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></span></li><?php } ?>
            <?php if ($delete_href && $is_admin) { ?><li><span class="jbutton large black"><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></span></li><?php } ?>
            <?php if ($copy_href) { ?><li><span class="jbutton large black"><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></span></li><?php } ?>
            <?php if ($move_href) { ?><li><span class="jbutton large black"><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></span></li><?php } ?>
            <!-- <?php if ($search_href) { ?><li><span class="jbutton large black"><a href="<?php echo $search_href ?>" class="btn_b01">검색</a></span></li><?php } ?> -->
            <li><span class="jbutton large black"><a href="<?php echo $list_href ?>" class="btn_b01"><i class="fa fa-list" aria-hidden="true"></i> 목록</a></span></li>
            <!-- <?php if ($reply_href) { ?><li><span class="jbutton large black"><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></span></li><?php } ?> -->
            <?php if ($write_href && $is_admin) { ?><li><span class="jbutton large black"><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></span></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

	<div id="bo_v_share">
    <?php
    include_once(G5_SNS_PATH."/view.sns.skin.php");
    ?>
	</div>

    <?php
    // 코멘트 입출력
    //include_once('./view_comment.php');
     ?>
     
     <div id="bottom_p_n">

<?
 // 윗글을 얻음
$sql = " select wr_id, wr_subject, wr_datetime from $write_table where wr_is_comment = 0 and wr_num = '$write[wr_num]' and wr_reply < '$write[wr_reply]' $sql_search order by wr_num desc, wr_reply desc limit 1 ";
$prev = sql_fetch($sql);
// 위의 쿼리문으로 값을 얻지 못했다면
if (!$prev[wr_id])     {
	$sql = " select wr_id, wr_subject, wr_datetime from $write_table where wr_is_comment = 0 and wr_num < '$write[wr_num]' $sql_search order by wr_num desc, wr_reply desc limit 1 ";
	$prev = sql_fetch($sql);
}

// 아래글을 얻음
$sql = " select wr_id, wr_subject, wr_datetime from $write_table where wr_is_comment = 0 and wr_num = '$write[wr_num]' and wr_reply > '$write[wr_reply]' $sql_search order by wr_num, wr_reply limit 1 ";
$next = sql_fetch($sql);
// 위의 쿼리문으로 값을 얻지 못했다면
if (!$next[wr_id]) {
	$sql = " select wr_id, wr_subject, wr_datetime from $write_table where wr_is_comment = 0 and wr_num > '$write[wr_num]' $sql_search order by wr_num, wr_reply limit 1 ";
	$next = sql_fetch($sql);
}
?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td height="1" bgcolor="#dbdbdb" colspan="4"></td></tr>
    <tr>
		<td class="write_head" style="border-left:1px solid #dbdbdb;">이전글</td>
		<td class="write_body"> 
		<? if ($prev_href) { 
		$prev_wr_subject = get_text(cut_str($prev[wr_subject], 100));
		$prev_wr_datetime = substr($prev[wr_datetime],0,10);
		echo "<a href=\"$prev_href\" title=\"$prev_wr_subject\">$prev_wr_subject</a>&nbsp;<span id='p_n_datetime'>$prev_wr_datetime</span>"; 
		}else{ 
		echo"이전글이 없습니다."; 
		}?></td>
		
	</tr>
    
     <tr>
		<td class="write_head" style="border-left:1px solid #dbdbdb;">다음글</td>
		<td class="write_body"><? if ($next_href) { 
		$next_wr_subject = get_text(cut_str($next[wr_subject], 100));
		$next_wr_datetime = substr($next[wr_datetime],0,10);
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

	//sns공유
    $(".btn_share").click(function(){
        $("#bo_v_sns").fadeIn();
   
    });

    $(document).mouseup(function (e) {
        var container = $("#bo_v_sns");
        if (!container.is(e.target) && container.has(e.target).length === 0){
        container.css("display","none");
        }	
    });
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