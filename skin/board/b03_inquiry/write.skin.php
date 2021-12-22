<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<style>
input, textarea {
   -webkit-appearance: none;
   -webkit-border-radius: 0;
}

/* .boardtitle{text-align: center; font-size: 50px; letter-spacing: -0.07em; margin-bottom: 60px;}
 */
.req { color: #568fee; }
input.frm_input { max-width: 715px; }
input.half_input { width: 49%; max-width: 355px; }
#wr_content { width: 100% !important; max-width: 715px !important; height: 130px !important; resize:none;}
.td_job > span { display: inline-block; padding: 3px 0; }

#priv { position: relative; }
#priv textarea { width: 100%; height:200px; resize: none; border: 1px solid #dfdfdf; padding: 5px; }
#priv > div { margin: 25px 0 50px; text-align: center; }
#priv label { font-size: 15px; color: #888; font-weight: 400; letter-spacing: -0.02em; }

.jtbl_frm01 th{text-align: left; padding-left: 40px; width:200px; font-size: 18px;}

@media (max-width:1024px){
	.jtbl_frm01 th{width:160px; font-size: 16px;}
}

@media (max-width: 800px) {
	#priv textarea { height: 100px; }
	#priv > div { margin: 15px 0 30px; }
	#priv label { font-size: 13px; }
	.jtbl_frm01 th{width:30%; padding-left: 10px;}
}


</style>

<section id="bo_w">
    <h2 class="sound_only"><?php echo $g5['title'] ?></h2>

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
    <input type="hidden" name="wr_10" value="<?php echo $den_id ?>">
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
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">HTML</label>';
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
	
	<div class="boardtitle coreTh">상담문의 <span class="coreB">예약하기</span></div>

    <div class="jtbl_frm01 tbl_wrap">
        <table>
        <tbody>
		<tr><td colspan="2" class="td_border"></td></tr>
		<?php if ($option) { ?>
        <tr style="display:none;">
            <th scope="row">옵션</th>
            <td><?php echo $option ?></td>
        </tr>
        <?php } ?>

        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="ca_name" id="ca_name" required class="frm_input" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </td>
        </tr>
        <?php } ?>
		<!-- <tr>
		            <th scope="row"><label for="wr_1">제품명 <span class="req">*</span></label></th>
		            <td>
				<select name="wr_1" id="wr_1" required class="frm_input" >
		                    <option value="">선택</option>
						<option value="블록체인 > Blockchain Platform" <?php if($wr_1=='블록체인 > Blockchain Platform')echo"selected"; ?>>블록체인 > Blockchain Platform</option>
						<option value="블록체인 > Blockchain Security Suite" <?php if($wr_1=='블록체인 > Blockchain Security Suite')echo"selected"; ?>>블록체인 > Blockchain Security Suite</option>
						<option value="인증 솔루션 > 사설 인증 체계" <?php if($wr_1=='인증 솔루션 > 사설 인증 체계')echo"selected"; ?>>인증 솔루션 > 사설 인증 체계</option>
						<option value="인증 솔루션 > Non-ActiveX 공인인증" <?php if($wr_1=='인증 솔루션 > Non-ActiveX 공인인증')echo"selected"; ?>>인증 솔루션 > Non-ActiveX 공인인증</option>
						<option value="인증 솔루션 > 서버 기반 공인인증" <?php if($wr_1=='인증 솔루션 > 서버 기반 공인인증')echo"selected"; ?>>인증 솔루션 > 서버 기반 공인인증</option>
						<option value="인증 솔루션 > 생체인증 플랫폼" <?php if($wr_1=='인증 솔루션 > 생체인증 플랫폼')echo"selected"; ?>>인증 솔루션 > 생체인증 플랫폼</option>
						<option value="인증 솔루션 > 웹 기반 간편인증" <?php if($wr_1=='인증 솔루션 > 웹 기반 간편인증')echo"selected"; ?>>인증 솔루션 > 웹 기반 간편인증</option>
						<option value="통합인증, 계정/권한관리 > 사용자 인증 정책 관리" <?php if($wr_1=='통합인증, 계정/권한관리 > 사용자 인증 정책 관리')echo"selected"; ?>>통합인증, 계정/권한관리 > 사용자 인증 정책 관리</option>
						<option value="통합인증, 계정/권한관리 > SSO/EAM/IM" <?php if($wr_1=='통합인증, 계정/권한관리 > SSO/EAM/IM')echo"selected"; ?>>통합인증, 계정/권한관리 > SSO/EAM/IM</option>
						<option value="데이터 암호화 > 통합 키 관리" <?php if($wr_1=='데이터 암호화 > 통합 키 관리')echo"selected"; ?>>데이터 암호화 > 통합 키 관리</option>
						<option value="데이터 암호화 > 비정형데이터 암호화" <?php if($wr_1=='데이터 암호화 > 비정형데이터 암호화')echo"selected"; ?>>데이터 암호화 > 비정형데이터 암호화</option>
						<option value="데이터 암호화 > 정형데이터 암호화" <?php if($wr_1=='데이터 암호화 > 정형데이터 암호화')echo"selected"; ?>>데이터 암호화 > 정형데이터 암호화</option>
						<option value="데이터 암호화 > 이메일 보안" <?php if($wr_1=='데이터 암호화 > 이메일 보안')echo"selected"; ?>>데이터 암호화 > 이메일 보안</option>
						<option value="데이터 암호화 > 전문통신 데이터 암호화" <?php if($wr_1=='데이터 암호화 > 전문통신 데이터 암호화')echo"selected"; ?>>데이터 암호화 > 전문통신 데이터 암호화</option>
						<option value="스마트시티 플랫폼 > NFLUX (스마트시티 관제 솔루션)" <?php if($wr_1=='스마트시티 플랫폼 > NFLUX (스마트시티 관제 솔루션)')echo"selected"; ?>>스마트시티 플랫폼 > NFLUX (스마트시티 관제 솔루션)</option>
						<option value="모바일 보안 > 모바일 웹 기반 전자서명" <?php if($wr_1=='모바일 보안 > 모바일 웹 기반 전자서명')echo"selected"; ?>>모바일 보안 > 모바일 웹 기반 전자서명</option>
						<option value="모바일 보안 > 모바일 앱 기반 공인인증/암호화" <?php if($wr_1=='모바일 보안 > 모바일 앱 기반 공인인증/암호화')echo"selected"; ?>>모바일 보안 > 모바일 앱 기반 공인인증/암호화</option>
						<option value="모바일 보안 > 가상키보드 보안" <?php if($wr_1=='모바일 보안 > 가상키보드 보안')echo"selected"; ?>>모바일 보안 > 가상키보드 보안</option>
						<option value="모바일 보안 > 모바일 앱 위변조 방지" <?php if($wr_1=='모바일 보안 > 모바일 앱 위변조 방지')echo"selected"; ?>>모바일 보안 > 모바일 앱 위변조 방지</option>
						<option value="모바일 보안 > 인증서 중계 시스템" <?php if($wr_1=='모바일 보안 > 인증서 중계 시스템')echo"selected"; ?>>모바일 보안 > 인증서 중계 시스템</option>
						<option value="파트너 제품 > Clarity(오픈소스 보안)" <?php if($wr_1=='파트너 제품 > Clarity(오픈소스 보안)')echo"selected"; ?>>파트너 제품 > Clarity(오픈소스 보안)</option>
						<option value="파트너 제품 > AppCheck(랜섬웨어)" <?php if($wr_1=='파트너 제품 > AppCheck(랜섬웨어)')echo"selected"; ?>>파트너 제품 > AppCheck(랜섬웨어)</option>
						<option value="파트너 제품 > THALES(HSM)" <?php if($wr_1=='파트너 제품 > THALES(HSM)'); ?>>파트너 제품 > THALES(HSM)</option>
						<option value="파트너 제품 > Kaspersky Lab(백신)" <?php if($wr_1=='파트너 제품 > Kaspersky Lab(백신)')echo"selected"; ?>>파트너 제품 > Kaspersky Lab(백신)</option>
						<option value="파트너 제품 > Splunk(SIEM&Security)" <?php if($wr_1=='파트너 제품 > Splunk(SIEM&Security)')echo"selected"; ?>>파트너 제품 > Splunk(SIEM&Security)</option>
						<option value="파트너 제품 > DigiCert(SSL인증서)" <?php if($wr_1=='파트너 제품 > DigiCert(SSL인증서)')echo"selected"; ?>>파트너 제품 > DigiCert(SSL인증서)</option>
						<option value="파트너 제품 > Blancco(영구 삭제)" <?php if($wr_1=="파트너 제품 > Blancco(영구 삭제)")echo"selected"; ?>>파트너 제품 > Blancco(영구 삭제)</option>
						<option value="파트너 제품 > SecuLetter(Exploit공격)" <?php if($wr_1=="파트너 제품 > SecuLetter(Exploit공격)")echo"selected"; ?>>파트너 제품 > SecuLetter(Exploit공격)</option>
						<option value="기타" <?php if($wr_1=="기타")echo"selected"; ?>>기타</option>
		                </select>
			</td>
		        </tr> -->

        <tr>
            <th scope="row"><label for="wr_name">이름 <span class="req">*</span></label></th>
            <td>
				<input type="text" name="wr_name" value="<?php if($member['mb_name']) echo $member['mb_name'] ?>" id="wr_name" required class="frm_input" style="max-width: 355px;">
			</td>
        </tr>

		<!-- <tr>
		            <th scope="row"><label for="wr_2">산업구분 <span class="req">*</span></label></th>
		            <td><input type="text" name="wr_2" value="<?php echo $wr_2 ?>" id="wr_2" required class="frm_input"></td>
		        </tr> -->

		<!-- <tr>
		            <th scope="row"><label for="wr_3">이름<span class="req">*</span></label></th>
		            <td>
				<input type="text" name="wr_3" value="<?php echo $wr_3 ?>" id="wr_3" required class="frm_input" placeholder="이름">
			</td>
		        </tr> -->

		<!-- <tr>
		            <th scope="row"><label for="wr_5">부서/팀명 <span class="req">*</span></label></th>
		            <td>
				<input type="text" name="wr_5" value="<?php echo $wr_5 ?>" id="wr_5" required class="frm_input half_input" placeholder="부서">
				<input type="text" name="wr_6" value="<?php echo $wr_6 ?>" id="wr_6" required class="frm_input half_input" placeholder="팀">
			</td>
		        </tr> -->

		<!-- <tr>
		            <th scope="row"><label for="wr_7">직무 <span class="req">*</span></label></th>
		            <td class="td_job">
				<span>
					<input type="radio" name="wr_7" value="임원" <?php if($wr_7=="임원")echo"checked";?> id="job1" required>
					<label for="job1">임원</label> &nbsp;&nbsp;
				</span>
				<span>
					<input type="radio" name="wr_7" value="SW 개발" <?php if($wr_7=="SW 개발")echo"checked";?> id="job2" required>
					<label for="job2">SW 개발</label> &nbsp;&nbsp;
				</span>
				<span>
					<input type="radio" name="wr_7" value="HW 개발" <?php if($wr_7=="HW 개발")echo"checked";?> id="job3" required>
					<label for="job3">HW 개발</label> &nbsp;&nbsp;
				</span>
				<span>
					<input type="radio" name="wr_7" value="구매" <?php if($wr_7=="구매")echo"checked";?> id="job4" required>
					<label for="job4">구매</label> &nbsp;&nbsp;
				</span>
				<span>
					<input type="radio" name="wr_7" value="영업" <?php if($wr_7=="영업")echo"checked";?> id="job5" required>
					<label for="job5">영업</label> &nbsp;&nbsp;
				</span>
				<span>
					<input type="radio" name="wr_7" value="마케팅" <?php if($wr_7=="마케팅")echo"checked";?> id="job6" required>
					<label for="job6">마케팅</label> &nbsp;&nbsp;
				</span>
				<span>
					<input type="radio" name="wr_7" value="생산" <?php if($wr_7=="생산")echo"checked";?> id="job7" required>
					<label for="job7">생산</label> &nbsp;&nbsp;
				</span>
				<span>
					<input type="radio" name="wr_7" value="관리" <?php if($wr_7=="관리")echo"checked";?> id="job8" required>
					<label for="job8">관리</label> &nbsp;&nbsp;
				</span>
				<span>
					<input type="radio" name="wr_7" value="기획" <?php if($wr_7=="기획")echo"checked";?> id="job9" required>
					<label for="job9">기획</label> &nbsp;&nbsp;
				</span>
				<span>
					<input type="radio" name="wr_7" value="기타" <?php if($wr_7=="기타")echo"checked";?> id="job10" required>
					<label for="job10">기타</label>
				</span>
			</td>
		        </tr> -->

		<tr>
            <th scope="row"><label for="wr_email">E-mail<span class="req">*</span></label></th>
            <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" required class="frm_input email"></td>
        </tr>
		

		<tr>
            <th scope="row"><label for="wr_8">전화번호 <span class="req">*</span></label></th>
            <td><input type="text" name="wr_8" value="<?php echo $wr_8 ?>" id="wr_8" required class="frm_input"></td>
        </tr>

		<tr>
            <th scope="row"><label for="wr_9">휴대폰번호 <span class="req">*</span></label></th>
            <td><input type="text" name="wr_9" value="<?php echo $wr_9 ?>" id="wr_9" required class="frm_input"></td>
        </tr>        

		<tr>
            <th scope="row" style="padding-bottom: 80px;"><label for="wr_content">진료 및 <br>문의내용 <span class="req">*</span></label></th>
            <td class="wr_content">
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>
            </td>
        </tr>

		<?//php if ($is_password) { ?>
        <!-- <tr>
            <th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
            <td>
        			<input type="text" style="position:absolute;top:0;left:0;width:1px;height:1px;opacity:0;border:0">
        			<input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input" autocomplete="new-password" minlength="4" maxlength="8">
        			<span class="help">4~8자리 입력</span>
        			</td>
        </tr> -->
        <?//php } ?>


        <input type="hidden" name="wr_subject" value="상담문의합니다.">

        <!-- <?php for ($i=1; $is_link && $i<=1; $i++) { ?>
        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">인지경로 <span class="req">*</span></label></th>
            <td><input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input"></td>
        </tr>
        <?php } ?> -->

        <!-- <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">파일 #<?php echo $i+1 ?></th>
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
        <?php } ?> -->

        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">보안코드 <span class="req">*</span></th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

	
    <div class="write_btn_div">
		<input type="submit" value="예약하기" id="btn_submit" accesskey="s" class="btn_submit btn">
		<?php if($is_admin || $member['mb_id'] == $den_id) { 
			if($den_id) {
				$list_url = './board.php?bo_table='.$bo_table.'&den_id='.$den_id;			
			} else {
				$list_url = './board.php?bo_table='.$bo_table;
			}
			?>
        <a href="<?php echo $list_url ?>" class="btn_cancel btn">목록보기</a>
		<?php } ?>        
    </div>
    </form>

	<script>
	$(function() {
		$("input[name=wr_8], input[name=wr_9]").keyup(function(){
			var val= $(this).val();
			if(val != "") {
				if(val.replace(/[0-9\-]/g, "").length > 0) {
					alert("연락처는 숫자나 하이픈(-)만 입력해 주십시오.");
					$(this).val("");
				}
			}
		});
	});
	</script>
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
		if (!f.agree.checked) {
            alert("개인정보 수집 안내에 동의해주세요.");
            f.agree.focus();
            return false;
        }

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