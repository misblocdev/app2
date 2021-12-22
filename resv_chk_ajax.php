<?php
include_once('./_common.php');

$kk = $_POST['kk'];

$now = date("Y-m");

$thistime_01 = date("Y-m-01", strtotime(date("Y-m").' '.$kk.' month')); // 셀렉 달 1일
$thistime_m = date("Y-m", strtotime(date("Y-m").' '.$kk.' month')); // 셀렉 달

$cpid = $_POST['cpid'];
?>

<script>
	function getWeekNo(v_date_str) {
		var date = new Date();
		if(v_date_str){
			date = new Date(v_date_str);
		}
		return Math.ceil(date.getDate() / 7);
	}

	var cchhwwchwy = '';
	var cchhwwchw = '';
	var htmld = '';
	var colwidth = "<col width='14%'><col width='14%'><col width='14%'><col width='14%'><col width='14%'><col width='14%'><col width='14%'>";
	var ddd = "<?php echo $kk?>";
	
	function setStyle(id,style,value)
	{
	//	id.style[style] = value;
	}
	function opacity(el,opacity)
	{
	//	setStyle(el,"filter:","alpha(opacity="+opacity+")");
	//	setStyle(el,"-moz-opacity",opacity/100);
	//	setStyle(el,"-khtml-opacity",opacity/100);
	//	setStyle(el,"opacity",opacity/100);
	}

	var nows = new Date();
	var dnow = nows.getDate();
	var now = new Date();
	var date = new Date(now.getFullYear(), now.getMonth()+Number(ddd), 1);
	var day =   now.getDate();
	var month = date.getMonth();
	var year = date.getYear();
	if(year<=200)
	{
		year += 1900;
	}
	months = new Array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
	days_in_month = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
	if(year%4 == 0 && year!=1900)
	{
		days_in_month[1]=29;
	}
	total = days_in_month[month];
	var date_today = year+'년 '+months[month]+'월 ';


	if(months[month]<10){
		chw_date = year+"-0"+months[month]+"-";
	}else{
		chw_date = year+"-"+months[month]+"-";
	}
	cchhwwchwy = year;

	beg_j = date;
	beg_j.setDate(1);
	if(beg_j.getDate()==2)
	{
		beg_j=setDate(0);
	}
	beg_j = beg_j.getDay();
	htmld +='<table class="cal_calendar">'+colwidth+'<tbody id="cal_body"><tr><th colspan="7">'+date_today+'</th></tr>';
	htmld +='<tr class="cal_d_weeks"><th class="ttt">일</th><th>월</th><th>화</th><th>수</th><th>목</th><th>금</th><th class="tttt">토</th></tr><tr>';
	week = 0;
	for(i=1;i<=beg_j;i++)
	{
		htmld +='<td class="cal_days_bef_aft">'+'</td>';//(days_in_month[month-1]-beg_j+i)
		week++;
	}
	var div1 = new Array();
	var div2 = new Array();

	div1[0] = "<?php echo $h1;?>";
	div1[1] = "<?php echo $h2;?>";
	div1[2] = "<?php echo $h3;?>";
	div1[3] = "<?php echo $h4;?>";
	div1[4] = "<?php echo $h5;?>";
	div1[5] = "<?php echo $h6;?>";
	div1[6] = "<?php echo $h7;?>";
	div1[7] = "<?php echo $h8;?>";
	div1[8] = "<?php echo $h9;?>";
	div1[9] = "<?php echo $h10;?>";
	div1[10] = "<?php echo $h11;?>";
	div1[11] = "<?php echo $h12;?>";
	div1[12] = "<?php echo $h13;?>";
	div1[13] = "<?php echo $h14;?>";
	div1[14] = "<?php echo $h15;?>";
	div1[15] = "<?php echo $h16;?>";
	div1[16] = "<?php echo $h17;?>";
	div1[17] = "<?php echo $h18;?>";
	div1[18] = "<?php echo $h19;?>";
	div1[19] = "<?php echo $h20;?>";
	div1[20] = "<?php echo $h21;?>";
	div1[21] = "<?php echo $h22;?>";
	div1[22] = "<?php echo $h23;?>";
	div1[23] = "<?php echo $h24;?>";
	div1[24] = "<?php echo $h25;?>";
	div1[25] = "<?php echo $h26;?>";
	div1[26] = "<?php echo $h27;?>";
	div1[27] = "<?php echo $h28;?>";
	div1[28] = "<?php echo $h29;?>";
	div1[29] = "<?php echo $h30;?>";
	div1[30] = "<?php echo $h31;?>";

	div2[0] = "<?php echo $true_1;?>";
	div2[1] = "<?php echo $true_2;?>";
	div2[2] = "<?php echo $true_3;?>";
	div2[3] = "<?php echo $true_4;?>";
	div2[4] = "<?php echo $true_5;?>";
	div2[5] = "<?php echo $true_6;?>";
	div2[6] = "<?php echo $true_7;?>";
	div2[7] = "<?php echo $true_8;?>";
	div2[8] = "<?php echo $true_9;?>";
	div2[9] = "<?php echo $true_10;?>";
	div2[10] = "<?php echo $true_11;?>";
	div2[11] = "<?php echo $true_12;?>";
	div2[12] = "<?php echo $true_13;?>";
	div2[13] = "<?php echo $true_14;?>";
	div2[14] = "<?php echo $true_15;?>";
	div2[15] = "<?php echo $true_16;?>";
	div2[16] = "<?php echo $true_17;?>";
	div2[17] = "<?php echo $true_18;?>";
	div2[18] = "<?php echo $true_19;?>";
	div2[19] = "<?php echo $true_20;?>";
	div2[20] = "<?php echo $true_21;?>";
	div2[21] = "<?php echo $true_22;?>";
	div2[22] = "<?php echo $true_23;?>";
	div2[23] = "<?php echo $true_24;?>";
	div2[24] = "<?php echo $true_25;?>";
	div2[25] = "<?php echo $true_26;?>";
	div2[26] = "<?php echo $true_27;?>";
	div2[27] = "<?php echo $true_28;?>";
	div2[28] = "<?php echo $true_29;?>";
	div2[29] = "<?php echo $true_30;?>";
	div2[30] = "<?php echo $true_31;?>";
	//alert(div1[27]);
	//alert(day)
	
	var div3 = new Array();

	div3[0] = "<?php echo $not_1;?>";
	div3[1] = "<?php echo $not_2;?>";
	div3[2] = "<?php echo $not_3;?>";
	div3[3] = "<?php echo $not_4;?>";
	div3[4] = "<?php echo $not_5;?>";
	div3[5] = "<?php echo $not_6;?>";
	div3[6] = "<?php echo $not_7;?>";
	div3[7] = "<?php echo $not_8;?>";
	div3[8] = "<?php echo $not_9;?>";
	div3[9] = "<?php echo $not_10;?>";
	div3[10] = "<?php echo $not_11;?>";
	div3[11] = "<?php echo $not_12;?>";
	div3[12] = "<?php echo $not_13;?>";
	div3[13] = "<?php echo $not_14;?>";
	div3[14] = "<?php echo $not_15;?>";
	div3[15] = "<?php echo $not_16;?>";
	div3[16] = "<?php echo $not_17;?>";
	div3[17] = "<?php echo $not_18;?>";
	div3[18] = "<?php echo $not_19;?>";
	div3[19] = "<?php echo $not_20;?>";
	div3[20] = "<?php echo $not_21;?>";
	div3[21] = "<?php echo $not_22;?>";
	div3[22] = "<?php echo $not_23;?>";
	div3[23] = "<?php echo $not_24;?>";
	div3[24] = "<?php echo $not_25;?>";
	div3[25] = "<?php echo $not_26;?>";
	div3[26] = "<?php echo $not_27;?>";
	div3[27] = "<?php echo $not_28;?>";
	div3[28] = "<?php echo $not_29;?>";
	div3[29] = "<?php echo $not_30;?>";
	div3[30] = "<?php echo $not_31;?>";

	var chw_4_week = 0;
	for(i=1;i<=total;i++)
	{
		if(week==0)
		{
			htmld +='<tr>';
		}		
		
		if(week==0){
			yoilname = "일";
		}else if(week==1){
		    yoilname = "월";
		}else if(week==2){
		    yoilname = "화";
		}else if(week==3){
		    yoilname = "수";
		}else if(week==4){
		    yoilname = "목";
		}else if(week==5){
		    yoilname = "금";
		}else if(week==6){
		    yoilname = "토";
		}

		if(i < 10){
			var chw_d = '0'+i;
		} else {
			var chw_d = i;
		}

		if(week == 1){
			chw_4_week = chw_4_week+1;

			var oj_out = "";
		} else {
			var oj_out = "";
		}

		htmld +='<td>'+'<a href="javascript:;" data-date="'+chw_date+chw_d+'" class="date_click">'+i+'</a>'+'</td>';
		
		week++;
		if(week==7)
		{
			htmld +='</tr>';
			week=0;
		}
	}
	for(i=1;week!=0;i++)
	{
		htmld +='<td class="cal_days_bef_aft">'+'</td>';
		week++;
		if(week==7)
		{
			htmld +='</tr>';
			week=0;
		}
	}
	htmld +='</tbody></table>';
	//opacity(document.getElementById('cal_body'),70);
</script>	
<div id="yayadddd">

</div>
<script type="text/javascript">	
$("#yayadddd").html(htmld);

$(function(){
	
	$(".date_click").click(function(){
		var datess = $(this).data("date");

		$(".date_click").removeClass("on");
		$(this).addClass("on");

		$.ajax({
			url: "<?php echo G5_URL?>/resv_cont_ajax.php",
			type: "POST",
			data: {date:datess},
			success: function(msg){
				$("#resv_wrap").html(msg);					
			}
		});
	});

	var initdate = '<?php echo date("Y-m-d")?>';
	$("a[data-date="+initdate+"]").addClass("on");

	$.ajax({
		url: "<?php echo G5_URL?>/resv_cont_ajax.php",
		type: "POST",
		data: {date:initdate},
		success: function(msg){
			$("#resv_wrap").html(msg);					
		}
	});
});
</script>