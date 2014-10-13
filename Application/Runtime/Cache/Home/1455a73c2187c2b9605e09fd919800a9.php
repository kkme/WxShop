<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="/WxShop/Public/css/zy.css" rel="stylesheet" type="text/css" />
<meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,minimal-ui">
<script src="/WxShop/Public/js/jquery.js"></script>
<title>微店</title>
</head>
<body>
<div class="box" style="margin-bottom:51px;">
	<div class="top">
    	<a class="tjt" href="javascript:history.go(-1);"><img src="/WxShop/Public/images/tjt_03.png"></a>
        <a class="a1">店铺预览</a>
        <a class="a5" href="#">刷新</a>
    </div>
    <div class="baik">
        <div class="dian"><img src="/WxShop/Public/images/dian_03.png">微店<span class="dian1">和煦百货</span></div>
         <div class="xin"><img src="/WxShop/Public/images/xin_09.png"></div>
        <div class="huitiao2"></div>
      </div>
      <div class="x_banner"><img src="/WxShop/Public/images/x_banner.jpg"width="100%"></div>
      <div class="x_touxiang">
      	<div class="x_tx">
        <img src="/WxShop/Public/images/x_touxiang_15.png">
        <div class="x_text">
        <p class="x_dm"><?php echo ($store['title']); ?></p>
        <p class="x_wx"><?php echo ($store['intro']); ?></p>
        </div>
        </div>
      </div>
     
    <div class="x_dztj">
    	<p class="x_tj">本店产品</p>
          <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/WxShop/index.php/Home/Store/goodsDis?goods_id=<?php echo ($vo["id"]); ?>">
              <div class="x_cp">
                <dl>
                  <dt><img src="/WxShop/Uploads/goodsImg/<?php echo ($vo["headerImg"]); ?>"width="100%"height="150px"></dt>
                    <dd>
                        <p class="name"><?php echo (syssubstr($vo["name"],18)); ?>...</p>
                        <p class="x_jq">￥<?php echo ($vo["retailPrice"]); ?></p>
                    </dd>
                </dl>
             </div>
           </a><?php endforeach; endif; else: echo "" ;endif; ?>
     </div>
     
     <div class="db1">
       		<ul>
            	<li><img src="/WxShop/Public/images/fdj.png"></li>
            	<li class="line"><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">商品分类</a>
        <div id="light" class="white_content">该店家暂未设置分类 <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">关闭</a></div> 
        <div id="fade" class="black_overlay"></div> </li>
      			<li class="line"><a href="wdwd1.html">我的微店</a></li>
      			<li class="line"><a href="gwc.html">购物车</a></li>
  			</ul>
            <div class="tb_content">
            	<div class="search_left">
                	<a  class="tb_title"></a>
                </div>
                <form action="" method="get">
                	<input  class="block"type="search" placeholder="搜索本店铺商品">
                    <a class="search">搜索</a> 
                </form>
            </div>
    </div>
</div>
</body>
</html>