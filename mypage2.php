<!-- 기업 마이페이지 -->
<!-- 마이페이지 시작 { -->

<?php
$sql_dent = " select * from g5_write_dental where wr_code = '".$member['mb_3']."' ";
$row_dent = sql_fetch($sql_dent);

$board = get_board_db('dental', true);
$write_dent = get_write('g5_write_dental', $row_dent['wr_id']);
$dental = get_view($write_dent, $board, '');

if($row_dent['wr_id']) {
$dent_href = short_url_clean(G5_BBS_URL.'/write.php?w=u&amp;bo_table='.$board['bo_table'].'&amp;wr_id='.$row_dent['wr_id'].'&amp;den_id='.$row_dent['wr_code']);
} else {
$dent_href = get_pretty_url($board['bo_table']);
}
?>

<style>
#smb_my > h1{}
.smb_btn{width:1000px; margin: 0 auto;}
.smb_btn ul{overflow: hidden;}
.smb_btn ul li{float:left; width:500px;}
.smb_btn ul li:nth-child(2n){margin-right: 0;}
.smb_btn ul li:nth-child(2n-1){border-right: 0;}
.smb_btn ul li a{width:100%; padding:0px 30px; letter-spacing: -0.02em; color:#444444; border-top:1px solid #e8e8e8; border-right:1px solid #e8e8e8; border-left:1px solid #e8e8e8; font-weight: bold; font-size: 20px; font-family: 'S-CoreDream-6Bold'; display: block; height:100px;}
.smb_btn ul li:nth-child(7) a, .smb_btn ul li:nth-child(8) a{border-bottom:1px solid #e8e8e8;}
.smb_btn ul li:nth-child(2n-1) a{border-right: 0;}
.smb_btn ul li a img:first-child{padding-bottom:7px; width:40px;}
.smb_btn ul li a span{padding-top:38px; margin-left: 15px; display: inline-block;}
.smb_btn ul li a img:last-child{float:right; padding-top:40px; width:12px;}

@media only screen and (max-width: 1280px) { /* viewport width : 1280 */
#smb_my > h1{}
.smb_btn{width:78.1250vw; margin: 0 auto;}
.smb_btn ul{}
.smb_btn ul li{ width:39.0625vw;}
.smb_btn ul li:nth-child(2n){margin-right: 0;}
.smb_btn ul li:nth-child(2n-1){border-right: 0;}
.smb_btn ul li a{padding:0.0000vw 2.3438vw;letter-spacing: -0.02em;  border-top:0.0781vw solid #e8e8e8; border-right:0.0781vw solid #e8e8e8; border-left:0.0781vw solid #e8e8e8; font-size: 1.5625vw;   height:7.8125vw;}
.smb_btn ul li:nth-child(7) a, .smb_btn ul li:nth-child(8) a{border-bottom:0.0781vw solid #e8e8e8;}
.smb_btn ul li:nth-child(2n-1) a{border-right: 0;}
.smb_btn ul li a img:first-child{padding-bottom:0.5469vw; width:3.1250vw;}
.smb_btn ul li a span{padding-top:2.9688vw; margin-left: 1.1719vw; }
.smb_btn ul li a img:last-child{ padding-top:3.1250vw; width:0.9375vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */
#smb_my > h1{border-bottom: 15px solid #f5f5f5; padding-bottom:7.8125vw; margin-bottom: 0;}
.smb_btn{width:100%; margin: 0 auto;}
.smb_btn ul{}
.smb_btn ul li{ width:100%;}
.smb_btn ul li:nth-child(2n){margin-right: 0;}
.smb_btn ul li a{margin-bottom: 0; width:100%; padding:0.0000vw 5.2083vw; letter-spacing: -0.02em;  border:0;  border-bottom:0.1302vw solid #e8e8e8; font-size: 3.5156vw;   height:14.3229vw;}
.smb_btn ul li a img:first-child{padding-bottom:0.66vw; width:5.2083vw;}
.smb_btn ul li a span{padding-top:4.5573vw; margin-left: 1.3021vw; }
.smb_btn ul li a img:last-child{ padding-top:6.5104vw; width:1.5625vw;}
}
</style>

<div id="smb_my">
	<h1><span>아나파톡 병원</span> 관리자페이지</h1>
	<div class="smb_btn">
		<ul>
			<li><a href="<?php echo get_pretty_url('dental', $row_dent['wr_id']);?>&den_id=<?php echo $member['mb_3']?>"><img src="/images/icon1.png" alt=""><span>병원 바로가기</span><img src="/images/right_arrow.png" alt=""></a></li>
			<li><a href="<?php echo G5_URL?>/mypage_r.php?den_id=<?php echo $member['mb_3']?>"><img src="/images/icon2.png" alt=""><span>예약고객 리스트</span><img src="/images/right_arrow.png" alt=""></a></li>
			<li><a href="<?php echo get_pretty_url('inquiry');?>&den_id=<?php echo $member['mb_3']?>"><img src="/images/icon3.png" alt=""><span>상담리스트</span><img src="/images/right_arrow.png" alt=""></a></li>
			<li><a href="<?php echo get_pretty_url('event');?>&den_id=<?php echo $member['mb_3']?>"><img src="/images/icon4.png" alt=""><span>병원 이벤트 관리</span><img src="/images/right_arrow.png" alt=""></a></li>
			<li><a href="<?php echo get_pretty_url('request');?>&den_id=<?php echo $member['mb_3']?>"><img src="/images/icon5.png" alt=""><span>이벤트 예약 목록</span><img src="/images/right_arrow.png" alt=""></a></li>
			<li><a href="<?php echo G5_URL;?>/reviewlist.php?den_id=<?php echo $member['mb_3']?>"><img src="/images/icon6.png" alt=""><span>병원 후기 관리</span><img src="/images/right_arrow.png" alt=""></a></li>
			<li><a href="<?php echo G5_BBS_URL.'/write.php?bo_table=dental&wr_id='.$row_dent['wr_id'].'&w=u';?>"><img src="/images/icon7.png" alt=""><span>병원 정보 관리</span><img src="/images/right_arrow.png" alt=""></a></li>
			<li><a href="<?php echo get_pretty_url('dental_notice');?>"><img src="/images/icon8.png" alt=""><span>공지사항</span><img src="/images/right_arrow.png" alt=""></a></li>
		</ul>
	</div>
</div>

<script>
function member_leave()
{
    return confirm('정말 회원에서 탈퇴 하시겠습니까?')
}
</script>
<!-- } 마이페이지 끝 -->