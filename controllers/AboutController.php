<?php 

class AboutController 
{
    public function actionIndex()
    {
        $mixService = Services::getServices();
        $mixService['AllService'] = array_chunk($mixService['AllService'], 2);
        $workers = User::getWorksUser();

        require_once ROOT . '/views/about/index.php';
        return true;
    }
}