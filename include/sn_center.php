<div class="sub_title">고객센터</div>
<div class="sub_nav sub_nav_4">
	<ul class="clearfix">
		<li<?php echo $on == 0 ? ' class="on"' : ''?>><a href="<?php echo get_pretty_url('notice');?>">공지사항</a></li>
		<li<?php echo $on == 1 ? ' class="on"' : ''?>><a href="<?php echo get_pretty_url('faq');?>">자주묻는 질문</a></li>
		<li<?php echo $on == 2 ? ' class="on"' : ''?>><a href="<?php echo get_pretty_url('content', 'provision');?>">이용약관</a></li>
		<li<?php echo $on == 3 ? ' class="on"' : ''?>><a href="<?php echo get_pretty_url('content', 'privacy');?>" class="line_2">개인정보<br class="show768"/>처리방침</a></li>
	</ul>
</div>