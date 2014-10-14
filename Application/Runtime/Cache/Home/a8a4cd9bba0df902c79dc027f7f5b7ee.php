<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta charset="utf-8">
<title>微店</title>
<link href="/WxShop/Public/css/zy.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/WxShop/Public/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="/WxShop/Public/js/tool.js"></script>
<meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,minimal-ui">
</head>
<body>

    <div class="box">
    <div class="top">
        <a class="tianxie">填写微店基本信息</a>
        <a class="wancheng" href="zc6.html">完成</a>
    </div>
    <div class="zc1_k"> 
        <div class="toux"><img src="/WxShop/Public/images/zhaoxiang.png"></div>
        <div class="renxiang"><img id="avatar" src="/WxShop/Public/images/renxiang_03.png"></div>
        <div class="shangc" style="visibility:hidden">正在上传<span>2%</span></div>

        <form action="/WxShop/index.php/Home/Regist/imgUpload" method="post" enctype="multipart/form-data" target="hidden_frame" id="pic">
            <input type="file" name="pic" style="visibility:hidden"/>
            <input type="submit" value="submit" style="visibility:hidden"/>
        </form>
        <iframe name='hidden_frame' id="hidden_frame" style='display:none'></iframe>

        <form>
             <input class="zc5_mz" type="text" value="请输入商家名" onfocus="if(this.value='请输入商家名') this.value = ''" onblur="if(this.value == '') this.value = '请输入商家名'"  name='title'/><br><br>
            
            <textarea name="intro" class="zc5_mz" style="height:160px;"  onfocus="if(this.value='请输入商家简介') this.value = ''" onblur="if(this.value == '') this.value = 请输入商家简介'">请输入商家简介
            </textarea>
        </form> 
        
    </div>
    </div>


    <script type="text/javascript">
        //点击图片触发文件上传按钮
        $('img').click(function(){
            $('input[name="pic"]').click();
        });
        // 提交图片之后，自动提交
        $('input[name="pic"]').change(function(){
            //模拟点击提交按钮
            $('input[type="submit"]').click();
            //显示进度条
            $('.shangc').removeAttr('style');
            //模拟进度条，给图片上传争取时间
            var i = 0;
            time = setInterval(function(){
                i++;
                $('.shangc span').text(i+'%');
                if (i == 100) {
                    $('.shangc').css("visibility","hidden");
                    clearInterval(time);
                    //向服务器端获取这个图片在服务器上的位置
                    $.post('/WxShop/index.php/Home/Regist/imgResponse',function(data){
                        if (data == '') {
                            alert('未知错误,错误代码:005');
                        }else{
                            $('img#avatar').attr('src','/WxShop/Uploads/avatar/'+data);
                        };
                    });
                };
            },50);
  
        });
        $('.wancheng').click(function(event){
            event.preventDefault();
            var title = $('input[name="title"]').val();
            var intro = $('textarea[name="intro"]').val();
            if (title == '请输入商家名' || intro == '请输入商家简介') {
                alert('请填写正确的商家名和商家简介');
                return 0;
            };
            $.post('/WxShop/index.php/Home/Regist/setStorePro',{title:title,intro:intro},function(data){
                if (data.status) {
                    location.href = "<?php echo U('Home/Store/shopDis');?>";
                }else{
                    alert(data.info);
                };
            });
        });
    </script>

</div>
</body>
</html>