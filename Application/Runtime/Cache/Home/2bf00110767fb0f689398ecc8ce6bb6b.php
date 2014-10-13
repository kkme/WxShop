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
            <a class="a1">登陆</a>
            <a class="a2" href="#">完成</a>
        </div>
        <div class="zc1_k"> 
            <p class="zc_p1"></p>
            <div class="zc_phone">
            <p class="zc_p2">+86</p>
            <p class="zc_p3"></p>
            <form action="" method="get">
                <input class="zc_hm" type="text" value="填写手机号" onfocus="if(this.value=' 请写您的电话号') this.value = ''" onblur="if(this.value == '') this.value = ' 请写您的电话号'"  name='shoper_phone'/>
            </form>
            </div> 
            <div class="zc_phone">
            <form action="" method="get">
                <input class="zc_hm" type="text" value="请输入密码" name="hidepassword" />
                <input class="zc_hm" type="password" style="display:none" name='password'/>
            </form>
            </div> 
        </div>
    </div>


    <script type="text/javascript">
        $('.a2').click(function(event){
            var shoper_phone = $('input[name="shoper_phone"]').val();
            var password = $('input[name="password"]').val();
            event.preventDefault();
            $.post('/WxShop/index.php/Home/Regist/loginPro',{shoper_phone:shoper_phone,password:password},function(data){
                if (data.status) {
                    location.href = "<?php echo U('Home/Store/shopDis');?>";
                }else{
                    alert(data.info);
                };
            });
        });

        $('.zc_hm[name="hidepassword"]').focus(function(){
            $(this).hide();
            $('.zc_hm[name="password"]').show().focus();
        });
        
    </script>

</div>
</body>
</html>