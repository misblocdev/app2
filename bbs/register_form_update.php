<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 리퍼러 체크
referer_check();

if (!($w == '' || $w == 'u')) {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

if ($w == 'u' && $is_admin == 'super') {
    if (file_exists(G5_PATH.'/DEMO'))
        alert('데모 화면에서는 하실(보실) 수 없는 작업입니다.');
}

if (!chk_captcha()) {
    //alert('자동등록방지 숫자가 틀렸습니다.');
}

for($i=0;$i<100;$i++){
	$rand_code = sprintf('%08d',rand(100000,999999));
	
	//$sql_rn = ' SELECT * FROM g5_member where mb_code = "'.$rand_code.'" ';
	$row_rn = sql_fetch(' SELECT mb_id FROM g5_member where mb_code = "'.$rand_code.'" ');
	if($row_rn['mb_id']){
		//break;
	}else{
		//$mb_code = $rand_code;
		break;
	}
}

if($w == 'u')
    $mb_id = isset($_SESSION['ss_mb_id']) ? trim($_SESSION['ss_mb_id']) : '';
else if($w == '')
    $mb_id = isset($_POST['mb_id']) ? trim($_POST['mb_id']) : '';
else
    alert('잘못된 접근입니다', G5_URL);

if(!$mb_id)
    alert('회원아이디 값이 없습니다. 올바른 방법으로 이용해 주십시오.');

$mb_password    = isset($_POST['mb_password']) ? trim($_POST['mb_password']) : '';
$mb_password_re = isset($_POST['mb_password_re']) ? trim($_POST['mb_password_re']) : '';
$mb_name        = isset($_POST['mb_name']) ? trim($_POST['mb_name']) : '';
$mb_nick        = isset($_POST['mb_nick']) ? trim($_POST['mb_nick']) : '';
$mb_email       = isset($_POST['mb_email']) ? trim($_POST['mb_email']) : '';
$mb_sex         = isset($_POST['mb_sex'])           ? trim($_POST['mb_sex'])         : "";
$mb_birth       = isset($_POST['mb_birth'])         ? trim($_POST['mb_birth'])       : "";
$mb_homepage    = isset($_POST['mb_homepage'])      ? trim($_POST['mb_homepage'])    : "";
$mb_tel         = isset($_POST['mb_tel'])           ? trim($_POST['mb_tel'])         : "";
$mb_hp          = isset($_POST['mb_hp'])            ? trim($_POST['mb_hp'])          : "";
$mb_zip1        = isset($_POST['mb_zip'])           ? substr(trim($_POST['mb_zip']), 0, 3) : "";
$mb_zip2        = isset($_POST['mb_zip'])           ? substr(trim($_POST['mb_zip']), 3)    : "";
$mb_addr1       = isset($_POST['mb_addr1'])         ? trim($_POST['mb_addr1'])       : "";
$mb_addr2       = isset($_POST['mb_addr2'])         ? trim($_POST['mb_addr2'])       : "";
$mb_addr3       = isset($_POST['mb_addr3'])         ? trim($_POST['mb_addr3'])       : "";
$mb_addr_jibeon = isset($_POST['mb_addr_jibeon'])   ? trim($_POST['mb_addr_jibeon']) : "";
$mb_signature   = isset($_POST['mb_signature'])     ? trim($_POST['mb_signature'])   : "";
$mb_profile     = isset($_POST['mb_profile'])       ? trim($_POST['mb_profile'])     : "";
$mb_recommend   = isset($_POST['mb_recommend'])     ? trim($_POST['mb_recommend'])   : "";
$mb_mailling    = isset($_POST['mb_mailling'])      ? trim($_POST['mb_mailling'])    : "";
$mb_sms         = isset($_POST['mb_sms'])           ? trim($_POST['mb_sms'])         : "";
$mb_1           = isset($_POST['mb_1'])             ? trim($_POST['mb_1'])           : "";
$mb_2           = isset($_POST['mb_2'])             ? trim($_POST['mb_2'])           : "";
$mb_3           = isset($_POST['mb_3'])             ? trim($_POST['mb_3'])           : "";
//$mb_3           = isset($mb_code)                   ? trim($mb_code)                 : "";
$mb_4           = isset($_POST['mb_4'])             ? trim($_POST['mb_4'])           : "";
$mb_5           = isset($_POST['mb_5'])             ? trim($_POST['mb_5'])           : "";
$mb_6           = isset($_POST['mb_6'])             ? trim($_POST['mb_6'])           : "";
$mb_7           = isset($_POST['mb_7'])             ? trim($_POST['mb_7'])           : "";
$mb_8           = isset($_POST['mb_8'])             ? trim($_POST['mb_8'])           : "";
$mb_9           = isset($_POST['mb_9'])             ? trim($_POST['mb_9'])           : "";
$mb_10          = isset($_POST['mb_10'])            ? trim($_POST['mb_10'])          : "";

$mb_name        = clean_xss_tags($mb_name);
$mb_email       = get_email_address($mb_email);
$mb_homepage    = clean_xss_tags($mb_homepage);
$mb_tel         = clean_xss_tags($mb_tel);
$mb_zip1        = preg_replace('/[^0-9]/', '', $mb_zip1);
$mb_zip2        = preg_replace('/[^0-9]/', '', $mb_zip2);
$mb_addr1       = clean_xss_tags($mb_addr1);
$mb_addr2       = clean_xss_tags($mb_addr2);
$mb_addr3       = clean_xss_tags($mb_addr3);
$mb_addr_jibeon = preg_match("/^(N|R)$/", $mb_addr_jibeon) ? $mb_addr_jibeon : '';

run_event('register_form_update_before', $mb_id, $w);

if ($w == '' || $w == 'u') {

    if ($msg = empty_mb_id($mb_id))         alert($msg, "", true, true); // alert($msg, $url, $error, $post);
    if ($msg = valid_mb_id($mb_id))         alert($msg, "", true, true);
    if ($msg = count_mb_id($mb_id))         alert($msg, "", true, true);

    // 이름, 닉네임에 utf-8 이외의 문자가 포함됐다면 오류
    // 서버환경에 따라 정상적으로 체크되지 않을 수 있음.
    $tmp_mb_name = iconv('UTF-8', 'UTF-8//IGNORE', $mb_name);
    if($tmp_mb_name != $mb_name) {
        alert('이름을 올바르게 입력해 주십시오.');
    }
    $tmp_mb_nick = iconv('UTF-8', 'UTF-8//IGNORE', $mb_nick);
    if($tmp_mb_nick != $mb_nick) {
        alert('닉네임을 올바르게 입력해 주십시오.');
    }

    if ($w == '' && !$mb_password)
        alert('비밀번호가 넘어오지 않았습니다.');
    if($w == '' && $mb_password != $mb_password_re)
        alert('비밀번호가 일치하지 않습니다.');

    if ($msg = empty_mb_name($mb_name))       alert($msg, "", true, true);
    if ($msg = empty_mb_nick($mb_nick))     alert($msg, "", true, true);
    if ($msg = empty_mb_email($mb_email))   alert($msg, "", true, true);
    if ($msg = reserve_mb_id($mb_id))       alert($msg, "", true, true);
    if ($msg = reserve_mb_nick($mb_nick))   alert($msg, "", true, true);
    // 이름에 한글명 체크를 하지 않는다.
    //if ($msg = valid_mb_name($mb_name))     alert($msg, "", true, true);
    if ($msg = valid_mb_nick($mb_nick))     alert($msg, "", true, true);
    if ($msg = valid_mb_email($mb_email))   alert($msg, "", true, true);
    if ($msg = prohibit_mb_email($mb_email))alert($msg, "", true, true);

    // 휴대폰 필수입력일 경우 휴대폰번호 유효성 체크
    if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {
        if ($msg = valid_mb_hp($mb_hp))     alert($msg, "", true, true);
    }

    if ($w=='') {
        if ($msg = exist_mb_id($mb_id))     alert($msg);

        if (get_session('ss_check_mb_id') != $mb_id || get_session('ss_check_mb_nick') != $mb_nick || get_session('ss_check_mb_email') != $mb_email) {
            set_session('ss_check_mb_id', '');
            set_session('ss_check_mb_nick', '');
            set_session('ss_check_mb_email', '');

            alert('올바른 방법으로 이용해 주십시오.');
        }

        // 본인확인 체크
        if($config['cf_cert_use'] && $config['cf_cert_req']) {
            $post_cert_no = isset($_POST['cert_no']) ? trim($_POST['cert_no']) : '';
            if($post_cert_no !== get_session('ss_cert_no') || ! get_session('ss_cert_no'))
                alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
        }

        if ($config['cf_use_recommend'] && $mb_recommend) {
            if (!exist_mb_id($mb_recommend))
                alert("추천인이 존재하지 않습니다.");
        }

        if (strtolower($mb_id) == strtolower($mb_recommend)) {
            alert('본인을 추천할 수 없습니다.');
        }
    } else {
        // 자바스크립트로 정보변경이 가능한 버그 수정
        // 닉네임수정일이 지나지 않았다면
        if ($member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400)))
            $mb_nick = $member['mb_nick'];
        // 회원정보의 메일을 이전 메일로 옮기고 아래에서 비교함
        $old_email = $member['mb_email'];
    }

    run_event('register_form_update_valid', $w, $mb_id, $mb_nick, $mb_email);

    if ($msg = exist_mb_nick($mb_nick, $mb_id))     alert($msg, "", true, true);
    if ($msg = exist_mb_email($mb_email, $mb_id))   alert($msg, "", true, true);
}

