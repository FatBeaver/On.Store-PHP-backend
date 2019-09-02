<?php 

class Blog 
{   
    /**
     * Возвращает массив записей постов блога с их категориями и именами авторов;
     * 
     * @return array 
     */
    public static function adminGetAllBlogPosts()
    {
        $db = Db::getConnection();

        $sql = "SELECT b_p.id, b_p.title, b_p.description, b_p.content, "
                . "b_p.viewed, b_p.date, u.first_name, u.last_name, u.id AS user_id "
                . "FROM blog_post AS b_p LEFT JOIN user AS u ON b_p.user_id = u.id";
        
        $result = $db->query($sql);
    
        for ($i = 1; $row = $result->fetch(); $i++)
        {
            $blogPosts[$i]['id'] = $row['id'];
            $blogPosts[$i]['title'] = $row['title'];
            $blogPosts[$i]['description'] = $row['description'];
            $blogPosts[$i]['content'] = $row['content'];
            $blogPosts[$i]['viewed'] = $row['viewed'];
            $blogPosts[$i]['date'] = $row['date'];
            $blogPosts[$i]['first_name'] = $row['first_name'];
            $blogPosts[$i]['last_name'] = $row['last_name'];
            $blogPosts[$i]['user_id'] = $row['user_id'];
            $blogPosts[$i]['category'] = Blog::getCategoriesForBlogPost($row['id']);
        }
        
        return $blogPosts;
    }

    /**
     * Возвращает все категории для выбранного блога
     * 
     * @return array
     */
    public static function getCategoriesForBlogPost($id)
    {
        $db = Db::getConnection();

        $sql = "SELECT blog_post.id, blog_category.title FROM blog_category 
                JOIN blog_to_category
                ON blog_to_category.category_id = blog_category.id 
                JOIN blog_post 
                ON blog_post.id = blog_to_category.blog_id WHERE blog_post.id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        if ($result->execute() === true) { 
            for ($i = 0; $row = $result->fetch(); $i++)
            {
                $categories[$i] = $row['title'];
            }
            return $categories;
        } 
        return null;
    }

    /**
     * Возвращает все имеющие категории в бд
     * 
     * @return array
     */
    public static function getAllCategories() 
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM blog_category";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        for ($i = 0; $row = $result->fetch(); $i++)
        {
            $categories[$i]['id'] = $row['id'];
            $categories[$i]['title'] = $row['title'];
        }
    
        return $categories;   
    }

    /**
     * Создает запись блога добавляя так же данные в таблицы категорий
     * 
     * @return void
     */
    public static function adminCreateBlogPost($post)
    {
        $db = Db::getConnection();

        $sql = "INSERT INTO blog_post
                (title, description, content, user_id, viewed,  image) 
                VALUES 
                (:title, :description, :content, :user_id, :viewed, :image)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':title', $post['title'], PDO::PARAM_STR);
        $result->bindParam(':description', $post['description'], PDO::PARAM_STR);
        $result->bindParam(':content', $post['content'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $post['user_id'], PDO::PARAM_INT);
        $result->bindValue(':viewed', 0, PDO::PARAM_INT);
       // $result->bindValue(':date', date('NOW()'), PDO::PARAM_STR);
        $result->bindParam(':image', $post['image']);
        
        if ($result->execute()) {
            $id = $db->lastInsertId();
        } else {
            exit ('Ошибка, возможно вы не заполнили одно из полей');
        }

        foreach ($post['categories'] as $categoryID) 
        {
            $sql = "INSERT INTO blog_to_category 
                    (blog_id, category_id) 
                    VALUES 
                    (:blog_id, :category_id)";

            $result = $db->prepare($sql);
            $result->bindParam(':blog_id', $id, PDO::PARAM_INT);
            $result->bindParam(':category_id', $categoryID, PDO::PARAM_INT);
            $result->execute();
        }      
    }

    /**
     * Удаляет запись блога и так же подчищает таблицу связующую посты блога с категориями
     * 
     * @return void
     */
    public static function adminDeleteBlogPostById($id)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM blog_post WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $sql = "DELETE FROM blog_to_category WHERE blog_id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }


    public static function getOneBlogPostById($id) 
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM blog_post WHERE id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        $post = $result->fetch();
        $categories = Blog::getCategoriesForBlogPost($id);
        
        $postData = [
            'post' => $post,
            'categories' => $categories
        ];
    
        return $postData;
    }

    /**
     * Изменяет данные поста в таблице blog_post и в таблице blog_to_category
     * 
     * @return void 
     */
    public static function adminUpdateBlogPost($post, $id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE blog_post
                SET 
                title = :title, 
                description = :description, 
                content = :content, 
                user_id = :user_id, 
                image = :image
                WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':title', $post['title'], PDO::PARAM_STR);
        $result->bindParam(':description', $post['description'], PDO::PARAM_STR);
        $result->bindParam(':content', $post['content'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $post['user_id'], PDO::PARAM_INT);
        $result->bindParam(':image', $post['image'], PDO::PARAM_STR);
        $result->execute();

        Blog::geleteForeignKeysOfBlogToCategotyTable($id);
        Blog::addForeignKeysOfBlogToCategoryTable($post['categories'], $id);
    }

    public static function geleteForeignKeysOfBlogToCategotyTable($id)
    {   
        $db = Db::getConnection();
        $sql = "DELETE FROM blog_to_category WHERE blog_id = :id";

        $result =  $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function addForeignKeysOfBlogToCategoryTable($categories, $id)
    {
        
        $db = Db::getConnection();
        foreach ($categories as $category) 
        {   
            $sql = "INSERT INTO blog_to_category 
                    (blog_id, category_id) 
                    VALUES 
                    (:blog_id, :category_id)";

            $result = $db->prepare($sql);
            $result->bindParam(':blog_id', $id, PDO::PARAM_INT);
            $result->bindParam(':category_id', $category, PDO::PARAM_INT);
            $result->execute();
        }  
    }

}