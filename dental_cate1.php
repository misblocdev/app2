<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.php');
?>

<style>
.sc li {float: left;position:relative;margin:0 0 20px 0;background:#fff;padding: 30px;border: 1px solid #dddddd;border-top-left-radius: 25px;border-bottom-right-radius: 25px;width: 590px;}
.sc li:nth-child(even) {float: right;}
.sc li:nth-child(11) {display: none;}
.sc li:nth-child(12) {display: none;}
.sc .cate_img{text-align:center;float: left;padding-right: 30px;}
.sc .cate_img a,.sc .cate_img .no_image,.sc .cate_img .is_notice{display:block}
.sc .cate_img img{height:auto !important}
.sc .cate_img span{display:inline-block;background:#eee;text-align:center;line-height:150px;text-transform:uppercase;font-weight:bold;font-size:1.25em;color:#777}
.sc .cate_txt {padding: 16px 0 0px;float: left;width: 340px;}
.sc .cate_name {display:block;font-size: 20px;font-weight:500;line-height: 25px;margin-bottom: 14px;letter-spacing: -0.02em;overflow: hidden; white-space: nowrap; text-overflow: ellipsis; word-break: break-word;}
.sc .cate_name a {color: #9196ff;}
.sc .cate_explain {font-size: 16px; color: #3d3d3d; font-weight: 400;line-height: 24px;letter-spacing: -0.02em;display: -webkit-box;display: box;vertical-align: top;overflow: hidden;text-overflow: ellipsis;word-break: keep-all;-webkit-box-orient: vertical;-webkit-line-clamp: 2;}
.sc .cate_btn {position: absolute;right: 30px;top: 27px;}

/* 반응형 css */
@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

.sc li {margin:0 0 1.5625vw 0;padding: 2.3438vw;border-top-left-radius: 1.9531vw;border-bottom-right-radius: 1.9531vw;width: 46.0938vw;}
.sc .cate_img{padding-right: 2.3438vw;}
.sc .cate_img img{width:10.0781vw;height: 10.0781vw !important}
.sc .cate_img span{line-height:11.7188vw;}
.sc .cate_txt {padding: 1.2500vw 0 0.0000vw;width: 26.5625vw;}
.sc .cate_name {font-size: 1.5625vw;line-height: 1.9531vw;margin-bottom: 1.0938vw;}
.sc .cate_explain {font-size: 1.2500vw;  line-height: 1.8750vw;}
.sc .cate_btn {right: 2.3438vw;top: 2.1094vw;}
.sc .cate_btn img {width: 3.5156vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

.sc li {float: none;margin:0 0 2.6042vw 0;padding: 4.5573vw 3.2552vw;border-top-left-radius: 4.5573vw;border-bottom-right-radius: 4.5573vw;width: 100%;}
.sc li:after {content: '';display: block;clear: both;}
.sc li:nth-child(even) {float: none;}
.sc .cate_img {padding-right: 0.0000vw;width: 22.1354vw;margin-right: 3.9063vw;}
.sc .cate_img img {width: 100%;height:auto !important}
.sc .cate_txt {padding: 1.3021vw 0 0.0000vw;width: 54.6875vw;}
.sc .cate_name {font-size: 3.6458vw;line-height: 7.2917vw;margin-bottom: 0.6510vw;}
.sc .cate_explain {font-size: 3.1250vw; line-height: 5.4688vw;}
.sc .cate_btn {right: 3.9063vw;top: 3.2552vw;}
.sc .cate_btn img {width: 6.3802vw;}

}
</style>

<div class="sub_content">
	<div class="inner">
		<div class="sub_title">치과찾기</div>
		<div class="sub_nav sub_nav_4">
			<ul class="clearfix">
				<li><a href="<?php echo G5_URL;?>/dental_cate3.php">지도<span class="hide768">로 </span>찾기</a></li>
				<li class="on"><a href="<?php echo G5_URL;?>/dental_cate1.php">분야<span class="hide768">로 </span>찾기</a></li>
				<li><a href="<?php echo G5_URL;?>/dental_cate2.php">지역<span class="hide768">으로 </span>찾기</a></li>
				<li><a href="<?php echo G5_URL;?>/dental_cate4.php">증상<span class="hide768">으로 </span>찾기</a></li>
			</ul>
		</div>
		<div class="sc">
			<ul class="clearfix">
			<?php 
			$sql_ca = ' select * from g5_board where bo_table = "dental" ';
			$row_ca = sql_fetch($sql_ca);
			$cate = explode('|', $row_ca['bo_category_list']);

			for($i = 0 ; $i < count($cate) ; $i++) { ?>
				<li>
					<div class="cate_img"><a href="<?php echo get_pretty_url('dental','','&sca='.$cate[$i].'&ct=1');?>"><img src="/images/cate_icon_<?php echo $i+1?>_on.png" alt="<?php echo $cate[$i]?>"></a></div>
					<div class="cate_txt">
						<div class="cate_name"><a href="<?php echo get_pretty_url('dental','','&sca='.$cate[$i].'&ct=1');?>"><?php echo $cate[$i]?></a></div>
						<div class="cate_explain"><?php echo $row_ca['bo_'.($i+1)]?></div>
					</div>
					<div class="cate_btn"><a href="<?php echo get_pretty_url('dental','','&sca='.$cate[$i].'&ct=1');?>"><img src="/images/btn_info.png" alt="상세보기"></a></div>
				</li>
			<?php } ?>
			</ul>
		</div>
	</div>
</div>

<?php
include_once(G5_PATH.'/tail.php');