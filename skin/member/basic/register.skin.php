<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>

<!-- 회원가입약관 동의 시작 { -->
<div class="register">
	<h1><?php echo $g5['title'];?></h1>
    <form name="fregister" id="fregister" action="<?php echo $register_action_url ?>?<?php if($reco) echo 'rec='.$reco; ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
	<input type="hidden" value="<?php echo $mb_10 ? $mb_10 : '0';?>" name="mb_10">
    <!-- <p><i class="fa fa-check-circle" aria-hidden="true"></i> 회원가입약관 및 개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.</p> -->
    
    <?php
    // 소셜로그인 사용시 소셜로그인 버튼
    @include_once(get_social_skin_path().'/social_register.skin.php');
    ?>
	
	<div id="fregister_chkall" class="chk_all fregister_agree">
        <input type="checkbox" name="chk_all" id="chk_all" class="selec_chk">
        <label for="chk_all"><span></span>모든 약관에 동의합니다</label>
    </div>

    <section id="fregister_term">
        <h2>회원가입약관</h2>
        <textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
        <fieldset class="fregister_agree">
            <input type="checkbox" name="agree" value="1" id="agree11" class="selec_chk">
            <label for="agree11"><span></span><b class="sound_only">회원가입약관의 내용에 동의합니다.</b></label>
        </fieldset>
    </section>

    <section id="fregister_private">
        <h2>개인정보처리방침안내</h2>
        <textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea>

        <fieldset class="fregister_agree">
            <input type="checkbox" name="agree2" value="1" id="agree21" class="selec_chk">
            <label for="agree21"><span></span><b class="sound_only">개인정보처리방침안내의 내용에 동의합니다.</b></label>
       </fieldset>
    </section>

    <section id="fregister_private">
        <h2>제3자 정보 제공 동의</h2>
        <textarea readonly><?php echo get_text($config['cf_1']) ?></textarea>

        <fieldset class="fregister_agree">
            <input type="checkbox" name="agree3" value="1" id="agree31" class="selec_chk">
            <label for="agree31"><span></span><b class="sound_only">제3자 정보 제공 동의 내용에 동의합니다.</b></label>
       </fieldset>
    </section>
	    
    <div class="btn_confirm">
        <button type="submit" class="btn_submit">회원가입</button>
    	<a href="<?php echo G5_URL ?>" class="btn_close">취소</a>
    </div>

    </form>

    <script>
    function fregister_submit(f)
    {
        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        if (!f.agree3.checked) {
            alert("제3자 정보 제공 동의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        return true;
    }
    
    jQuery(function($){
        // 모두선택
        $("input[name=chk_all]").click(function() {
            if ($(this).prop('checked')) {
                $("input[name^=agree]").prop('checked', true);
            } else {
                $("input[name^=agree]").prop("checked", false);
            }
        });
    });

    </script>
</div>
<!-- } 회원가입 약관 동의 끝 -->
