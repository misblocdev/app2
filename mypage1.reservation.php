<?php
include_once('./_common.php');

//$it_id = isset($_REQUEST['it_id']) ? safe_replace_regex($_REQUEST['it_id'], 'it_id') : '';
$den_id = isset($_REQUEST['den_id']) ? safe_replace_regex($_REQUEST['den_id'], 'den_id') : '';

if( !isset($it) && !get_session("ss_tv_idx") ){
    if( !headers_sent() ){  //헤더를 보내기 전이면 검색엔진에서 제외합니다.
        echo '<meta name="robots" content="noindex, nofollow">';
    }
    /*
    if( !G5_IS_MOBILE ){    //PC 에서는 검색엔진 화면에 노출하지 않도록 수정
        return;
    }
    */
}

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 현재페이지, 총페이지수, 한페이지에 보여줄 행, URL
function reservation_page($write_pages, $cur_page, $total_page, $url, $add="")
{
    //$url = preg_replace('#&amp;page=[0-9]*(&amp;page=)$#', '$1', $url);
    $url = preg_replace('#&amp;page=[0-9]*#', '', $url) . '&amp;page=';

    $str = '';
    if ($cur_page > 1) {
        $str .= '<a href="'.$url.'1'.$add.'" class="pg_page pg_reservation_page pg_start">처음</a>'.PHP_EOL;
    }

    $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
    $end_page = $start_page + $write_pages - 1;

    if ($end_page >= $total_page) $end_page = $total_page;

    if ($start_page > 1) $str .= '<a href="'.$url.($start_page-1).$add.'" class="pg_page pg_reservation_page pg_prev">이전</a>'.PHP_EOL;

    if ($total_page > 1) {
        for ($k=$start_page;$k<=$end_page;$k++) {
            if ($cur_page != $k)
                $str .= '<a href="'.$url.$k.$add.'" class="pg_page pg_reservation_page">'.$k.'</a><span class="sound_only">페이지</span>'.PHP_EOL;
            else
                $str .= '<span class="sound_only">열린</span><strong class="pg_current">'.$k.'</strong><span class="sound_only">페이지</span>'.PHP_EOL;
        }
    }

    if ($total_page > $end_page) $str .= '<a href="'.$url.($end_page+1).$add.'" class="pg_page pg_reservation_page pg_next">다음</a>'.PHP_EOL;

    if ($cur_page < $total_page) {
        $str .= '<a href="'.$url.$total_page.$add.'" class="pg_page pg_reservation_page pg_end">맨끝</a>'.PHP_EOL;
    }

    if ($str)
        return "<nav class=\"pg_wrap\"><span class=\"pg\">{$str}</span></nav>";
    else
        return "";
}

$sql_common = " from reser where mb_id = '".$member['mb_id']."' and etc = '예약' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select COUNT(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 5;
$total_page  = ceil($total_count / $rows); // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 레코드 구함

$sql = "select * $sql_common order by wr_id desc limit $from_record, $rows ";
$row = sql_fetch($sql);
$result = sql_query($sql);
$total = sql_num_rows($result);
//echo $sql;

//$review_list = G5_URL."/reviewlist.php";
//$review_form = G5_URL."/reviewform.php?den_id=".$row['it_id'];
//$review_formupdate = G5_URL."/reviewformupdate.php?den_id=".$row['it_id'];

//$review_skin = G5_REVIEW_SKIN_PATH.'/review.skin.php';

$page_url = G5_URL."/mypage1.reservation.php?page=";
?>

<!-- 예약 내역 시작 { -->
<section id="reservation_list">
	<table>
        <caption class="sound_only">예약 내역 목록</caption>		
		<thead>
			<tr>
				<th>날짜</th>
				<th>시간</th>
				<th>병원</th>
				<th>문진표</th>
				<th>상태</th>
			</tr>
		</thead>
		<tbody>
			<?php for ($i=0; $rows=sql_fetch_array($result); $i++) {
			$sql_m = " select * from munjin where dental_id = '{$rows['dental_id']}' and mb_id = '{$member['mb_id']}' ";
			$row_m = sql_fetch($sql_m);

			$sql_d = " select * from g5_write_dental where wr_code = '{$rows['dental_id']}' ";
			$row_d = sql_fetch($sql_d);
			?>
			<tr>
				<td><?php echo $rows['wr_date'];?></td>
				<td><?php echo $rows['wr_time'];?></td>
				<td><a href="<?php echo get_pretty_url('dental', $row_d['wr_id']);?>&den_id=<?php echo $rows['dental_id']?>"><?php echo $rows['dental_name'];?></a></td>
				<td><a href="<?php echo G5_URL; ?>/munjin_view.php?type=<?php echo $row_m['munjin_type']?>&mid=<?php echo $row_m['munjin_id']?>" target="_blank" class="win_munjin"><img src="/images/mypage_munjin.png" alt="문진표 보기"></a></td>
				<td>
				<?php 
				if($rows['wr_date'] <= G5_TIME_YMD) {
					echo '<span class="rsv_done" style="color: #7c87f2;">검진완료</span>';
				} else {
					echo '<span class="rsv_cancel" style="color: red;cursor: pointer;" onclick="rsv_cancel(\''.$rows['wr_id'].'\');">취소하기</span>';
				}
				?>
				</td>
			</tr>
			<?php } 
				
			if($total == 0){?>
			<tr>
				<td colspan="5">예약 내역이 없습니다.</td>
			</tr>
			<?php }?>
		</tbody>	
	</table>
</section>

<?php
echo reservation_page($config['cf_write_pages'], $page, $total_page, $page_url, "");
?>

<script>
var win_munjin = function(href) {
	var new_win = window.open(href, 'win_munjin', 'left=100,top=100,width=850, height=1000, scrollbars=1');
	new_win.focus();
}

$(function(){

    $(".pg_reservation_page").click(function(){
        $("#reservation").load($(this).attr("href"));
        return false;
    });

    $(".win_munjin").click(function() {
        win_munjin(this.href);
        return false;
    });

});
</script>
<!-- } 예약 내역 끝 -->