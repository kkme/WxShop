<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta charset="utf-8">
<title>微店</title>
<link href="/WxShop/Public/css/zy.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/WxShop/Public/js/jquery-1.9.1.js"></script>
<meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,minimal-ui">
</head>
<body>

    <div class="box">
    <div class="top">
        <a class="a1">填写个人资料</a>
        <a class="a2" href="zc5.html">下一步</a>
    </div>
    <div class="zc1_k"> 
        <p class="zc4_p1">请如实填写真实姓名和身份证号，否则将无法提现。</p>
        <form action="" method="get">
        <input class="zc4_xm" type="text" value="请填写你的真实姓名" onfocus="if(this.value=' 请填写你的真实姓名') this.value = ''" onblur="if(this.value == '') this.value = ' 请填写你的真实姓名'"  name='numb'/>
        <input class="zc4_xm" type="text" value="请填写你的身份证号" onfocus="if(this.value=' 请填写你的身份证号') this.value = ''" onblur="if(this.value == '') this.value = ' 请填写你的身份证号'"  name='numb'/>
        <input class="zc4_xm" type="text" value="请重复输入一遍你的身份证号" onfocus="if(this.value=' 请重复输入一遍你的身份证号') this.value = ''" onblur="if(this.value == '') this.value = ' 请重复输入一遍你的身份证号'"  name='numb'/>
         
        </form>
    </div>
</div>


	<script type="text/javascript">
		$(function(){
			console.log('^_^');
		});
	</script>

</div>
</body>
</html>