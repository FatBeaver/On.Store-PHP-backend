<?php 

class AdminCategoryController extends AdminBase
{
    public function actionIndex()
    {   
        self::checkAdmin();
        $categories = Category::getAllCategory();

        require_once ROOT . '/views/admin/category_blog/index.php';
        return true;
    }

    public function actionCreate()
    {   
        self::checkAdmin();
        if (isset($_POST['submit'])) 
        {
            $category['title'] = $_POST['title'];
            $category['description'] = $_POST['description'];

            Category::createNewCategory($category);
            header('Location: /admin/category/');
        }

        require_once ROOT . '/views/admin/category_blog/create.php';
        return true;
    }

    public function actionUpdate($id)
    {   
        self::checkAdmin();
        $category = Category::getCategoryById($id);

        if (isset($_POST['submit']))
        {
            $category['title'] = $_POST['title'];
            $category['description'] = $_POST['description'];

            Category::updateCategory($category, $id);
            header('Location: /admin/category/');
        }

        require_once ROOT . '/views/admin/category_blog/update.php';
        return true;
    }

    public function actionDelete($id)
    {   
        self::checkAdmin();
        if (isset($_POST['submit']))
        {
            Category::deleteCategoryById($id);
            header('Location: /admin/category/');
        }

        require_once ROOT . '/views/admin/category_blog/delete.php';
        return true;
    }

}