// 사용자 코드 실행
@include_once($member_skin_path.'/register_form_update.head.skin.php');

//===============================================================
//  본인확인
//---------------------------------------------------------------
$mb_hp = hyphen_hp_number($mb_hp);
if($config['cf_cert_use'] && get_session('ss_cert_type') && get_session('ss_cert_dupinfo')) {
    // 중복체크
    $sql = " select mb_id from {$g5['member_table']} where mb_id <> '{$member['mb_id']}' and mb_dupinfo = '".get_session('ss_cert_dupinfo')."' ";
    $row = sql_fetch($sql);
    if ($row['mb_id']) {
        alert("입력하신 본인확인 정보로 가입된 내역이 존재합니다.\\n회원아이디 : ".$row['mb_id']);
    }
}

$sql_certify = '';
$md5_cert_no = get_session('ss_cert_no');
$cert_type = get_session('ss_cert_type');
if ($config['cf_cert_use'] && $cert_type && $md5_cert_no) {
    // 해시값이 같은 경우에만 본인확인 값을 저장한다.
    if (get_session('ss_cert_hash') == md5($mb_name.$cert_type.get_session('ss_cert_birth').$md5_cert_no)) {
        $sql_certify .= " , mb_hp = '{$mb_hp}' ";
        $sql_certify .= " , mb_certify  = '{$cert_type}' ";
        $sql_certify .= " , mb_adult = '".get_session('ss_cert_adult')."' ";
        $sql_certify .= " , mb_birth = '".get_session('ss_cert_birth')."' ";
        $sql_certify .= " , mb_sex = '".get_session('ss_cert_sex')."' ";
        $sql_certify .= " , mb_dupinfo = '".get_session('ss_cert_dupinfo')."' ";
        if($w == 'u')
            $sql_certify .= " , mb_name = '{$mb_name}' ";
    } else {
        $sql_certify .= " , mb_hp = '{$mb_hp}' ";
        $sql_certify .= " , mb_certify  = '' ";
        $sql_certify .= " , mb_adult = 0 ";
        $sql_certify .= " , mb_birth = '' ";
        $sql_certify .= " , mb_sex = '' ";
    }
} else {
    if (get_session("ss_reg_mb_name") != $mb_name || get_session("ss_reg_mb_hp") != $mb_hp) {
        $sql_certify .= " , mb_hp = '{$mb_hp}' ";
        $sql_certify .= " , mb_certify = '' ";
        $sql_certify .= " , mb_adult = 0 ";
        $sql_certify .= " , mb_birth = '' ";
        $sql_certify .= " , mb_sex = '' ";
    }
}
//===============================================================

