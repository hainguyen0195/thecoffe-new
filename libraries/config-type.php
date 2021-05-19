<?php
    /* Config type - Photo */
    require_once LIBRARIES.'type/config-type-photo.php';
    require_once LIBRARIES.'type/config-type-news.php';

    /* Seo page */
    $config['seopage']['page'] = array(
   
    );
    $config['seopage']['width'] = 300;
    $config['seopage']['height'] = 200;
    $config['seopage']['thumb'] = '300x200x1';
    $config['seopage']['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

    /* Setting */
    $config['setting']['slogan'] = false;
    $config['setting']['diachi'] = false;
    $config['setting']['dienthoai'] = false;
    $config['setting']['hotline'] = false;
    $config['setting']['zalo'] = false;
    $config['setting']['oaidzalo'] = false;
    $config['setting']['email'] = false;
    $config['setting']['website'] = false;
    $config['setting']['fanpage'] = false;
    $config['setting']['messenger'] = false;
    $config['setting']['toado'] = false;
    $config['setting']['time_open'] = false;
    $config['setting']['coppyright'] = false;
    $config['setting']['toado_iframe'] = false;
    $config['setting']['paging_product'] = false;
    $config['setting']['paging_news'] = false;
    $config['setting']['paging_index'] = false;

    /* Quản lý import */
    $config['import']['images'] = false;
    $config['import']['thumb'] = '100x100x1';
    $config['import']['img_type'] = ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF";

    /* Quản lý export */
    $config['export']['category'] = false;

    /* Quản lý tài khoản */
    $config['user']['active'] = true;
    $config['user']['admin'] = false;
    $config['user']['visitor'] = true;

    /* Quản lý phân quyền */
    $config['permission'] = false;

    /* Quản lý giỏ hàng */
    $config['order']['active'] = false;
    $config['order']['search'] = false;
    $config['order']['excel'] = false;
    $config['order']['word'] = false;
    $config['order']['excelall'] = false;
    $config['order']['wordall'] = false;
    $config['order']['thumb'] = '100x100x1';

    /* Quản lý thông báo đẩy */
    $config['onesignal'] = false;
?>