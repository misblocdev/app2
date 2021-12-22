<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<style>
#sps .review_li {float: left;width: 590px;margin-bottom: 30px;border: 1px solid #cccccc;border-top-left-radius: 25px;border-bottom-right-radius: 25px;padding: 25px;position: relative;}
#sps .review_li:nth-child(odd) {clear: both;}
#sps .review_li:nth-child(even) {float: right;}
#sps .review_li:after {content: '';display: block;clear: both;}
#sps .review_li .review_thum {float: left;width: 128px;height: 128px;margin-right: 30px;text-align: center;overflow: hidden;border-radius: 50%;position: relative;}
#sps .review_li .review_thum img {width: 100%;}
#sps .review_li .review_thum img.rv_thumb_image {position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);}
#sps .review_li .review_con {float: left;width: 380px;padding-top: 7px;}
#sps .review_li .review_dental {font-size: 17px;line-height: 1;margin-bottom: 2px;}
#sps .review_li dl {padding-right: 60px;}
#sps .review_li dt {font-size: 0;width: 0;height: 0;text-indent: -9999em;}
#sps .review_li dd {font-size: 17px;color: #aeaeae;}
#sps .review_li dd.dd_name {float: left;/* border-right: 1px solid #aeaeae; */line-height: 14px;padding-right: 10px;margin-right: 10px;}
#sps .review_li dd.dd_date {line-height: 14px;}
#sps .review_li .review_tit {font-size: 21px;color: #3d3d3d;overflow: hidden; white-space: nowrap; text-overflow: ellipsis; word-break: break-word;}
#sps .review_li .review_tit strong {color: #9196ff;}
#sps .review_li .review_txt {margin-top: 8px;font-size: 18px; color: #3d3d3d; font-weight: 400;line-height: 22px;letter-spacing: -0.02em;display: -webkit-box;display: box;vertical-align: top;overflow: hidden;text-overflow: ellipsis;word-break: keep-all;-webkit-box-orient: vertical;-webkit-line-clamp: 2;}
#sps .review_li .review_cmd {margin-top: 12px;}
#sps .review_li .write_cmd a {width: 49%;}
#sps .review_li .admin_cmd a {width: 100%;}
#sps .review_li .review_cmd a {display: inline-block;text-align: center;height: 40px;padding: 5px 15px;font-size: 18px;border-radius: 3px;}
#sps .review_li .review_cmd a.review_delete {background: #767676;color: #fff;}
#sps .review_li .review_cmd a.adm_delete {background: #767676;color: #fff;}
#sps .review_li .review_detail {border: none;background: none;position: absolute;top: 27px;right: 30px;}
#sps .pg_wrap {margin-top: 30px;}

/* 반응형 css */
@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

#sps .review_li {width: 46.0938vw;margin-bottom: 2.3438vw;border-top-left-radius: 1.9531vw;border-bottom-right-radius: 1.9531vw;padding: 1.9531vw;}
#sps .review_li .review_thum {width: 10.0000vw;height: 10.0000vw;margin-right: 2.3438vw;}
#sps .review_li .review_con {width: 29vw;padding-top: 0.5469vw;}
#sps .review_li .review_dental {font-size: 1.3281vw;margin-bottom: 0.1563vw;}
#sps .review_li dl {padding-right: 4.6875vw;}
#sps .review_li dd {font-size: 1.3281vw;}
#sps .review_li dd.dd_name {line-height: 1.0938vw;padding-right: 0.7813vw;margin-right: 0.7813vw;}
#sps .review_li dd.dd_date {line-height: 1.0938vw;}
#sps .review_li .review_tit {font-size: 1.6406vw;}
#sps .review_li .review_txt {margin-top: 0.6250vw;font-size: 1.4063vw;  line-height: 1.7188vw;}
#sps .review_li .review_cmd {margin-top: 0.9375vw;}
#sps .review_li .write_cmd a {width: 49%;}
#sps .review_li .admin_cmd a {width: 100%;}
#sps .review_li .review_cmd a {height: 3.1250vw;padding: 0.3906vw 1.1719vw;font-size: 1.4063vw;border-radius: 0.2344vw;}
#sps .review_li .review_cmd a.review_delete {background: #767676;}
#sps .review_li .review_detail {top: 2.1094vw;right: 2.3438vw;}
#sps .review_li .review_detail img {width: 3.5156vw;}
#sps .pg_wrap {margin-top: 2.3438vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

