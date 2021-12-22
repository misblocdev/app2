<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<section id="bo_w">
    <h2 id="container_title"><?php //echo $g5['title'] ?></h2>

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

    <div class="jtbl_frm01 tbl_wrap">
        <table>
        <tbody>
        <?php if ($is_name) { ?>
        <tr>
            <th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input" size="10" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_password) { ?>
        <tr>
            <th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_email) { ?>
        <tr>
            <th scope="row"><label for="wr_email">이메일</label></th>
            <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" size="50" maxlength="100"></td>
        </tr>
        <?php } ?>

        <?php if ($is_homepage) { ?>
        <tr>
            <th scope="row"><label for="wr_homepage">홈페이지</label></th>
            <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" size="50"></td>
        </tr>
        <?php } ?>

        <!-- <?php if ($option) { ?>
        <tr>
            <th scope="row">옵션</th>
            <td><?php echo $option ?></td>
        </tr>
        <?php } ?> -->

        <?php if ($is_category) { 
		function get_category_option2($bo_table='', $ca_name='')
		{
			global $g5, $board, $is_admin;

			$categories = explode("|", $board['bo_category_list']); // 구분자가 | 로 되어 있음
			$ca_name = explode("|", $ca_name); // 구분자가 | 로 되어 있음
			$str = "";
			for ($i=0; $i<count($categories); $i++) {
				$category = trim($categories[$i]);
				if (!$category) continue;

				$str .= "<input type=\"checkbox\" name=\"ca_name_list\" value=\"$categories[$i]\" id=\"cate_$i\"";
				if (in_array($category, $ca_name)) {
					$str .= ' checked';
				}
				$str .= "> <label for=\"cate_$i\">$categories[$i]</label>&nbsp; \n";
			}

			return $str;
		}

		$category_option = '';
		if ($board['bo_use_category']) {
			$ca_name = "";
			if (isset($write['ca_name']))
				$ca_name = $write['ca_name'];
			$category_option = get_category_option2($bo_table, $ca_name);
			$is_category = true;
		}
		?>
        <tr>
            <th scope="row"><label for="ca_name">분야<strong class="sound_only">필수</strong></label></th>
            <td>
                <?php echo $category_option ?>
				<input type="hidden" name="ca_name" value="<?php echo $ca_name;?>">
            </td>
        </tr>
        <?php } ?>

        <tr>
            <th scope="row"><label for="wr_11">증상<strong class="sound_only">필수</strong></label></th>
            <td>
				<?php
				$symp = explode("|", $write['wr_11']);
				?>
                <input type="checkbox" name="symp_list" value="기본진료" id="symp_1" <?php if (in_array('기본진료', $symp)) echo ' checked'; ?>> <label for="symp_1">기본진료</label>&nbsp;
                <input type="checkbox" name="symp_list" value="일반진료" id="symp_2" <?php if (in_array('일반진료', $symp)) echo ' checked'; ?>> <label for="symp_2">일반진료</label>&nbsp;
                <input type="checkbox" name="symp_list" value="신경치료" id="symp_3" <?php if (in_array('신경치료', $symp)) echo ' checked'; ?>> <label for="symp_3">신경치료</label>&nbsp;
                <input type="checkbox" name="symp_list" value="잇몸치료" id="symp_4" <?php if (in_array('잇몸치료', $symp)) echo ' checked'; ?>> <label for="symp_4">잇몸치료</label>&nbsp;
                <input type="checkbox" name="symp_list" value="사랑니발치" id="symp_5" <?php if (in_array('사랑니발치', $symp)) echo ' checked'; ?>> <label for="symp_5">사랑니발치</label>&nbsp;
                <input type="checkbox" name="symp_list" value="심미보철" id="symp_6" <?php if (in_array('심미보철', $symp)) echo ' checked'; ?>> <label for="symp_6">심미보철</label>&nbsp;
                <input type="checkbox" name="symp_list" value="교정진료" id="symp_7" <?php if (in_array('교정진료', $symp)) echo ' checked'; ?>> <label for="symp_7">교정진료</label>&nbsp;
                <input type="checkbox" name="symp_list" value="라미네이트" id="symp_8" <?php if (in_array('라미네이트', $symp)) echo ' checked'; ?>> <label for="symp_8">라미네이트</label>&nbsp;
                <input type="checkbox" name="symp_list" value="투명교정" id="symp_9" <?php if (in_array('투명교정', $symp)) echo ' checked'; ?>> <label for="symp_9">투명교정</label>&nbsp;
                <input type="checkbox" name="symp_list" value="설측교정" id="symp_10" <?php if (in_array('설측교정', $symp)) echo ' checked'; ?>> <label for="symp_10">설측교정</label>&nbsp;
                <input type="checkbox" name="symp_list" value="부분교정" id="symp_11" <?php if (in_array('부분교정', $symp)) echo ' checked'; ?>> <label for="symp_11">부분교정</label>&nbsp;
                <input type="checkbox" name="symp_list" value="미백진료" id="symp_12" <?php if (in_array('미백진료', $symp)) echo ' checked'; ?>> <label for="symp_12">미백진료</label><br/>
                <input type="checkbox" name="symp_list" value="임플란트" id="symp_13" <?php if (in_array('임플란트', $symp)) echo ' checked'; ?>> <label for="symp_13">임플란트</label>&nbsp;
                <input type="checkbox" name="symp_list" value="디지털임플란트" id="symp_14" <?php if (in_array('디지털임플란트', $symp)) echo ' checked'; ?>> <label for="symp_14">디지털임플란트</label>&nbsp;
                <input type="checkbox" name="symp_list" value="틀니치료" id="symp_15" <?php if (in_array('틀니치료', $symp)) echo ' checked'; ?>> <label for="symp_15">틀니치료</label>&nbsp;
                <input type="checkbox" name="symp_list" value="수면진정치료" id="symp_16" <?php if (in_array('수면진정치료', $symp)) echo ' checked'; ?>> <label for="symp_16">수면진정치료</label>&nbsp;
                <input type="checkbox" name="symp_list" value="턱관절치료" id="symp_17" <?php if (in_array('턱관절치료', $symp)) echo ' checked'; ?>> <label for="symp_17">턱관절치료</label>&nbsp;
                <input type="checkbox" name="symp_list" value="어린이치료" id="symp_18" <?php if (in_array('어린이치료', $symp)) echo ' checked'; ?>> <label for="symp_18">어린이치료</label>&nbsp;
                <input type="checkbox" name="symp_list" value="사각턱수술" id="symp_19" <?php if (in_array('사각턱수술', $symp)) echo ' checked'; ?>> <label for="symp_19">사각턱수술</label>&nbsp;
                <input type="checkbox" name="symp_list" value="양악수술" id="symp_20" <?php if (in_array('양악수술', $symp)) echo ' checked'; ?>> <label for="symp_20">양악수술</label>&nbsp;
                <input type="checkbox" name="symp_list" value="안면윤곽술" id="symp_21" <?php if (in_array('안면윤곽술', $symp)) echo ' checked'; ?>> <label for="symp_21">안면윤곽술</label>
				<input type="hidden" name="wr_11" value="<?php echo $write['wr_11'];?>">
            </td>
        </tr>
		
		<?php if($is_admin) { ?>
        <tr>
            <th scope="row"><label for="wr_code">회원 번호<strong class="sound_only">필수</strong></label></th>
            <td>
				<input type="text" name="wr_code" value="<?php echo $member['mb_3'] ? $member['mb_3'] : $write['wr_code']; ?>" id="wr_code" required class="frm_input" size="50" maxlength="6">
            </td>
        </tr>
		<?php }else { ?>
		<input type="hidden" name="wr_code" value="<?php echo $member['mb_3'] ? $member['mb_3'] : $write['wr_code']; ?>" id="wr_code" required class="frm_input" size="50" maxlength="6">
		<?php } ?>

        <tr>
            <th scope="row"><label for="wr_subject">병원명<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_subject" value="<?php echo $subject ? $subject : $member['mb_1'] ?>" id="wr_subject" required class="frm_input" size="50" maxlength="255">
                    <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                    <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                    <!-- <button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
                    <div id="autosave_pop">
                        <strong>임시 저장된 글 목록</strong>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                        <ul></ul>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                    </div> -->
                    <?php } ?>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_content">병원 문구<strong class="sound_only">필수</strong></label></th>
            <td>
				<input type="text" name="wr_content" value="<?php echo $content;?>" id="wr_content" class="frm_input" size="50" maxlength="36" required placeholder="병원 문구 (36자 이내)">
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_business">사업자 번호</label></th>
            <td>
				<input type="text" name="wr_business" value="<?php echo $member['mb_2'] ? $member['mb_2'] : $write['wr_business']; ?>" id="wr_business" class="frm_input" size="50">
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_1">원장님<strong class="sound_only">필수</strong></label></th>
            <td>
				<input type="text" name="wr_1" value="<?php echo $wr_1;?>" id="wr_1" class="frm_input" size="50">
            </td>
        </tr>

        <?php for ($i=1; $is_file && $i<2; $i++) { ?>
        <tr>
            <th scope="row">원장님 사진</th>
            <td>
                <input type="file" name="bf_file[<?php echo $i?>]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

        <tr>
            <th scope="row"><label for="wr_12">원장님 이력</label></th>
            <td>
				<textarea name="wr_12" value="<?php echo $write['wr_12'];?>" id="wr_12" class="frm_input" cols="30" rows="10"></textarea>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_2">주소<strong class="sound_only">필수</strong></label></th>
            <td>
				<label for="wr_zip" class="sound_only">우편번호<strong class="sound_only"> 필수</strong></label>
				<input type="hidden" name="wr_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="wr_zip" class="frm_input twopart_input" size="5" maxlength="6"  placeholder="우편번호">

				<input type="text" name="wr_2" value="<?php echo get_text( $wr_2 ? $wr_2 : $member['mb_addr1'] ) ?>" id="wr_2" required class="frm_input frm_address required" size="50"  placeholder="기본주소" style="margin-bottom: 5px;">
				<label for="wr_2" class="sound_only">기본주소<strong> 필수</strong></label>
				<button type="button" class="btn_frmline" onclick="win_zip('fwrite', 'wr_zip', 'wr_2', 'wr_2_1', 'mb_addr_jibeon');">주소 검색</button><br>
				<input type="text" name="wr_2_1" value="<?php echo get_text( $write['wr_2_1'] ? $write['wr_2_1'] : $member['mb_addr2'] ) ?>" id="wr_2_1" class="frm_input frm_address" size="50" placeholder="상세주소">
				<label for="wr_2_1" class="sound_only">상세주소</label>
	            <input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_3">운영시간<strong class="sound_only">필수</strong></label></th>
            <td>
				평일 : <input type="text" name="wr_3" value="<?php echo $wr_3;?>" id="wr_3" class="frm_input" size="50" style="margin-bottom: 5px;" required><br/>
				야간 : <input type="text" name="wr_5" value="<?php echo $wr_5;?>" id="wr_5" class="frm_input" size="50" style="margin-bottom: 5px;">
				<?php
				$wr_4_array = explode("|", $wr_4); // 구분자가 | 로 되어 있음				
				?>
				<input type="checkbox" name="wr_4_day" value="월" id="wr_41" <?php if (in_array('월', $wr_4_array)) { echo 'checked';} ?>> <label for="wr_41">월</label> 
				<input type="checkbox" name="wr_4_day" value="화" id="wr_42" <?php if (in_array('화', $wr_4_array)) { echo 'checked';} ?>> <label for="wr_42">화</label> 
				<input type="checkbox" name="wr_4_day" value="수" id="wr_43" <?php if (in_array('수', $wr_4_array)) { echo 'checked';} ?>> <label for="wr_43">수</label> 
				<input type="checkbox" name="wr_4_day" value="목" id="wr_44" <?php if (in_array('목', $wr_4_array)) { echo 'checked';} ?>> <label for="wr_44">목</label> 
				<input type="checkbox" name="wr_4_day" value="금" id="wr_45" <?php if (in_array('금', $wr_4_array)) { echo 'checked';} ?>> <label for="wr_45">금</label>
				<input type="hidden" name="wr_4" value="<?php echo $wr_4;?>">
				<br/>
				점심 : <input type="text" name="wr_6" value="<?php echo $wr_6;?>" id="wr_6" class="frm_input" size="50" style="margin-bottom: 5px;"><br/>
				토요일 : <input type="text" name="wr_7" value="<?php echo $wr_7;?>" id="wr_7" class="frm_input" size="50">
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_8">연락처<strong class="sound_only">필수</strong></label></th>
            <td>
				<input type="text" name="wr_8" value="<?php echo $wr_8;?>" id="wr_8" class="frm_input" size="50">
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_9">주차시설</label></th>
            <td>
				<input type="checkbox" name="wr_9" value="1" id="wr_9" <?php if ($wr_9 == 1) { echo 'checked';} ?>>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_10">가맹점</label></th>
            <td>
				<input type="checkbox" name="wr_10" value="1" id="wr_10" <?php if ($wr_10 == 1) { echo 'checked';} ?>>
            </td>
        </tr>

        <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">링크 #<?php echo $i ?></label></th>
            <td><input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input" size="50"></td>
        </tr>
        <?php } ?>

        <?php for ($i=0; $is_file && $i<1; $i++) { ?>
        <tr>
            <th scope="row">썸네일</th>
            <td>
                <input type="file" name="bf_file[<?php echo $i?>]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

        <?php for ($i=2; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">병원 이미지 #<?php echo $i-1 ?></th>
            <td>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
      <span class="jbutton large black"><input type="submit" value="작성완료" id="btn_submit" accesskey="s" /></span>
      <span class="jbutton large black"><a href="./board.php?bo_table=<?php echo $bo_table ?>">취소</a></span>    </div>
  </form>

    <script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

		var list = ''; // 분야 선택
		var ca_num = 0;
		$("input[name='ca_name_list']:checked").each(function() { 
			if( list == '' ) {
				list = $(this).val();
			} else {
				list = list + '|' + $(this).val();
			}
			ca_num++;
		});
		if(ca_num > 6) {
			//alert('분야는 최대 6개까지 선택 가능합니다.');
			//return false;
		}
		$('input[name="ca_name"]').val(list);

		if ( !$('input[name="ca_name"]').val() ) {
			alert("분야를 선택해주세요.");
			return false;
		}

		var symp = ''; // 증상 선택
		$("input[name='symp_list']:checked").each(function() { 
			if( symp == '' ) {
				symp = $(this).val();
			} else {
				symp = symp + '|' + $(this).val();
			}
		});

		$('input[name="wr_11"]').val(symp);

		if ( !$('input[name="wr_11"]').val() ) {
			alert("증상을 선택해주세요.");
			return false;
		}

		var day = ''; // 야간 시간 선택
		$("input[name='wr_4_day']:checked").each(function() { 
			if( day == '' ) {
				day = $(this).val();
			} else {
				day = day + '|' + $(this).val();
			}
		});
		$('input[name="wr_4"]').val(day);

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->