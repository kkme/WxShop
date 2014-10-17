function p(content){
	console.log(content);
    return 0;
};

function session(key,value){
            if (value == undefined) {
                 $.post('/WxShop/index.php/Home/Tool/sessionGet.html',{key:key},function(data){
                    p(data);
                 });
            }else{
                $.post('/WxShop/index.php/Home/Tool/sessionSet.html',{key:key,value:value},function(data){
                    p(data);
                 });
            };
        };

//重写alert()
// function alert(data){
//     $('body').append('<div class="white_content" style="display:inline">'+data+'<a href="#" id="close"><div style="width:20px;height:20px;background-color:#ccc;border-radius:50px;text-align:center;color:red;float:right;margin:-20px;line-height:20px;">X</div></a>');
//     $('#close').click(function(event){
//       event.preventDefault();
//       $('.white_content').remove();;
//     });  
//   }