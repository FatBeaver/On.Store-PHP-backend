<?php 

class PortfolioController 
{
    public function actionIndex()
    {
        $portfolioPosts = Portfolio::adminGetAllPortfolioPost();

        require_once ROOT . '/views/portfolio/index.php';
        return true;
    }

    public function actionView($id)
    {
        $post = Portfolio::getOnePortfolioPostById($id);
        
        require_once ROOT . '/views/portfolio/view.php';
        return true;
    }
}