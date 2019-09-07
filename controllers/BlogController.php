<?php 

class BlogController 
{
    public function actionIndex($page = 1)
    {   
        $limit = 6;
        $offset = ($page - 1) * $limit;
        $total = Blog::getTotalBlogPost();

        $pagination = new Pagination($total['count'], $limit, $page, 'blogpost');
        $blogPosts = Blog::getPostForBlogPage($limit, $offset);

        require_once ROOT . '/views/blog/index.php';
        return true;
    }

    public function actionView($id)
    {
        $post = Portfolio::getOnePortfolioPostById($id);
        
        require_once ROOT . '/views/portfolio/view.php';
        return true;
    }
}