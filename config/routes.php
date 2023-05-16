<?php
return array(
    //товар
    'product/([0-9]+)' => 'product/view/$1', 
    //каталог
    'catalog/page-([0-9]+)'=>'catalog/index/$1',
    'catalog'=>'catalog/index',
    //категории
    'category/([0-9]+)/page-([0-9]+)'=>'catalog/category/$1/$2',
    'category/([0-9]+)'=>'catalog/category/$1',
    //корзина
    'cart/checkout' => 'cart/checkout',   
    'cart/delete/([0-9]+)' => 'cart/delete/$1',  
    'cart/add/([0-9]+)'=>'cart/add/$1',
    'cart/addAjax/([0-9]+)'=>'cart/addAjax/$1',
    'cart'=>'cart/index',
    //юзер
    'user/register'=>'user/register',
    'user/login'=>'user/login',
    'user/logout'=>'user/logout',
    //личный кабинет
    'cabinet/edit'=>'cabinet/edit',
    'cabinet'=>'cabinet/index',
    //контакты
    'contacts'=>'site/contacts',
    'about'=>'site/about',
    
    //админская часть
    // Управление товарами:    
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',
    // Управление категориями:    
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',
    // Управление заказами:    
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',
    //news
    'admin/news/create' => 'adminNews/create',
    'admin/news/edit/([0-9]+)' => 'adminNews/edit/$1',
    'admin/news/delete/([0-9]+)' => 'adminNews/delete/$1',
    'admin/news' => 'adminNews/index',
    // Админпанель:
    'admin' => 'admin/index',
    
    //новости ??
    'news/([0-9]+)' => 'news/view/$1', //actionView NewsController
    'news' => 'news/index', //actionIndex NewsController
    
    
    ''=>'site/index', //act index sitecontroller    
    
    );