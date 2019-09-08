<?php 

return [
    // Навигация по сайту
    'contact' => 'contact/index',
    'blogpost/page-([0-9]+)' => 'blog/index/$1',
    'blogpost/category-([0-9]+)/page-([0-9]+)' => 'blog/categoryPosts/$1/$2',
    'blogpost/category-([0-9]+)' => 'blog/categoryPosts/$1',
    'blogpost/search/page-([0-9]+)' => 'blog/search/$1',
    'blogpost/search' => 'blog/search',
    'blogpost' => 'blog/index',
    'blogpost/views/([0-9]+)' => 'blog/view/$1',
    'portfoliopost' => 'portfolio/index',
    'portfoliopost/view/([0-9]+)' => 'portfolio/view/$1',
    'service' => 'service/index',
    'about' => 'about/index', 

    //Aдмин панель
    'admin' => 'admin/index',
    // Aдмин панель управления пользователями
    'admin/user/page-([0-9]+)' => 'adminUser/index/$1',
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