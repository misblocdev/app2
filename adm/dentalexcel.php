<?php
$sub_menu = '300900';
include_once('./_common.php');

check_demo();

auth_check_menu($auth, $sub_menu, 'r');

$g5['title'] = '치과 엑셀 등록';
include_once ('./admin.head.php');
?>

<div class="">
    <h1><?php echo $g5['title']; ?></h1>

    <form name="fitemexcel" method="post" action="./dentalexcelupdate.php" enctype="MULTIPART/FORM-DATA" autocomplete="off">

    <div id="excelfile_upload">
        <label for="excelfile">파일선택</label>
        <input type="file" name="excelfile" id="excelfile">
    </div>

    <div class="win_btn btn_confirm">
        <input type="submit" value="엑셀파일 등록" class="btn_submit btn">
        <!-- <button type="button" onclick="window.close();" class="btn_close btn">닫기</button> -->
    </div>

    </form>

</div>

<?php
include_once ('./admin.tail.php');