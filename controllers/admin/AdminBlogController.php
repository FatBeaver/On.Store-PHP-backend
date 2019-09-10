<?php 

class AdminBlogController extends AdminBase
{
    public function actionIndex()
    {   
        self::checkAdmin();
        $posts = Blog::adminGetAllBlogPosts();

        require_once ROOT . '/views/admin/blog/index.php';
        return true;
    }

    public function actionCreate()
    {   
        self::checkAdmin();
        $categories = Blog::getAllCategories();

        if (isset($_POST['submit'])) {
            $post['title'] = $_POST['title'];
            $post['content'] = $_POST['content'];
            $post['user_id'] = 1;
            $post['description'] = $_POST['min_desc'];
            $post['categories'] = $_POST['categories'];
            $post['image'] = FileImages::addImages('blog');
           
            Blog::adminCreateBlogPost($post);

            header('Location: /admin/blog/');
        }

        require_once ROOT . '/views/admin/blog/create.php';
        return true;
    }

    public function actionDelete($id)
    {   
        self::checkAdmin();
        if (isset($_POST['submit'])) 
        {
            Blog::adminDeleteBlogPostById($id);
            
            header('Location: /admin/blog/');
        }

        require_once ROOT . '/views/admin/blog/delete.php';
        return true;
    }

    public function actionUpdate($id)
    {   
        self::checkAdmin();
        $post = Blog::getOneBlogPostById($id);
        $categories = Blog::getAllCategories();
            
        if (isset($_POST['submit']))
        {   
            $blogPost['title'] = $_POST['title'];
            $blogPost['description'] = $_POST['min_desc'];
            $blogPost['content'] = $_POST['content'];
            $blogPost['user_id'] = 1;
            $blogPost['categories'] = $_POST['categories'];
            $blogPost['image'] = FileImages::addImages('blog');

            Blog::adminUpdateBlogPost($blogPost, $id);
            
            header('Location: /admin/blog/');
        }

        require_once ROOT . '/views/admin/blog/update.php';
        return true;
    }
}