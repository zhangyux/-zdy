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
    <link rel="stylesheet" type="text/css" href="/thinkcmf/public/css/wenjuan_ht.css">
    <script src="/thinkcmf/public/js/add.js"></script>

</head>
<body>
	<div class="dx_box" data-t="0" style="display: block;">
                    <textarea name="" cols="" rows="" class="input_wenbk btwen_text btwen_text_dx" placeholder="单选题目"><?php echo ($radio["radiotitle"]); ?></textarea>
                    <div class="title_itram">

  

 	 <div class="kzjxx_iteam">
                            <input name="" type="radio" value="" class="dxk">
                            <input name="" type="text" class="input_wenbk" value="<?php echo ($v["questiontitle"]); ?>" placeholder="选项">
                            <label>
                                 
                            </label> <a href="javascript:void(0);" class="del_xm">删除</a>
                        </div>         

                    </div>
                    <a href="javascript:void(0)" class="zjxx">增加选项</a>
                    <!--完成编辑-->
                    <div class="bjqxwc_box">
                        <a href="javascript:void(0);" onclick="backs()" class="qxbj_but">取消编辑</a>
                        <a href="javascript:void(0);" onclick="sub()"  class="qxbj_but"> 完成编辑</a>
                    </div>
                </div>


		<!-- 	<div class="form-actions">
				<input type="hidden" name="id" value="<?php echo ($id); ?>" />
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('SAVE');?></button>
				<a class="btn" onclick="backs()"><?php echo L('BACK');?></a>
			</div> -->
		</form>
	</div>
	<script src="/thinkcmf/public/js/common.js"></script>
	<script type="text/javascript">
		function backs()
		{
	 		var index=parent.layer.getFrameIndex(window.name);

			parent.layer.close(index);

		}

 
		function sub()
		{	var suv = "<?php echo ($suv); ?>";
			var getquestion = $(".dx_box").children("textarea").val(); //编辑题目区
			  $(".dx_box").children(".title_itram").children('.kzjxx_iteam').each(function(){
				var question = $(this).children('.input_wenbk').val();
				// alert(question)
				$.getJSON("<?php echo U('Surveylist/add_post');?>",{suv:suv,question:question},function(data){
					// alert(data)
				});
			}); 
			 // alert(getquestion);
				$.getJSON("<?php echo U('Surveylist/add_postquestion');?>",{suv:suv,question:getquestion},function(data){
					 
						window.parent.location.reload()
					 
				});	 
			 // alert(getquestion)
		}
	</script>
</body>
</html>