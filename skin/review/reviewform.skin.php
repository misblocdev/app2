<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<style>
#sit_use_write #is_content {height: 300px;}

.filebox {max-width: 600px}

/*.filebox input[type="file"] {
	position: absolute;
	width: 1px;
	height: 1px;
	padding: 0;
	margin: -1px;
	overflow: hidden;
	clip:rect(0,0,0,0);
	border: 0;
}*/
.filebox input[type="file"] {opacity: 0;}
	
.filebox label {
	display: inline-block;
	padding: .5em .75em;
	color: #999;
	font-size: inherit;
	line-height: normal;
	vertical-align: middle;
	background-color: #fff;
	cursor: pointer;
	border: 1px solid #aaa;
	border-bottom-color: #aaa;
	border-radius: .25em;
	width: 29%;
	float: right;
	text-align: center;
}

/* named upload */
.filebox .upload-name {
	display: inline-block;
	padding: .5em .75em;
	font-size: inherit;
	font-family: inherit;
	line-height: normal;
	vertical-align: middle;
	background-color: #fff;
  border: 1px solid #aaa;
  border-bottom-color: #aaa;
  border-radius: .25em;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  width: 70%;
}

.filebox.bs3-primary label {
  color: #fff;
	background-color: #777dee;
	border-color: #777dee;
}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

#sit_use_write #is_content {height: 39.0625vw;}

}
</style>

<!-- 사용후기 쓰기 시작 { -->
<div id="sit_use_write" class="new_win">
    <h1 id="win_title">진료후기 쓰기</h1>

    <form name="fitemuse" method="post" action="<?php echo G5_URL;?>/reviewformupdate.php" onsubmit="return fitemuse_submit(this);" autocomplete="off" enctype="MULTIPART/FORM-DATA">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="den_id" value="<?php echo $den_id; ?>">
    <input type="hidden" name="is_id" value="<?php echo $is_id; ?>">
    <input type="hidden" name="is_score" value="5">

    <div class="new_win_con form_01">
        <ul>
            <li>
                <label for="is_subject" class="sound_only">제목<strong> 필수</strong></label>
                <input type="text" name="is_subject" value="<?php echo get_text($use['is_subject']); ?>" id="is_subject" required class="required frm_input full_input"  maxlength="250" placeholder="제목">
            </li>
			<?php if($member['mb_3'] == $den_id || $is_admin) { ?>
            <li>
                <label for="is_name" class="sound_only">이름</label>
                <input type="text" name="is_name" value="<?php echo get_text($use['is_name']); ?>" id="is_name" class="frm_input full_input"  maxlength="250" placeholder="이름">
            </li>
			<?php }?>
			<?php if($member['mb_3'] == $den_id || $is_admin) { ?>
            <li>
                <label for="is_time" class="sound_only">날짜</label>
                <input type="text" name="is_time" value="<?php echo get_text($use['is_time']); ?>" id="is_time" class="frm_input full_input"  maxlength="250" placeholder="<?php echo G5_TIME_YMD;?>">
            </li>
			<?php }?>
            <li>
                <strong  class="sound_only">내용</strong>
                <?php //echo $editor_html; ?>
				<textarea name="is_content" id="is_content" cols="30" rows="10"><?php echo $use['is_content'];?></textarea>
            </li>
            <li>
                <strong  class="sound_only">이미지 첨부</strong>
				<div class="filebox bs3-primary clearfix">
					<input class="upload-name" value="파일선택" disabled="disabled">

					<label for="rv_img">후기 이미지</label> 
					<input type="file" name="rv_img" id="rv_img" class="upload-hidden"> 
				</div>
				<?php
				$rv_img = G5_DATA_PATH.'/review/'.$use['rv_img'];
				$rv_img_exists = run_replace('review_image_exists', (is_file($rv_img) && file_exists($rv_img)));

				if($rv_img_exists) {
					$thumb = get_it_thumbnail($use['rv_img'], 25, 25);
					$img_tag = run_replace('review_image_tag', '<img src="'.G5_DATA_URL.'/review/'.$use['rv_img'].'" class="review_preview_image" >');
				?>
				<input type="checkbox" name="rv_img_del" id="rv_img_del" value="1">
				<label for="rv_img_del"><span class="sound_only">이미지 </span>파일삭제</label>         
				<?php } ?>
				<script>
				$(document).ready(function(){
				var fileTarget = $('.filebox .upload-hidden');
					fileTarget.on('change', function(){
						if(window.FileReader){
							var filename = $(this)[0].files[0].name;
						} else {
							var filename = $(this).val().split('/').pop().split('\\').pop();
						}

						$(this).siblings('.upload-name').val(filename);
					});
				});
				</script>
            </li>
            <li>
                <span class="sound_only">분야</span>
                <ul id="sit_use_write_cate" class="chk_box">
				<?php 
				$sql_den = ' select * from g5_board where bo_table = "dental" ';
				$row_den = sql_fetch($sql_den);

				$cate = explode('|', $row_den['bo_category_list']);

				for($i = 0 ; $i < count($cate) ; $i++){
				?>
                    <li>
                        <input type="radio" name="is_cate" value="<?php echo $cate[$i];?>" id="is_cate<?php echo $i?>" <?php echo ($is_cate==$cate[$i])?'checked="checked"':''; ?>>
                        <label for="is_cate<?php echo $i?>"><span></span><?php echo $cate[$i];?></label>
                    </li>
				<?php }
				?>
                </ul>
            </li>
        </ul>

        <div class="win_btn">
            <button type="submit" class="btn_submit">작성완료</button>
            <button type="button" onclick="self.close();" class="btn_close">닫기</button>
        </div>
    </div>
    </form>
</div>

<script type="text/javascript">
function fitemuse_submit(f)
{
    <?php echo $editor_js; ?>

    return true;
}
</script>
<!-- } 사용후기 쓰기 끝 -->