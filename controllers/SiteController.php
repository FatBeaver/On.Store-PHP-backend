<?php 

class SiteController 
{
    public function actionIndex()
    {
        $mixService = Services::getServices();
        $mixService['AllService'] = array_chunk($mixService['AllService'], 2);
        $portfolioPosts = Portfolio::getPortfolioPostsForHomePage();
        $workers = User::getWorksUser();
        $blogPosts = Blog::getBlogPostsForHomePage();

        require_once ROOT . '/views/site/index.php';
        return true;
    }
}