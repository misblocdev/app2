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

    <div id="register_form" class="form_01"> 
        <div class="tbl_frm01 tbl_wrap register_form_inner register_form_inner1">
	        <h2 class="sound_only">기업정보 입력</h2>
	        <ul>
	            <li> 
	                <label for="reg_wr_subject">상호*</label>
	                <input type="text" name="wr_subject" value="<?php echo get_text($write['wr_subject']) ?>" id="reg_wr_subject" required class="frm_input full_input" size="70" maxlength="255" placeholder="상호명을 입력하세요">
	            </li>
	            <li>
	                <label for="reg_wr_business">사업자 번호*</label>
	                <input type="text" name="wr_business" value="<?php echo get_text($write['wr_business']) ?>" id="reg_wr_business" <?php echo $is_admin ? '' : 'required';?> class="frm_input full_input" size="70" maxlength="25" placeholder="사업자 번호를 입력하세요">
	            </li>
	            <li>
	                <label for="reg_wr_content">설명글(25자이내)*</label>
	                <input type="text" name="wr_content" value="<?php echo get_text($write['wr_content']) ?>" id="reg_wr_content" <?php echo $is_admin ? '' : 'required';?> class="frm_input full_input" size="70" maxlength="25" placeholder="간단한 설명글을 입력하세요">
	            </li>
	            <li>
	                <label for="reg_ca_name">전문분야(최대 3개)*</label>
					<div class="cate">
	                <?php 
					$ca = sql_fetch(" select * from g5_board where bo_table = 'dental' ");
					$caname = explode('|', $ca['bo_category_list']);
					$calist = explode("|", $write['ca_name']);
					for($i = 0 ; $i < count($caname) ; $i++) { ?>
						<input type="checkbox" value="<?php echo $caname[$i]?>" id="caname<?php echo $i+1?>" name="ca_list" class="selec_chk" onclick="open_pop(<?php echo $i+1?>)" <?php if (in_array($caname[$i], $calist)) echo ' checked'; ?>><label for="caname<?php echo $i+1?>"><span><?php echo $caname[$i]?></span></label>
					<?php }
					?>
					</div>
					<div class="cate_pop">
	                <?php 
					for($i = 0 ; $i < 12 ; $i++) { ?>
						<div class="cate_pop_<?php echo $i+1?>">
							<h3><?php echo $caname[$i];?></h3>
							<a href="javascript:;" class="close_cate_pop"><img src="/images/close_pop.png" alt="팝업 닫기"></a>
							<?php
							$casub = explode(', ', $ca['bo_'.($i+1)]);
							$casublist = explode("|", $write['wr_11']);
							for($j = 0 ; $j < count($casub) ; $j++) { ?>
								<input type="checkbox" value="<?php echo $casub[$j]?>" id="casub<?php echo $i+1?>_<?php echo $j+1?>" name="casub<?php echo $i+1?>_list" class="selec_chk" onclick="check_sub(this.id, <?php echo $i+1?>)" <?php if (in_array($casub[$i], $casublist)) echo ' checked'; ?>><label for="casub<?php echo $i+1?>_<?php echo $j+1?>"><span></span><?php echo $casub[$j]?></label>
							<?php }?>
						</div>
					<?php }
					?>					
					</div>
					<script>
					var total = 0;

					// 세부분야 열기
					function open_pop(num) {
						var checked = $('#caname' + num).is(':checked');
						if(!checked)
							$('#caname' + num).prop('checked',true);
						else
							$('#caname' + num).prop('checked',false);
						$(".cate_pop").show();
						$(".cate_pop_" + num).show();
					}
						
					// 세부분야 닫기
					$(document).mouseup(function (e){
						var container = $(".cate_pop");
						if( container.has(e.target).length === 0) {
						container.hide();
						$(".cate_pop > div").hide();
						}
					});

					// 세부분야 닫기
					$('.close_cate_pop').click(function(){
						$(".cate_pop").hide();
						$(".cate_pop > div").hide();
					});

					// 세부분야 선택시
					function check_sub(e, num) {						
						$('#' + e).is(':checked') ? total++ : total--;

						if(total > 3) {
							alert('전문분야는 최대 3개까지 선택 가능합니다.');
							$('#' + e).prop('checked',false);
							total--;
							return false;
						}

						var chk = $("input[name='casub" + num + "_list']:checked").length;
						var checked = $('#caname' + num).is(':checked');
						if(!checked) {
							$('#caname' + num).prop('checked',true);
						} else {
							if(chk > 0) {
								$('#caname' + num).prop('checked',true);
							} else {
								$('#caname' + num).prop('checked',false);							
							}
						}
					}
					</script>
					<input type="hidden" name="ca_name" value="<?php echo $write['ca_name'];?>">
					<input type="hidden" name="wr_11" value="<?php echo $write['wr_11'];?>">
	            </li>
	
	            <?php if ($config['cf_use_addr']) { ?>
	            <li class="reg_addr">
	            	<label>주소</label>
					<?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php }  ?>
					<label for="wr_zip" class="sound_only">우편번호<strong class="sound_only">필수</strong></label>
					<input type="hidden" name="wr_zip" value="<?php echo $write['wr_zip'] ? $write['wr_zip'] : $member['mb_zip1'].$member['mb_zip2']; ?>" id="wr_zip" class="frm_input twopart_input" size="5" maxlength="6"  placeholder="우편번호">
	                <button type="button" class="btn_frmline" onclick="win_zip('fregisterform', 'wr_zip', 'wr_2', 'wr_2_1', 'mb_addr_jibeon');">주소 검색</button>
	            </li>
	            <li>
	                <label for="wr_2">기본주소</label>
	                <input type="text" name="wr_2" value="<?php echo get_text($write['wr_2'] ? $write['wr_2'] : $member['mb_addr2']) ?>" id="wr_2" class="frm_input frm_address full_input" size="50"  placeholder="시, 구, 동을 입력하세요">
	            </li>
	            <li>
	                <label for="wr_2_1">상세주소</label>
	                <input type="text" name="wr_2_1" value="<?php echo get_text($write['wr_2_1'] ? $write['wr_2_1'] : $member['mb_addr2']) ?>" id="wr_2_1" class="frm_input frm_address full_input" size="50" placeholder="상세주소를 입력하세요">
	                <input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($write['mb_addr_jibeon']); ?>">
	            </li>	
	            <?php }  ?>
	            <li>
	                <label for="wr_3">운영시간*</label>
					<div class="time clearfix">
						<label for="wr_3">평일 : </label><input type="text" name="wr_3" value="<?php echo $write['wr_3'];?>" id="wr_3" class="frm_input" size="50" required placeholder="평일 운영시간을 입력하세요">
						<label for="wr_5">야간 : </label><input type="text" name="wr_5" value="<?php echo $write['wr_5'];?>" id="wr_5" class="frm_input" size="50" placeholder="야간 운영시간을 입력하세요">
						<?php
						$wr_4_array = explode("|", $write['wr_4']); // 구분자가 | 로 되어 있음				
						?>
						<div class="chk_box">
							<input type="checkbox" name="wr_4_day" value="월" id="wr_41" <?php if (in_array('월', $wr_4_array)) { echo 'checked';} ?> class="selec_chk"> <label for="wr_41"><span></span>월</label> 
							<input type="checkbox" name="wr_4_day" value="화" id="wr_42" <?php if (in_array('화', $wr_4_array)) { echo 'checked';} ?> class="selec_chk"> <label for="wr_42"><span></span>화</label> 
							<input type="checkbox" name="wr_4_day" value="수" id="wr_43" <?php if (in_array('수', $wr_4_array)) { echo 'checked';} ?> class="selec_chk"> <label for="wr_43"><span></span>수</label> 
							<input type="checkbox" name="wr_4_day" value="목" id="wr_44" <?php if (in_array('목', $wr_4_array)) { echo 'checked';} ?> class="selec_chk"> <label for="wr_44"><span></span>목</label> 
							<input type="checkbox" name="wr_4_day" value="금" id="wr_45" <?php if (in_array('금', $wr_4_array)) { echo 'checked';} ?> class="selec_chk"> <label for="wr_45"><span></span>금</label>
							<input type="hidden" name="wr_4" value="<?php echo $write['wr_4'];?>">
						</div>
						<label for="wr_6">점심 : </label><input type="text" name="wr_6" value="<?php echo $write['wr_6'];?>" id="wr_6" class="frm_input" size="50" placeholder="점심시간을 입력하세요">
						<label for="wr_7">토요일 : </label><input type="text" name="wr_7" value="<?php echo $write['wr_7'];?>" id="wr_7" class="frm_input" size="50" placeholder="토요일 운영시간을 입력하세요">
					</div>
	            </li>
	            <li>
	                <label for="wr_8">연락처*</label>
	                <input type="text" name="wr_8" value="<?php echo $write['wr_8'];?>" id="wr_8" class="frm_input" size="50" <?php echo $is_admin ? '' : 'required';?> placeholder="연락처를 입력하세요">
	            </li>
	            <li>
	                <label for="wr_1">원장님*</label>
	                <input type="text" name="wr_1" value="<?php echo $write['wr_1'];?>" id="wr_1" class="frm_input" size="50" <?php echo $is_admin ? '' : 'required';?> placeholder="원장님 성함을 입력하세요">
	            </li>
	            <li>
	                <label for="bf_file_1">원장님 사진</label>
					<div class="filebox">
						<input class="upload-name upload-name-1 frm_input full_input" value="<?php if($w == 'u') echo $file[1]['source'];?>" disabled="disabled"> 
						<label for="bf_file_1" class="frm_label_btn">파일첨부</label> 
						<input type="file" id="bf_file_1" class="upload-hidden upload-hidden-1" name="bf_file[1]"> 
						<?php if($w == 'u' && $file[1]['file']) { ?>
						<div class="chk_box">
							<input type="checkbox" id="bf_file_del1" name="bf_file_del[1]" value="1" class="selec_chk"> <label for="bf_file_del1"><span></span> <?php echo $file[1]['source'].'('.$file[1]['size'].')';  ?> 파일 삭제</label>
						</div>
						<?php } ?>
					</div>
	            </li>
	            <li>
	                <label for="wr_12">원장님 이력</label>
					<textarea name="wr_12" value="<?php echo $write['wr_12'];?>" id="wr_12" class="frm_input" cols="30" rows="10" placeholder="원장님 이력을 입력하세요"></textarea>
	            </li>
	            <li>
	                <label for="bf_file_0">병원 대표이미지</label>
					<div class="filebox">
						<input class="upload-name upload-name-0 frm_input full_input" value="<?php if($w == 'u') echo $file[0]['source'];?>" disabled="disabled"> 
						<label for="bf_file_0" class="frm_label_btn">파일첨부</label> 
						<input type="file" id="bf_file_0" class="upload-hidden upload-hidden-0" name="bf_file[0]">  
						<?php if($w == 'u' && $file[0]['file']) { ?>
						<div class="chk_box">
							<input type="checkbox" id="bf_file_del0" name="bf_file_del[0]" value="1" class="selec_chk"> <label for="bf_file_del0"><span></span> <?php echo $file[0]['source'].'('.$file[0]['size'].')';  ?> 파일 삭제</label>
						</div>
						<?php } ?>
					</div>
	            </li>
				<?php for($i = 2 ; $i < 12 ; $i++){?>
	            <li>
	                <label for="bf_file_<?php echo $i?>">병원이미지 #<?php echo $i-1?></label>
					<div class="filebox">
						<input class="upload-name upload-name-<?php echo $i?> frm_input full_input" value="<?php if($w == 'u') echo $file[$i]['source'];?>" disabled="disabled"> 
						<label for="bf_file_<?php echo $i?>" class="frm_label_btn">파일첨부</label> 
						<input type="file" id="bf_file_<?php echo $i?>" class="upload-hidden upload-hidden-<?php echo $i?>" name="bf_file[<?php echo $i;?>]">
						<?php if($w == 'u' && $file[$i]['file']) { ?>
						<div class="chk_box">
							<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1" class="selec_chk"> <label for="bf_file_del<?php echo $i ?>"><span></span> <?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
						</div>
						<?php } ?>
					</div>
	            </li>
				<?php }?>
	            <li class="chk_box reg_chk">
	                <label for="wr_9">주차 시설</label>
					<input type="checkbox" name="wr_9" value="1" id="wr_9" <?php if ($write['wr_9'] == 1) { echo 'checked';} ?> class="selec_chk"><label for="wr_9"><span></span></label>
	            </li>
	            <li class="chk_box reg_chk">
	                <label for="wr_10">가맹점</label>
					<input type="checkbox" name="wr_10" value="1" id="wr_10" <?php if ($write['wr_10'] == 1) { echo 'checked';} ?> class="selec_chk"><label for="wr_10"><span></span></label>
	            </li>
	        </ul>
	    </div>
    </div>

    <div class="btn_confirm">
      <span class="jbutton large black"><input type="submit" value="작성완료" id="btn_submit" accesskey="s" /></span>
      <span class="jbutton large black"><a href="./board.php?bo_table=<?php echo $bo_table ?>">취소</a></span>    </div>
  </form>

    <script>
	$('.filebox .upload-hidden-0').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-0').val(filename); 
	}); 

	$('.filebox .upload-hidden-1').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-1').val(filename); 
	}); 

	$('.filebox .upload-hidden-2').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-2').val(filename); 
	}); 

	$('.filebox .upload-hidden-3').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-3').val(filename); 
	}); 

	$('.filebox .upload-hidden-4').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-4').val(filename); 
	}); 

	$('.filebox .upload-hidden-5').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-5').val(filename); 
	}); 

	$('.filebox .upload-hidden-6').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-6').val(filename); 
	}); 

	$('.filebox .upload-hidden-7').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-7').val(filename); 
	}); 

	$('.filebox .upload-hidden-8').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-8').val(filename); 
	}); 

	$('.filebox .upload-hidden-9').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-9').val(filename); 
	}); 

	$('.filebox .upload-hidden-10').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-10').val(filename); 
	}); 

	$('.filebox .upload-hidden-11').on('change', function(){ 
		if(window.FileReader){ 
			var filename = $(this)[0].files[0].name; 
		} else { 
			var filename = $(this).val().split('/').pop().split('\\').pop();
		} 
		$('.upload-name-11').val(filename); 
	}); 

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

		var day = ''; // 야간 시간 선택
		$("input[name='wr_4_day']:checked").each(function() { 
			if( day == '' ) {
				day = $(this).val();
			} else {
				day = day + '|' + $(this).val();
			}
		});
		$('input[name="wr_4"]').val(day);

		var cate = ''; // 전문분야 선택
		$(".cate input[type='checkbox']:checked").each(function() { 
			if( cate == '' ) {
				cate = $(this).val();
			} else {
				cate = cate + '|' + $(this).val();
			}
		});
		$('input[name="ca_name"]').val(cate);

		var catesub = ''; // 전문분야 선택
		$(".cate_pop input[type='checkbox']:checked").each(function() { 
			if( catesub == '' ) {
				catesub = $(this).val();
			} else {
				catesub = catesub + '|' + $(this).val();
			}
		});
		$('input[name="wr_11"]').val(catesub);	

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