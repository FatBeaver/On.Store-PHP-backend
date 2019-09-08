<?php 

class BlogController 
{
    public function actionIndex($page = 1)
    {   
        $limit = 4;
        $offset = ($page - 1) * $limit;
        $total = Blog::getTotalBlogPost();
        if ($limit < $total) {
            $pagination = new Pagination($total['count'], $limit, $page, 'blogpost');
        }

        $blogPosts = Blog::getPostForBlogPage($limit, $offset);

        $popularPosts = Blog::getPopularPosts();
        $categoryCountPosts = Blog::getCategoriesWithCountPosts();
      
        require_once ROOT . '/views/blog/index.php';
        return true;
    }


    public function actionView($id)
    {
        $post = Blog::getOneBlogPostById($id);
        $popularPosts = Blog::getPopularPosts();
        $categoryCountPosts = Blog::getCategoriesWithCountPosts();

        require_once ROOT . '/views/blog/view.php';
        return true;
    }


    public function actionCategoryPosts($id, $page = 1)
    {
        $limit = 4;
        $offset = ($page - 1) * $limit;
        $total = Blog::getTotalBlogPostForCategory($id);
        $index = 'blogpost/category-' . $id;
        if ($limit < $total) {
            $pagination = new Pagination($total['post_count'], $limit, $page, $index);
        }

        $blogPosts = Blog::getPostsForCetegoryById($id, $limit, $offset);

        $popularPosts = Blog::getPopularPosts();
        $categoryCountPosts = Blog::getCategoriesWithCountPosts();
      
        require_once ROOT . '/views/blog/index.php';
        return true;
    }


    public static function actionSearch($page = 1)
    {
        if (empty($_POST['query'])) {
            header('Location: /blogpost/');
        }
        $query = $_POST['query'];
        $limit = 4;
        $offset = ($page - 1) * $limit;
        $total = Blog::getTotalBlogPostByQuerySearch($query);
        $index = 'blogpost/search/' . $query;
        if ($limit < $total) {
            $pagination = new Pagination($total['post_count'], $limit, $page, $index);
        }

        $blogPosts = Blog::getPostForBlogPageByQuerySearch($limit, $offset, $query);

        $popularPosts = Blog::getPopularPosts();
        $categoryCountPosts = Blog::getCategoriesWithCountPosts();
      
        require_once ROOT . '/views/blog/index.php';
        return true;
    }
}