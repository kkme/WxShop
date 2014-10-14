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
        <a class="tjt" href="/WxShop/index.php/Home/Regist/welcome"><img src="/WxShop/Public/images/tjt_03.png"></a>
        <a class="a1">注册</a>
        <a class="a2" href="#">下一步</a>
    </div>
    <div class="zc1_k"> 
        <p class="zc_p1">请输入您的手机号</p>
       
        <div class="zc_phone">
        <p class="zc_p2">+86</p>
        <p class="zc_p3"></p>
        <form action="" method="get">
            <input class="zc_hm" type="text" value="填写手机号" onfocus="if(this.value=' 请写您的电话号') this.value = ''" onblur="if(this.value == '') this.value = ' 请写您的电话号'"  name='number'/>
        </form>
        </div>
    </div>
</div>


    <script type="text/javascript">
        $(function(){
            $('.a2').click(function(event){
                event.preventDefault();
                var phone = $('input[name="number"]').val();
                if (!phone.match(/^1[3|4|5|8][0-9]\d{4,8}$/)) {
                    alert('请输入正确的手机号码');
                }else{
                    $.post("/WxShop/index.php/Home/Regist/sendCode",{phone:phone},function(data){
                        console.log(data);
                        if (data.status) {
                            location.href="/WxShop/index.php/Home/Regist/regist_2.html?phone="+phone;
                        }else{
                            alert(data.info);
                        };
                    });    
                };
                
            });

        });
    </script>

</div>
</body>
</html>