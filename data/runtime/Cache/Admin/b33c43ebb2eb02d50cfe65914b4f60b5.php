<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/thinkcmf/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/thinkcmf/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/thinkcmf/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/thinkcmf/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/thinkcmf/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<script type="text/javascript">
	//全局变量
	var GV = {
	    ROOT: "/thinkcmf/",
	    WEB_ROOT: "/thinkcmf/",
	    JS_ROOT: "public/js/",
	    APP:'<?php echo (MODULE_NAME); ?>'/*当前应用名*/
	};
	</script>
    <script src="/thinkcmf/public/js/jquery.js"></script>
    <script src="/thinkcmf/public/js/wind.js"></script>
    <script src="/thinkcmf/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script>
    	$(function(){
    		$("[data-toggle='tooltip']").tooltip();
    	});
    </script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
<!-- <link rel="stylesheet" href="/thinkcmf/public/swiper/swiper.min.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="/thinkcmf/public/css/city-picker.css"> -->
</head>
	<div class="wrap js-check-wrap">
		 
        <form class="well form-search" method="post" action="<?php echo U('Surveydetail/index');?>">
            用户名:
             <select id="choosesurvey">
             <?php if(is_array($allsurvey)): foreach($allsurvey as $key=>$v): ?><option value="<?php echo ($v["surveyid"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; ?>
             	
             </select>
          
            <!-- <input type="submit" class="btn btn-primary" value="搜索" /> -->

            <label>请选择地区:</label>
            
				<div class="city-picker-select" ></div>
            <a class="btn btn-primary" onclick="lists()">查看统计</a>

            

        </form>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
				
					<th width="50">ID</th>
					<?php if(is_array($allradio)): foreach($allradio as $key=>$v): ?><th width="50"><?php echo ($v["radiotitle"]); ?></th><?php endforeach; endif; ?>
					    
					
				<th width="120"><?php echo ($sssurvey["textarea"]); ?></th>
					<th width="120"><?php echo L('EDIT');?> </th>
			 	
				</tr>
			</thead>
			<tbody>
				<!-- <?php $user_statuses=array("0"=>L('USER_STATUS_BLOCKED'),"1"=>L('USER_STATUS_ACTIVATED'),"2"=>L('USER_STATUS_UNVERIFIED')); ?> -->

				<?php if(is_array($surveyrecord)): foreach($surveyrecord as $key=>$vo): ?><tr>
				
				
					<td><?php echo ($vo["id"]); ?></td>
					<?php if(is_array($vo["question"])): foreach($vo["question"] as $key=>$v): ?><td>
						<?php echo ($v["questionname"]); ?>
						<!-- <?php echo ($vo["question"]); ?> -->

					</td><?php endforeach; endif; ?>
					<?php $__FOR_START_880911602__=$vo["count"];$__FOR_END_880911602__=$countradio;for($i=$__FOR_START_880911602__;$i < $__FOR_END_880911602__;$i+=1){ ?><td> </td><?php } ?>
					
				 <td><?php echo ($vo["textare"]); ?></td>
						
				 <td>
				 		<a   href="#" onclick="dele(<?php echo ($vo["id"]); ?>)"><?php echo L('DELETE');?></a>
				 </td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
	</div>
	<script src="/thinkcmf/public/js/common.js"></script>
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
	<script type="text/javascript">
		function searchs()
		{
			 var suv = $("#choosesurvey").val(); 
			window.location.href="<?php echo U('Surveydetail/index');?>&survey="+suv;
			 
		 
		}
		function lists()
		{
			var district = $("#district").val();
			var districtname = $("#district").find("option:selected").text();
			 if(district == 0||district=='请选择区县'){
			 	alert("请选择区县,当前显示全国统计！");
			 	
			 }else{
			 	alert("当前显示"+districtname+"统计！");

			 }
			  
			 var suv = $("#choosesurvey").val(); 
			window.location.href="<?php echo U('Surveydetail/index');?>&survey="+suv+"&district="+district;
			 
		}
	</script>
	<script type="text/javascript">
		function dele(data)
		{
			if(confirm("是否删除此问卷内容")){
				 $.getJSON("<?php echo U('Surveydetail/dele');?>",{id:data},function(data){
			 	 window.location.reload();
			 });
			}
			
		}
	</script>
</body>
</html>