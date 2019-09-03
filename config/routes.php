<?php 

return [
    // Навигация по сайту
    'contact' => 'contact/index',
    'blogpost' => 'blog/index',
    'portfoliopost' => 'portfolio/index',
    'service' => 'service/index',
    'about' => 'about/index', 

    //Aдмин панель
    'admin' => 'admin/index',
    // Aдмин панель управления пользователями
    'admin/user' => 'adminUser/index',
    'admin/user/create' => 'adminUser/create',
    'admin/user/update/([0-9]+)' => 'adminUser/update/$1',
    'admin/user/delete/([0-9]+)' => 'adminUser/delete/$1',
    // Админ панель управления комментариями
    'admin/comment' => 'adminComment/index',
    'admin/comment/statusChange/([0-9]+)' => 'adminComment/statusChange/$1',
    'admin/comment/delete/([0-9]+)' => 'adminComment/delete/$1',
    // Aдмин панель управления постами блога
    'admin/blog' => 'adminBlog/index',
    'admin/blog/delete/([0-9]+)' => 'adminBlog/delete/$1',
    'admin/blog/create' => 'adminBlog/create',
    'admin/blog/update/([0-9]+)' => 'adminBlog/update/$1',
    // Админ панель управления постами портфолио
    'admin/portfolio' => 'adminPortfolio/index',
    'admin/portfolio/create' => 'adminPortfolio/create',
    'admin/portfolio/delete/([0-9]+)' => 'adminPortfolio/delete/$1',
    'admin/portfolio/update/([0-9]+)' => 'adminPortfolio/update/$1',
    // Aдмин панель управления категориями постов
    'admin/category' => 'adminCategory/index',
    'admin/category/create' => 'adminCategory/create',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    
    // Запрос по умолчанию
    '' => 'site/index',  
];