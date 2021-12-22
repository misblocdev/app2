<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<!-- 기업 회원가입 -->
<!-- 회원정보 입력/수정 시작 { -->

<div class="register">
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
<script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo G5_JS_VER; ?>"></script>
<?php } ?>

	<form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="mb_10" value="<?php echo $member['mb_10'] ? $member['mb_10'] : $mb_10;?>">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="agree" value="<?php echo $agree ?>">
	<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
	<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
	<input type="hidden" name="cert_no" value="">
	<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
	<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
	<input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
	<input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
	<?php }  ?>

	<input type="hidden" name="mb_sms" value="1" id="reg_mb_sms" <?php echo ($w=='' || $member['mb_sms'])?'checked':''; ?>>
	<input type="hidden" name="mb_mailling" value="1" id="reg_mb_mailling" <?php echo ($w=='' || $member['mb_mailling'])?'checked':''; ?>>
	
	<h1 class="dental_h"><span>아나파톡 병원</span> <?php echo $g5['title'];?></h1>
	<p class="dental_p">아나파톡 서비스를 위해 개인 기본정보를 입력해주세요</p>
	
	<div id="register_form" class="form_01">   
	    <div class="register_form_inner register_form_inner1">
	        <h2 class="sound_only">사이트 이용정보 입력</h2>
	        <ul>
	            <li>
	                <label for="reg_mb_id">
	                	아이디*<strong class="sound_only">필수</strong>
	                	<!-- <button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
						<span class="tooltip">영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요.</span> -->
	                </label>
	                <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="frm_input full_input <?php echo $readonly ?>" minlength="3" maxlength="20" placeholder="아이디를 입력하세요">
	                <span id="msg_mb_id"></span>
	            </li>

				<li>
	                <label for="reg_mb_hp">휴대폰번호*<strong class="sound_only">필수</strong></label>
	                
	                <input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" required class="frm_input full_input" maxlength="20" placeholder="휴대폰번호를 입력해주세요">
	                <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
	                <input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
	                <?php } ?>
	            </li>
	
	            <li>
	                <label for="reg_mb_email">이메일*<strong class="sound_only">필수</strong></label>
	                <input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
	                <input type="text" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="frm_input email full_input" size="70" maxlength="100" placeholder="이메일을 입력하세요">
	            
	            </li>

	            <li class="">
	                <label for="reg_mb_password">비밀번호*<strong class="sound_only">필수</strong></label>
	                <input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="frm_input full_input" minlength="3" maxlength="20" placeholder="영문, 숫자 포함 8-20자 입력">
				</li>
	            <li class="">
	                <label for="reg_mb_password_re">비밀번호 확인*<strong class="sound_only">필수</strong></label>
	                <input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="frm_input full_input" minlength="3" maxlength="20" placeholder="입력한 비밀번호를 입력하세요">
	            </li>
	        </ul>
	    </div>
	
	    <div class="tbl_frm01 tbl_wrap register_form_inner register_form_inner1">
			<?php
			$sql = " select * from g5_write_dental where wr_code = '{$member['mb_id']}' ";
			$row = sql_fetch($sql);
			$file = get_file('dental', $row['wr_id']);
			?>
	        <h2 class="sound_only">기업정보 입력</h2>
	        <ul>
	            <li> 
	                <label for="reg_wr_subject">상호*</label>
	                <input type="text" name="wr_subject" value="<?php echo get_text($row['wr_subject']) ?>" id="reg_wr_subject" required class="frm_input full_input" size="70" maxlength="255" placeholder="상호명을 입력하세요">
	                <input type="hidden" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name">
					<script type="text/javascript">

					$(document).ready(function(){

						$("#reg_wr_subject").keyup(function(){

							$("#reg_mb_name").val($("#reg_wr_subject").val());
						});

					});

					</script>
	            </li>
	            <li>
	                <label for="reg_wr_business">사업자 번호*</label>
	                <input type="text" name="wr_business" value="<?php echo get_text($row['wr_business']) ?>" id="reg_wr_business" required class="frm_input full_input" size="70" maxlength="25" placeholder="사업자 번호를 입력하세요">
	            </li>
	            <li>
	                <label for="reg_wr_content">설명글(25자이내)*</label>
	                <input type="text" name="wr_content" value="<?php echo get_text($row['wr_content']) ?>" id="reg_wr_content" required class="frm_input full_input" size="70" maxlength="25" placeholder="간단한 설명글을 입력하세요">
	            </li>
	            <li>
	                <label for="reg_ca_name">전문분야(최대 3개)*</label>
					<div class="cate">
	                <?php 
					$ca = sql_fetch(" select * from g5_board where bo_table = 'dental' ");
					$caname = explode('|', $ca['bo_category_list']);
					for($i = 0 ; $i < count($caname) ; $i++) { ?>
						<input type="checkbox" value="<?php echo $caname[$i]?>" id="caname<?php echo $i+1?>" name="ca_list" class="selec_chk" onclick="open_pop(<?php echo $i+1?>)"><label for="caname<?php echo $i+1?>"><span><?php echo $caname[$i]?></span></label>
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
							for($j = 0 ; $j < count($casub) ; $j++) { ?>
								<input type="checkbox" value="<?php echo $casub[$j]?>" id="casub<?php echo $i+1?>_<?php echo $j+1?>" name="casub<?php echo $i+1?>_list" class="selec_chk" onclick="check_sub(this.id, <?php echo $i+1?>)"><label for="casub<?php echo $i+1?>_<?php echo $j+1?>"><span></span><?php echo $casub[$j]?></label>
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
					<input type="hidden" name="ca_name" value="<?php echo $row['ca_name'];?>">
					<input type="hidden" name="wr_11" value="<?php echo $row['wr_11'];?>">
	            </li>
	            <?php if ($req_nick) { ?>
	            <li style="display: none;">
	                <label for="reg_mb_nick">
	                	닉네임
	                	<button type="button" class="tooltip_icon"><i class="fa fa-question-circle-o" aria-hidden="true"></i><span class="sound_only">설명보기</span></button>
						<span class="tooltip">공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상)<br> 닉네임을 바꾸시면 앞으로 <?php echo (int)$config['cf_nick_modify'] ?>일 이내에는 변경 할 수 없습니다.</span>
	                </label>
	                
                    <input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
                    <input type="text" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>" id="reg_mb_nick" class="frm_input nospace full_input" size="10" maxlength="20" placeholder="닉네임">
                    <span id="msg_mb_nick"></span>	                
	            </li>
				<script type="text/javascript">

				$(document).ready(function(){

					$("#reg_mb_id").keyup(function(){

						$("#reg_mb_nick").val($("#reg_mb_id").val());
					});

				});

				</script>
	            <?php }  ?>
	
	            <?php if ($config['cf_use_homepage']) {  ?>
	            <li>
	                <label for="reg_mb_homepage">홈페이지<?php if ($config['cf_req_homepage']){ ?><strong class="sound_only">필수</strong><?php } ?></label>
	                <input type="text" name="mb_homepage" value="<?php echo get_text($member['mb_homepage']) ?>" id="reg_mb_homepage" <?php echo $config['cf_req_homepage']?"required":""; ?> class="frm_input full_input <?php echo $config['cf_req_homepage']?"required":""; ?>" size="70" maxlength="255" placeholder="홈페이지">
	            </li>
	            <?php }  ?>
	
	            <!-- <li>
	            <?php if ($config['cf_use_tel']) {  ?>
	            
	                <label for="reg_mb_tel">전화번호<?php if ($config['cf_req_tel']) { ?><strong class="sound_only">필수</strong><?php } ?></label>
	                <input type="text" name="mb_tel" value="<?php echo get_text($member['mb_tel']) ?>" id="reg_mb_tel" <?php echo $config['cf_req_tel']?"required":""; ?> class="frm_input full_input <?php echo $config['cf_req_tel']?"required":""; ?>" maxlength="20" placeholder="전화번호">
	            <?php }  ?>
	            				</li> -->
	
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
	                <input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
	            </li>	
	            <?php }  ?>
	            <li>
	                <label for="wr_3">운영시간*</label>
					<div class="time clearfix">
						<label for="wr_3">평일 : </label><input type="text" name="wr_3" value="<?php echo $row['wr_3'];?>" id="wr_3" class="frm_input" size="50" required placeholder="평일 운영시간을 입력하세요">
						<label for="wr_5">야간 : </label><input type="text" name="wr_5" value="<?php echo $row['wr_5'];?>" id="wr_5" class="frm_input" size="50" placeholder="야간 운영시간을 입력하세요">
						<?php
						$wr_4_array = explode("|", $row['wr_4']); // 구분자가 | 로 되어 있음				
						?>
						<div class="chk_box">
							<input type="checkbox" name="wr_4_day" value="월" id="wr_41" <?php if (in_array('월', $wr_4_array)) { echo 'checked';} ?> class="selec_chk"> <label for="wr_41"><span></span>월</label> 
							<input type="checkbox" name="wr_4_day" value="화" id="wr_42" <?php if (in_array('화', $wr_4_array)) { echo 'checked';} ?> class="selec_chk"> <label for="wr_42"><span></span>화</label> 
							<input type="checkbox" name="wr_4_day" value="수" id="wr_43" <?php if (in_array('수', $wr_4_array)) { echo 'checked';} ?> class="selec_chk"> <label for="wr_43"><span></span>수</label> 
							<input type="checkbox" name="wr_4_day" value="목" id="wr_44" <?php if (in_array('목', $wr_4_array)) { echo 'checked';} ?> class="selec_chk"> <label for="wr_44"><span></span>목</label> 
							<input type="checkbox" name="wr_4_day" value="금" id="wr_45" <?php if (in_array('금', $wr_4_array)) { echo 'checked';} ?> class="selec_chk"> <label for="wr_45"><span></span>금</label>
							<input type="hidden" name="wr_4" value="<?php echo $row['wr_4'];?>">
						</div>
						<label for="wr_6">점심 : </label><input type="text" name="wr_6" value="<?php echo $row['wr_6'];?>" id="wr_6" class="frm_input" size="50" placeholder="점심시간을 입력하세요">
						<label for="wr_7">토요일 : </label><input type="text" name="wr_7" value="<?php echo $row['wr_7'];?>" id="wr_7" class="frm_input" size="50" placeholder="토요일 운영시간을 입력하세요">
					</div>
	            </li>
	            <li>
	                <label for="wr_8">연락처*</label>
	                <input type="text" name="wr_8" value="<?php echo $row['wr_8'];?>" id="wr_8" class="frm_input" size="50" required placeholder="연락처를 입력하세요">
	            </li>
	            <li>
	                <label for="wr_1">원장님*</label>
	                <input type="text" name="wr_1" value="<?php echo $row['wr_1'];?>" id="wr_1" class="frm_input" size="50" required placeholder="원장님 성함을 입력하세요">
	            </li>
	            <li>
	                <label for="bf_file_1">원장님 사진</label>
					<div class="filebox">
						<input class="upload-name upload-name-1 frm_input full_input" value="<?php if($w == 'u') echo $file[0]['bf_content'];?>" disabled="disabled"> 
						<label for="bf_file_1" class="frm_label_btn">파일첨부</label> 
						<input type="file" id="bf_file_1" class="upload-hidden upload-hidden-1" name="bf_file[1]"> 
					</div>
	            </li>
	            <li>
	                <label for="wr_12">원장님 이력</label>
					<textarea name="wr_12" value="<?php echo $row['wr_12'];?>" id="wr_12" class="frm_input" cols="30" rows="10" placeholder="원장님 이력을 입력하세요"></textarea>
	            </li>
	            <li>
	                <label for="bf_file_0">병원 대표이미지</label>
					<div class="filebox">
						<input class="upload-name upload-name-0 frm_input full_input" value="<?php if($w == 'u') echo $file[1]['bf_content'];?>" disabled="disabled"> 
						<label for="bf_file_0" class="frm_label_btn">파일첨부</label> 
						<input type="file" id="bf_file_0" class="upload-hidden upload-hidden-0" name="bf_file[0]"> 
					</div>
	            </li>
				<?php for($i = 2 ; $i < 12 ; $i++){?>
	            <li>
	                <label for="bf_file_<?php echo $i?>">병원이미지 #<?php echo $i-1?></label>
					<div class="filebox">
						<input class="upload-name upload-name-<?php echo $i?> frm_input full_input" value="<?php if($w == 'u') echo $file[$i]['bf_content'];?>" disabled="disabled"> 
						<label for="bf_file_<?php echo $i?>" class="frm_label_btn">파일첨부</label> 
						<input type="file" id="bf_file_<?php echo $i?>" class="upload-hidden upload-hidden-<?php echo $i?>" name="bf_file[<?php echo $i;?>]"> 
					</div>
	            </li>
				<?php }?>
	            <li class="chk_box reg_chk">
	                <label for="wr_9">주차 시설</label>
					<input type="checkbox" name="wr_9" value="1" id="wr_9" <?php if ($row['wr_9'] == 1) { echo 'checked';} ?> class="selec_chk"><label for="wr_9"><span></span></label>
	            </li>
	            <li class="chk_box reg_chk">
	                <label for="wr_10">가맹점</label>
					<input type="checkbox" name="wr_10" value="1" id="wr_10" <?php if ($row['wr_10'] == 1) { echo 'checked';} ?> class="selec_chk"><label for="wr_10"><span></span></label>
	            </li>
	        </ul>
	    </div>
	</div>
	<div class="btn_confirm">
	    <button type="submit" id="btn_submit" class="btn_submit" accesskey="s"><?php echo $w==''?'회원가입':'정보수정'; ?></button>
	    <a href="<?php echo G5_URL ?>" class="btn_close">취소</a>
	</div>
	</form>
