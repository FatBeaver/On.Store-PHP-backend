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
        for ($i=0; $row = $result->fetch(); $i++) 
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
}