if($mb_10 == 0) {
	$mb_level = $config['cf_register_level'];
} else {
	$mb_level = 3;
}

if ($w == '') {
    $sql = " insert into {$g5['member_table']}
                set mb_id = '{$mb_id}',
                     mb_password = '".get_encrypt_string($mb_password)."',
                     mb_name = '{$mb_name}',
                     mb_nick = '{$mb_nick}',
                     mb_nick_date = '".G5_TIME_YMD."',
                     mb_email = '{$mb_email}',
                     mb_homepage = '{$mb_homepage}',
                     mb_tel = '{$mb_tel}',
                     mb_zip1 = '{$mb_zip1}',
                     mb_zip2 = '{$mb_zip2}',
                     mb_addr1 = '{$mb_addr1}',
                     mb_addr2 = '{$mb_addr2}',
                     mb_addr3 = '{$mb_addr3}',
                     mb_addr_jibeon = '{$mb_addr_jibeon}',
                     mb_signature = '{$mb_signature}',
                     mb_profile = '{$mb_profile}',
                     mb_today_login = '".G5_TIME_YMDHIS."',
                     mb_datetime = '".G5_TIME_YMDHIS."',
                     mb_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_level = '{$mb_level}',
                     mb_recommend = '{$mb_recommend}',
                     mb_login_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_mailling = '{$mb_mailling}',
                     mb_sms = '{$mb_sms}',
                     mb_open = '{$mb_open}',
                     mb_open_date = '".G5_TIME_YMD."',
                     mb_1 = '{$mb_1}',
                     mb_2 = '{$mb_2}',
                     mb_3 = '{$mb_id}',
                     mb_4 = '{$mb_4}',
                     mb_5 = '{$mb_5}',
                     mb_6 = '{$mb_6}',
                     mb_7 = '{$mb_7}',
                     mb_8 = '{$mb_8}',
                     mb_9 = '{$mb_9}',
                     mb_10 = '{$mb_10}'
                     {$sql_certify} ";

    // 이메일 인증을 사용하지 않는다면 이메일 인증시간을 바로 넣는다
    if (!$config['cf_use_email_certify'])
        $sql .= " , mb_email_certify = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);

	// 병원 추가
	if($mb_10 == 1) {
		$bo_table = 'dental';
		$write_table = 'g5_write_dental';

        $wr_num = get_next_num($write_table);
        $wr_reply = '';

		$sql = " insert into $write_table
                set wr_num = '$wr_num',
                     wr_reply = '$wr_reply',
                     wr_comment = 0,
                     ca_name = '{$_POST['ca_name']}',
                     wr_option = '',
                     wr_subject = '{$_POST['wr_subject']}',
                     wr_content = '{$_POST['wr_content']}',
                     wr_seo_title = '{$_POST['wr_subject']}',
                     wr_link1 = '',
                     wr_link2 = '',
                     wr_link1_hit = 0,
                     wr_link2_hit = 0,
                     wr_hit = 0,
                     wr_good = 0,
                     wr_nogood = 0,
                     mb_id = '{$mb_id}',
                     wr_password = '{$wr_password}',
                     wr_name = '{$_POST['wr_name']}',
                     wr_email = '{$_POST['wr_email']}',
                     wr_homepage = '',
                     wr_datetime = '".G5_TIME_YMDHIS."',
                     wr_last = '".G5_TIME_YMDHIS."',
                     wr_ip = '{$_SERVER['REMOTE_ADDR']}',
					 wr_business = '{$_POST['wr_business']}',
					 wr_code = '{$mb_id}',
                     wr_1 = '{$_POST['wr_1']}',
                     wr_2 = '{$_POST['wr_2']}',
                     wr_3 = '{$_POST['wr_3']}',
                     wr_4 = '{$_POST['wr_4']}',
                     wr_5 = '{$_POST['wr_5']}',
                     wr_6 = '{$_POST['wr_6']}',
                     wr_7 = '{$_POST['wr_7']}',
                     wr_8 = '{$_POST['wr_8']}',
                     wr_9 = '{$_POST['wr_9']}',
                     wr_10 = '{$_POST['wr_10']}',
					 wr_2_1 = '{$_POST['wr_2_1']}',
					 wr_11 = '{$_POST['wr_11']}',
					 wr_12 = '{$_POST['wr_12']}',
					 wr_13 = '{$_POST['wr_13']}'";
		sql_query($sql);
		//echo $sql;
		//exit;

		$wr_id = sql_insert_id();

		// 부모 아이디에 UPDATE
		sql_query(" update $write_table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

		// 새글 INSERT
		sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '{$bo_table}', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '{$mb_id}' ) ");

		// 게시글 1 증가
		sql_query("update {$g5['board_table']} set bo_count_write = bo_count_write + 1 where bo_table = '{$bo_table}'");

		// 파일업로드
		$upload_max_filesize = ini_get('upload_max_filesize');
		$file_count   = 0;
		$upload_count = (isset($_FILES['bf_file']['name']) && is_array($_FILES['bf_file']['name'])) ? count($_FILES['bf_file']['name']) : 0;

		for ($i=0; $i<$upload_count; $i++) {
			if($_FILES['bf_file']['name'][$i] && is_uploaded_file($_FILES['bf_file']['tmp_name'][$i]))
				$file_count++;
		}

		if($w == 'u') {
			$file = get_file($bo_table, $wr_id);
			//if($file_count && (int)$file['count'] > $board['bo_upload_count'])
			//	alert('기존 파일을 삭제하신 후 첨부파일을 '.number_format($board['bo_upload_count']).'개 이하로 업로드 해주십시오.');
		} else {
			//if($file_count > $board['bo_upload_count'])
			//	alert('첨부파일을 '.number_format($board['bo_upload_count']).'개 이하로 업로드 해주십시오.');
		}

		// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
		@mkdir(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);
		@chmod(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);

		$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

		// 가변 파일 업로드
		$file_upload_msg = '';
		$upload = array();

		if(isset($_FILES['bf_file']['name']) && is_array($_FILES['bf_file']['name'])) {
			for ($i=0; $i<count($_FILES['bf_file']['name']); $i++) {
				$upload[$i]['file']     = '';
				$upload[$i]['source']   = '';
				$upload[$i]['filesize'] = 0;
				$upload[$i]['image']    = array();
				$upload[$i]['image'][0] = 0;
				$upload[$i]['image'][1] = 0;
				$upload[$i]['image'][2] = 0;
				$upload[$i]['fileurl'] = '';
				$upload[$i]['thumburl'] = '';
				$upload[$i]['storage'] = '';

				// 삭제에 체크가 되어있다면 파일을 삭제합니다.
				if (isset($_POST['bf_file_del'][$i]) && $_POST['bf_file_del'][$i]) {
					$upload[$i]['del_check'] = true;

					$row = sql_fetch(" select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");

					$delete_file = run_replace('delete_file_path', G5_DATA_PATH.'/file/'.$bo_table.'/'.str_replace('../', '', $row['bf_file']), $row);
					if( file_exists($delete_file) ){
						@unlink($delete_file);
					}
					// 썸네일삭제
					if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
						delete_board_thumbnail($bo_table, $row['bf_file']);
					}
				}
				else
					$upload[$i]['del_check'] = false;

				$tmp_file  = $_FILES['bf_file']['tmp_name'][$i];
				$filesize  = $_FILES['bf_file']['size'][$i];
				$filename  = $_FILES['bf_file']['name'][$i];
				$filename  = get_safe_filename($filename);

				// 서버에 설정된 값보다 큰파일을 업로드 한다면
				if ($filename) {
					if ($_FILES['bf_file']['error'][$i] == 1) {
						$file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
						continue;
					}
					else if ($_FILES['bf_file']['error'][$i] != 0) {
						$file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
						continue;
					}
				}

				if (is_uploaded_file($tmp_file)) {
					// 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
					//if (!$is_admin && $filesize > $board['bo_upload_size']) {
					//	$file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($board['bo_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
					//	continue;
					//}

					//=================================================================\
					// 090714
					// 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
					// 에러메세지는 출력하지 않는다.
					//-----------------------------------------------------------------
					$timg = @getimagesize($tmp_file);
					// image type
					if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
						 preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
						if ($timg['2'] < 1 || $timg['2'] > 16)
							continue;
					}
					//=================================================================

					$upload[$i]['image'] = $timg;

					// 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정
					if ($w == 'u') {
						// 존재하는 파일이 있다면 삭제합니다.
						$row = sql_fetch(" select * from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
						
						if(isset($row['bf_file']) && $row['bf_file']){
							$delete_file = run_replace('delete_file_path', G5_DATA_PATH.'/file/'.$bo_table.'/'.str_replace('../', '', $row['bf_file']), $row);
							if( file_exists($delete_file) ){
								@unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$row['bf_file']);
							}
							// 이미지파일이면 썸네일삭제
							if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
								delete_board_thumbnail($bo_table, $row['bf_file']);
							}
						}
					}

					// 프로그램 원래 파일명
					$upload[$i]['source'] = $filename;
					$upload[$i]['filesize'] = $filesize;

					// 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
					$filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

					shuffle($chars_array);
					$shuffle = implode('', $chars_array);

					// 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
					$upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

					$dest_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$upload[$i]['file'];

					// 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
					$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

					// 올라간 파일의 퍼미션을 변경합니다.
					chmod($dest_file, G5_FILE_PERMISSION);

					$dest_file = run_replace('write_update_upload_file', $dest_file, $board, $wr_id, $w);
					$upload[$i] = run_replace('write_update_upload_array', $upload[$i], $dest_file, $board, $wr_id, $w);
				}
			}   // end for
		}   // end if

		// 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
		for ($i=0; $i<count($upload); $i++)
		{
			$upload[$i]['source'] = sql_real_escape_string($upload[$i]['source']);
			$bf_content[$i] = isset($bf_content[$i]) ? sql_real_escape_string($bf_content[$i]) : '';
			$bf_width = isset($upload[$i]['image'][0]) ? (int) $upload[$i]['image'][0] : 0;
			$bf_height = isset($upload[$i]['image'][1]) ? (int) $upload[$i]['image'][1] : 0;
			$bf_type = isset($upload[$i]['image'][2]) ? (int) $upload[$i]['image'][2] : 0;

			$row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
			if ($row['cnt'])
			{
				// 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
				// 그렇지 않다면 내용만 업데이트 합니다.
				if ($upload[$i]['del_check'] || $upload[$i]['file'])
				{
					$sql = " update {$g5['board_file_table']}
								set bf_source = '{$upload[$i]['source']}',
									 bf_file = '{$upload[$i]['file']}',
									 bf_content = '{$bf_content[$i]}',
									 bf_fileurl = '{$upload[$i]['fileurl']}',
									 bf_thumburl = '{$upload[$i]['thumburl']}',
									 bf_storage = '{$upload[$i]['storage']}',
									 bf_filesize = '".(int)$upload[$i]['filesize']."',
									 bf_width = '".$bf_width."',
									 bf_height = '".$bf_height."',
									 bf_type = '".$bf_type."',
									 bf_datetime = '".G5_TIME_YMDHIS."'
							  where bo_table = '{$bo_table}'
										and wr_id = '{$wr_id}'
										and bf_no = '{$i}' ";
					sql_query($sql);
				}
				else
				{
					$sql = " update {$g5['board_file_table']}
								set bf_content = '{$bf_content[$i]}'
								where bo_table = '{$bo_table}'
										  and wr_id = '{$wr_id}'
										  and bf_no = '{$i}' ";
					sql_query($sql);
				}
			}
			else
			{
				$sql = " insert into {$g5['board_file_table']}
							set bo_table = '{$bo_table}',
								 wr_id = '{$wr_id}',
								 bf_no = '{$i}',
								 bf_source = '{$upload[$i]['source']}',
								 bf_file = '{$upload[$i]['file']}',
								 bf_content = '{$bf_content[$i]}',
								 bf_fileurl = '{$upload[$i]['fileurl']}',
								 bf_thumburl = '{$upload[$i]['thumburl']}',
								 bf_storage = '{$upload[$i]['storage']}',
								 bf_download = 0,
								 bf_filesize = '".(int)$upload[$i]['filesize']."',
								 bf_width = '".$bf_width."',
								 bf_height = '".$bf_height."',
								 bf_type = '".$bf_type."',
								 bf_datetime = '".G5_TIME_YMDHIS."' ";
				sql_query($sql);

				run_event('write_update_file_insert', $bo_table, $wr_id, $upload[$i], $w);
			}
		}

		// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
		// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
		$row = sql_fetch(" select max(bf_no) as max_bf_no from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
		for ($i=(int)$row['max_bf_no']; $i>=0; $i--)
		{
			$row2 = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");

			// 정보가 있다면 빠집니다.
			if ($row2['bf_file']) break;

			// 그렇지 않다면 정보를 삭제합니다.
			sql_query(" delete from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
		}

		// 파일의 개수를 게시물에 업데이트 한다.
		$row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
		sql_query(" update {$write_table} set wr_file = '{$row['cnt']}' where wr_id = '{$wr_id}' ");

	}
	// 병원 추가 끝

    // 회원가입 포인트 부여
    insert_point($mb_id, $config['cf_register_point'], '회원가입 축하', '@member', $mb_id, '회원가입');

    // 추천인에게 포인트 부여
    if ($config['cf_use_recommend'] && $mb_recommend)
        insert_point($mb_recommend, $config['cf_recommend_point'], $mb_id.'의 추천인', '@member', $mb_recommend, $mb_id.' 추천');

    // 회원님께 메일 발송
    if ($config['cf_email_mb_member']) {
        $subject = '['.$config['cf_title'].'] 회원가입을 축하드립니다.';

        // 어떠한 회원정보도 포함되지 않은 일회용 난수를 생성하여 인증에 사용
        if ($config['cf_use_email_certify']) {
            $mb_md5 = md5(pack('V*', rand(), rand(), rand(), rand()));
            sql_query(" update {$g5['member_table']} set mb_email_certify2 = '$mb_md5' where mb_id = '$mb_id' ");
            $certify_href = G5_BBS_URL.'/email_certify.php?mb_id='.$mb_id.'&amp;mb_md5='.$mb_md5;
        }

        ob_start();
        include_once ('./register_form_update_mail1.php');
        $content = ob_get_contents();
        ob_end_clean();
        
        $content = run_replace('register_form_update_mail_mb_content', $content, $mb_id);

        mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $mb_email, $subject, $content, 1);

        run_event('register_form_update_send_mb_mail', $config['cf_admin_email_name'], $config['cf_admin_email'], $mb_email, $subject, $content);

        // 메일인증을 사용하는 경우 가입메일에 인증 url이 있으므로 인증메일을 다시 발송되지 않도록 함
        if($config['cf_use_email_certify'])
            $old_email = $mb_email;
    }

    // 최고관리자님께 메일 발송
    if ($config['cf_email_mb_super_admin']) {
        $subject = run_replace('register_form_update_mail_admin_subject', '['.$config['cf_title'].'] '.$mb_nick .' 님께서 회원으로 가입하셨습니다.', $mb_id, $mb_nick);

        ob_start();
        include_once ('./register_form_update_mail2.php');
        $content = ob_get_contents();
        ob_end_clean();
        
        $content = run_replace('register_form_update_mail_admin_content', $content, $mb_id);

        mailer($mb_nick, $mb_email, $config['cf_admin_email'], $subject, $content, 1);

        run_event('register_form_update_send_admin_mail', $mb_nick, $mb_email, $config['cf_admin_email'], $subject, $content);
    }

    // 메일인증 사용하지 않는 경우에만 로그인
    if (!$config['cf_use_email_certify'])
        set_session('ss_mb_id', $mb_id);

    set_session('ss_mb_reg', $mb_id);

} else if ($w == 'u') {
    if (!trim(get_session('ss_mb_id')))
        alert('로그인 되어 있지 않습니다.');

    if (trim($_POST['mb_id']) != $mb_id)
        alert("로그인된 정보와 수정하려는 정보가 틀리므로 수정할 수 없습니다.\\n만약 올바르지 않은 방법을 사용하신다면 바로 중지하여 주십시오.");

    $sql_password = "";
    if ($mb_password)
        $sql_password = " , mb_password = '".get_encrypt_string($mb_password)."' ";

    $sql_nick_date = "";
    if ($mb_nick_default != $mb_nick)
        $sql_nick_date =  " , mb_nick_date = '".G5_TIME_YMD."' ";

    $sql_open_date = "";
    if ($mb_open_default != $mb_open)
        $sql_open_date =  " , mb_open_date = '".G5_TIME_YMD."' ";

    // 이전 메일주소와 수정한 메일주소가 틀리다면 인증을 다시 해야하므로 값을 삭제
    $sql_email_certify = '';
    if ($old_email != $mb_email && $config['cf_use_email_certify'])
        $sql_email_certify = " , mb_email_certify = '' ";

    $sql = " update {$g5['member_table']}
                set mb_nick = '{$mb_nick}',
                    mb_mailling = '{$mb_mailling}',
                    mb_sms = '{$mb_sms}',
                    mb_open = '{$mb_open}',
                    mb_email = '{$mb_email}',
                    mb_homepage = '{$mb_homepage}',
                    mb_tel = '{$mb_tel}',
                    mb_zip1 = '{$mb_zip1}',
                    mb_zip2 = '{$mb_zip2}',
                    mb_addr1 = '{$mb_addr1}',
                    mb_addr2 = '{$mb_addr2}',
                    mb_addr3 = '{$mb_addr3}',
                    mb_addr_jibeon = '{$mb_addr_jibeon}',
                    mb_signature = '{$mb_signature}',
                    mb_profile = '{$mb_profile}',
                    mb_1 = '{$mb_1}',
                    mb_2 = '{$mb_2}',
                    mb_3 = '{$mb_3}',
                    mb_4 = '{$mb_4}',
                    mb_5 = '{$mb_5}',
                    mb_6 = '{$mb_6}',
                    mb_7 = '{$mb_7}',
                    mb_8 = '{$mb_8}',
                    mb_9 = '{$mb_9}',
                    mb_10 = '{$mb_10}'
                    {$sql_password}
                    {$sql_nick_date}
                    {$sql_open_date}
                    {$sql_email_certify}
                    {$sql_certify}
              where mb_id = '$mb_id' ";
    sql_query($sql);
}


