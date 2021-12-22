<?php
include_once('./_common.php');
include_once('./head.sub.php');

$sql = " select * from munjin where munjin_id = '{$mid}' ";
$row = sql_fetch($sql);

if($type == '일반') {
	$img = '/images/munjin_basic.jpg';
} else {
	$img = '/images/munjin_braces.jpg';
}
?>
<style>
.munjinpyo {position: relative;min-width: 830px;}
.munjinpyo_wrap {padding-top: 42px;padding-left: 54px;padding-right: 53px;font-size: 13px;position: absolute;top: 0;left: 0;}
.munjinpyo_chk {display: inline-block;width: 10px;height: 10px;background: url(/img/chk.png) no-repeat 50% 50% #8864e0;background-size: 10px;}

/* munjinpyo_top */
.munjinpyo_top > div {float: left;height: 34px;position: relative;line-height: 34px;}
.munjinpyo_top .munjinpyo_num {width: 169px;padding-left: 62px;}
.munjinpyo_top .munjinpyo_date {width: 130px;padding-left: 30px;}
.munjinpyo_top .munjinpyo_type {width: 170px;}
.munjinpyo_top .munjinpyo_type .munjinpyo_basic {position: absolute;left: 75px;top: 12px;}
.munjinpyo_top .munjinpyo_type .munjinpyo_braces {position: absolute;left: 132px;top: 12px;}

/* munjinpyo_info */
.munjinpyo_info {padding: 3px 0 2px;}
.munjinpyo_info > div {float: left;position: relative;}
.munjinpyo_info > div:nth-child(odd) {width: 379px;}
.munjinpyo_info > div:nth-child(even) {width: 346px;}
.munjinpyo_info .munjinpyo_name {height: 36px;line-height: 36px;padding-left: 35px;}
.munjinpyo_info .munjinpyo_birth {height: 36px;line-height: 36px;padding-left: 56px;}
.munjinpyo_info .munjinpyo_phone {height: 38px;line-height: 36px;padding-left: 46px;}
.munjinpyo_info .munjinpyo_sex {height: 38px;}
.munjinpyo_info .munjinpyo_sex .munjinpyo_male {position: absolute;left: 102px;top: 13px;}
.munjinpyo_info .munjinpyo_sex .munjinpyo_female {position: absolute;left: 197px;top: 13px;}
.munjinpyo_info .munjinpyo_addr {width: 100%;height: 41px;padding-left: 35px;line-height: 41px;}

/* munjinpyo_section01 */
.munjinpyo_section01 {padding-top: 32px;}
/* munjinpyo_section01 - q01 */
.munjinpyo_section01 .q01 {width: 100%;height: 100px;position: relative;}
.munjinpyo_section01 .q01 > span {position: absolute;}
.munjinpyo_section01 .q01 > span:nth-child(-n+7) {top: 49px;}
.munjinpyo_section01 .q01 > span:nth-child(n+8) {top: 77px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_1 {left: 3px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_2 {left: 89px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_3 {left: 190px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_4 {left: 320px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_5 {left: 398px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_6 {left: 493px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_7 {left: 590px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_8 {left: 3px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_9 {left: 89px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_10 {left: 189px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_11 {left: 321px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_12 {left: 399px;}
.munjinpyo_section01 .q01 .munjinpyo_q01_13 {left: 399px;}
/* munjinpyo_section01 - q02 */
.munjinpyo_section01 .q02 {width: 100%;height: 90px;}
.munjinpyo_section01 .q02 .q02_chk {width: 100%;height: 41px;position: relative;}
.munjinpyo_section01 .q02 .q02_chk > span {position: absolute;top: 17px;}
.munjinpyo_section01 .q02 .munjinpyo_q02_1 {left: 251px;}
.munjinpyo_section01 .q02 .munjinpyo_q02_2 {left: 317px;}
.munjinpyo_section01 .q02 .q02_sub {width: 100%;height: 41px;padding-left: 235px;line-height: 32px;}
/* munjinpyo_section01 - q03 */
.munjinpyo_section01 .q03 {width: 100%;height: 85px;}
.munjinpyo_section01 .q03 .q03_chk {width: 100%;height: 36px;position: relative;}
.munjinpyo_section01 .q03 .q03_chk > span {position: absolute;top: 15px;}
.munjinpyo_section01 .q03 .munjinpyo_q03_1 {left: 251px;}
.munjinpyo_section01 .q03 .munjinpyo_q03_2 {left: 317px;}
.munjinpyo_section01 .q03 .munjinpyo_q03_3 {left: 618px;top: 13px !important;}
.munjinpyo_section01 .q03 .q03_sub {width: 100%;height: 41px;padding-left: 255px;line-height: 38px;}
/* munjinpyo_section01 - q04 */
.munjinpyo_section01 .q04 {width: 100%;height: 73px;}
.munjinpyo_section01 .q04 .q04_chk {width: 100%;height: 40px;position: relative;}
.munjinpyo_section01 .q04 .q04_chk > span {position: absolute;top: 14px;}
.munjinpyo_section01 .q04 .munjinpyo_q04_1 {left: 251px;}
.munjinpyo_section01 .q04 .munjinpyo_q04_2 {left: 317px;}
.munjinpyo_section01 .q04 .q04_sub {width: 100%;height: 33px;position: relative;}
.munjinpyo_section01 .q04 .q04_sub > span {position: absolute;top: 7px;}
.munjinpyo_section01 .q04 .munjinpyo_q04_sub_1 {left: 3px;}
.munjinpyo_section01 .q04 .munjinpyo_q04_sub_2 {left: 125px;}
.munjinpyo_section01 .q04 .munjinpyo_q04_sub_3 {left: 237px;}
.munjinpyo_section01 .q04 .munjinpyo_q04_sub_4 {left: 358px;}
.munjinpyo_section01 .q04 .munjinpyo_q04_sub_5 {left: 475px;}
/* munjinpyo_section01 - q05 */
.munjinpyo_section01 .q05 {width: 100%;height: 79px;}
.munjinpyo_section01 .q05 .q05_chk {width: 100%;height: 40px;position: relative;}
.munjinpyo_section01 .q05 .q05_chk > span {position: absolute;top: 15px;}
.munjinpyo_section01 .q05 .munjinpyo_q05_1 {left: 251px;}
.munjinpyo_section01 .q05 .munjinpyo_q05_2 {left: 317px;}
.munjinpyo_section01 .q05 .q05_sub {width: 100%;height: 33px;position: relative;}
.munjinpyo_section01 .q05 .q05_sub > span {position: absolute;top: 5px;}
.munjinpyo_section01 .q05 .munjinpyo_q05_sub_1 {left: 3px;}
.munjinpyo_section01 .q05 .munjinpyo_q05_sub_2 {left: 180px;}
.munjinpyo_section01 .q05 .munjinpyo_q05_sub_3 {left: 345px;}
.munjinpyo_section01 .q05 .munjinpyo_q05_sub_4 {left: 520px;}

/* munjinpyo_section02 */
.munjinpyo_section02 {}
/* munjinpyo_section02 - q06 */
.munjinpyo_section02 .q06 {width: 100%;height: 74px;position: relative;}
.munjinpyo_section02 .q06 > span {position: absolute;top: 46px;}
.munjinpyo_section02 .q06 .munjinpyo_q06_1 {left: 3px;}
.munjinpyo_section02 .q06 .munjinpyo_q06_2 {left: 109px;}
.munjinpyo_section02 .q06 .munjinpyo_q06_3 {left: 273px;}
/* munjinpyo_section02 - q07 */
.munjinpyo_section02 .q07 {width: 100%;height: 97px;position: relative;padding: 40px 18px 10px;}

/* munjinpyo_section03 */
.munjinpyo_section03 .insurance_1 {width: 100%;height: 76px;}
.munjinpyo_section03 .insurance_1 .insurance_1_chk {width: 100%;height: 40px;position: relative;}
.munjinpyo_section03 .insurance_1 .insurance_1_chk > span {position: absolute;top: 25px;}
.munjinpyo_section03 .insurance_1 .munjinpyo_insurance_1_1 {left: 251px;}
.munjinpyo_section03 .insurance_1 .munjinpyo_insurance_1_2 {left: 317px;}
.munjinpyo_section03 .insurance_1 .insurance_1_sub {width: 100%;height: 36px;padding-left: 70px;line-height: 33px;}
.munjinpyo_section03 .insurance_2 {width: 100%;height: 62px;position: relative;}
.munjinpyo_section03 .insurance_2 > span {position: absolute;top: 37px;}
.munjinpyo_section03 .insurance_2 .munjinpyo_insurance_2_1 {left: 3px;}
.munjinpyo_section03 .insurance_2 .munjinpyo_insurance_2_2 {left: 122px;}
.munjinpyo_section03 .insurance_2 .munjinpyo_insurance_2_3 {left: 244px;}
.munjinpyo_section03 .insurance_2 .munjinpyo_insurance_2_4 {left: 349px;}

/* munjinpyo_bottom */
.munjinpyo_bottom {padding: 26px 0 2px;}
.munjinpyo_bottom > div {float: left;position: relative;height: 38px;}
.munjinpyo_bottom > div:nth-child(odd) {width: 468px;}
.munjinpyo_bottom > div:nth-child(even) {width: 258px;}
.munjinpyo_bottom .munjinpyo_name {line-height: 38px;padding-left: 35px;}
.munjinpyo_bottom .munjinpyo_agree {line-height: 43px;padding-left: 56px;}
</style>

<div class="munjinpyo">
	<img src="<?php echo $img?>" alt="<?php echo $type?> 문진표">
	<?php if($type == '일반') {?>
	<div class="munjinpyo_wrap">

		<div class="munjinpyo_top clearfix">
			<div class="munjinpyo_num"><?php echo $row['munjin_id'];?></div>
			<div class="munjinpyo_date"></div>
			<div class="munjinpyo_type">
				<span class="munjinpyo_basic <?php if($type == '일반') {?>munjinpyo_chk<?php }?>"></span>
				<span class="munjinpyo_braces <?php if($type == '교정') {?>munjinpyo_chk<?php }?>"></span>
			</div>
		</div>

		<div class="munjinpyo_info clearfix">
			<div class="munjinpyo_name"><?php echo $row['munjin_name'];?></div>
			<div class="munjinpyo_birth"><?php echo $row['munjin_birth'];?></div>
			<div class="munjinpyo_phone"><?php echo $row['munjin_phone'];?></div>
			<div class="munjinpyo_sex">
				<span class="munjinpyo_male <?php if($row['munjin_sex'] == '남자') {?>munjinpyo_chk<?php }?>"></span>
				<span class="munjinpyo_female <?php if($row['munjin_sex'] == '여자') {?>munjinpyo_chk<?php }?>"></span>
			</div>
			<div class="munjinpyo_addr"><?php echo $row['munjin_addr'];?></div>
		</div>

		<div class="munjinpyo_section01">
			<div class="q01">
				<?php $q01 = explode('/',$row['q01']);?>
				<span class="munjinpyo_q01_1 <?php echo in_array("혈압",  $q01) ? 'munjinpyo_chk' : ''?>"></span>
				<span class="munjinpyo_q01_2 <?php echo in_array("아스피린 복용",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
				<span class="munjinpyo_q01_3 <?php echo in_array("심장질환(수술여부)",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
				<span class="munjinpyo_q01_4 <?php echo in_array("당뇨",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
				<span class="munjinpyo_q01_5 <?php echo in_array("간염",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
				<span class="munjinpyo_q01_6 <?php echo in_array("신장병",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
				<span class="munjinpyo_q01_7 <?php echo in_array("위장질환",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
				<span class="munjinpyo_q01_8 <?php echo in_array("뇌졸증",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
				<span class="munjinpyo_q01_9 <?php echo in_array("결핵",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
				<span class="munjinpyo_q01_10 <?php echo in_array("혈액투석",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
				<span class="munjinpyo_q01_11 <?php echo in_array("갑상선",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
				<span class="munjinpyo_q01_12 <?php echo in_array("골다골증",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
				<span class="munjinpyo_q01_13 <?php echo in_array("턱관절 장애",  $q01) ? 'munjinpyo_chk' : ''?>"></span> 
			</div>
			<div class="q02">
				<div class="q02_chk">
					<span class="munjinpyo_q02_1 <?php echo $row['q02'] == '예' ? 'munjinpyo_chk' : ''?>"></span>
					<span class="munjinpyo_q02_2 <?php echo $row['q02'] == '아니요' ? 'munjinpyo_chk' : ''?>"></span>					
				</div>
				<div class="q02_sub"><?php echo $row['q02_sub']?>tttt</div>
			</div>
			<div class="q03">
				<div class="q03_chk">
					<span class="munjinpyo_q03_1 <?php echo $row['q03'] == '예' ? 'munjinpyo_chk' : ''?>"></span>
					<span class="munjinpyo_q03_2 <?php echo $row['q03'] == '아니요' ? 'munjinpyo_chk' : ''?>"></span>					
					<span class="munjinpyo_q03_3 <?php echo $row['q03'] == '잘 모르겠어요.' ? 'munjinpyo_chk' : ''?>"></span>
				</div>
				<div class="q03_sub"><?php echo $row['q03_sub']?>tttt</div>
			</div>
			<div class="q04">
				<div class="q04_chk">
					<span class="munjinpyo_q04_1 <?php echo $row['q04'] == '예' ? 'munjinpyo_chk' : ''?>"></span>
					<span class="munjinpyo_q04_2 <?php echo $row['q04'] == '아니요' ? 'munjinpyo_chk' : ''?>"></span>				
				</div>
				<div class="q04_sub">
					<span class="munjinpyo_q04_sub_1 <?php echo $row['q04_sub'] == '1~2회 흡연' ? 'munjinpyo_chk' : ''?>"></span>
					<span class="munjinpyo_q04_sub_2 <?php echo $row['q04_sub'] == '반갑 이하' ? 'munjinpyo_chk' : ''?>"></span>				
					<span class="munjinpyo_q04_sub_3 <?php echo $row['q04_sub'] == '반갑 미만' ? 'munjinpyo_chk' : ''?>"></span>				
					<span class="munjinpyo_q04_sub_4 <?php echo $row['q04_sub'] == '반갑 이상' ? 'munjinpyo_chk' : ''?>"></span>				
					<span class="munjinpyo_q04_sub_5 <?php echo $row['q04_sub'] == '잘 모르겠어요.' ? 'munjinpyo_chk' : ''?>"></span>				
				</div>
			</div>
			<div class="q05">
				<div class="q05_chk">
					<span class="munjinpyo_q05_1 <?php echo $row['q05'] == '예' ? 'munjinpyo_chk' : ''?>"></span>
					<span class="munjinpyo_q05_2 <?php echo $row['q05'] == '아니요' ? 'munjinpyo_chk' : ''?>"></span>				
				</div>						 
				<div class="q05_sub">		 
					<span class="munjinpyo_q05_sub_1 <?php echo $row['q05_sub'] == '임신 초기 ( 3개월 미만 )' ? 'munjinpyo_chk' : ''?>"></span>
					<span class="munjinpyo_q05_sub_2 <?php echo $row['q05_sub'] == '임신 중기 ( 4개월~ 7개월 )' ? 'munjinpyo_chk' : ''?>"></span>				
					<span class="munjinpyo_q05_sub_3 <?php echo $row['q05_sub'] == '임신 후기 ( 8개월 ~ 10개월 )' ? 'munjinpyo_chk' : ''?>"></span>	
					<span class="munjinpyo_q05_sub_4 <?php echo $row['q05_sub'] == '잘 모르겠어요.' ? 'munjinpyo_chk' : ''?>"></span>				
				</div>
			</div>
		</div>

		<div class="munjinpyo_section02">
			<div class="q06">
				<span class="munjinpyo_q06_1 <?php echo $row['q06'] == '검진만' ? 'munjinpyo_chk' : ''?>"></span>
				<span class="munjinpyo_q06_2 <?php echo $row['q06'] == '아픈치아의 치료만' ? 'munjinpyo_chk' : ''?>"></span>	
				<span class="munjinpyo_q06_3 <?php echo $row['q06'] == '전체적으로 검진하고 치료를 원함' ? 'munjinpyo_chk' : ''?>"></span>	
			</div>
			<div class="q07"><?php echo $row['q07']?></div>
		</div>

		<div class="munjinpyo_section03">
			<div class="insurance_1">
				<div class="insurance_1_chk">
					<span class="munjinpyo_insurance_1_1 <?php echo $row['insurance_1'] == '예' ? 'munjinpyo_chk' : ''?>"></span>
					<span class="munjinpyo_insurance_1_2 <?php echo $row['insurance_1'] == '아니요' ? 'munjinpyo_chk' : ''?>"></span>
				</div>
				<div class="insurance_1_sub"><?php echo $row['insurance_1_sub']?>tttt</div>
			</div>
			<div class="insurance_2">
				<span class="munjinpyo_insurance_2_1 <?php echo $row['insurance_2'] == '6개월 이하' ? 'munjinpyo_chk' : ''?>"></span>
				<span class="munjinpyo_insurance_2_2 <?php echo $row['insurance_2'] == '6개월 ~1년' ? 'munjinpyo_chk' : ''?>"></span>
				<span class="munjinpyo_insurance_2_3 <?php echo $row['insurance_2'] == '1년 이상' ? 'munjinpyo_chk' : ''?>"></span>
				<span class="munjinpyo_insurance_2_4 <?php echo $row['insurance_2'] == '2년 이상' ? 'munjinpyo_chk' : ''?>"></span>
			</div>
		</div>

		<div class="munjinpyo_bottom clearfix">
			<div class="munjinpyo_name"><?php echo $row['munjin_name'];?></div>
			<div class="munjinpyo_agree">동의</div>
		</div>

	</div>
	<?php }?>
</div>