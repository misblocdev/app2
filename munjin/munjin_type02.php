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
				<input type="hidden" value="교정" name="munjin_type">
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
									<div class="munjin_sex">
										<input type="radio" value="남자" <?php echo ($munjin['munjin_sex'] == '남자' || $member['mb_sex'] == 'M') ? 'checked' : '' ;?> id="munjin_sex_1" name="munjin_sex" class="selec_chk"><label for="munjin_sex_1">남자</label>
										<input type="radio" value="여자" <?php echo ($munjin['munjin_sex'] == '여자' || $member['mb_sex'] == 'F') ? 'checked' : '' ;?> id="munjin_sex_2" name="munjin_sex" class="selec_chk"><label for="munjin_sex_2">여자</label>
									</div>
								</div>
								<div class="munjin_div">
									<input type="text" id="munjin_addr" value="<?php echo $munjin['munjin_addr'] ? $munjin['munjin_addr'] : $member['mb_addr1'].' '.$member['mb_addr2'];?>" name="munjin_addr" placeholder="주소 입력 ">
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
								<h3>어떤 교정 치료를 생각하고 계십니까? <span>(중복체크 가능)</span></h3>
								<div class="munjin_div chk_type02 chk_label_2">
									<?php $q06 = explode('/',$munjin['q06']);?>
									<input type="checkbox" value="전체교정" <?php echo in_array("전체교정",  $q06) ? 'checked' : ''?> id="q06_1" name="q06_list" class="selec_chk left_chk"><label for="q06_1"><span></span>전체교정</label>
									<input type="checkbox" value="앞니 부분 교정" <?php echo in_array("앞니 부분 교정",  $q06) ? 'checked' : ''?> id="q06_2" name="q06_list" class="selec_chk"><label for="q06_2"><span></span>앞니 부분 교정</label>
									<input type="checkbox" value="어금니 부분 교정" <?php echo in_array("어금니 부분 교정",  $q06) ? 'checked' : ''?> id="q06_3" name="q06_list" class="selec_chk left_chk"><label for="q06_3"><span></span>어금니 부분 교정</label>
									<input type="checkbox" value="투명교정" <?php echo in_array("투명교정",  $q06) ? 'checked' : ''?> id="q06_4" name="q06_list" class="selec_chk"><label for="q06_4"><span></span>투명교정</label>
									<input type="checkbox" value="양악수술 교정" <?php echo in_array("양악수술 교정",  $q06) ? 'checked' : ''?> id="q06_5" name="q06_list" class="selec_chk left_chk"><label for="q06_5"><span></span>양악수술 교정</label>
									<input type="checkbox" value="클리피시 · 세라믹" <?php echo in_array("클리피시 · 세라믹",  $q06) ? 'checked' : ''?> id="q06_6" name="q06_list" class="selec_chk"><label for="q06_6"><span></span>클리피시 · 세라믹</label>
									<input type="checkbox" value="잘 모르겠다."<?php echo in_array("잘 모르겠다.",  $q06) ? 'checked' : ''?> id="q06_7" name="q06_list" class="selec_chk"><label for="q06_7"><span></span>잘 모르겠다.</label>

									<input type="hidden" name="q06" value="<?php echo $munjin['q06'];?>">
								</div>
							</div>
							<div class="swiper-slide">
								<div class="munjin_div">
									<h4>Q1. 교정상담을 하게 된 이유는 무엇입니까? <span>(중복 가능)</span></h4>
									<div class="munjin_question chk_type01 chk_label_2">
									<?php $q07 = explode('/',$munjin['q07']);?>
										<input type="checkbox" value="콤플렉스(외모)" id="q07_1" name="q07_list" class="selec_chk" <?php echo in_array("콤플렉스(외모)",  $q07) ? 'checked' : ''?>><label for="q07_1"><span></span>콤플렉스(외모)</label>
										<input type="checkbox" value="불편해서 (기능)" id="q07_2" name="q07_list" class="selec_chk" <?php echo in_array("불편해서 (기능)",  $q07) ? 'checked' : ''?>><label for="q07_2"><span></span>불편해서 (기능)</label>
										<input type="checkbox" value="교정필요 유/무 확인 차" id="q07_3" name="q07_list" class="selec_chk" <?php echo in_array("교정필요 유/무 확인 차",  $q07) ? 'checked' : ''?>><label for="q07_3"><span></span>교정필요 유/무 확인 차</label>
										<input type="checkbox" value="주변인(가족,친구,지인)의 권유" id="q07_4" name="q07_list" class="selec_chk" <?php echo in_array("주변인(가족,친구,지인)의 권유",  $q07) ? 'checked' : ''?>><label for="q07_4"><span></span>주변인(가족,친구,지인)의 권유</label>
										
										<input type="hidden" name="q07" value="<?php echo $munjin['q07'];?>">
									</div>
								</div>
								<div class="munjin_div">
									<h4>Q2. 교정치료로 고치고 싶은 부분은 무엇인가요? <span>(중복 가능)</span></h4>
									<div class="munjin_question chk_type01 chk_label_2">
									<?php $q08 = explode('/',$munjin['q08']);?>
										<input type="checkbox" value="삐뚤삐뚤한 치아" id="q08_1" name="q08_list" class="selec_chk" <?php echo in_array("삐뚤삐뚤한 치아",  $q08) ? 'checked' : ''?>><label for="q08_1"><span></span>삐뚤삐뚤한 치아</label>
										<input type="checkbox" value="치아나 입이 튀어나왔음" id="q08_2" name="q08_list" class="selec_chk" <?php echo in_array("치아나 입이 튀어나왔음",  $q08) ? 'checked' : ''?>><label for="q08_2"><span></span>치아나 입이 튀어나왔음</label>
										<input type="checkbox" value="웃을 때 잇몸이 많이 보임" id="q08_3" name="q08_list" class="selec_chk" <?php echo in_array("웃을 때 잇몸이 많이 보임",  $q08) ? 'checked' : ''?>><label for="q08_3"><span></span>웃을 때 잇몸이 많이 보임</label>
										<input type="checkbox" value="위, 아래 앞니가 서로 안물림" id="q08_4" name="q08_list" class="selec_chk" <?php echo in_array("위, 아래 앞니가 서로 안물림",  $q08) ? 'checked' : ''?>><label for="q08_4"><span></span>위, 아래 앞니가 서로 안물림</label>
										<input type="checkbox" value="치아가 깊게 물려서 아래 치아가 안보임" id="q08_5" name="q08_list" class="selec_chk" <?php echo in_array("치아가 깊게 물려서 아래 치아가 안보임",  $q08) ? 'checked' : ''?>><label for="q08_5" style="width: 100%;"><span></span>치아가 깊게 물려서 아래 치아가 안보임</label>
										<input type="checkbox" value="치아 사이에 틈이 있음" id="q08_6" name="q08_list" class="selec_chk" <?php echo in_array("치아 사이에 틈이 있음",  $q08) ? 'checked' : ''?>><label for="q08_6"><span></span>치아 사이에 틈이 있음</label>
										<input type="checkbox" value="주걱턱" id="q08_7" name="q08_list" class="selec_chk" <?php echo in_array("주걱턱",  $q08) ? 'checked' : ''?>><label for="q08_7"><span></span>주걱턱</label>
										<input type="checkbox" value="아래 턱이 너무 작음" id="q08_8" name="q08_list" class="selec_chk" <?php echo in_array("아래 턱이 너무 작음",  $q08) ? 'checked' : ''?>><label for="q08_8"><span></span>아래 턱이 너무 작음</label>
										<input type="checkbox" value="턱이 틀어졌음" id="q08_9" name="q08_list" class="selec_chk" <?php echo in_array("턱이 틀어졌음",  $q08) ? 'checked' : ''?>><label for="q08_9"><span></span>턱이 틀어졌음</label>
										<input type="checkbox" value="기타" id="q08_10" name="q08_list" class="selec_chk" <?php echo in_array("기타",  $q08) ? 'checked' : ''?>><label for="q08_10"><span></span>기타</label>
										
										<input type="hidden" name="q08" value="<?php echo $munjin['q08'];?>">
									</div>
								</div>
								<div class="munjin_div">
									<h4>Q3. 교정치료 시 중요하게 고려하는 사항은 있나요? <span>(중복 가능)</span></h4>
									<div class="munjin_question chk_type01 chk_label_2">
									<?php $q09 = explode('/',$munjin['q09']);?>
										<input type="checkbox" value="치료의 우수함" id="q09_1" name="q09_list" class="selec_chk" <?php echo in_array("치료의 우수함",  $q09) ? 'checked' : ''?>><label for="q09_1"><span></span>치료의 우수함</label>
										<input type="checkbox" value="비용" id="q09_2" name="q09_list" class="selec_chk" <?php echo in_array("비용",  $q09) ? 'checked' : ''?>><label for="q09_2"><span></span>비용</label>
										<input type="checkbox" value="의료진(신뢰감)" id="q09_3" name="q09_list" class="selec_chk" <?php echo in_array("의료진(신뢰감)",  $q09) ? 'checked' : ''?>><label for="q09_3"><span></span>의료진(신뢰감)</label>
										<input type="checkbox" value="병원규모" id="q09_4" name="q09_list" class="selec_chk" <?php echo in_array("병원규모",  $q09) ? 'checked' : ''?>><label for="q09_4"><span></span>병원규모</label>
										<input type="checkbox" value="교정장치" id="q09_5" name="q09_list" class="selec_chk" <?php echo in_array("교정장치",  $q09) ? 'checked' : ''?>><label for="q09_5"><span></span>교정장치</label>
										<input type="checkbox" value="내원거리" id="q09_6" name="q09_list" class="selec_chk" <?php echo in_array("내원거리",  $q09) ? 'checked' : ''?>><label for="q09_6"><span></span>내원거리</label>
										<input type="checkbox" value="치료기간" id="q09_7" name="q09_list" class="selec_chk" <?php echo in_array("치료기간",  $q09) ? 'checked' : ''?>><label for="q09_7"><span></span>치료기간</label>
										
										<input type="hidden" name="q09" value="<?php echo $munjin['q09'];?>">
									</div>
								</div>
								<div class="munjin_div">
									<h4>Q4. 향후 1~2년 이내 다음과 같은 계획이 있습니까? <span>(중복 가능)</span></h4>
									<div class="munjin_question chk_type01 chk_label_2">
									<?php $q10 = explode('/',$munjin['q10']);?>
										<input type="checkbox" value="결혼" id="q10_1" name="q10_list" class="selec_chk" <?php echo in_array("결혼",  $q10) ? 'checked' : ''?>><label for="q10_1"><span></span>결혼</label>
										<input type="checkbox" value="유학" id="q10_2" name="q10_list" class="selec_chk" <?php echo in_array("유학",  $q10) ? 'checked' : ''?>><label for="q10_2"><span></span>유학</label>
										<input type="checkbox" value="임신" id="q10_3" name="q10_list" class="selec_chk" <?php echo in_array("임신",  $q10) ? 'checked' : ''?>><label for="q10_3"><span></span>임신</label>
										<input type="checkbox" value="군입대" id="q10_4" name="q10_list" class="selec_chk" <?php echo in_array("군입대",  $q10) ? 'checked' : ''?>><label for="q10_4"><span></span>군입대</label>
										<input type="checkbox" value="기타" id="q10_5" name="q10_list" class="selec_chk" <?php echo in_array("기타",  $q10) ? 'checked' : ''?>><label for="q10_5"><span></span>기타</label>
										
										<input type="hidden" name="q10" value="<?php echo $munjin['q10'];?>">
									</div>
								</div>
								<div class="munjin_div">
									<h4>Q5. 입을 벌리거나 다물때 귀 부위 턱관절에서 소리가 나거나 <br/><span class="blank"></span>통증이 있습니까?</h4>
									<div class="munjin_question chk_type01 chk_label_2">
										<input type="radio" value="예" id="q11_1" name="q11" class="selec_chk" <?php echo $munjin['q11']=='예' ? 'checked' : '' ;?>><label for="q11_1"><span></span>예</label>
										<input type="radio" value="아니요" id="q11_2" name="q11" class="selec_chk" <?php echo $munjin['q11']=='아니요' ? 'checked' : '' ;?>><label for="q11_2"><span></span>아니요</label>
										<input type="radio" value="잘 모르겠어요" id="q11_3" name="q11" class="selec_chk" <?php echo $munjin['q11']=='잘 모르겠어요' ? 'checked' : '' ;?>><label for="q11_3"><span></span>잘 모르겠어요</label>
									</div>
								</div>
								<div class="munjin_div">
									<h4>Q6. 가족의 치열은 어떻습니까? 가족 중 본인과 비슷한 치열을 <br/><span class="blank"></span>가진 분이 계신가요? <span>(중복 가능)</span></h4>
									<div class="munjin_question chk_type01 chk_label_2">
									<?php $q12 = explode('/',$munjin['q12']);?>
										<input type="checkbox" value="아빠" id="q12_1" name="q12_list" class="selec_chk" <?php echo in_array("아빠",  $q12) ? 'checked' : ''?>><label for="q12_1"><span></span>아빠</label>
										<input type="checkbox" value="엄마" id="q12_2" name="q12_list" class="selec_chk" <?php echo in_array("엄마",  $q12) ? 'checked' : ''?>><label for="q12_2"><span></span>엄마</label>
										<input type="checkbox" value="형제 혹은 자매" id="q12_3" name="q12_list" class="selec_chk" <?php echo in_array("형제 혹은 자매",  $q12) ? 'checked' : ''?>><label for="q12_3"><span></span>형제 혹은 자매</label>
										<input type="checkbox" value="없음" id="q12_4" name="q12_list" class="selec_chk" <?php echo in_array("없음",  $q12) ? 'checked' : ''?>><label for="q12_4"><span></span>없음</label>
										
										<input type="hidden" name="q12" value="<?php echo $munjin['q12'];?>">
									</div>
								</div>
								<div class="munjin_div">
									<h4>Q7. 다음 중 자신에게 해당하는 습관이 있으면 모두 체크해 <br/><span class="blank"></span>주세요. <span>(중복 가능)</span></h4>
									<div class="munjin_question chk_type01 chk_label_2">
									<?php $q13 = explode('/',$munjin['q13']);?>
										<input type="checkbox" value="손가락 빨기" id="q13_1" name="q13_list" class="selec_chk" <?php echo in_array("손가락 빨기",  $q13) ? 'checked' : ''?>><label for="q13_1"><span></span>손가락 빨기</label>
										<input type="checkbox" value="혀 내밀기" id="q13_2" name="q13_list" class="selec_chk" <?php echo in_array("혀 내밀기",  $q13) ? 'checked' : ''?>><label for="q13_2"><span></span>혀 내밀기</label>
										<input type="checkbox" value="손톱 깨물기" id="q13_3" name="q13_list" class="selec_chk" <?php echo in_array("손톱 깨물기",  $q13) ? 'checked' : ''?>><label for="q13_3"><span></span>손톱 깨물기</label>
										<input type="checkbox" value="턱 괴기" id="q13_4" name="q13_list" class="selec_chk" <?php echo in_array("턱 괴기",  $q13) ? 'checked' : ''?>><label for="q13_4"><span></span>턱 괴기</label>
										
										<input type="hidden" name="q13" value="<?php echo $munjin['q13'];?>">
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<h3>치아보험사 가입을 하셨나요?</h3>
								<div class="munjin_div chk_type02">
									<input type="radio" value="예" <?php echo $munjin['insurance']=='예' ? 'checked' : '' ;?> id="insurance_1" name="insurance" class="selec_chk"><label for="insurance_1"><span></span>예</label>
									<input type="radio" value="아니요" <?php echo $munjin['insurance']=='아니요' ? 'checked' : '' ;?> id="insurance_2" name="insurance" class="selec_chk"><label for="insurance_2"><span></span>아니요</label>
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
										<input type="checkbox" id="agree" name="agree" class="selec_chk" <?php echo $munjin_id ? 'checked' : ''?>><label for="agree"><span></span>위 내용에 대해 동의합니다.</label>
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
		$('.munjin_form').scrollTop(0);
	  } else if(this.activeIndex == 5) {
        $('.swiper-button-prev').show();
        $('.munjin_back_btn').hide();
        $('.swiper-button-next').hide();
        $('.munjin_submit').show();
		$('.munjin_form').scrollTop(0);  
	  } else {
        $('.swiper-button-prev').show();
        $('.munjin_back_btn').hide();
        $('.swiper-button-next').show();
        $('.munjin_submit').hide();
		$('.munjin_form').scrollTop(0);
	  }
    }
  }
});

