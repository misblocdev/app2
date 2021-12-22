<?php
include_once('./munjin.head.php');

if($munjinid) {
	$sql_munjin = " select * from munjin where munjin_id = '{$munjinid}' ";
	$munjin = sql_fetch($sql_munjin);
}
?>

<div id="allwrap">
	<div id="munjinWrap">
		<h2 class="munjin_logo"><img src="/images/hd_logo.png" alt="로고"></h2>
		<div class="munjin_step">
			<div class="on_step"></div>
			<div class="off_step">
				<!-- If we need pagination -->
				<div class="swiper-pagination"></div>
			</div>
		</div>
		<div class="munjin_back">
			<a href="javascript:history.back();" class="munjin_back_btn"><img src="/images/munjin_back.png" alt="뒤로가기"></a>
			<div class="swiper-button-prev"><img src="/images/munjin_back.png" alt="뒤로가기"></div>
		</div>
		<div class="munjin_box">
			<form action="./munjin_update.php" method="post" id="munjinForm" onsubmit="return fwrite_submit(this);">
				<input type="hidden" value="일반" name="munjin_type">
				<input type="hidden" value="<?php echo $denid;?>" name="denid">
				<input type="hidden" value="<?php echo $date;?>" name="rdate">
				<input type="hidden" value="<?php echo $time;?>" name="rtime">
				<div class="munjin_form">
					<!-- Slider main container -->
					<div class="swiper">
						<!-- Additional required wrapper -->
						<div class="swiper-wrapper">
							<!-- Slides -->
							<div class="swiper-slide munjin_info">
								<h3>문진표 작성을 위해 <br/>필요한 정보를 입력해 주세요.</h3>
								<div class="munjin_div">
									<input type="text" id="munjin_name" value="<?php echo $munjin['munjin_name'] ? $munjin['munjin_name'] : $member['mb_name'];?>" name="munjin_name" placeholder="이름">
								</div>
								<div class="munjin_div">
									<input type="text" id="munjin_birth" value="<?php echo $munjin['munjin_birth'] ? $munjin['munjin_birth'] : $member['mb_birth'];?>" name="munjin_birth" placeholder="생년월일 (ex 19801220)">
								</div>
								<div class="munjin_div">
									<input type="text" id="munjin_phone" value="<?php echo $munjin['munjin_phone'] ? $munjin['munjin_phone'] : $member['mb_hp'];?>" name="munjin_phone" placeholder="휴대폰번호 입력 (- 제외)">
								</div>
								<div class="munjin_div">
									<input type="text" id="munjin_phone" value="<?php echo $munjin['munjin_phone'] ? $munjin['munjin_phone'] : $member['mb_hp'];?>" name="munjin_phone" placeholder="휴대폰번호 입력 (- 제외)">
								</div>
							</div>
							<div class="swiper-slide">
								<h3>전신질환이 있습니까? <span>(과거,현재 모두 해당됩니다.)</span></h3>
								<div class="munjin_div">
									<h4>Q1. 과거나 현재 가지고 있는 질환이 있으시면 표시해 주십시오.</h4>
									<div class="munjin_question chk_type01 munjin_chk">
									<?php $q01 = explode('/',$munjin['q01']);?>
										<input type="checkbox" value="혈압" id="q01_1" name="q01_list" class="selec_chk" <?php echo in_array("혈압",  $q01) ? 'checked' : ''?>><label for="q01_1"><span></span>혈압</label>
										<!-- <input type="checkbox" value="아스피린 복용" id="q01_2" name="q01_list" class="selec_chk"><label for="q01_2"><span></span>아스피린 복용</label>
										<input type="checkbox" value="심장질환(수술여부)" id="q01_3" name="q01_list" class="selec_chk"><label for="q01_3"><span></span>심장질환(수술여부)</label>
										<input type="checkbox" value="당뇨" id="q01_4" name="q01_list" class="selec_chk"><label for="q01_4"><span></span>당뇨</label>
										<input type="checkbox" value="간염" id="q01_5" name="q01_list" class="selec_chk"><label for="q01_5"><span></span>간염</label>
										<input type="checkbox" value="신장병" id="q01_6" name="q01_list" class="selec_chk"><label for="q01_6"><span></span>신장병</label>
										<input type="checkbox" value="위장질환" id="q01_7" name="q01_list" class="selec_chk"><label for="q01_7"><span></span>위장질환</label>
										<input type="checkbox" value="뇌졸증" id="q01_8" name="q01_list" class="selec_chk"><label for="q01_8"><span></span>뇌졸증</label>
										<input type="checkbox" value="결핵" id="q01_9" name="q01_list" class="selec_chk"><label for="q01_9"><span></span>결핵</label>
										<input type="checkbox" value="혈액투석" id="q01_10" name="q01_list" class="selec_chk"><label for="q01_10"><span></span>혈액투석</label>
										<input type="checkbox" value="갑상선" id="q01_11" name="q01_list" class="selec_chk"><label for="q01_11"><span></span>갑상선</label>
										<input type="checkbox" value="골다골증" id="q01_12" name="q01_list" class="selec_chk"><label for="q01_12"><span></span>골다골증</label>
										<input type="checkbox" value="턱관절 장애" id="q01_13" name="q01_list" class="selec_chk"><label for="q01_13"><span></span>턱관절 장애</label> -->
										<input type="checkbox" value="아스피린 복용" id="q01_2" name="q01_list" class="selec_chk" <?php echo in_array("아스피린 복용",  $q01) ? 'checked' : ''?>><label for="q01_2"><span></span>아스피린 복용</label>
										<input type="checkbox" value="심장질환(수술여부)" id="q01_3" name="q01_list" class="selec_chk" <?php echo in_array("심장질환(수술여부)",  $q01) ? 'checked' : ''?>><label for="q01_3"><span></span>심장질환(수술여부)</label>
										<input type="checkbox" value="당뇨" id="q01_4" name="q01_list" class="selec_chk" <?php echo in_array("당뇨",  $q01) ? 'checked' : ''?>><label for="q01_4"><span></span>당뇨</label>
										<input type="checkbox" value="간염" id="q01_5" name="q01_list" class="selec_chk" <?php echo in_array("간염",  $q01) ? 'checked' : ''?>><label for="q01_5"><span></span>간염</label>
										<input type="checkbox" value="신장병" id="q01_6" name="q01_list" class="selec_chk" <?php echo in_array("신장병",  $q01) ? 'checked' : ''?>><label for="q01_6"><span></span>신장병</label>
										<input type="checkbox" value="위장질환" id="q01_7" name="q01_list" class="selec_chk" <?php echo in_array("위장질환",  $q01) ? 'checked' : ''?>><label for="q01_7"><span></span>위장질환</label>
										<input type="checkbox" value="뇌졸증" id="q01_8" name="q01_list" class="selec_chk" <?php echo in_array("뇌졸증",  $q01) ? 'checked' : ''?>><label for="q01_8"><span></span>뇌졸증</label>
										<input type="checkbox" value="결핵" id="q01_9" name="q01_list" class="selec_chk" <?php echo in_array("결핵",  $q01) ? 'checked' : ''?>><label for="q01_9"><span></span>결핵</label>
										<input type="checkbox" value="혈액투석" id="q01_10" name="q01_list" class="selec_chk" <?php echo in_array("혈액투석",  $q01) ? 'checked' : ''?>><label for="q01_10"><span></span>혈액투석</label>
										<input type="checkbox" value="갑상선" id="q01_11" name="q01_list" class="selec_chk" <?php echo in_array("갑상선",  $q01) ? 'checked' : ''?>><label for="q01_11"><span></span>갑상선</label>
										<input type="checkbox" value="골다골증" id="q01_12" name="q01_list" class="selec_chk" <?php echo in_array("골다골증",  $q01) ? 'checked' : ''?>><label for="q01_12"><span></span>골다골증</label>
										<input type="checkbox" value="턱관절 장애" id="q01_13" name="q01_list" class="selec_chk" <?php echo in_array("턱관절 장애",  $q01) ? 'checked' : ''?>><label for="q01_13"><span></span>턱관절 장애</label>

										<input type="hidden" name="q01" value="<?php echo $munjin['q01'];?>">
									</div>
								</div>
								<div class="munjin_div">
									<h4>Q2. 현재 복용중인 약이 있습니까?</h4>
									<div class="munjin_question chk_type01">
										<input type="radio" value="예" <?php echo $munjin['q02']=='예' ? 'checked' : '' ;?> id="q02_1" name="q02" class="selec_chk"><label for="q02_1"><span></span>예</label>
										<input type="radio" value="아니요" <?php echo $munjin['q02']=='아니요' ? 'checked' : '' ;?> id="q02_2" name="q02" class="selec_chk"><label for="q02_2"><span></span>아니요</label>
									</div>
									<div class="munjin_question_sub chk_type01 munjin_question02_sub">
										<h4>Q. 현재 복용중인 약의 이름을 입력해 주세요.</h4>
										<input type="text" name="q02_sub" class="munjin_input" value="<?php echo $munjin['q02_sub'] && $munjin['q02_sub']!=='잘 모르겠어요.' ? $munjin['q02_sub'] : '' ?>">
										<input type="checkbox" value="잘 모르겠어요." <?php echo $munjin['q02_sub']=='잘 모르겠어요.' ? 'checked' : '' ?> id="q02_sub" name="q02_sub" class="selec_chk"><label for="q02_sub"><span></span>잘 모르겠어요.</label>
									</div>
								</div>
								<div class="munjin_div">
									<h4>Q3. 과민 반응을 보이는 약이 있습니까?</h4>
									<div class="munjin_question chk_type01">
										<input type="radio" value="예" <?php echo $munjin['q03']=='예' ? 'checked' : '' ;?> id="q03_1" name="q03" class="selec_chk"><label for="q03_1"><span></span>예</label>
										<input type="radio" value="아니요" <?php echo $munjin['q03']=='아니요' ? 'checked' : '' ;?> id="q03_2" name="q03" class="selec_chk"><label for="q03_2"><span></span>아니요</label>
									</div>
									<div class="munjin_question_sub chk_type01 munjin_question03_sub">
										<h4>Q. 과민 반응을 보이는 약의 이름을 입력해 주세요.</h4>
										<input type="text" name="q03_sub" class="munjin_input" value="<?php echo $munjin['q03_sub'] && $munjin['q03_sub']!=='잘 모르겠어요.' ? $munjin['q03_sub'] : '' ?>">
										<input type="checkbox" value="잘 모르겠어요." <?php echo $munjin['q03_sub']=='잘 모르겠어요.' ? 'checked' : '' ?> id="q03_sub" name="q03_sub" class="selec_chk"><label for="q03_sub"><span></span>잘 모르겠어요.</label>
									</div>
								</div>
								<div class="munjin_div">
									<h4>Q4. 담배를 피우십니까?</h4>
									<div class="munjin_question chk_type01">
										<input type="radio" value="예" <?php echo $munjin['q04']=='예' ? 'checked' : '' ;?> id="q04_1" name="q04" class="selec_chk"><label for="q04_1"><span></span>예</label>
										<input type="radio" value="아니요" <?php echo $munjin['q04']=='아니요' ? 'checked' : '' ;?> id="q04_2" name="q04" class="selec_chk"><label for="q04_2"><span></span>아니요</label>
									</div>
									<div class="munjin_question_sub chk_type01 munjin_question04_sub">
										<h4>Q. 하루에 피우는 담배 양을 입력해 주세요.</h4>
										<input type="radio" value="1~2회 흡연" <?php echo $munjin['q04_sub']=='1~2회 흡연' ? 'checked' : '' ;?> id="q04_sub01" name="q04_sub" class="selec_chk"><label for="q04_sub01"><span></span>1~2회 흡연</label>
										<input type="radio" value="반갑 이하" <?php echo $munjin['q04_sub']=='반갑 이하' ? 'checked' : '' ;?> id="q04_sub02" name="q04_sub" class="selec_chk"><label for="q04_sub02"><span></span>반갑 이하</label>
										<input type="radio" value="반갑 미만" <?php echo $munjin['q04_sub']=='반갑 미만' ? 'checked' : '' ;?> id="q04_sub03" name="q04_sub" class="selec_chk"><label for="q04_sub03"><span></span>반갑 미만</label>
										<input type="radio" value="한갑 이상" <?php echo $munjin['q04_sub']=='한갑 이상' ? 'checked' : '' ;?> id="q04_sub04" name="q04_sub" class="selec_chk"><label for="q04_sub04"><span></span>한갑  이상</label>
										<input type="radio" value="잘 모르겠어요." <?php echo $munjin['q04_sub']=='잘 모르겠어요.' ? 'checked' : '' ;?> id="q04_sub05" name="q04_sub" class="selec_chk"><label for="q04_sub05"><span></span>잘 모르겠어요.</label>
									</div>
								</div>
								<div class="munjin_div">
									<h4>Q5. 여성일 경우 임신 가능성이 있으십니까?</h4>
									<div class="munjin_question chk_type01">
										<input type="radio" value="예" <?php echo $munjin['q05']=='예' ? 'checked' : '' ;?> id="q05_1" name="q05" class="selec_chk"><label for="q05_1"><span></span>예</label>
										<input type="radio" value="아니요" <?php echo $munjin['q05']=='아니요' ? 'checked' : '' ;?> id="q05_2" name="q05" class="selec_chk"><label for="q05_2"><span></span>아니요</label>
									</div>
									<div class="munjin_question_sub chk_type01 munjin_question05_sub">
										<h4>Q. 임신 개월 수를 입력해 주세요.</h4>
										<input type="radio" value="임신 초기 ( 3개월 미만 )" <?php echo $munjin['q05_sub']=='임신 초기 ( 3개월 미만 )' ? 'checked' : '' ;?> id="q05_sub01" name="q05_sub" class="selec_chk"><label for="q05_sub01"><span></span>임신 초기 ( 3개월 미만 )</label>
										<input type="radio" value="임신 중기 ( 4개월~ 7개월 )"<?php echo $munjin['q05_sub']=='임신 초기 ( 4개월~ 7개월 )' ? 'checked' : '' ;?> id="q05_sub02" name="q05_sub" class="selec_chk"><label for="q05_sub02"><span></span>임신 중기 ( 4개월~ 7개월 )</label>
										<input type="radio" value="임신 후기 ( 8개월 ~ 10개월 )"<?php echo $munjin['q05_sub']=='임신 초기 ( 8개월 ~ 10개월 )' ? 'checked' : '' ;?> id="q05_sub03" name="q05_sub" class="selec_chk"><label for="q05_sub03"><span></span>임신 후기 ( 8개월 ~ 10개월 )</label>
										<input type="radio" value="잘 모르겠어요." <?php echo $munjin['q05_sub']=='잘 모르겠어요.' ? 'checked' : '' ;?> id="q05_sub04" name="q05_sub" class="selec_chk"><label for="q05_sub04"><span></span>잘 모르겠어요.</label>
									</div>
								</div>
							</div>
							<div class="swiper-slide swiper-slide-img">
								<h3>검진, 치료 받으시겠습니까?</h3>
								<div class="munjin_div chk_type02">
									<input type="radio" value="검진만" <?php echo $munjin['q06']=='검진만' ? 'checked' : '' ;?> id="q06_1" name="q06" class="selec_chk"><label for="q06_1"><span></span>검진만</label>
									<input type="radio" value="아픈치아의 치료만" <?php echo $munjin['q06']=='아픈치아의 치료만' ? 'checked' : '' ;?> id="q06_2" name="q06" class="selec_chk"><label for="q06_2"><span></span>아픈치아의 치료만</label>
									<input type="radio" value="전체적으로 검진하고 치료를 원함" <?php echo $munjin['q06']=='전체적으로 검진하고 치료를 원함' ? 'checked' : '' ;?> id="q06_3" name="q06" class="selec_chk"><label for="q06_3"><span></span>전체적으로 검진하고 치료를 원함</label>
								</div>
							</div>
							<div class="swiper-slide">
								<h3>불편한 곳이 있으신가요?</h3>
								<div class="munjin_div">
									<textarea name="q07" id="q07" cols="30" rows="10" class="munjin_input" placeholder="불편한 증상은 작성해 주세요."><?php echo $munjin['q07'] ? $munjin['q07'] : '' ;?></textarea>
								</div>
							</div>
							<div class="swiper-slide">
								<h3>치아보험사 가입을 하셨나요?</h3>
								<div class="munjin_div chk_type02">
									<input type="radio" value="예" <?php echo $munjin['insurance']=='예' ? 'checked' : '' ;?> id="insurance1" name="insurance" class="selec_chk"><label for="insurance1"><span></span>예</label>
									<input type="radio" value="아니요" <?php echo $munjin['insurance']=='아니요' ? 'checked' : '' ;?> id="insurance2" name="insurance" class="selec_chk"><label for="insurance2"><span></span>아니요</label>
								</div>
								<div class="munjin_insurance_sub">
									<div class="munjin_div chk_type01">
										<h4>Q1. 보험사명을 알고 계신가요?</h4>
										<input type="radio" value="예" <?php echo $munjin['insurance_1']=='예' ? 'checked' : '' ;?> id="insurance_1_1" name="insurance_1" class="selec_chk"><label for="insurance_1_1"><span></span>예</label>
										<input type="radio" value="아니요" <?php echo $munjin['insurance_1']=='아니요' ? 'checked' : '' ;?> id="insurance_1_2" name="insurance_1" class="selec_chk"><label for="insurance_1_2"><span></span>아니요</label>
										<input type="text" name="insurance_1_sub" value="<?php echo $munjin['insurance_1_sub'] ? $munjin['insurance_1_sub'] : '' ?>" class="munjin_input" placeholder="보험사 명을 기입하세요.">
									</div>
									<div class="munjin_div chk_type01 chk_label_4">
										<h4>Q2. 가입기간이 얼마나 되셨나요?</h4>
										<input type="radio" value="6개월 이하" <?php echo $munjin['insurance_2']=='6개월 이하' ? 'checked' : '' ;?> id="insurance_2_1" name="insurance_2" class="selec_chk"><label for="insurance_2_1"><span></span>6개월 이하</label>
										<input type="radio" value="6개월 ~1년" <?php echo $munjin['insurance_2']=='6개월 ~1년' ? 'checked' : '' ;?> id="insurance_2_2" name="insurance_2" class="selec_chk"><label for="insurance_2_2"><span></span>6개월 ~1년</label>
										<input type="radio" value="1년 이상" <?php echo $munjin['insurance_2']=='1년 이상' ? 'checked' : '' ;?> id="insurance_2_3" name="insurance_2" class="selec_chk"><label for="insurance_2_3"><span></span>1년 이상</label>
										<input type="radio" value="2년 이상" <?php echo $munjin['insurance_2']=='2년 이상' ? 'checked' : '' ;?> id="insurance_2_4" name="insurance_2" class="selec_chk"><label for="insurance_2_4"><span></span>2년 이상</label>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<h3>개인정보 수집·활용 동의서</h3>
								<div class="munjin_agree">
									<div class="munjin_agree_wrap">
										<?php echo get_text($config['cf_privacy']) ?>
									</div>
									<div class="munjin_div chk_type03">
										<input type="checkbox" value="" id="agree" name="agree" class="selec_chk" <?php echo $munjinid ? 'checked' : ''?>><label for="agree"><span></span>위 내용에 대해 동의합니다.</label>
									</div>
								</div>
								<div class="munjin_info">
									<div class="munjin_date"><?php echo date('Y년 m월 d일')?></div>
									<div class="munjin_name">환자성명 : <?php echo $member['mb_name'];?></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="munjin_next">
					<!-- If we need navigation buttons -->
					<div class="swiper-button-next munjin_next_btn">NEXT</div>
					<input type="submit" value="제출하기" class="munjin_submit munjin_next_btn">
				</div>
			</form>
		</div>
	</div>

	<div id="munjinResult">
	</div>
