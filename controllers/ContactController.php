<?php 

class ContactController 
{
    public function actionIndex()
    {
        
        require_once ROOT . '/views/contact/index.php';
        return true;
    }
}