// 회원 아이콘
$mb_dir = G5_DATA_PATH.'/member/'.substr($mb_id,0,2);

// 아이콘 삭제
if (isset($_POST['del_mb_icon'])) {
    @unlink($mb_dir.'/'.get_mb_icon_name($mb_id).'.gif');
}

$msg = "";

// 아이콘 업로드
$mb_icon = '';
$image_regex = "/(\.(gif|jpe?g|png))$/i";
$mb_icon_img = get_mb_icon_name($mb_id).'.gif';

if (isset($_FILES['mb_icon']) && is_uploaded_file($_FILES['mb_icon']['tmp_name'])) {
    if (preg_match($image_regex, $_FILES['mb_icon']['name'])) {
        // 아이콘 용량이 설정값보다 이하만 업로드 가능
        if ($_FILES['mb_icon']['size'] <= $config['cf_member_icon_size']) {
            @mkdir($mb_dir, G5_DIR_PERMISSION);
            @chmod($mb_dir, G5_DIR_PERMISSION);
            $dest_path = $mb_dir.'/'.$mb_icon_img;
            move_uploaded_file($_FILES['mb_icon']['tmp_name'], $dest_path);
            chmod($dest_path, G5_FILE_PERMISSION);
            if (file_exists($dest_path)) {
                //=================================================================\
                // 090714
                // gif 파일에 악성코드를 심어 업로드 하는 경우를 방지
                // 에러메세지는 출력하지 않는다.
                //-----------------------------------------------------------------
                $size = @getimagesize($dest_path);
                if (!($size[2] === 1 || $size[2] === 2 || $size[2] === 3)) { // jpg, gif, png 파일이 아니면 올라간 이미지를 삭제한다.
                    @unlink($dest_path);
                } else if ($size[0] > $config['cf_member_icon_width'] || $size[1] > $config['cf_member_icon_height']) {
                    $thumb = null;
                    if($size[2] === 2 || $size[2] === 3) {
                        //jpg 또는 png 파일 적용
                        $thumb = thumbnail($mb_icon_img, $mb_dir, $mb_dir, $config['cf_member_icon_width'], $config['cf_member_icon_height'], true, true);
                        if($thumb) {
                            @unlink($dest_path);
                            rename($mb_dir.'/'.$thumb, $dest_path);
                        }
                    }
                    if( !$thumb ){
                        // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                        @unlink($dest_path);
                    }
                }
                //=================================================================\
            }
        } else {
            $msg .= '회원아이콘을 '.number_format($config['cf_member_icon_size']).'바이트 이하로 업로드 해주십시오.';
        }

    } else {
        $msg .= $_FILES['mb_icon']['name'].'은(는) 이미지 파일이 아닙니다.';
    }
}

