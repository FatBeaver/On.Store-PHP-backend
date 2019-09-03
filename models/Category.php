<?php 

class Category
{
    public static function getAllCategory()
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM blog_category";

        $result = $db->query($sql);
        for ($i = 0; $row = $result->fetch(); $i++)
        {
            $caregories[$i]['id'] = $row['id'];
            $caregories[$i]['title'] = $row['title'];
            $caregories[$i]['description'] = $row['description'];
        }

        return $caregories;
    }

    public static function createNewCategory($categories)
    {
        $db = Db::getConnection();
        $sql = "INSERT INTO blog_category 
                (title, description) 
                VALUES 
                (:title, :description)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':title', $categories['title'], PDO::PARAM_STR);
        $result->bindParam(':description', $categories['description'], PDO::PARAM_STR);
        $result->execute();
    }

    public static function updateCategory($category, $id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE blog_category 
                SET 
                title = :title, description = :description 
                WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':title', $category['title'], PDO::PARAM_STR);
        $result->bindParam(':description', $category['description'], PDO::PARAM_STR);
        $result->execute();
    }

    public static function deleteCategoryById($id)
    {
        $db = Db::getConnection();
        $sql = "DELETE blog_category, portfolio_to_category FROM blog_category 
        JOIN portfolio_to_category ON blog_category.id = portfolio_to_category.category_id
        WHERE blog_category.id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function getCategoryById($id)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM blog_category, portfolio_t WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();

        return $result->fetch();
    }
}