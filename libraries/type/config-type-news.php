<?php
   
    /* Cửa hàng */
    $nametype = "cua-hang";
    $config['news'][$nametype]['title_main'] = "Cửa hàng";
   

    /* Quản lý mục (Không cấp) */
    if(isset($config['news']))
    {
        foreach($config['news'] as $key => $value)
        {
            if(!isset($value['dropdown']) || (isset($value['dropdown']) && $value['dropdown'] == false))
            { 
                $config['shownews'] = 1;
                break;
            }
        }
    }
?>