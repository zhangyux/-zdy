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
<head>
    <meta charset="utf-8">
    <title>后台上移下移，编辑，删除效果</title>
    <link rel="stylesheet" type="text/css" href="/thinkcmf/public/css/wenjuan_ht.css">
    <!-- <script src="/thinkcmf/public/js/jquery.js"></script> -->
    <script src="/thinkcmf/public/js/add.js"></script>
</head>

<body>
<label style="text-align:center"><h1>输入问卷调查标题</h1></label>
<label style="text-align:center"><input  type="text" id="title" name=""></label>
<br>
    <div class=" all_660">
        <div class="yd_box"></div>
        <div class="but" style="padding-top: 20px">
            <select id="addquerstions" class="addquerstions" name="">
                <option value="-1">添加问题</option>
                <option value="0">单选</option>
                <!-- <option value="1">多选</option> -->
                <option value="2">填空</option>
                <!-- <option value="3">矩阵</option> -->
            </select>

            <button onclick="creates()" class="btn btn-success">增加题目</button>
            <!-- <button id="add">增加问题</button> -->
            <br><br><br><br><br>
            
            <input type="button" class="btn btn-primary" name="" value="创建问卷" id="sub">
            <!-- <button >创建问卷</button> -->

        </div>
        <!--选项卡区域  模板区域---------------------------------------------------------------------------------------------------------------------------------------->
        <div class="xxk_box">
            <div class="xxk_conn hide">
                <!--单选----------------------------------------------------------------------------------------------------------------------------------------->
                <div class="xxk_xzqh_box dxuan ">
                    <textarea name="" cols="" rows="" class="input_wenbk btwen_text btwen_text_dx" placeholder="单选题目"></textarea>
                    <div class="title_itram">
                        <div class="kzjxx_iteam">
                            <input name="" type="radio" value="" class="dxk">
                            <input name="" type="text" class="input_wenbk" value="" placeholder="选项">
                            <label>
                                 
                            </label> <a href="javascript:void(0);" class="del_xm">删除</a>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="zjxx">增加选项</a>
                    <!--完成编辑-->
                    <div class="bjqxwc_box">
                        <a href="javascript:void(0);" class="qxbj_but">取消编辑</a>
                        <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                    </div>
                </div>
                <!--多选----------------------------------------------------------------------------------------------------------------------------------------->
                <div class="xxk_xzqh_box duoxuan hide">
                    <textarea name="" cols="" rows="" class="input_wenbk btwen_text btwen_text_duox" placeholder="多选题目"></textarea>
                    <div class="title_itram">
                        <div class="kzjxx_iteam">
                            <input name="" type="checkbox" value="" class="dxk">
                            <input name="" type="text" class="input_wenbk" value="选项" placeholder="选项">
                            <label>
                                <input name="" type="checkbox" value="" class="fxk"> <span>可填空</span></label>
                            <a href="javascript:void(0);" class="del_xm">删除</a>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="zjxx">增加选项</a>
                    <!--完成编辑-->
                    <div class="bjqxwc_box">
                        <a href="javascript:void(0);" class="qxbj_but">取消编辑</a>
                        <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                    </div>
                </div>
                <!-- 填空----------------------------------------------------------------------------------------------------------------------------------------->
                <div class="xxk_xzqh_box tktm hide">
                    <textarea name="" cols="" rows="" class="input_wenbk btwen_text btwen_text_tk" placeholder="答题区"></textarea>
                    <!--完成编辑-->
                    <div class="bjqxwc_box">
                        <a href="javascript:void(0);" class="qxbj_but">取消编辑</a>
                        <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                    </div>
                </div>
                <!-- 矩阵----------------------------------------------------------------------------------------------------------------------------------------->
                <div class="xxk_xzqh_box  hide">
                    <div class="line_dl"></div>
                    <div class="jztm">
                        <textarea name="" cols="" rows="" class="input_wenbk btwen_text" placeholder="题目"></textarea>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr valign="top">
                                    <td width="135">
                                        <h4 class="ritwenz_xx">左标题</h4>
                                        <textarea name="" cols="" rows="" class="leftbtwen_text" placeholder="例子：CCTV1，CCTV2，CCTV3"></textarea>
                                    </td>
                                    <td>
                                        <h4 class="ritwenz_xx  ">
                                                右侧选项文字 <input type="radio" name="xz" value="0"
                                                    checked="checked" class="xzqk">单选<input
                                                    type="radio" value="1" name="xz" class="xzqk">多选
                                            </h4>
                                        <div class="title_itram">
                                            <div class="kzjxx_iteam">
                                                <input name="" type="text" class="input_wenbk jzwent_input" value="选项" onblur="if(!this.value)this.value='选项'" onclick="if(this.value&amp;&amp;this.value=='选项' )  this.value=''">
                                                <label>
                                                    <input name="" type="checkbox" value="" class="fxk"> <span>可填空</span></label> <a href="javascript:void(0);" class="del_xm">删除</a>
                                            </div>
                                            <div class="kzjxx_iteam">
                                                <input name="" type="text" class="input_wenbk jzwent_input" value="选项" onblur="if(!this.value)this.value='选项'" onclick="if(this.value&amp;&amp;this.value=='选项' )  this.value=''">
                                                <label>
                                                    <input name="" type="checkbox" value="" class="fxk"> <span>可填空</span></label> <a href="javascript:void(0);" class="del_xm">删除</a>
                                            </div>
                                            <div class="kzjxx_iteam">
                                                <input name="" type="text" class="input_wenbk jzwent_input" value="选项" onblur="if(!this.value)this.value='选项'" onclick="if(this.value&amp;&amp;this.value=='选项' )  this.value=''">
                                                <label>
                                                    <input name="" type="checkbox" value="" class="fxk"> <span>可填空</span></label> <a href="javascript:void(0);" class="del_xm">删除</a>
                                            </div>
                                        </div> <a href="javascript:void(0)" class="zjxx" style="margin-left: 0;">增加选项</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--完成编辑-->
                        <div class="bjqxwc_box">
                            <a href="javascript:void(0);" class="qxbj_but">取消编辑</a> <a href="javascript:void(0);" class="swcbj_but"> 完成编辑</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
