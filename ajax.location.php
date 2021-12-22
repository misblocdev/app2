<?php
include_once('./_common.php');

$loca1 = $_POST['loca1'];
$loca2 = $_POST['loca2'];

$event = get_board_db('event', true);
//echo $board['bo_category_list'];
$cate = explode('|', $event['bo_category_list']);
?>
<ul>
<?php 
for($i = 0 ; $i < count($cate) ; $i++) { ?>
	<li><a href="<?php echo get_pretty_url('event');?>&sca=<?php echo $cate[$i]?>&sop=or&sfl=wr_3&stx=<?php echo $loca2;?>&locate=<?php echo $loca1;?>"><?php echo $cate[$i]?></a></li>
<?php }
?>
</ul>