#sps .review_li {float: none;width: 100%;margin-bottom: 3.9063vw;border-top-left-radius: 3.2552vw;border-bottom-right-radius: 3.2552vw;padding: 3.9063vw;}
#sps .review_li:nth-child(even) {float: none;}
#sps .review_li .review_thum {width: 17.3177vw;height: 17.3177vw;margin-right: 3.9063vw;padding-top: 1.3021vw;}
#sps .review_li .review_con {width: 63.8021vw;padding-top: 0.6510vw;}
#sps .review_li .review_dental {font-size: 2.7344vw;line-height: 1;margin-bottom: 0.0000vw;}
#sps .review_li dl {padding-right: 6.5104vw;}
#sps .review_li dd {font-size: 2.7344vw;}
#sps .review_li dd.dd_name {line-height: 2.3438vw;padding-right: 1.3021vw;margin-right: 1.3021vw;}
#sps .review_li dd.dd_date {line-height: 2.3438vw;}
#sps .review_li .review_tit {font-size: 3.2552vw;margin-bottom: 0.2604vw;}
#sps .review_li .review_txt {margin-top: 1.3021vw;font-size: 2.9948vw;;line-height: 3.6458vw;}
#sps .review_li .review_cmd {margin-top: 1.5625vw;}
#sps .review_li .review_cmd a {height: 6.2500vw;padding: 0.9115vw 1.3021vw;font-size: 2.6042vw;border-radius: 0.6510vw;}
#sps .review_li .review_detail {top: 3.5156vw;right: 3.9063vw;}
#sps .review_li .review_detail img {width: 6.3802vw;}
#sps .pg_wrap {margin-top: 10.4167vw;}

}
</style>

<div id="sps" class="sub_content">
<div class="inner">
	<div class="sub_title"><?php echo $sub_title;?></div>
    <!-- <p><?php echo $config['cf_title']; ?> 전체 사용후기 목록입니다.</p> -->
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

        if ($i == 0) echo '<div class="clearfix">';

		$review_list = G5_URL."/reviewlist.php";
		$review_form = G5_URL."/reviewform.php?den_id=".$row['it_id'];
		$review_formupdate = G5_URL."/reviewformupdate.php?den_id=".$row['it_id'];

		$rv_dental = sql_fetch(' select * from g5_write_dental where wr_code = "'.$row['it_id'].'" ');

		$num = array_search($is_cate, $den_cate) + 1;

		$rv_img = G5_DATA_PATH.'/review/'.$row['rv_img'];
		$rv_img_exists = run_replace('shop_item_image_exists', (is_file($rv_img) && file_exists($rv_img)));
		$img_tag = run_replace('rv_image_tag', '<img src="'.G5_DATA_URL.'/review/'.$row['rv_img'].'" class="rv_thumb_image" >');
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
			<?php } else if ($rv_dental['wr_code'] == $member['mb_id']) {?>
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
    if ($i == 0) echo '<p id="sps_empty">자료가 없습니다.</p>';
    ?>

	<?php echo get_paging($config['cf_write_pages'], $page, $total_page, $page_url); ?>
</div>
</div>

<script>
jQuery(function($){
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

    // 상품이미지 크게보기
    $(".prd_detail").click(function() {
        var url = $(this).attr("data-url");
        var top = 10;
        var left = 10;
        var opt = 'scrollbars=yes,top='+top+',left='+left;
        popup_window(url, "largeimage", opt);

        return false;
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
<!-- } 전체 상품 사용후기 목록 끝 -->