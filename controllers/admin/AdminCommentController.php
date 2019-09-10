<?php 

class AdminCommentController extends AdminBase
{
    public function actionIndex()
    {   
        self::checkAdmin();
        $comments = Comment::adminGetAllComments();

        require_once ROOT . '/views/admin/comments/index.php';
        return true;
    }

    public function actionStatusChange($id)
    {   
        self::checkAdmin();
        $comment = Comment::getCommentStatusById($id);

        if ($comment['status'] == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        Comment::adminCommentStatusChange($id, $status);
    
        header('Location: /admin/comment/');
        return true;
    }

    public function actionDelete($id) 
    {   
        self::checkAdmin();
        if (isset($_POST['submit'])) {
            if (Comment::adminDeleteCommentById($id)) {
                header('Location: /admin/comment/');
            }
        }
        require_once ROOT . '/views/admin/comment/delete.php';
        return true;
    }
}