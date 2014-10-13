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
        <a class="tjt" href="/WxShop/index.php/Home/Regist/regist_1.html"><img src="/WxShop/Public/images/tjt_03.png"></a>
        <a class="a1">请填写验证码</a>
        <a class="a2" href="#">下一步</a>
    </div>
    <div class="zc1_k"> 
        <p class="zc2_p1">我们已发送<span>验证码短信</span>到这个号码</p>
        <p class="zc2_p2">+86 xxxxxxxxxxx</p>
        <form action="" method="get">
            <input class="zc2_yz" type="text" value="验证码"onfocus="if(this.value=' 验证码') this.value = ''" onblur="if(this.value == '') this.value = ' 验证码'"  name='code'/>
        </form>
        <div class="zc2_p3">接收短信大约需要5秒</div>
    </div>
</div>


    <script type="text/javascript">
        var r = window.location.search.substr(7);
        $('.zc2_p2').text("+86 "+r);
        $('.a2').click(function(event){
            var code = $('input[name="code"]').val();
            event.preventDefault();
            $.post('/WxShop/index.php/Home/Regist/checkCode',{code:code,phone:r},function(data){
                if (data.status) {
                    location.href = "/WxShop/index.php/Home/Regist/setPassDis";
                }else{
                    alert(data.info);
                    // console.log(data);
                };
            });
        });
    </script>

</div>
</body>
</html>