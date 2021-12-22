<?php
$sub_menu = '300900';
include_once('./_common.php');

// 상품이 많을 경우 대비 설정변경
set_time_limit ( 0 );
ini_set('memory_limit', '50M');

auth_check_menu($auth, $sub_menu, "w");

function only_number($n)
{
    return preg_replace('/[^0-9]/', '', $n);
}

$is_upload_file = (isset($_FILES['excelfile']['tmp_name']) && $_FILES['excelfile']['tmp_name']) ? 1 : 0;

if( ! $is_upload_file){
    alert("엑셀 파일을 업로드해 주세요.");
}

if($is_upload_file) {
    $file = $_FILES['excelfile']['tmp_name'];

    include_once(G5_LIB_PATH.'/PHPExcel/IOFactory.php');

    $objPHPExcel = PHPExcel_IOFactory::load($file);
    $sheet = $objPHPExcel->getSheet(0);

    $num_rows = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    $dup_num = array();
    $dup_count = 0;
    $total_count = 0;
    $succ_count = 0;
    $update_count = 0;

    for ($i = 2; $i <= $num_rows; $i++) {
        $total_count++;

        $j = 0;

        $rowData = $sheet->rangeToArray('A' . $i . ':' . $highestColumn . $i,
                                            NULL,
                                            TRUE,
                                            FALSE);

        $wr_14              = addslashes($rowData[0][$j++]); // 번호 -> 엑셀고유번호
        $wr_subject         = (string) $rowData[0][$j++]; // 병원/약국명
        $wr_13              = addslashes($rowData[0][$j++]); // 병원/약국구분
        $wr_8               = addslashes($rowData[0][$j++]); // 전화번호
        $zipnum             = addslashes($rowData[0][$j++]); // 우편번호
        $wr_2               = addslashes($rowData[0][$j++]); // 소재지주소
        $wr_link1           = addslashes($rowData[0][$j++]); // 홈페이지        

        // wr_14 중복체크
        $sql2 = " select count(*) as cnt from g5_write_dental2 where wr_14 = '$wr_14' ";
        $row2 = sql_fetch($sql2);
        if(isset($row2['cnt']) && $row2['cnt']) {

			$sql = " update g5_write_dental2
                set wr_subject = '{$wr_subject}',
                     wr_link1 = '{$wr_link1}',
                     wr_2 = '{$wr_2}',
                     wr_8 = '{$wr_8}',
                     wr_13 = '{$wr_13}'
              where wr_14 = '{$wr_14}' ";
			sql_query($sql);

			$dup_num[] = $wr_14;
			$dup_count++;
			$update_count++;

			
        } else {
			$write_table = $g5['write_prefix'] . 'dental2';
			$wr_num = get_next_num($write_table);
			$wr_reply = '';

			$sql = " insert into g5_write_dental2
                set wr_num = '$wr_num',
                     wr_reply = '$wr_reply',
                     wr_comment = 0,
                     ca_name = '',
                     wr_option = '',
                     wr_subject = '$wr_subject',
                     wr_content = '',
                     wr_seo_title = '',
                     wr_link1 = '$wr_link1',
                     wr_link2 = '',
                     wr_link1_hit = 0,
                     wr_link2_hit = 0,
                     wr_hit = 0,
                     wr_good = 0,
                     wr_nogood = 0,
                     mb_id = 'admin',
                     wr_password = '',
                     wr_name = '최고관리자',
                     wr_email = 'admin@domain.com',
                     wr_homepage = '',
                     wr_datetime = '".G5_TIME_YMDHIS."',
                     wr_last = '".G5_TIME_YMDHIS."',
                     wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                     wr_2 = '$wr_2',
                     wr_8 = '$wr_8',
                     wr_13 = '$wr_13',
                     wr_14 = '$wr_14' ";

			sql_query($sql);

			$wr_id = sql_insert_id();

			// 부모 아이디에 UPDATE
			sql_query(" update g5_write_dental2 set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

			// 새글 INSERT
			sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( 'dental2', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', 'admin' ) ");

			// 게시글 1 증가
			sql_query("update {$g5['board_table']} set bo_count_write = bo_count_write + 1 where bo_table = 'dental2'");

			$succ_count++;

		}
    }
}

$g5['title'] = '엑셀일괄등록 결과';
include_once ('./admin.head.php');
?>

<div class="new_win">
    <h1><?php echo $g5['title']; ?></h1>

    <div class="local_desc01 local_desc">
        <p>등록을 완료했습니다.</p>
    </div>

    <dl id="excelfile_result">
        <dt>총등록수</dt>
        <dd><?php echo number_format($total_count); ?></dd>
        <dt>완료건수</dt>
        <dd><?php echo number_format($succ_count); ?></dd>
        <?php if($dup_count > 0) { ?>
        <dt>중복건수</dt>
        <dd><?php echo number_format($dup_count); ?></dd>
        <dt>중복코드</dt>
        <dd><?php echo implode(', ', $dup_num); ?></dd>
        <dt>업데이트수</dt>
        <dd><?php echo number_format($update_count); ?></dd>
        <?php } ?>
    </dl>

    <div class="btn_win01 btn_win">
        <a href="./dentalexcel.php">돌아가기</a>
    </div>

</div>

<?php
include_once ('./admin.tail.php');