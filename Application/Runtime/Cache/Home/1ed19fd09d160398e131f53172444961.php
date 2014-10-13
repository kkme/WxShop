<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<title>节点排序测试</title>
	<script type="text/javascript" src="/WxShop/Public/js/jquery-1.9.1.js"></script>
	<style type="text/css">
		.box{
			width: 480px;
			height: 50px;
			margin: 10px;
		}
	</style>
</head>
<body>
	<div style="width:500px;border:solid black">
		<div class="box" style="background-color:red" id="num_1" age="20" salary="9.9" time="120">
			id="num_1" age="20" salary="9.9" time="120"
		</div>
		<div class="box" style="background-color:green" id="num_2" age="12" salary="2.1" time="34">
			id="num_2" age="12" salary="2.1" time="34"
		</div>
		<div class="box" style="background-color:silver" id="num_3" age="56" salary="20.4" time="560">
			id="num_3" age="56" salary="20.4" time="560"
		</div>
		<div class="box" style="background-color:pink" id="num_4" age="34" salary="1.3" time="234">
			id="num_4" age="34" salary="1.3" time="234"
		</div>

	</div><br>
	<button name="sort_by_age">根据年龄重排</button>
	<button name="sort_by_salary">根据薪水重排</button>
	<button name="sort_by_time">根据时间重排</button>
	<script type="text/javascript">
		

		function sort(type){
			var boxes = $('.box');
			for(var i = 0 ; i < boxes.length ; i++){
				var this_box = $(boxes[i]);
				var this_iterm = this_box.attr(type);
				for(var j = i + 1 ; j < boxes.length ; j++){
					var another_box = $(boxes[j])
					var another_iterm = another_box.attr(type);
					if (this_iterm > another_iterm) {
						this_box.insertAfter(another_box);
						console.log(this_box.attr('id')+">"+another_box.attr('id'));
					}else{
						console.log(this_box.attr('id')+"<"+another_box.attr('id'));
					}
				}
			}
		}
		$('button').click(function(){
			var name = $(this).attr('name');
			if (name == 'sort_by_time') {
				sort('time');
			}else if(name == 'sort_by_salary'){
				sort('salary');
			}else if(name == 'sort_by_age'){
				sort('age');
			};

		});

		var boxes = $('.box');
		for(var i = 0 ; i < boxes.length ; i++){
			var this_box = $(boxes[i]);
			var min = 0;
			var this_iterm = this_box.attr('salary');
			
		}
	</script>	
</body>
</html>