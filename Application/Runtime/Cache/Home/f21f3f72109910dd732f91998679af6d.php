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
            <a class="tjt" href="/WxShop/index.php/Home/Regist/regist_2.html"><img src="/WxShop/Public/images/tjt_03.png"></a>
            <a class="a1">设置密码</a>
            <a class="a2" href="#">下一步</a>
        </div>
        <div class="zc1_k"> 
            <p class="zc3_p1">请设置密码</p>
            <form action="" method="get">
            <input class="zc3_mm" type="text" value="请输入密码"/>
            <input class="zc3_mm" type="password" style="display:none" name='pass'/>
            
            <input class="zc3_cm" type="text" value="请重复输入密码"/>
            <input class="zc3_cm" type="password" style="display:none" name='Repeatpass'/>
            </form>
        </div>
    </div>


    <script type="text/javascript">
        $('.a2').click(function(event){
            event.preventDefault();
            var pass = $('input[name="pass"]').val();
            var repeatPass = $('input[name="Repeatpass"]').val();
            if (pass != repeatPass) {
                alert('两次输入的密码不相同');
            }else{
               if (pass.length<6||pass.length>16) {
                    alert('密码请在6至16位之间'); 
               }else{
                    $.post('/WxShop/index.php/Home/Regist/setPass',{password:pass},function(data){
                        if (data.status) {
                            location.href = '/WxShop/index.php/Home/Regist/setPersonDis';
                        }else{
                            alert(data.info);
                        };
                    });
               };
            };
            
        });
        $('.zc3_mm[type="text"]').focus(function(){
            $(this).hide();
            $('.zc3_mm[type="password"]').show().focus();
        });
        $('.zc3_cm[type="text"]').focus(function(){
            $(this).hide();
            $('.zc3_cm[type="password"]').show().focus();
        });

    </script>

</div>
</body>
</html>