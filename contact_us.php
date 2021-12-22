<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.php');
?>

<style>
.contact_info {border-top: 2px solid #777dee;padding: 40px 10px;width: 1200px;margin: 0 auto;}
.contact_info li {float: left;padding-left: 75px;margin-right: 80px;background-repeat: no-repeat;background-position: 0 50%;line-height: 28px;height: 62px;}
.contact_info li:nth-child(1) {background-image: url(/images/contact_icon01.png);}
.contact_info li:nth-child(2) {background-image: url(/images/contact_icon02.png);}
.contact_info li:last-child {margin-right: 0;background-image: url(/images/contact_icon03.png);}
.contact_info dt {font-size: 22px;font-weight: bold;color: #777dee;}
.contact_info dd {font-size: 20px;font-weight: 300;color: #323232;}

.contact_map {position: relative;overflow: hidden;height: 575px;width: 1200px;margin: 0 auto;}
.root_daum_roughmap .wrap_controllers {display: none;}

/* 반응형 css */
@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

.contact_info {padding: 3.1250vw 0.7813vw;width: 93.7500vw;}
.contact_info li {padding-left: 5.8594vw;margin-right: 6.2500vw;line-height: 2.1875vw;height: 4.8438vw;}
.contact_info li:nth-child(1) {background-size: 4.9219vw;}
.contact_info li:nth-child(2) {background-size: 4.9219vw;}
.contact_info li:last-child {background-size: 4.9219vw;}
.contact_info dt {font-size: 1.7188vw;}
.contact_info dd {font-size: 1.5625vw;}

.contact_map {height: 44.9219vw;width: 93.7500vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

.contact_info {padding: 5.2083vw 0 0.0000vw 15.6250vw;width: 100vw;}
.contact_info li {float: none;padding-left: 11.4583vw;margin-right: 0.0000vw;line-height: 5.4688vw;height: 9.6354vw;margin-bottom: 6.5104vw;}
.contact_info li:nth-child(1) {background-size: 9.6354vw;}
.contact_info li:nth-child(2) {background-size: 9.6354vw;}
.contact_info li:last-child {background-size: 9.6354vw;}
.contact_info dt {font-size: 3.5156vw;}
.contact_info dd {font-size: 3.5156vw;}

.contact_map {height: 85.2865vw;width: 100vw;}

}
</style>

<div class="content sub_content">
	<div class="inner">
		<?php
		$on = 1;
		include_once(G5_PATH.'/include/sn_company.php');
		?>
	</div>
		
	<div class="contact_info">
		<ul class="clearfix">
			<li>
				<dl>
					<dt>주소</dt>
					<dd>서울특별시 강남구 테헤란로 25길 7 7층</dd>
				</dl>
			</li>
			<!-- <li>
				<dl>
					<dt>Tel</dt>
					<dd>02-1677-5477</dd>
				</dl>
			</li> -->
			<li>
				<dl>
					<dt>E-mail</dt>
					<dd>contact@misbloc.io</dd>
				</dl>
			</li>
		</ul>
	</div>

	<div class="contact_map">
		<!-- * 카카오맵 - 지도퍼가기 -->
		<!-- 1. 지도 노드 -->
		<div id="daumRoughmapContainer1628573825357" class="root_daum_roughmap root_daum_roughmap_landing" style="width:100%;position: absolute;top: 50%;left: 50%;transform:translate(-50%, -50%);"></div>

		<!--
			2. 설치 스크립트
			* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
		-->
		<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

		<!-- 3. 실행 스크립트 -->
		<script charset="UTF-8">
			new daum.roughmap.Lander({
				"timestamp" : "1628573825357",
				"key" : "26wxp",
				//"mapWidth" : "1200",
				"mapHeight" : "575"
			}).render();
		</script>
	</div>
</div>

<?php
include_once(G5_PATH.'/tail.php');