</div>
<script>
$(function() {
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

    $("#reg_zip_find").css("display", "inline-block");

    <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
    // 아이핀인증
    $("#win_ipin_cert").click(function() {
        if(!cert_confirm())
            return false;

        var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
        certify_win_open('kcb-ipin', url);
        return;
    });

    <?php } ?>
    <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
    // 휴대폰인증
    $("#win_hp_cert").click(function() {
        if(!cert_confirm())
            return false;

        <?php
        switch($config['cf_cert_hp']) {
            case 'kcb':
                $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                $cert_type = 'kcb-hp';
                break;
            case 'kcp':
                $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                $cert_type = 'kcp-hp';
                break;
            case 'lg':
                $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                $cert_type = 'lg-hp';
                break;
            default:
                echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                echo 'return false;';
                break;
        }
        ?>

        certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
        return;
    });
    <?php } ?>
});

// submit 최종 폼체크
function fregisterform_submit(f)
{
    // 회원아이디 검사
    if (f.w.value == "") {
        var msg = reg_mb_id_check();
        if (msg) {
            alert(msg);
            f.mb_id.select();
            return false;
        }
    }

    if (f.w.value == "") {
        if (f.mb_password.value.length < 3) {
            alert("비밀번호를 3글자 이상 입력하십시오.");
            f.mb_password.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        alert("비밀번호가 같지 않습니다.");
        f.mb_password_re.focus();
        return false;
    }

    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 3) {
            alert("비밀번호를 3글자 이상 입력하십시오.");
            f.mb_password_re.focus();
            return false;
        }
    }

    <?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
    // 본인확인 체크
    if(f.cert_no.value=="") {
        alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
        return false;
    }
    <?php } ?>

    // 닉네임 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
        var msg = reg_mb_nick_check();
        if (msg) {
            alert(msg);
            f.reg_mb_nick.select();
            return false;
        }
    }

    // E-mail 검사
    if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
        var msg = reg_mb_email_check();
        if (msg) {
            alert(msg);
            f.reg_mb_email.select();
            return false;
        }
    }

    <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
    // 휴대폰번호 체크
    var msg = reg_mb_hp_check();
    if (msg) {
        alert(msg);
        f.reg_mb_hp.select();
        return false;
    }
    <?php } ?>

    if (typeof f.mb_icon != "undefined") {
        if (f.mb_icon.value) {
            if (!f.mb_icon.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                alert("회원아이콘이 이미지 파일이 아닙니다.");
                f.mb_icon.focus();
                return false;
            }
        }
    }

    if (typeof f.mb_img != "undefined") {
        if (f.mb_img.value) {
            if (!f.mb_img.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                alert("회원이미지가 이미지 파일이 아닙니다.");
                f.mb_img.focus();
                return false;
            }
        }
    }

    if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
        if (f.mb_id.value == f.mb_recommend.value) {
            alert("본인을 추천할 수 없습니다.");
            f.mb_recommend.focus();
            return false;
        }

        var msg = reg_mb_recommend_check();
        if (msg) {
            alert(msg);
            f.mb_recommend.select();
            return false;
        }
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

	//console.log(day + cate + catesub);
	//return false;

    <?php echo chk_captcha_js();  ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

jQuery(function($){
	//tooltip
    $(document).on("click", ".tooltip_icon", function(e){
        $(this).next(".tooltip").fadeIn(400).css("display","inline-block");
    }).on("mouseout", ".tooltip_icon", function(e){
        $(this).next(".tooltip").fadeOut();
    });
});

</script>

<!-- } 회원정보 입력/수정 끝 -->