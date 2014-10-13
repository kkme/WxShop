<?php 

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


 ?>