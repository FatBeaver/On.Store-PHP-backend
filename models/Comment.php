<?php 

class Comment 
{   
    // ============== START ADMIN METHODS -===============
    public static function adminGetAllComments()
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM comment";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $comments = [];
        for ($i = 0; $row = $result->fetch(); $i++) 
        {
            $comments[$i]['id'] = $row['id'];
            $comments[$i]['text'] = $row['text'];
            $comments[$i]['date'] = $row['date'];
            $comments[$i]['blog_id'] = $row['blog_id'];
            $comments[$i]['user_id'] = $row['user_id'];
            $comments[$i]['status'] = $row['status'];
        }

        return $comments;
    }

    public static function adminCommentStatusChange($id, $status)
    {
        $db = Db::getConnection();

        $sql = "UPDATE comment SET status = :status WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
    }

    public static function adminDeleteCommentById($id)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM comment WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result->execute()) {
            return true;
        }
        return false;
        
    }
    // ======= / END ADMIN METHODS =============


    public static function getCommentStatusById($id)
    {
        $db = Db::getConnection();

        $sql = "SELECT status FROM comment WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    public static function addCommentToBlogPost($comment, $first_name, $last_name, $blog_id)
    {
        $db = Db::getConnection();
        $sql = "INSERT INTO comment 
                (text, blog_id, first_name, last_name) 
                VALUES 
                (:text, :blog_id, :first_name, :last_name)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':text', $comment, PDO::PARAM_STR);
        $result->bindParam(':blog_id', $blog_id, PDO::PARAM_STR);
        $result->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $result->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $result->execute();
    }
}