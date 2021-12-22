<?php
include_once('./_common.php');

$mbset = sql_fetch("select * from basic_set2 where mb_id='".$member['mb_id']."' and wr_date='".$_POST['td']."'");
$mbset2 = explode("|",$mbset['wr_times']);
?>

<form action="<?php echo G5_URL?>/m6_update2.php" id="fffff" method="post">
	<input type="hidden" value="<?php echo $_POST['td'];?>" name="wr_date1">
	<input type="hidden" value="<?php echo $mbset['wr_id'] ? 'u' : ''?>" name="w">
	<p><?php echo $_POST['td'];?></p>
	<div class="chk_holiday">
		<div class="chk_box">
			<input type="checkbox" id="for25" name="wr_date" value="휴무" class="checkboxc times12 selec_chk" <?php echo $mbset['etc']=="휴무"?"checked":"";?>>
			<label for="for25"><span></span>휴무</label>
		</div>
		<span style="display: block;color:red">휴무 설정시 하단 시간은 의미가 없어집니다.</span>
	</div>

	<div class="content inputdivt clearfix">
		<div class="chk_box">
			<input type="checkbox" id="ffor1" name="times5[]" <?php echo in_array("1",$mbset2)?"checked":"";?> value="1" class="checkboxc times2 selec_chk">
			<label for="ffor1"><span></span>01:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor2" name="times5[]" <?php echo in_array("2",$mbset2)?"checked":"";?> value="2" class="checkboxc times2 selec_chk">
			<label for="ffor2"><span></span>02:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor3" name="times5[]" <?php echo in_array("3",$mbset2)?"checked":"";?> value="3" class="checkboxc times2 selec_chk">
			<label for="ffor3"><span></span>03:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor4" name="times5[]" <?php echo in_array("4",$mbset2)?"checked":"";?> value="4" class="checkboxc times2 selec_chk">
			<label for="ffor4"><span></span>04:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor5" name="times5[]" <?php echo in_array("5",$mbset2)?"checked":"";?> value="5" class="checkboxc times2 selec_chk">
			<label for="ffor5"><span></span>05:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor6" name="times5[]" <?php echo in_array("6",$mbset2)?"checked":"";?> value="6" class="checkboxc times2 selec_chk">
			<label for="ffor6"><span></span>06:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor7" name="times5[]" <?php echo in_array("7",$mbset2)?"checked":"";?> value="7" class="checkboxc times2 selec_chk">
			<label for="ffor7"><span></span>07:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor8" name="times5[]" <?php echo in_array("8",$mbset2)?"checked":"";?> value="8" class="checkboxc times2 selec_chk">
			<label for="ffor8"><span></span>08:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor9" name="times5[]" <?php echo in_array("9",$mbset2)?"checked":"";?> value="9" class="checkboxc times2 selec_chk">
			<label for="ffor9"><span></span>09:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor10" name="times5[]" <?php echo in_array("10",$mbset2)?"checked":"";?> value="10" class="checkboxc times2 selec_chk">
			<label for="ffor10"><span></span>10:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor11" name="times5[]" <?php echo in_array("11",$mbset2)?"checked":"";?> value="11" class="checkboxc times2 selec_chk">
			<label for="ffor11"><span></span>11:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor12" name="times5[]" <?php echo in_array("12",$mbset2)?"checked":"";?> value="12" class="checkboxc times2 selec_chk">
			<label for="ffor12"><span></span>12:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor13" name="times5[]" <?php echo in_array("13",$mbset2)?"checked":"";?> value="13" class="checkboxc times2 selec_chk">
			<label for="ffor13"><span></span>13:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor14" name="times5[]" <?php echo in_array("14",$mbset2)?"checked":"";?> value="14" class="checkboxc times2 selec_chk">
			<label for="ffor14"><span></span>14:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor15" name="times5[]" <?php echo in_array("15",$mbset2)?"checked":"";?>  value="15" class="checkboxc times2 selec_chk">
			<label for="ffor15"><span></span>15:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor16" name="times5[]" <?php echo in_array("16",$mbset2)?"checked":"";?> value="16" class="checkboxc times2 selec_chk">
			<label for="ffor16"><span></span>16:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor17" name="times5[]" <?php echo in_array("17",$mbset2)?"checked":"";?> value="17" class="checkboxc times2 selec_chk">
			<label for="ffor17"><span></span>17:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor18" name="times5[]" <?php echo in_array("18",$mbset2)?"checked":"";?> value="18" class="checkboxc times2 selec_chk">
			<label for="ffor18"><span></span>18:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor19" name="times5[]" <?php echo in_array("19",$mbset2)?"checked":"";?> value="19" class="checkboxc times2 selec_chk">
			<label for="ffor19"><span></span>19:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor20" name="times5[]" <?php echo in_array("20",$mbset2)?"checked":"";?> value="20" class="checkboxc times2 selec_chk">
			<label for="ffor20"><span></span>20:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor21" name="times5[]" <?php echo in_array("21",$mbset2)?"checked":"";?> value="21" class="checkboxc times2 selec_chk">
			<label for="ffor21"><span></span>21:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor22" name="times5[]" <?php echo in_array("22",$mbset2)?"checked":"";?> value="22" class="checkboxc times2 selec_chk">
			<label for="ffor22"><span></span>22:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor23" name="times5[]" <?php echo in_array("23",$mbset2)?"checked":"";?> value="23" class="checkboxc times2 selec_chk">
			<label for="ffor23"><span></span>23:00</label>
		</div>
		<div class="chk_box">
			<input type="checkbox" id="ffor24" name="times5[]" <?php echo in_array("24",$mbset2)?"checked":"";?> value="24" class="checkboxc times2 selec_chk">
			<label for="ffor24"><span></span>24:00</label>
		</div>
	</div>

	<div class="content">
		<div class="chk_box">
			<input type="checkbox" id="allday" name="allday" value="1" class="checkboxc times2 selec_chk">
			<label for="allday"><span></span>전체적용</label>
		</div>	
		<span style="display: block;color:red">전체적용 설정시 <?php echo $_POST['td'];?>부터 적용됩니다.</span>
	</div>
</form>

<div class="content date_pop_btn">
	<a href="javascript:;" class="sbsbsb sbsbsb4">설정하기</a>
	<a href="javascript:;" style="background: #333;" class="sbsbsb sbsbsb5">닫기</a>
</div>