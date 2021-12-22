<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 상품 사용후기 시작 { -->
<section id="review_list">
    <h3 class="sound_only">등록된 진료후기</h3>
	<?php if($den_id) { ?>
	<div id="review_wbtn">
		<a href="<?php echo $review_form; ?>" class="btn02 review_form">후기작성<span class="sound_only"> 새 창</span></a>
		<!-- <a href="<?php echo $review_list; ?>" class="btn01 itemuse_list">더보기</a> -->
	</div>
	<?php }?>
    
    <?php
    $thumbnail_width = 500;

	$sql_den = ' select * from g5_board where bo_table = "dental" ';
	$row_den = sql_fetch($sql_den);
	$den_cate = explode('|', $row_den['bo_category_list']);

    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $is_num     = $total_count - ($page - 1) * $rows - $i;
        $is_star    = get_star($row['is_score']);

		if($is_admin) {
        $is_name    = get_text($row['is_name']);
		} else {
		$is_name    = mb_substr(get_text($row['is_name']), 0, 1).'**';
		}

        $is_cate    = get_text($row['is_cate']);
        $is_subject = conv_subject($row['is_subject'],50,"…");
        $is_content = get_view_thumbnail(conv_content($row['is_content'], 1), $thumbnail_width);
        $is_reply_name = !empty($row['is_reply_name']) ? get_text($row['is_reply_name']) : '';
        $is_reply_subject = !empty($row['is_reply_subject']) ? conv_subject($row['is_reply_subject'],50,"…") : '';
        $is_reply_content = !empty($row['is_reply_content']) ? get_view_thumbnail(conv_content($row['is_reply_content'], 1), $thumbnail_width) : '';
        $is_time    = substr($row['is_time'], 2, 8);

        $hash = md5($row['is_id'].$row['is_time'].$row['is_ip']);

		$rv_dental = sql_fetch(' select * from g5_write_dental where wr_code = "'.$row['it_id'].'" ');

		$num = array_search($is_cate, $den_cate) + 1;

		$rv_img = G5_DATA_PATH.'/review/'.$row['rv_img'];
		$rv_img_exists = run_replace('shop_item_image_exists', (is_file($rv_img) && file_exists($rv_img)));
		$img_tag = run_replace('rv_image_tag', '<img src="'.G5_DATA_URL.'/review/'.$row['rv_img'].'" class="rv_thumb_image" >');

        if ($i == 0) echo '<div id="review_wrap" class="clearfix">';
    ?>

        <div class="review_li">
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

				<div class="review_txt"><?php echo strip_tags($is_content); // 사용후기 내용 ?></div>

				<button class="sps_con_<?php echo $i; ?> review_detail"><img src="/images/btn_info.png" alt="내용보기"></button>

				<?php if ($is_admin || $row['mb_id'] == $member['mb_id']) { ?>
				<div class="review_cmd write_cmd">
					<a href="<?php echo $review_form."&amp;is_id={$row['is_id']}&amp;w=u"; ?>" class="review_form btn01" onclick="return false;">수정</a>
					<a href="<?php echo $review_formupdate."&amp;is_id={$row['is_id']}&amp;w=d&amp;hash={$hash}"; ?>" class="review_delete btn01">삭제</a>
				</div>
				<?php } else if ($rv_dental['wr_code'] == $member['mb_id']) { ?>
				<div class="review_cmd admin_cmd">
					<a href="javascript:;" class="adm_delete btn01">삭제요청</a>
				</div>
				<?php }?>

				<!-- 사용후기 자세히 시작 -->
				<div class="review_detail_cnt">
					<div class="review_detail_in">
						<h3>진료후기</h3>
						<div class="review_cnt">
							<div class="review_tp_cnt">
								<div class="review_dental"><a href="<?php echo get_pretty_url('dental', $rv_dental['wr_id']).'&den_id='.$rv_dental['wr_code']?>"><?php echo $rv_dental['wr_subject']?></a></div>
								<span><strong>[ <?php echo $is_cate;?> ]</strong> <?php echo get_text($row['is_subject']); ?></span>
								<dl class="sps_dl clearfix">
									<dt class="sound_only">작성자</dt>
									<dd class="dd_name"><?php echo $is_name; ?></dd>
									<!-- <dt class="sound_only">작성 날짜</dt>
									<dd class="dd_date"><?php echo $is_time; ?></dd> -->
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

				<!-- 삭제요청 시작 -->
				<div class="review_delete_cnt">
					<div class="review_delete_in">
						<h3>삭제사유</h3>
						<p>삭제사유를 입력하세요.</p>
						<div class="delete_cnt">
							<form action="<?php echo G5_URL?>/reviewdelete.php" method="post" enctype="multipart/form-data">
								<input type="hidden" name="is_id" value="<?php echo $row['is_id']; ?>">
								<input type="hidden" name="wr_id" value="<?php echo $rv_dental['wr_id']; ?>">
								<input type="hidden" name="den_id" value="<?php echo $rv_dental['wr_code']; ?>">
								<textarea name="is_delete_content" id="is_delete_content"></textarea>
								<input type="submit" value="삭제요청">
							</form>
						</div>
						<button class="delete_cls"><span class="sound_only">삭제요청 팝업 닫기</span><i class="fa fa-times" aria-hidden="true"></i></button>
					</div>
				</div>
				<!-- 삭제요청 끝 -->
			</div>
        </div>

    <?php }

    if ($i > 0) echo '</div>';

    if (!$i) echo '<p class="sit_empty">진료후기가 없습니다.</p>';
    ?>
</section>

<?php
echo review_page($config['cf_write_pages'], $page, $total_page, $page_url, "");
?>

<script>
$(function(){
    $(".review_form").click(function(){
        window.open(this.href, "review_form", "width=810,height=680,scrollbars=1");
        return false;
    });

    $(".review_delete").click(function(){
        if (confirm("정말 삭제 하시겠습니까?\n\n삭제후에는 되돌릴수 없습니다.")) {
            return true;
        } else {
            return false;
        }
    });

    $(".sit_use_li_title").click(function(){
        var $con = $(this).siblings(".sit_use_con");
        if($con.is(":visible")) {
            $con.slideUp();
        } else {
            $(".sit_use_con:visible").hide();
            $con.slideDown(
                function() {
                    // 이미지 리사이즈
                    $con.viewimageresize2();
                }
            );
        }
    });

    $(".pg_page").click(function(){
        $("#review").load($(this).attr("href"));
        return false;
    });

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

    // 삭제요청 열기
    $(".adm_delete").on("click", function(){
        $(this).parent("div").siblings(".review_delete_cnt").show();
    });
		
    // 삭제요청 닫기
    $(document).mouseup(function (e){
        var container = $(".review_delete_cnt");
        if( container.has(e.target).length === 0)
        container.hide();
    });

    // 삭제요청 닫기
    $('.delete_cls').click(function(){
        $('.review_delete_cnt').hide();
    });
});
</script>
<!-- } 상품 사용후기 끝 -->