// 회원 프로필 이미지
if( $config['cf_member_img_size'] && $config['cf_member_img_width'] && $config['cf_member_img_height'] ){
    $mb_tmp_dir = G5_DATA_PATH.'/member_image/';
    $mb_dir = $mb_tmp_dir.substr($mb_id,0,2);
    if( !is_dir($mb_tmp_dir) ){
        @mkdir($mb_tmp_dir, G5_DIR_PERMISSION);
        @chmod($mb_tmp_dir, G5_DIR_PERMISSION);
    }

    // 아이콘 삭제
    if (isset($_POST['del_mb_img'])) {
        @unlink($mb_dir.'/'.$mb_icon_img);
    }

    // 회원 프로필 이미지 업로드
    $mb_img = '';
    if (isset($_FILES['mb_img']) && is_uploaded_file($_FILES['mb_img']['tmp_name'])) {

        $msg = $msg ? $msg."\\r\\n" : '';

        if (preg_match($image_regex, $_FILES['mb_img']['name'])) {
            // 아이콘 용량이 설정값보다 이하만 업로드 가능
            if ($_FILES['mb_img']['size'] <= $config['cf_member_img_size']) {
                @mkdir($mb_dir, G5_DIR_PERMISSION);
                @chmod($mb_dir, G5_DIR_PERMISSION);
                $dest_path = $mb_dir.'/'.$mb_icon_img;
                move_uploaded_file($_FILES['mb_img']['tmp_name'], $dest_path);
                chmod($dest_path, G5_FILE_PERMISSION);
                if (file_exists($dest_path)) {
                    $size = @getimagesize($dest_path);
                    if (!($size[2] === 1 || $size[2] === 2 || $size[2] === 3)) { // gif jpg png 파일이 아니면 올라간 이미지를 삭제한다.
                        @unlink($dest_path);
                    } else if ($size[0] > $config['cf_member_img_width'] || $size[1] > $config['cf_member_img_height']) {
                        $thumb = null;
                        if($size[2] === 2 || $size[2] === 3) {
                            //jpg 또는 png 파일 적용
                            $thumb = thumbnail($mb_icon_img, $mb_dir, $mb_dir, $config['cf_member_img_width'], $config['cf_member_img_height'], true, true);
                            if($thumb) {
                                @unlink($dest_path);
                                rename($mb_dir.'/'.$thumb, $dest_path);
                            }
                        }
                        if( !$thumb ){
                            // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                            @unlink($dest_path);
                        }
                    }
                    //=================================================================\
                }
            } else {
                $msg .= '회원이미지을 '.number_format($config['cf_member_img_size']).'바이트 이하로 업로드 해주십시오.';
            }

        } else {
            $msg .= $_FILES['mb_img']['name'].'은(는) gif/jpg 파일이 아닙니다.';
        }
    }
}

