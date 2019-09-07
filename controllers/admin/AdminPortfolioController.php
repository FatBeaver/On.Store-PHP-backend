<?php 

class AdminPortfolioController
{
    public function actionIndex()
    {
        $posts = Portfolio::adminGetAllPortfolioPost();

        require_once ROOT . '/views/admin/portfolio/index.php';
        return true;
    }

    public function actionCreate()
    {
        $categories = Blog::getAllCategories();
        if (isset($_POST['submit']))
        {
            $post['title'] = $_POST['title'];
            $post['content'] = $_POST['content'];
            $post['user_id'] = 1;
            $post['client'] = $_POST['client'];
            $post['web_site'] = $_POST['web_site'];
            $post['contacts'] = $_POST['contacts'];
            $post['description'] = $_POST['description'];
            $post['categories'] = $_POST['categories'];
            $post['image'] = FileImages::addImages('portfolio');
           
            @Portfolio::adminCreatePortfolioPost($post);
            header('Location: /admin/portfolio/');
        }

        require_once ROOT . '/views/admin/portfolio/create.php';
        return true;
    }

    public function actionUpdate($id)
    {
        $post = Portfolio::getOnePortfolioPostById($id);
        $categories = Blog::getAllCategories();
            
        if (isset($_POST['submit']))
        {   
            $blogPost['title'] = $_POST['title'];
            $blogPost['description'] = $_POST['description'];
            $blogPost['content'] = $_POST['content'];
            $blogPost['client'] = $_POST['client'];
            $blogPost['rating'] = $_POST['rating'];
            $blogPost['web_site'] = $_POST['web_site'];
            $blogPost['categories'] = $_POST['categories'];
            $blogPost['image'] = FileImages::addImages('portfolio');
            $blogPost['contacts'] = $_POST['contacts'];

            Portfolio::adminUpdatePortfolioPost($blogPost, $id);
            
            header('Location: /admin/portfolio/');
        }

        require_once ROOT . '/views/admin/portfolio/update.php';
        return true;
    }

    public function actionDelete($id)
    {
        if (isset($_POST['submit'])) 
        {
            Portfolio::adminDeletePortfolioPostById($id);
            
            header('Location: /admin/portfolio/');
        }


        require_once ROOT . '/views/admin/portfolio/delete.php';
        return true;
    }

}