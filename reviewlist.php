<?php
include_once('./_common.php');

if( isset($sfl) && ! in_array($sfl, array('b.it_name', 'a.it_id', 'a.is_subject', 'a.is_content', 'a.is_name', 'a.mb_id')) ){
    //다른값이 들어가있다면 초기화
    $sfl = '';
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/reviewlist.php');
    return;
}

$g5['title'] = '진료후기';
include_once('./_head.php');

//$sql_common = " from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id) ";
$sql_common = " from `{$g5['g5_shop_item_use_table']}` ";
$sql_search = " where is_confirm = '1' and is_delete = '0' ";

if(!$sfl)
    $sfl = 'b.it_name';

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "a.it_id" :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
        case "a.is_name" :
        case "a.mb_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default :
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($den_id) {
	$sql_search .= " and it_id = '{$den_id}' ";
	$page_url = $_SERVER['SCRIPT_NAME'].'?$qstr&amp;den_id='.$den_id.'&amp;page=';
	$sub_title = '병원 후기 관리';
} else {
	$page_url = $_SERVER['SCRIPT_NAME'].'?$qstr&amp;page=';
	$sub_title = '치과치료 후기';
}

if (!$sst) {
    $sst  = "is_id";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

//echo $sql;

$itemuselist_skin = G5_REVIEW_SKIN_PATH.'/reviewlist.skin.php';

if(!file_exists($itemuselist_skin)) {
    echo str_replace(G5_PATH.'/', '', $itemuselist_skin).' 스킨 파일이 존재하지 않습니다.';
} else {
    include_once($itemuselist_skin);
}

include_once('./_tail.php');