// 인증메일 발송
if ($config['cf_use_email_certify'] && $old_email != $mb_email) {
    $subject = '['.$config['cf_title'].'] 인증확인 메일입니다.';

    // 어떠한 회원정보도 포함되지 않은 일회용 난수를 생성하여 인증에 사용
    $mb_md5 = md5(pack('V*', rand(), rand(), rand(), rand()));

    sql_query(" update {$g5['member_table']} set mb_email_certify2 = '$mb_md5' where mb_id = '$mb_id' ");

    $certify_href = G5_BBS_URL.'/email_certify.php?mb_id='.$mb_id.'&amp;mb_md5='.$mb_md5;

    ob_start();
    include_once ('./register_form_update_mail3.php');
    $content = ob_get_contents();
    ob_end_clean();
    
    $content = run_replace('register_form_update_mail_certify_content', $content, $mb_id);

    mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $mb_email, $subject, $content, 1);

    run_event('register_form_update_send_certify_mail', $config['cf_admin_email_name'], $config['cf_admin_email'], $mb_email, $subject, $content);
}


// 신규회원 쿠폰발생
if($w == '' && $default['de_member_reg_coupon_use'] && $default['de_member_reg_coupon_term'] > 0 && $default['de_member_reg_coupon_price'] > 0) {
    $j = 0;
    $create_coupon = false;

    do {
        $cp_id = get_coupon_id();

        $sql3 = " select count(*) as cnt from {$g5['g5_shop_coupon_table']} where cp_id = '$cp_id' ";
        $row3 = sql_fetch($sql3);

        if(!$row3['cnt']) {
            $create_coupon = true;
            break;
        } else {
            if($j > 20)
                break;
        }
    } while(1);

    if($create_coupon) {
        $cp_subject = '신규 회원가입 축하 쿠폰';
        $cp_method = 2;
        $cp_target = '';
        $cp_start = G5_TIME_YMD;
        $cp_end = date("Y-m-d", (G5_SERVER_TIME + (86400 * ((int)$default['de_member_reg_coupon_term'] - 1))));
        $cp_type = 0;
        $cp_price = $default['de_member_reg_coupon_price'];
        $cp_trunc = 1;
        $cp_minimum = $default['de_member_reg_coupon_minimum'];
        $cp_maximum = 0;

        $sql = " INSERT INTO {$g5['g5_shop_coupon_table']}
                    ( cp_id, cp_subject, cp_method, cp_target, mb_id, cp_start, cp_end, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum, cp_datetime )
                VALUES
                    ( '$cp_id', '$cp_subject', '$cp_method', '$cp_target', '$mb_id', '$cp_start', '$cp_end', '$cp_type', '$cp_price', '$cp_trunc', '$cp_minimum', '$cp_maximum', '".G5_TIME_YMDHIS."' ) ";

        $res = sql_query($sql, false);

        if($res)
            set_session('ss_member_reg_coupon', 1);
    }
}


