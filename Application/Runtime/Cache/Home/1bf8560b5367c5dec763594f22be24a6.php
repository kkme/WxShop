<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" name="viewport" />

<title>我的微店</title>
<meta name="description" content="">
<meta name="keywords" content="">

<link href="/WxShop/Public/css/weidian.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/WxShop/Public/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="/WxShop/Public/js/tool.js"></script>
</head>

<body>
<div class="box">
	<div class="top">
    	<div class="top1"><a href="javascript:history.go(-1);"><img src="/WxShop/Public/images/tjt_03.png"></a></div>
        <div class="top2">我的微店</div>
        <div class="top3"><a  href="tjsp.html">添加</a></div>
    </div>
	<div class="sousuo">
    	<form action="" method="get">
        	<input name="" type="text" value="搜索" class="sousuo1">
        </form>
    </div>
    <div class="con">
    	<div class="con_tb"><a href="/WxShop/index.php/Home/Store/shopViewDis?store_id=<?php echo ($store['id']); ?>"><img src="/WxShop/Uploads/avatar/<?php echo ($store['avatar']); ?>"></a></div>
        <div class="con_wz">
       	   <h1><?php echo ($store['title']); ?><br><?php echo ($store['intro']); ?></h1>
        </div>
    </div>
    <div class="con1">
    	<div class="con1_nav"><span>|</span><a href="#">上架时间</a></div>
        <div class="con1_nav"><span>|</span><a href="#">销量</a></div>
        <div class="con1_nav"><span>|</span><a href="#">库存</a></div>
        <div class="con1_nav"><a href="#">已售完</a></div>
    </div>
    <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="con2" id="goods_num_<?php echo ($vo["id"]); ?>">
            <div class="con2_nr">
                <div class="con2_nr_tb"><a href="spxq.html"><img src="/WxShop/Uploads/goodsImg/<?php echo ($vo["headerImg"]); ?>" width="70px" height='70px'></a></div>
                <div class="con2_nr_wz">
                  <p><?php echo ($vo["name"]); ?><br><b>$<?php echo ($vo["retailPrice"]); ?></b></p>
                </div>
                
                <div class="con2_nr_tj">
                    <div class="con2_nr_tj_nav con2_nr_tj_one">销量：<?php echo ($vo["sellQuantity"]); ?><span>|</span></div>
                    <div class="con2_nr_tj_nav con2_nr_tj_two">库存：<?php echo ($vo["remainingQuantity"]); ?><span>|</span></div>
                    <div class="con2_nr_tj_nav con2_nr_tj_three">时间：<?php echo (date("m-d",$vo["time"])); ?></div>
                </div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    
</div>
</body>
</html>