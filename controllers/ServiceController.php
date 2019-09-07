<?php 

class ServiceController 
{
    public function actionIndex()
    {
        $services = Services::getServices();
    
        require_once ROOT . '/views/services/index.php';
        return true;
    }
}