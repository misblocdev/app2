<?php
include_once('./_common.php');

if (!$is_member)
    goto_url(G5_BBS_URL."/login.php?url=".urlencode(G5_BBS_URL."/mypage.php"));


$g5['title'] = '마이페이지';
include_once('./_head.php');

if($member['mb_10'] == 1) {
include_once(G5_PATH.'/mypage2.php');
} else {
include_once(G5_PATH.'/mypage1.php');
}

include_once("./_tail.php");