</div>

<script>
const swiper = new Swiper('.swiper', {
  speed: 400,
  spaceBetween: 10,
  autoHeight: true,
  allowTouchMove: false,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    type: 'progressbar',
  },
  on: {
    slideChange: function () {
	  if(this.activeIndex == 0) {
        $('.swiper-button-prev').hide();
        $('.munjin_back_btn').show();
        $('.swiper-button-next').show();
        $('.munjin_submit').hide();		
	  } else if(this.activeIndex == 5) {
        $('.swiper-button-prev').show();
        $('.munjin_back_btn').hide();
        $('.swiper-button-next').hide();
        $('.munjin_submit').show();		  
	  } else {
        $('.swiper-button-prev').show();
        $('.munjin_back_btn').hide();
        $('.swiper-button-next').show();
        $('.munjin_submit').hide();		  
	  }
    }
  }
});

function fwrite_submit(f) {	
	if (!f.munjin_name.value || !f.munjin_birth.value || !f.munjin_phone.value) {
		swiper.slideTo(0);
		if (!f.munjin_name.value) { // 이름 없을때
			alert("이름을 입력해주세요.");
			f.munjin_name.focus();
			return false;
		}
		if (!f.munjin_birth.value) { // 생년월일 없을때
			alert("생년월일을 입력해주세요.");
			f.munjin_birth.focus();
			return false;
		}
		if (!f.munjin_phone.value) { // 휴대폰번호 없을때
			alert("휴대폰번호를 입력해주세요.");
			f.munjin_phone.focus();
			return false;
		}
	}

	if (!f.q02.value || !f.q03.value || !f.q04.value) {
		swiper.slideTo(1);
		if (!f.q02.value) { // 현재 복용중인 약 없을때
			alert("현재 복용중인 약을 체크해주세요.");
			return false;
		}
		if (!f.q03.value) { // 과민 반응을 보이는 약 없을때
			alert("과민 반응을 보이는 약을 체크해주세요.");
			return false;
		}
		if (!f.q04.value) { // 흡연 없을때
			alert("흡연 여부를 체크해주세요.");
			return false;
		}
	}

	if (!f.q06.value) {
		swiper.slideTo(2);
		if (!f.q06.value) { // 검진 목적 없을때
			alert("검진 목적을 체크해주세요.");
			return false;
		}
	}

	if (!f.q07.value) {
		swiper.slideTo(3);
		if (!f.q07.value) { // 불편한 곳 없을때
			alert("불편한 곳을 입력해주세요.");
			return false;
		}
	}

	if (!f.insurance.value) {
		swiper.slideTo(4);
		if (!f.insurance.value) { // 치아보험사 가입여부 없을때
			alert("치아보험사 가입여부 체크해주세요.");
			return false;
		}
	}

	if (!$("#agree").is(':checked')) {
		alert("개인정보 수집·활용 동의해주시기 바랍니다.");
		return false;
	}

	var cate = ''; // q01 체크박스 선택
	$(".munjin_chk input[type='checkbox']:checked").each(function() { 
		if( cate == '' ) {
			cate = $(this).val();
		} else {
			cate = cate + '/' + $(this).val();
		}
	});
	$('input[name="q01"]').val(cate);

	$.ajax({
		url: "./munjin_update.php",
		type: "POST",
		data: {
			munjin_type : f.munjin_type.value,
			denid : f.denid.value,
			rdate : f.rdate.value,
			rtime : f.rtime.value,
			munjin_name : f.munjin_name.value,
			munjin_birth : f.munjin_birth.value,
			munjin_phone : f.munjin_phone.value,
			q01 : f.q01.value,
			q02 : f.q02.value,
			q02_sub : f.q02_sub.value,
			q03 : f.q03.value,
			q03_sub : f.q03_sub.value,
			q04 : f.q04.value,
			q04_sub : f.q04_sub.value,
			q05 : f.q05.value,
			q05_sub : f.q05_sub.value,
			q06 : f.q06.value,
			q07 : f.q07.value,
			insurance : f.insurance.value,
			insurance_1 : f.insurance_1.value,
			insurance_1_sub : f.insurance_1_sub.value,
			insurance_2 : f.insurance_2.value,
		},
		success: function(msg){
			$("#munjinResult").html(msg).show();
		}
	});
	return false;
}

