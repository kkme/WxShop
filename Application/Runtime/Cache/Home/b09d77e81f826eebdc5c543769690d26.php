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
        <a class="a1">填写个人资料</a>
        <a class="a2" href="zc5.html">完成</a>
    </div>
    <div class="zc1_k"> 
        <p class="zc4_p1">请填写你的真实的信息，以便审核。</p>
        <form action="" method="get">
        <input class="zc4_xm" type="text" value="请填写你的真实姓名" onfocus="if(this.value=' 请填写你的真实姓名') this.value = ''" onblur="if(this.value == '') this.value = '请填写你的真实姓名'"  name='shoper_name'/>
        <input class="zc4_xm" type="text" value="请填写商家所在地址" onfocus="if(this.value=' 请填写商家所在地址') this.value = ''" onblur="if(this.value == '') this.value = '请填写商家所在地址'"  name='address'/>
        <input class="zc4_xm" type="text" value="请填写你的身份证号" onfocus="if(this.value=' 请填写你的身份证号') this.value = ''" onblur="if(this.value == '') this.value = '请填写你的身份证号'"  name='shoper_ID'/>
        <input class="zc4_xm" type="text" value="请重复输入一遍你的身份证号" onfocus="if(this.value=' 请重复输入一遍你的身份证号') this.value = ''" onblur="if(this.value == '') this.value = '请重复输入一遍你的身份证号'"  name='shoper_ID_repeat'/>
         
        </form>
    </div>
</div>


    <script type="text/javascript">
        $(".a2").click(function(event){
            event.preventDefault();
            var shoper_name = $('input[name="shoper_name"]').val();
            var address = $('input[name="address"]').val();
            var shoper_ID = $('input[name="shoper_ID"]').val();
            var shoper_ID_repeat = $('input[name="shoper_ID_repeat"]').val();
            if (shoper_ID != shoper_ID_repeat) {
                alert('两次输入的身份证号码不相同');
                return 0;
            }
            if (address == '请填写商家所在地址') {
                alert('请输入正确的商家所在地址');
                return 0;
            };
            
           if (shoper_name == '请填写你的真实姓名') {
                alert('请正确填写你的真实姓名'); 
           }else{
                $.post('/WxShop/index.php/Home/Regist/setPersonPro',{shoper_name:shoper_name,shoper_ID:shoper_ID,address:address},function(data){
                    if (data.status) {
                        p(data.info);
                        location.href = '/WxShop/index.php/Home/Regist/regist_5';
                    }else{
                        alert(data.info);
                    };
                });
           };
        
        });


    </script>

</div>
</body>
</html>