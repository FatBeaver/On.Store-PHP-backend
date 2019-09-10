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
                . "b_p.viewed, b_p.date, b_p.image, u.first_name, u.last_name, u.id AS user_id "
                . "FROM blog_post AS b_p LEFT JOIN user AS u ON b_p.user_id = u.id";
        
        $result = $db->query($sql);
        $blogPosts = null;
        for ($i = 1; $row = $result->fetch(); $i++)
        {
            $blogPosts[$i]['id'] = $row['id'];
            $blogPosts[$i]['title'] = $row['title'];
            $blogPosts[$i]['description'] = $row['description'];
            $blogPosts[$i]['content'] = $row['content'];
            $blogPosts[$i]['viewed'] = $row['viewed'];
            $blogPosts[$i]['date'] = $row['date'];
            $blogPosts[$i]['image'] = $row['image'];
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
        $result->bindValue(':image', $post['image'], PDO::PARAM_STR);
        
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
        FileImages::deleteImageByID($id, 'blog_post', 'blog');

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
        $comments = Blog::getCommentsForBlogPost($id);
        
        $sql = "SELECT first_name, last_name FROM user WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $post['user_id'], PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $post['name'] = $result->fetch(0); 

        $postData = [
            'post' => $post,
            'categories' => $categories
        ];
        
        return $postData;
    }

    public static function getAdjoiningPosts($id)
    {
        $db = Db::getConnection();
        $sql = "(SELECT id, title FROM blog_post WHERE id > :id LIMIT 1) 
                UNION 
                (SELECT id, title FROM blog_post WHERE id < :id LIMIT 1 ) 
                ORDER BY id ASC";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        for ($i = 0; $row = $result->fetch(); $i++)
        {
            $posts[$i]['id'] = $row['id'];
            $posts[$i]['title'] = $row['title'];
        }
        return $posts;
    }

    public static function getCommentsForBlogPost($id)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM comment WHERE blog_id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $comments = null;
        for($i = 0; $row = $result->fetch(); $i++)
        {
            $comments[$i]['id'] = $row['id'];
            $comments[$i]['text'] = $row['text'];
            $comments[$i]['date'] = $row['date'];
            $comments[$i]['first_name'] = $row['first_name'];
            $comments[$i]['last_name'] = $row['last_name'];      
        }
      
        return $comments;
    }
    /**
     * Изменяет данные поста в таблице blog_post и в таблице blog_to_category
     * 
     * @return void 
     */
    public static function adminUpdateBlogPost($post, $id)
    {
        $db = Db::getConnection();
        FileImages::deleteImageByID($id, 'blog_post', 'blog');

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

    public static function getBlogPostsForHomePage()
    {
        $db = Db::getConnection();
        $sql = "SELECT b_p.id, b_p.title, b_p.description, b_p.content, "
                    . "b_p.viewed, b_p.date, b_p.image, u.first_name, u.last_name, u.id AS user_id "
                    . "FROM blog_post AS b_p LEFT JOIN user AS u ON b_p.user_id = u.id 
                    ORDER BY id DESC LIMIT 4";

        $result = $db->query($sql);
        for($i = 0; $row = $result->fetch(); $i++)
        {
            $posts[$i]['id'] = $row['id'];
            $posts[$i]['title'] = $row['title'];
            $posts[$i]['description'] = $row['description'];
            $posts[$i]['date'] = $row['date'];
            $posts[$i]['first_name'] = $row['first_name'];
            $posts[$i]['last_name'] = $row['last_name'];
            $posts[$i]['image'] = $row['image'];
        }
        return $posts;
    }


    public static function getTotalBlogPost()
    {
        $db = Db::getConnection();

        $sql = "SELECT COUNT(*) AS count FROM blog_post";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    public static function getPostForBlogPage($limit = 10, $offset)
    {
        $db = Db::getConnection();

        $sql = "SELECT b_p.*, u.first_name, u.last_name, u.id AS user_id 
                FROM blog_post AS b_p LEFT JOIN user AS u ON b_p.user_id = u.id 
                ORDER BY id DESC LIMIT $limit OFFSET $offset";
        
        $result = $db->query($sql);
        $blogPosts = null;
        for ($i = 1; $row = $result->fetch(); $i++)
        {
            $blogPosts[$i]['id'] = $row['id'];
            $blogPosts[$i]['title'] = $row['title'];
            $blogPosts[$i]['description'] = $row['description'];
            $blogPosts[$i]['content'] = $row['content'];
            $blogPosts[$i]['viewed'] = $row['viewed'];
            $blogPosts[$i]['date'] = $row['date'];
            $blogPosts[$i]['image'] = $row['image'];
            $blogPosts[$i]['first_name'] = $row['first_name'];
            $blogPosts[$i]['last_name'] = $row['last_name'];
            $blogPosts[$i]['user_id'] = $row['user_id'];
            $blogPosts[$i]['category'] = Blog::getCategoriesForBlogPost($row['id']);
            $blogPosts[$i]['comments'] = count(Blog::getCommentsForBlogPost($row['id']));
        }
        return $blogPosts;
    }

    public static function getPopularPosts()
    {
        $db = Db::getConnection();
        $sql = "SELECT id, title, date, image FROM blog_post ORDER BY viewed DESC LIMIT 4";

        $dateNow = new DateTime('now');
        

        $result = $db->query($sql);
        for($i = 0; $row = $result->fetch(); $i++)
        {   
            $dateCreate = new DateTime($row['date']);
            $dateInterval = $dateCreate->diff($dateNow);
            if ($dateInterval->h == 0 ) {
                $dateInterval = 'Менее часа назад';
            } else if ($dateInterval->h == 1) {
                $dateInterval = "Час назад";
            } elseif ($dateInterval->h == 2 
            || $dateInterval->h == 3 || $dateInterval->h == 4 ) {
                $dateInterval = $dateInterval->h . " часа назад";
            } else {
                $dateInterval = $dateInterval->h . " часов назад";
            }
            $posts[$i]['id'] = $row['id'];
            $posts[$i]['title'] = $row['title'];
            $posts[$i]['date'] = $dateInterval;
            $posts[$i]['image'] = $row['image'];
            
        }

        return $posts;
    }

    public static function getCategoriesWithCountPosts()
    {
        $db = Db::getConnection();
        $sql = "SELECT blog_category.id, blog_category.title, COUNT(blog_to_category.blog_id) AS post_count 
                FROM blog_category
                INNER JOIN blog_to_category ON blog_category.id = blog_to_category.category_id 
                GROUP BY blog_category.title, blog_category.id";

        $result = $db->query($sql);
        for($i = 0; $row = $result->fetch(); $i++)
        {
            $countsPostsForCategory[$i]['id'] = $row['id'];
            $countsPostsForCategory[$i]['title'] = $row['title'];
            $countsPostsForCategory[$i]['post_count'] = $row['post_count'];
        }

        return $countsPostsForCategory;
    }


    public static function getTotalBlogPostForCategory($id)
    {
        $db = Db::getConnection();
        $sql = "SELECT COUNT(*) AS post_count FROM blog_to_category WHERE category_id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }

    public static function getPostsForCetegoryById($id, $limit, $offset)
    {
        $db = Db::getConnection();
        $sql = "SELECT blog_post.*, user.first_name, user.last_name
                FROM user
                JOIN blog_post ON blog_post.user_id = user.id
                JOIN blog_to_category ON blog_to_category.blog_id = blog_post.id
                WHERE blog_to_category.category_id = :id LIMIT :limit OFFSET :offset";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        $blogPosts = null;
        for ($i = 1; $row = $result->fetch(); $i++)
        {
            $blogPosts[$i]['id'] = $row['id'];
            $blogPosts[$i]['title'] = $row['title'];
            $blogPosts[$i]['description'] = $row['description'];
            $blogPosts[$i]['content'] = $row['content'];
            $blogPosts[$i]['viewed'] = $row['viewed'];
            $blogPosts[$i]['date'] = $row['date'];
            $blogPosts[$i]['image'] = $row['image'];
            $blogPosts[$i]['first_name'] = $row['first_name'];
            $blogPosts[$i]['last_name'] = $row['last_name'];
            $blogPosts[$i]['user_id'] = $row['user_id'];
            $blogPosts[$i]['category'] = Blog::getCategoriesForBlogPost($row['id']);
        }    
        return $blogPosts;
    }


    public static function getPostForBlogPageByQuerySearch($limit, $offset, $query)
    {
        $db = Db::getConnection();
        $sql = "SELECT b_p.*, u.first_name, u.last_name, u.id AS user_id 
                FROM blog_post AS b_p LEFT JOIN user AS u ON b_p.user_id = u.id 
                WHERE b_p.title LIKE '%$query%' OR b_p.description LIKE '%$query%' OR b_p.content LIKE '%$query%' 
                ORDER BY id DESC LIMIT $limit OFFSET $offset ";
               
        
        $result = $db->query($sql);

        $blogPosts = null;
        for ($i = 1; $row = $result->fetch(); $i++)
        {
            $blogPosts[$i]['id'] = $row['id'];
            $blogPosts[$i]['title'] = $row['title'];
            $blogPosts[$i]['description'] = $row['description'];
            $blogPosts[$i]['content'] = $row['content'];
            $blogPosts[$i]['viewed'] = $row['viewed'];
            $blogPosts[$i]['date'] = $row['date'];
            $blogPosts[$i]['image'] = $row['image'];
            $blogPosts[$i]['first_name'] = $row['first_name'];
            $blogPosts[$i]['last_name'] = $row['last_name'];
            $blogPosts[$i]['user_id'] = $row['user_id'];
            $blogPosts[$i]['category'] = Blog::getCategoriesForBlogPost($row['id']);
        }
       
        return $blogPosts;
    }


    public static function getTotalBlogPostByQuerySearch(string $query)
    {   
        $query = trim($query);
        $db = Db::getConnection();
        $sql = "SELECT COUNT(*) AS post_count 
                FROM blog_post
                WHERE title LIKE '%$query%' OR description LIKE '%$query%' OR content LIKE '%$query%' ";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
    
        return $result->fetch();
    }


    public static function addViewedForBlogPost($id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE blog_post 
                SET viewed = viewed + 1 
                WHERE id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

}