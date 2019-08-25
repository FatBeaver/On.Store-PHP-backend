<?php 

class BlogController 
{
    public function actionIndex()
    {
        
        require_once ROOT . '/views/blog/index.php';
        return true;
    }
}