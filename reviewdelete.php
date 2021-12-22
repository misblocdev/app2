<?php
include_once('./_common.php');

$is_id               = isset($_POST['is_id']) ? safe_replace_regex($_POST['is_id'], 'is_id') : '';
$wr_id               = isset($_POST['wr_id']) ? safe_replace_regex($_POST['wr_id'], 'wr_id') : '';
$den_id              = isset($_POST['den_id']) ? safe_replace_regex($_POST['den_id'], 'den_id') : '';
if (isset($_POST['is_delete_content'])) {
    $is_delete_content = substr(trim($_POST['is_delete_content']),0,65536);
    $is_delete_content = preg_replace("#[\\\]+$#", "", $is_delete_content);
}

if (!$is_delete_content) alert("삭제사유를 입력하여 주십시오.");

$url = get_pretty_url('dental').'&wr_id='.$wr_id.'&den_id='.$den_id;

$sql = " update {$g5['g5_shop_item_use_table']}
                set is_delete = '1',
                    is_delete_content = '$is_delete_content'
              where is_id = '$is_id' ";
sql_query($sql);

$alert_msg = "진료후기 삭제가 요청되었습니다.";

alert($alert_msg, $url);