// 사용자 코드 실행
@include_once ($member_skin_path.'/register_form_update.tail.skin.php');

if(isset($_SESSION['ss_cert_type'])) unset($_SESSION['ss_cert_type']);
if(isset($_SESSION['ss_cert_no'])) unset($_SESSION['ss_cert_no']);
if(isset($_SESSION['ss_cert_hash'])) unset($_SESSION['ss_cert_hash']);
if(isset($_SESSION['ss_cert_birth'])) unset($_SESSION['ss_cert_birth']);
if(isset($_SESSION['ss_cert_adult'])) unset($_SESSION['ss_cert_adult']);

if ($msg)
    echo '<script>alert(\''.$msg.'\');</script>';

run_event('register_form_update_after', $mb_id, $w);

if ($w == '') {
    goto_url(G5_HTTP_BBS_URL.'/register_result.php');
} else if ($w == 'u') {
    $row  = sql_fetch(" select mb_password from {$g5['member_table']} where mb_id = '{$member['mb_id']}' ");
    $tmp_password = $row['mb_password'];

    if ($old_email != $mb_email && $config['cf_use_email_certify']) {
        set_session('ss_mb_id', '');
        alert('회원 정보가 수정 되었습니다.\n\nE-mail 주소가 변경되었으므로 다시 인증하셔야 합니다.', G5_URL);
    } else {
        echo '
        <!doctype html>
        <html lang="ko">
        <head>
        <meta charset="utf-8">
        <title>회원정보수정</title>
        <body>
        <form name="fregisterupdate" method="post" action="'.G5_HTTP_BBS_URL.'/register_form.php">
        <input type="hidden" name="w" value="u">
        <input type="hidden" name="mb_id" value="'.$mb_id.'">
        <input type="hidden" name="mb_password" value="'.$tmp_password.'">
        <input type="hidden" name="is_update" value="1">
        </form>
        <script>
        alert("회원 정보가 수정 되었습니다.");
        document.fregisterupdate.submit();
        </script>
        </body>
        </html>';
    }
}