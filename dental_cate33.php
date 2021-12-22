<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.php');
?>

<style>

.sc_alert {font-size: 16px;}

#map {width: 100%;height: 800px;}
.wrap {display: none;position: absolute;left: 50%;bottom: 48px;transform: translateX(-49%);text-align: left;font-size: 12px;font-family: 'Malgun Gothic', dotum, '돋움', sans-serif;line-height: 1.5;}
.wrap * {padding: 0;margin: 0;}
.wrap .info {min-width: 250px;border-radius: 5px;border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;background: #fff;}
.wrap .info:nth-child(1) {border: 0;box-shadow: 0px 1px 2px #888;}
.info .title {padding: 5px 0 0 10px;height: 34px;background: #eee;border-bottom: 1px solid #ddd;font-size: 18px;font-weight: bold;}
.info .close {position: absolute;top: 10px;right: 10px;color: #888;width: 17px;height: 17px;background: url('https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/overlay_close.png');}
.info .close:hover {cursor: pointer;}
.info .body {position: relative;overflow: hidden;}
.info .desc {position: relative;margin: 13px 10px 0 10px;padding-bottom: 15px;}
.desc .ellipsis {/* overflow: hidden;text-overflow: ellipsis; */white-space: normal;-ms-word-break: keep-all;word-break: keep-all;}
.desc .jibun {font-size: 11px;color: #888;margin-top: -2px;}
.info .img {position: absolute;top: 6px;left: 5px;width: 73px;height: 71px;border: 1px solid #ddd;color: #888;overflow: hidden;}
.info:after {content: '';position: absolute;margin-left: -12px;left: 50%;bottom: 0;width: 22px;height: 12px;background: url('https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/vertex_white.png');transform: translateY(100%)}
.info .link {color: #5085BB;}

/* 반응형 css */
@media only screen and (max-width: 1280px) { /* viewport width : 1280 */

#map {width: 100%;height: auto;padding-top: 62.5vw;}

}

@media only screen and (max-width: 768px) { /* viewport width : 768 */

.sc_alert {font-size: 24px;margin-bottom: 20px;}
#map {padding-top: 80vw;}

}
</style>

<?php
$sql_den = ' select * from g5_write_dental2 ';
$result_den = sql_query($sql_den);
$total = sql_num_rows($result_den);
?>

<div class="sub_content">
	<div class="inner">
		<div class="sub_title">치과찾기</div>
		<div class="sub_nav sub_nav_4">
			<ul class="clearfix">
				<li class="on"><a href="<?php echo G5_URL;?>/dental_cate3.php">지도<span class="hide768">로 </span>찾기</a></li>
				<li><a href="<?php echo G5_URL;?>/dental_cate1.php">분야<span class="hide768">로 </span>찾기</a></li>
				<li><a href="<?php echo G5_URL;?>/dental_cate2.php">지역<span class="hide768">으로 </span>찾기</a></li>
				<li><a href="<?php echo G5_URL;?>/dental_cate4.php">증상<span class="hide768">으로 </span>찾기</a></li>
			</ul>
		</div>
		<div class="sc">
			<p class="sc_alert show768">
			모바일 접속시 지도가 안나올 경우 <br/>
			설정에서 위치추척을 허용으로 변경해주세요.
			</p>
			<div id="map"></div>
			<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=aa5711f253b77b4ce7e4f5951dfdc8d0&libraries=services,clusterer,drawing"></script>
			<script>

			function successCallback(position) {

				var posX = position.coords.latitude;
				var posY = position.coords.longitude;
				console.log(posX, posY);

				var container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
				var options = { //지도를 생성할 때 필요한 기본 옵션
					center: new kakao.maps.LatLng(posX, posY), //지도의 중심좌표.
					level: 1 //지도의 레벨(확대, 축소 정도)
				};

				var map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴

				var markerPosition  = new kakao.maps.LatLng(posX, posY); 

				// 마커를 생성합니다
				var marker = new kakao.maps.Marker({
					position: markerPosition
				});
				// 마커가 지도 위에 표시되도록 설정합니다
				marker.setMap(map);


				// 치과들 좌표 구하기
				var geocoder = new kakao.maps.services.Geocoder();

				var positions = [];
				var addressArray = [];
				var total = <?php echo $total;?>;
				var counter = 0;

				<?php 
				for($i = 0 ; $den = sql_fetch_array($result_den) ; $i++) {	
				?>
				//console.log("<?php echo $den['wr_2'] ?> <?php echo $den['wr_2_1']?>");
				//geocoder.addressSearch("<?php echo $den['wr_2']?> <?php echo $den['wr_2_1']?>", callback);
				addressArray.push({id : "<?php echo $den['wr_id'];?>", name : "<?php echo $den['wr_subject'];?>", address : "<?php echo $den['wr_2']?>", detail : "<?php echo $den['wr_2']?> <?php echo $den['wr_2_1']?>", code : "<?php echo $den['wr_code'];?>", homepage : "<?php echo $den['wr_link1'];?>"});
				<?php } 
				?>

				addressArray.forEach(function (addr, index) {
					geocoder.addressSearch(addr.address, function(data, status) {
						console.log(addr)
						console.log(data)
						if(data[0].road_address.building_name) {
							var posTitle = data[0].road_address.building_name;
						} else {
							var posTitle = data[0].address_name;
						}

						positions[index] = {title : posTitle, latlng: new kakao.maps.LatLng(data[0].y, data[0].x)};

						var imageSize = new kakao.maps.Size(24, 35); 

						if(addr.homepage) {
						var homepage = '                <div><a href="' + addr.homepage + '" target="_blank" class="link">홈페이지</a></div>'
						} else {
						var homepage = '';
						} 

						var content = '<div class="wrap wrap'+index+'">' + 
						'    <div class="info">' + 
						'        <div class="title">' + 
						'			 <a href="<?php echo get_pretty_url("dental")?>&wr_id=' + addr.id + '&den_id=' + addr.code + '">' + 
						'            ' + addr.name + 
						'			 </a>' + 
						'            <div class="close" onclick="closeOverlay('+ index +')" title="닫기"></div>' + 
						'        </div>' + 
						'        <div class="body">' + 
						'            <div class="desc">' + 
						'                <div class="ellipsis">'+ addr.detail +'</div>' + homepage +
						'            </div>' + 
						'        </div>' + 
						'    </div>' +    
						'</div>';

						// 마커 이미지의 이미지 주소입니다
						var imageSrc = "https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png"; 
					
						// 마커 이미지를 생성합니다    
						var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize); 
						
						// 마커를 생성합니다
						marker = new kakao.maps.Marker({
							map: map, // 마커를 표시할 지도
							position: positions[index].latlng, // 마커를 표시할 위치
							title : positions[index].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
							image : markerImage // 마커 이미지 
						});

						var overlay = new kakao.maps.CustomOverlay({
							content: content,
							map: map,
							position: positions[index].latlng      
						});

						// 마커를 클릭했을 때 커스텀 오버레이를 표시합니다
						kakao.maps.event.addListener(marker, 'click', function() {
							//overlay.setMap(map);
							$('.wrap' + index).show();
						});

						$('.wrap' + index).hide();
					});

				});

			}


			function errorCallback(error) {

				alert(error.message);

			}


			function load(){ 

				if ( navigator.geolocation ) {

					navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

				} else {

					alert("geolocation not supported");

				}

			}

			// 커스텀 오버레이를 닫기 위해 호출되는 함수입니다 
			function closeOverlay(num) {
				//overlay[num].setMap(null);
				$('.wrap' + num).hide();
			}

			load();

			</script>
		</div>
	</div>
</div>

<?php
include_once(G5_PATH.'/tail.php');