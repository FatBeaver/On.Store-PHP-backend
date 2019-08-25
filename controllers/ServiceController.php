<?php 

class ServiceController 
{
    public function actionIndex()
    {
        
        require_once ROOT . '/views/services/index.php';
        return true;
    }
}