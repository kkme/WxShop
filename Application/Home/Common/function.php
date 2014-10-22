<?php 
/**
 * UTF-8中文字符截取
 */
 function sysSubStr($String,$Length,$Append = false)
{
    if (strlen($String) <= $Length )
    {
        return $String;
    }
    else
    {
        $I = 0;
        while ($I < $Length)
        {
            $StringTMP = substr($String,$I,1);
            if ( ord($StringTMP) >=224 )
            {
                $StringTMP = substr($String,$I,3);
                $I = $I + 3;
            }
            elseif( ord($StringTMP) >=192 )
            {
                $StringTMP = substr($String,$I,2);
                $I = $I + 2;
            }
            else
            {
                $I = $I + 1;
            }
            $StringLast[] = $StringTMP;
        }
        $StringLast = implode("",$StringLast);
        if($Append)
        {
            $StringLast .= "...";
        }
        return $StringLast;
    }
}

/**
 * 通过goods_id获取goods信息
 */
function getGoods($goods_id,$field = ''){
    $goods = M('Goods')->where(array('id'=>$goods_id))->find();
    if (empty($field)) {
        return $goods;        
    }else{
        return $goods[$field];
    }
}

/**
 * 通过user_id获取用户信息
 */
function getUser($user_id,$field = ''){
    $user = M('User')->where(array('id'=>$user_id))->find();
    if (empty($field)) {
        return $user;        
    }else{
        return $user[$field];
    }
}

/**
 * 通过store_id获取商家信息
 */
function getStore($store_id,$field = ''){
    $user = M('Store')->where(array('id'=>$store_id))->find();
    if (empty($field)) {
        return $user;        
    }else{
        return $user[$field];
    }
}

 ?>