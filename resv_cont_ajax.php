<?php
include_once('./_common.php');

$date = $_POST['date'];

/* 예약온 리스트 */
$my_reser = sql_query("select * from reser where dental_id='".$member['mb_id']."' and wr_date='".$date."' order by wr_date desc, wr_time desc");
$my_reser_num = sql_num_rows($my_reser);
?>

<?php if($my_reser_num > 0) { ?>
<!-- 나의 예약리스트 있음-->
<ul class="resv_list">
	<?php for($i = 0; $row = sql_fetch_array($my_reser) ;$i++) {
		$den = sql_fetch(" select * from g5_write_dental where wr_code = '{$row['dental_id']}' ");
	?>
	<li>
		<strong><?php echo $row['wr_date'].' '.$row['wr_time'];?></strong>
		<span><?php echo $row['mb_name'];?></span>
		<a href="/bbs/board.php?bo_table=dental&wr_id=<?php echo $den['wr_id']; ?>&den_id=<?php echo $row['dental_id']; ?>">문진표보기</a>
	</li>		
	<?php } ?>
</ul>
<?php } else { ?>
<!-- 나의 예약리스트 없음-->
<p>예약이 없습니다.</p>
<?php } ?>

<div class="modalbox" style="display:none;">

</div>

<script>
function idprint(mbid){
	$.ajax({
		url : "<?php echo G5_URL?>/mbinfo_ajax.php",
		type: "POST",
		data : {
			"mbid" : mbid
		},
		async: false,
		success: function(msg) {
			$(".modalbox").html(msg);
		},error: function(request,status,error){
			alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
		}
	});
};
</script>