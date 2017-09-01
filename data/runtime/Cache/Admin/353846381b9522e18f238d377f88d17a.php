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
</head>
<body>
	<div class="wrap js-check-wrap">
		 <body>
<?php if($nowsurvey["title"] != false): echo ($nowsurvey["title"]); ?>,分享链接:
<label>http://zhangyuxing.com/thinkcmf/index.php?m=survey&a=index&surveyid=<?php echo ($nowsurvey["surveyid"]); ?></label><?php endif; ?>

        <form class="well form-search" method="post" action="<?php echo U('Surveylist/index');?>">
            用户名:
             <select id="choosesurvey">
             <?php if(is_array($allsurvey)): foreach($allsurvey as $key=>$v): ?><option value="<?php echo ($v["surveyid"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; ?>
             	
             </select>
          
            <!-- <input type="submit" class="btn btn-primary" value="搜索" /> -->
            <a class="btn btn-success" onclick="searchs()">搜索</a>
            <a class="btn btn-primary" onclick="lists()">查看统计</a>
            <a class="btn btn-inverse" onclick="add()">增加问题</a>
            <a class="btn btn-danger" onclick="del()">删除问卷</a>
             
        </form>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="50">ID</th>
					<th>题目</th>
					<th>问题1</th>
					<th>问题2</th>
					<th>问题3</th>
					<th>问题4</th>
					<th width="120"><?php echo L('EDIT');?></th>
				</tr>
			</thead>
			<tbody>
				<!-- <?php $user_statuses=array("0"=>L('USER_STATUS_BLOCKED'),"1"=>L('USER_STATUS_ACTIVATED'),"2"=>L('USER_STATUS_UNVERIFIED')); ?> -->

				<?php if(is_array($surveylist)): foreach($surveylist as $key=>$vo): ?><tr>
					<td><?php echo ($vo["number"]); ?></td>
					<td>
						<?php echo ($vo["radiotitle"]); ?>
						<!-- <?php echo ($vo["question"]); ?> -->

					</td>
					<?php if(is_array($vo['question'])): foreach($vo['question'] as $key=>$qs): ?><td><?php echo ($qs["questiontitle"]); ?></td><?php endforeach; endif; ?>

					
					<?php if($vo["count"] < 4): $__FOR_START_1283267461__=$vo["count"];$__FOR_END_1283267461__=4;for($i=$__FOR_START_1283267461__;$i < $__FOR_END_1283267461__;$i+=1){ ?><td></td><?php } endif; ?>
					
					 
					<td>
						 
								<a onclick="edit(<?php echo ($vo['radioid']); ?>)">编辑</a>  
							 
							|<a   href="#" onclick="delradio(<?php echo ($vo['radioid']); ?>)"><?php echo L('DELETE');?></a>
						 |<a   href="#" onclick="up(<?php echo ($vo['radioid']); ?>,<?php echo ($vo["number"]); ?>)">上移</a>|<a   href="#" onclick="down(<?php echo ($vo['radioid']); ?>,<?php echo ($vo["number"]); ?>)">下移</a>
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
	</div>
	<script src="/thinkcmf/public/js/common.js"></script>
	<script src="/thinkcmf/public/js/layer/layer.js"></script>
	<script type="text/javascript">
		function searchs()
		{
			 var suv = $("#choosesurvey").val(); 
			window.location.href="<?php echo U('Surveylist/index');?>&survey="+suv;
			 
		 
		}
		function lists()
		{
			var suv = $("#choosesurvey").val(); 
			window.location.href="<?php echo U('Surveylist/lists');?>&survey="+suv;
			 
		}
		function edit(radioid){
			layer.open({
			  type: 2,
			  area: ['700px', '450px'],
			  fixed: false, //不固定
			  maxmin: true,
			  content: "<?php echo U('Surveylist/edit');?>&radioid="+radioid+""
			});
		}
		function add()
		{
			 var suv =  "<?php echo ($nowsurvey["surveyid"]); ?>"; 


			 layer.open({
			  type: 2,
			  area: ['700px', '450px'],
			  fixed: false, //不固定
			  maxmin: true,
			  content: "<?php echo U('Surveylist/add');?>&suv="+suv+""
			});


			// if (confirm("是否需要增加问题")) {
			// 	$.getJSON("<?php echo U('Surveylist/add');?>",{suv:suv},function(data){
			// 		// alert(data)
			// 	});
			// }
		}
		function del()
		{
			if(confirm("是否删除此问卷")){
				var suv = $("#choosesurvey").val(); 
				 $.getJSON("<?php echo U('Surveylist/dele');?>",{suv:suv},function(data){
						// alert(data)
						window.location.reload();
					});	 
		}
			 
		}
		function up(radioid,number)
		{
			if(number<2)
			{
				alert("已经最高不能上移");
				return false;
			}

				var suv = "<?php echo ($nowsurvey["surveyid"]); ?>"; 
				 $.getJSON("<?php echo U('Surveylist/up');?>",{suv:suv,radioid:radioid,number:number},function(data){
						// alert(data[1])
						// alert(data)
						// alert(data[2])
						window.location.reload();
					});	
		}
		function down(radioid,number)
		{
			var maxid = "<?php echo ($numberradio); ?>";
			 
			if(number>maxid-1)
			{
				alert("已经最低不能下移");
				return false;
			}
			 	
				var suv =  "<?php echo ($nowsurvey["surveyid"]); ?>"; 
				 $.getJSON("<?php echo U('Surveylist/down');?>",{suv:suv,radioid:radioid,number:number},function(data){
						// alert(data)
						window.location.reload();
					});	
		}

		function delradio(data)
		{
			if(confirm("是否删除此问题")){
			var suv = $("#choosesurvey").val(); 
			 $.getJSON("<?php echo U('Surveylist/delradio');?>",{radio:data},function(data){
					// alert(data)
					window.location.reload();
				});	 
		}
		}
	</script>
</body>
</html>