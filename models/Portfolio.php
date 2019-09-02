<?php 

class Portfolio 
{   
    // ============ ADMIN SECTION START =================
    /**
     * Возвращает все записи таблицы портфолио с их категориями
     * 
     * @return array
     */
    public static function adminGetAllPortfolioPost()
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM portfolio_post";
        
        $result = $db->query($sql);
        for ($i = 0; $row = $result->fetch(); $i++)
        {
            $post[$i]['id'] = $row['id'];
            $post[$i]['title'] = $row['title'];
            $post[$i]['description'] = $row['description'];
            $post[$i]['content'] = $row['content'];
            $post[$i]['rating'] = $row['rating'];
            $post[$i]['client'] = $row['client'];
            $post[$i]['website'] = $row['website'];
            $post[$i]['date'] = $row['date'];
            $post[$i]['contacts'] = $row['contacts'];
            $post[$i]['categories'] = Portfolio::getCategoriesForPortfolioPost($row['id']);
            $post[$i]['image'] = $row['image'];
        }

        return $post;
    }


    public static function adminCreatePortfolioPost($post)
    {
        $db = Db::getConnection();
        $sql = "INSERT INTO portfolio_post
                (title, description, content, rating, client, website, contacts, image) 
                VALUES 
                (:title, :description, :content, :rating, :client, :website, :contacts, :image)";

        $result = $db->prepare($sql);
        $result->bindParam(':title', $post['title'], PDO::PARAM_STR);
        $result->bindParam(':description', $post['description'], PDO::PARAM_STR);
        $result->bindParam(':content', $post['content'], PDO::PARAM_STR);
        $result->bindParam(':rating', $post['rating']);
        $result->bindParam(':client', $post['client'], PDO::PARAM_STR);
        $result->bindParam(':website', $post['web_site'], PDO::PARAM_STR);
        $result->bindParam(':contacts', $post['contacts'], PDO::PARAM_STR);
        $result->bindParam(':image', $post['image'], PDO::PARAM_STR);
        if ($result->execute()) {
            $id = $db->lastInsertId();
        } else {
            exit ('Ошибка, возможно вы не заполнили одно из полей');
        }

        foreach ($post['categories'] as $categoryID) 
        {
            $sql = "INSERT INTO portfolio_to_category 
                    (portfolio_id, category_id) 
                    VALUES 
                    (:portfolio_id, :category_id)";

            $result = $db->prepare($sql);
            $result->bindParam(':portfolio_id', $id, PDO::PARAM_INT);
            $result->bindParam(':category_id', $categoryID, PDO::PARAM_INT);
            $result->execute();
        }
    }


    public static function adminUpdatePortfolioPost($blogPost, $id)
    {  
        $db = Db::getConnection();
        $sql = "UPDATE portfolio_post 
                SET 
                title = :title, description = :description, content = :content, 
                client = :client, rating = :rating, website = :website, 
                image = :image, contacts = :contacts";
        
        $result = $db->prepare($sql);
        $result->bindParam(':title', $blogPost['title'], PDO::PARAM_STR);
        $result->bindParam(':description', $blogPost['description'], PDO::PARAM_STR);
        $result->bindParam(':content', $blogPost['content'], PDO::PARAM_STR);
        $result->bindParam(':client', $blogPost['client'], PDO::PARAM_STR);
        $result->bindParam(':rating', $blogPost['rating']);
        $result->bindParam(':website', $blogPost['web_site'], PDO::PARAM_STR);
        $result->bindParam(':image', $blogPost['image'], PDO::PARAM_STR);
        $result->bindParam(':contacts', $blogPost['contacts'], PDO::PARAM_STR);
        $result->execute();
        
        Portfolio::geleteForeignKeysOfPortfolioToCategotyTable($id);
        Portfolio::addForeignKeysOfPortfolioToCategoryTable($blogPost['categories'], $id);
    }
    // =========== ADMIN SECTION END ============


    public static function geleteForeignKeysOfPortfolioToCategotyTable($id)
    {   
        $db = Db::getConnection();
        $sql = "DELETE FROM portfolio_to_category WHERE portfolio_id = :id";

        $result =  $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }


    public static function addForeignKeysOfPortfolioToCategoryTable($categories, $id)
    {
        $db = Db::getConnection();
        foreach ($categories as $category) 
        {   
            $sql = "INSERT INTO portfolio_to_category 
                    (portfolio_id, category_id) 
                    VALUES 
                    (:portfolio_id, :category_id)";

            $result = $db->prepare($sql);
            $result->bindParam(':portfolio_id', $id, PDO::PARAM_INT);
            $result->bindParam(':category_id', $category, PDO::PARAM_INT);
            $result->execute();
        }  
    }

    /**
     * Возвращает данные одного поста портфолио по ID
     * 
     * @return array
     */
    public static function getOnePortfolioPostById($id) 
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM portfolio_post WHERE id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        
        $post = $result->fetch();
        $categories = Portfolio::getCategoriesForPortfolioPost($id);
        
        $postData = [
            'post' => $post,
            'categories' => $categories
        ];
    
        return $postData;
    }

    /**
     * Возвращает все категории для выбранного поста портфолио
     * 
     * @return array
     */
    public static function getCategoriesForPortfolioPost($id)
    {
        $db = Db::getConnection();

        $sql = "SELECT portfolio_post.id, blog_category.title FROM blog_category 
                JOIN portfolio_to_category
                ON portfolio_to_category.category_id = blog_category.id 
                JOIN portfolio_post 
                ON portfolio_post.id = portfolio_to_category.portfolio_id 
                WHERE portfolio_post.id = :id";
        
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

}