var fill = 0;
var addradio = 0;

$('#sub').click(function() {
    var title = $("#title").val();
    if((title==null)||(title=='')){
        alert("请输入标题");
        return false;
    }

    if(confirm("是否确认发布此问卷调查")){
        var i=0;
        $.getJSON("<?php echo U('Surveyadd/getmaxsurveyid');?>",function(surveyid){
            var smaxid = surveyid;
            // alert(smaxid);

            // alert(title);
            var textareas = $("#fill").html();
            if(textareas==null){
                textareas="请提出您的意见";
            }
            $.getJSON("<?php echo U('Surveyadd/addsurvey');?>", {smaxid:smaxid,textarea:textareas,title:title}, function(surve){
            });


            // alert(a);
            $("#sub").parent(".but").parent(".all_660").children(".yd_box").children(".movie_box").each(function() {
                // alert(2)
            // // alert();
            i++
            var c =  $(this).children(".wjdc_list").children('.rad').val();
            if(c!=null)
            {
                var radioname = $("#"+c).html();
                    // alert(radioname) ;

                $.getJSON("<?php echo U('Surveyadd/addsurveyradio');?>", {smaxid:smaxid,radioname:radioname,i:i}, function(radioid){  
            //         var radioid = radioid;
                    $("."+c).each(function(){

                    var questiontitle = $(this).parent("label").children("span").html(); 
                    // alert(questiontitle)  ;
                    $.getJSON("<?php echo U('Surveyadd/addsurveyquestion');?>", {radioid:radioid,questiontitle:questiontitle}, function(data){
                        
                                        });
            //         })
                });

            // // $(this).children(".wjdc_list").children("li").each(function() {
            // //  var rd = $(this).children("label").children("span").html();
            // //  if(rd!=null){
            // //      alert(rd);
            // //      alert(c);
            // //  }

            });


            }

            });
        });
alert("问卷创建成功");
        // window.location.reload();
    }

});
</script>
<script type="text/javascript">
   
</script>
</html>