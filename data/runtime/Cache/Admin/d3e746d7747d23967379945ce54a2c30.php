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
		 
        <form class="well form-search" method="post" action="<?php echo U('Surveycharts/search');?>">
            用户名:s
            <select id="">
            	<option>2</option>
            	<option>43</option>
            </select>
            邮箱:
            <select id="">
            	<option>2</option>
            	<option>43</option>
            </select><br>
            邮箱:
            <select id="">
            	<option>2</option>
            	<option>43</option>
            </select>
            <input type="submit" class="btn btn-primary" value="搜索" />
            <!-- <a class="btn btn-danger" href="<?php echo U('User/index');?>">清空</a> -->
        </form>
 
 
      
 
    <body>
        <div id="chartContainer"></div>
 
        
    
	</div>
	  <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
	
	<script src="/thinkcmf/public/js/common.js"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script type="text/javascript">
 
            $(function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "theme2",
                    animationEnabled: true,
                    title: {
                        text: "提问问题"
                    },
                    data: [
                    {
                        type: "column",                
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }
                    ]
                });
                chart.render();
            });
        </script>
</body>
</html>