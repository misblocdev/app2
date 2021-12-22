<?php
include_once('./_common.php');

$mb_id = $_POST['mbid'];

// 유저 불러오기
$sql_mb = " select * from {$g5['member_table']} where mb_id = '{$mb_id}' limit 1";
$row_mb = sql_fetch($sql_mb);
$result_mb = sql_query($sql_mb);
$mb = sql_fetch_array($result_mb);
?>

<p><?php echo $mb['mb_name']; ?></p>
<p><?php echo $mb['mb_id']; ?></p>
<p><?php echo $mb['mb_email']; ?></p>
<p><?php echo $mb['mb_hp']; ?></p>