// 문진표 완료 팝업 닫기
$('#munjinResult').click(function(){
	location.href = '<?php echo G5_URL?>/reservation_update.php?denid=<?php echo $denid?>&date=<?php echo $date?>&time=<?php echo $time?>';
});

$(document).ready(function(){

	//클릭이 아닌 상태에서 값이 존재할경우 show hide
	if($("input[name=q02]:checked").val() == "예"){
		$('.munjin_question02_sub').show();
	} else if($("input[name=q02]:checked").val() == "아니요"){
		$('.munjin_question02_sub').hide();
		if($("input[name=q02_sub]").attr('type') == 'text') {
				$("input[name=q02_sub]").val('');
			}
			if($("#q02_sub").is(':checked')) {
				$("#q02_sub").prop('checked', false);
			}
	}

	if($("input[name=q03]:checked").val() == "예"){
		$('.munjin_question03_sub').show();
	} else if($("input[name=q03]:checked").val() == "아니요"){
		$('.munjin_question03_sub').hide();
		if($("input[name=q03_sub]").attr('type') == 'text') {
				$("input[name=q03_sub]").val('');
			}
			if($("#q03_sub").is(':checked')) {
				$("#q03_sub").prop('checked', false);
			}
	}

	if($("input[name=q04]:checked").val() == "예"){
		$('.munjin_question04_sub').show();
	} else if($("input[name=q04]:checked").val() == "아니요"){
		$('.munjin_question04_sub').hide();
		if($("input[name=q04_sub]").attr('type') == 'text') {
				$("input[name=q04_sub]").val('');
			}
			if($("#q04_sub").is(':checked')) {
				$("#q04_sub").prop('checked', false);
			}
	}

	if($("input[name=q05]:checked").val() == "예"){
		$('.munjin_question05_sub').show();
	} else if($("input[name=q05]:checked").val() == "아니요"){
		$('.munjin_question05_sub').hide();
		if($("input[name=q05_sub]").attr('type') == 'text') {
				$("input[name=q05_sub]").val('');
			}
			if($("#q05_sub").is(':checked')) {
				$("#q05_sub").prop('checked', false);
			}
	}

	if($("input[name=insurance]:checked").val() == "예"){
		$('.munjin_insurance_sub').show();
	} else if($("input[name=insurance]:checked").val() == "아니요"){
		$('.munjin_insurance_sub').hide();
		if($("input[name=insurance_1]").is(':checked')) {
			$("input[name=insurance_1]").prop('checked', false);
		}
		$('.munjin_insurance_sub input[type="text"]').val('').hide();
		if($("input[name=insurance_2]").is(':checked')) {
			$("input[name=insurance_2]").prop('checked', false);
		}
	}

	if($("input[name=insurance_1]:checked").val() == "예"){
		$('.munjin_insurance_sub input[type="text"]').show();
	} else if($("input[name=insurance_1]:checked").val() == "아니요"){
		$('.munjin_insurance_sub input[type="text"]').hide();
		$('.munjin_insurance_sub input[type="text"]').val('');
	}
 
    // 라디오버튼 클릭시 이벤트 발생
    $("input[name=q02]").click(function(){
        if($("input[name=q02]:checked").val() == "아니요"){
			$('.munjin_question02_sub').hide();
			if($("input[name=q02_sub]").attr('type') == 'text') {
				$("input[name=q02_sub]").val('');
			}
			if($("#q02_sub").is(':checked')) {
				$("#q02_sub").prop('checked', false);
			}
        } else if ($("input[name=q02]:checked").val() == "예"){
			$('.munjin_question02_sub').show();
        }
		var conheight = $('.swiper-slide-active').height();
		$('.swiper-wrapper').height(conheight);
    });

    $("input[name=q03]").click(function(){
        if($("input[name=q03]:checked").val() == "아니요"){
			$('.munjin_question03_sub').hide();
			if($("input[name=q03_sub]").attr('type') == 'text') {
				$("input[name=q03_sub]").val('');
			}
			if($("#q03_sub").is(':checked')) {
				$("#q03_sub").prop('checked', false);
			}
        } else if ($("input[name=q03]:checked").val() == "예"){
			$('.munjin_question03_sub').show();
        }
		var conheight = $('.swiper-slide-active').height();
		$('.swiper-wrapper').height(conheight);
    });

    $("input[name=q04]").click(function(){
        if($("input[name=q04]:checked").val() == "아니요"){
			$('.munjin_question04_sub').hide();
			if($("input[name=q04_sub]").is(':checked')) {
				$("input[name=q04_sub]").prop('checked', false);
			}
        } else if ($("input[name=q04]:checked").val() == "예"){
			$('.munjin_question04_sub').show();
        }
		var conheight = $('.swiper-slide-active').height();
		$('.swiper-wrapper').height(conheight);
    });

    $("input[name=q05]").click(function(){
        if($("input[name=q05]:checked").val() == "아니요"){
			$('.munjin_question05_sub').hide();
			if($("input[name=q05_sub]").is(':checked')) {
				$("input[name=q05_sub]").prop('checked', false);
			}
        } else if ($("input[name=q05]:checked").val() == "예"){
			$('.munjin_question05_sub').show();
        }
		var conheight = $('.swiper-slide-active').height();
		$('.swiper-wrapper').height(conheight);
    });

    $("input[name=insurance]").click(function(){
        if($("input[name=insurance]:checked").val() == "예"){
			$('.munjin_insurance_sub').show();
        } else if ($("input[name=insurance]:checked").val() == "아니요"){
			$('.munjin_insurance_sub').hide();
			if($("input[name=insurance_1]").is(':checked')) {
				$("input[name=insurance_1]").prop('checked', false);
			}
			$('.munjin_insurance_sub input[type="text"]').val('').hide();
			if($("input[name=insurance_2]").is(':checked')) {
				$("input[name=insurance_2]").prop('checked', false);
			}
        }
		var conheight = $('.swiper-slide-active').height();
		$('.swiper-wrapper').height(conheight);
    });

    $("input[name=insurance_1]").click(function(){
        if($("input[name=insurance_1]:checked").val() == "예"){
			$('.munjin_insurance_sub input[type="text"]').show();
        } else if ($("input[name=insurance_1]:checked").val() == "아니요"){
			$('.munjin_insurance_sub input[type="text"]').hide();
			$('.munjin_insurance_sub input[type="text"]').val('');
        }
		var conheight = $('.swiper-slide-active').height();
		$('.swiper-wrapper').height(conheight);
    });
});
</script>

<?php 
include_once('./munjin.tail.php');