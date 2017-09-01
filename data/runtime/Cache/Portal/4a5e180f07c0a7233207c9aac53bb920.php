<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta content="yes" name="apple-mobile-web-app-capable">
	<meta content="black" name="apple-mobile-web-app-status-bar-style">
	<meta name="format-detection" content="tele意见反馈=no">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/thinkcmf/public/css/reset.css" />
	<link rel="stylesheet" href="/thinkcmf/public/css/toup.css" />
	<link rel="stylesheet" href="/thinkcmf/public/swiper/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="/thinkcmf/public/css/city-picker.css">

	<script src="/thinkcmf/public/js/jquery.js"></script>
	<script src="/thinkcmf/public/js/fontSize.js"></script>
	<title>投票</title>
</head>
<body>
	<section class="toup"  id="t1">
		<!-- <div class="logo">
			<img src="images/logo.png"/>
		</div> -->
		<div class="swipers">
			<div class="con">
				<h1>电子校牌调查问卷</h1>
				<p>请选择地区</p>
				<div class="city-picker-select" ></div>
 
				<!-- <p>3D时尚定制鞋开创者lamoda是国内领先的鞋类私人订制品牌，致力于为您设计、生产您想要的鞋、舒适的鞋。</p>
				<p>lamoda自推出“DIY自主设计”以来，受到了众多客户朋友的喜爱与追捧，为了让“DIY”能够更好地满足您对鞋子的所有向往，我们非常期待能知道您的想法。</p>
				<p>坐下来，品一杯咖啡，细细地想一想，您心中的lamodaDIY，是什么样的呢？</p> -->
			</div>
			<a href="javascript:;" class="jion" onclick="abc()">参加本调查</a>
		</div>
	</section>
	<section class="toup" id="t2">
		<!-- <div class="logo">
			<img src="images/logo.png"/>
		</div> -->
		<div class="swipers">
		<!-- 上下 -->
		<div class="swiper-container">
			<div class="swiper-wrapper">
 
			<?php if(is_array($survey["radio"])): foreach($survey["radio"] as $key=>$v): ?><div class="swiper-slide">
					<div class="scores">

						<div class="f" ><span><?php echo ($v["addcounter"]); ?></span></div>

					<h3 ><?php echo ($v["radiotitle"]); ?></h3>

						 
						<div class="choose">
						<?php if(is_array($v[($v[radioid])])): foreach($v[($v[radioid])] as $key=>$question): ?><div class="input"><input type="radio" name="radio<?php echo ($question["radioid"]); ?>" value="<?php echo ($question["questionid"]); ?>" class="radio<?php echo ($question["radioid"]); ?>" id="<?php echo ($question["questionid"]); ?>">
							  <label for="<?php echo ($question["questionid"]); ?>"> <?php echo ($question["questiontitle"]); ?></label></div><?php endforeach; endif; ?>
							

							 
					
						</div>
					</div>
				</div><?php endforeach; endif; ?>
				 
			 




			</div>
			<div class="preNexts">
				<div class="swiper-button-prev"><div class="pre"></div>上一题</div>
				<div class="swiper-button-next"><div class="next"></div>下一题</div>
			</div>
		</div>
		<!-- 上下end -->
		</div>
	</section>
	<section class="toup" id="t3">
		<!-- <div class="logo">
			<img src="images/logo.png"/>
		</div> -->
		<div class="swipers">
			<div class="con con1">
			
				<!-- <input type="number" name="" class="意见反馈" placeholder="手机号码"/> -->
				<div class="smile">
					<p>非常感谢您的配合!</p>
					<p>
					<?php if($survey["textarea"] == '0'): ?>请列举您的意见:
				 <?php elseif($survey["textarea"] != '0'): ?>
				 		<?php echo ($survey["textarea"]); ?>:<?php endif; ?>
					</p>

				</div>
				<textarea class="feedback" style="height: 3rem" id="feedback"></textarea>
			</div>
			<a href="javascript:;" class="tijiao" onclick="sub()">提交调查</a>
		</div>
	</section>
	<script src="/thinkcmf/public/swiper/swiper.min.js"></script>
	<script>
		var mySwiper  = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 30,
        loop: true,
		onReachEnd: function(swiper){
			$("#t2").hide();
			$("#t3").show();
		}
    });
	$("#t2,#t3").hide();
		$("a.jion").on("click",function(){
			$("#t1").hide();
			$("#t2").show();
	});
	$(".swiper-container label,.swiper-container input").click(function(){
		var this_active = $(this).parents(".swiper-slide").index();
		setTimeout(function(){
			mySwiper.slideTo(this_active+1,1000)
		},500);
		
 });
	$('.swiper-button-next').click(function(){
		if(mySwiper .isEnd){
			$("#t2").hide();
			$("#t3").show();
		}
	})
	
	</script>
	<script type="text/javascript">
		function sub()
		{
			var surveyid = "<?php echo ($survey["surveyid"]); ?>";
			var radiotag = "<?php echo ($radiotag); ?>";
			var local = $("#district").val();

			var questionid = 0;
			var addnumber = 1;
			  $.getJSON("<?php echo U('Survey/getradio');?>", {surveyid:surveyid}, function(radioid){
			  	 	$.each(radioid,function(i,n){
			  	 		 
					 	questionid = $("input[name='radio"+n.radioid+"']:checked").val();  
					  
					 	questionname = $("input[name='radio"+n.radioid+"']:checked").parents(".input").children('label').html();  
					  addnumber++;
					  // alert(questionid)
					  // alert(questionname)
					 		 $.getJSON("<?php echo U('Survey/surveyradiorecord');?>", {radioid:n.radioid,questionid:questionid,questionname:questionname,radioname:n.radiotitle,radiotag:radiotag,local:local}, function(radioid){
					 		 	 
					 		 });

					 	 

					 	


					});
			  });



			

				var textareas = $("#feedback").val();
				if((textareas==null)||(textareas=='')){
					textareas = 0;
				}

				$.getJSON("<?php echo U('Survey/surveyrecord');?>", {surveyid:surveyid,radiotag:radiotag,local:local,textareas:textareas}, function(radioid){
					// alert(2)
				alert("问卷提交成功");
					
				});




				// alert('s:'+surveyid+'r:'+radiotag+'l'+local+'t:'+textareas);
			 	location.reload();
				
		}
	</script>
 
	<!-- <script type="text/javascript" src="/thinkcmf/public/js/jquery.min.js"></script> -->
	<script type="text/javascript" src="/thinkcmf/public/js/citydata.js"></script>
	<script type="text/javascript" src="/thinkcmf/public/js/cityPicker-1.0.0.js?v=1"></script>
	<script type="text/javascript">
		$(function () {
			//原生城市-无联动
			var select = $('.city-picker-select').cityPicker({
				dataJson: cityData,
				renderMode: false,
				linkage: false
			});

		 
		});
	</script>
	<script type="text/javascript">
		function abc()
		{
			var district = $("#district").val();
			 if(district == 0||district=='请选择区县'){
			 	location.reload();
			 	alert("请选择区县");
			 	
			 }
		}
	</script>
</body>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?move=0" charset="utf-8"></script>
<!-- JiaThis Button END -->
</html>