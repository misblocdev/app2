<?php
include_once('../common.php');

include_once(G5_PATH.'/head.sub.php');

$den_id = $_GET['denid'];
$rsv_date = $_GET['date'];
$rsv_time = $_GET['time'];
$dental = sql_fetch("select * from g5_write_dental where wr_code='".$den_id."'");
?>
<link rel="stylesheet" href="<?php echo G5_URL;?>/munjin/munjin.css">
<link
  rel="stylesheet"
  href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
/>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>