function fwrite_submit(f) {	

	var q01 = ''; // q01 체크박스 선택
	$("input[name='q01_list']:checked").each(function() { 
		if( q01 == '' ) {
			q01 = $(this).val();
		} else {
			q01 = q01 + '/' + $(this).val();
		}
	});
	$('input[name="q01"]').val(q01);

	var q06 = ''; // q06 체크박스 선택
	$("input[name='q06_list']:checked").each(function() { 
		if( q06 == '' ) {
			q06 = $(this).val();
		} else {
			q06 = q06 + '/' + $(this).val();
		}
	});
	$('input[name="q06"]').val(q06);

	var q07 = ''; // q07 체크박스 선택
	$("input[name='q07_list']:checked").each(function() { 
		if( q07 == '' ) {
			q07 = $(this).val();
		} else {
			q07 = q07 + '/' + $(this).val();
		}
	});
	$('input[name="q07"]').val(q07);

	var q08 = ''; // q08 체크박스 선택
	$("input[name='q08_list']:checked").each(function() { 
		if( q08 == '' ) {
			q08 = $(this).val();
		} else {
			q08 = q08 + '/' + $(this).val();
		}
	});
	$('input[name="q08"]').val(q08);

	var q09 = ''; // q09 체크박스 선택
	$("input[name='q09_list']:checked").each(function() { 
		if( q09 == '' ) {
			q09 = $(this).val();
		} else {
			q09 = q09 + '/' + $(this).val();
		}
	});
	$('input[name="q09"]').val(q09);

	var q10 = ''; // q10 체크박스 선택
	$("input[name='q10_list']:checked").each(function() { 
		if( q10 == '' ) {
			q10 = $(this).val();
		} else {
			q10 = q10 + '/' + $(this).val();
		}
	});
	$('input[name="q10"]').val(q10);

	var q12 = ''; // q12 체크박스 선택
	$("input[name='q12_list']:checked").each(function() { 
		if( q12 == '' ) {
			q12 = $(this).val();
		} else {
			q12 = q12 + '/' + $(this).val();
		}
	});
	$('input[name="q12"]').val(q12);

	var q13 = ''; // q06 체크박스 선택
	$("input[name='q13_list']:checked").each(function() { 
		if( q13 == '' ) {
			q13 = $(this).val();
		} else {
			q13 = q13 + '/' + $(this).val();
		}
	});
	$('input[name="q13"]').val(q13);

	if (!f.munjin_name.value || !f.munjin_birth.value || !f.munjin_phone.value || !f.munjin_sex.value || !f.munjin_addr.value) {
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
		if (!f.munjin_sex.value) { // 성별 없을때
			alert("성별을 체크해주세요.");
			return false;
		}
		if (!f.munjin_addr.value) { // 주소 없을때
			alert("주소를 입력해주세요.");
			f.munjin_addr.focus();
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

	if (!f.q06.value) { // 교정 치료 선택 없을때
		swiper.slideTo(2);
		alert("교정 치료를 체크해주세요.");
		return false;
	}

	if (!f.q07.value) { // 교정상담을 하게 된 이유 선택 없을때
		swiper.slideTo(3);
		alert("교정상담을 하게 된 이유를 체크해주세요.");
		return false;
	}

	if (!f.q08.value) { // 교정치료로 고치고 싶은 부분 선택 없을때
		swiper.slideTo(3);
		alert("교정치료로 고치고 싶은 부분을 체크해주세요.");
		return false;
	}

	if (!f.q09.value) { // 교정치료 시 중요하게 고려하는 사항 선택 없을때
		swiper.slideTo(3);
		alert("교정치료 시 중요하게 고려하는 사항을 체크해주세요.");
		return false;
	}

	if (!f.q10.value) { // 향후 1~2년 이내 다음과 같은 계획 선택 없을때
		swiper.slideTo(3);
		alert("향후 1~2년 이내 다음과 같은 계획을 체크해주세요.");
		return false;
	}

	if (!f.q11.value) { // 입을 벌리거나 다물때 귀 부위 턱관절에서 소리가 나거나 통증 선택 없을때
		swiper.slideTo(3);
		alert("입을 벌리거나 다물때 귀 부위 턱관절에서 소리가 나거나 통증이 있는지 체크해주세요.");
		return false;
	}

	if (!f.q12.value) { // 가족 중 본인과 비슷한 치열을 가진 분이 계신지 선택 없을때
		swiper.slideTo(3);
		alert("가족 중 본인과 비슷한 치열을 가진 분이 계신지 체크해주세요.");
		return false;
	}

	if (!f.q13.value) { // 자신에게 해당하는 습관 선택 없을때
		swiper.slideTo(3);
		alert("자신에게 해당하는 습관 체크해주세요.");
		return false;
	}

	if (!f.insurance.value) { // 치아보험사 가입여부 없을때
		swiper.slideTo(4);
		alert("치아보험사 가입여부 체크해주세요.");
		return false;
	}

	if (!$("#agree").is(':checked')) {
		alert("개인정보 수집·활용 동의해주시기 바랍니다.");
		return false;
	}

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
			q08 : f.q08.value,
			q09 : f.q09.value,
			q010 : f.q10.value,
			q011 : f.q11.value,
			q012 : f.q12.value,
			q013 : f.q13.value,
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