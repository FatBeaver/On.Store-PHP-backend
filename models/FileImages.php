<?php 

class FileImages
{
    public $image;

    public static function addImages($localPath)
    {   
        $fileName = rand(1, 10000) . $_FILES['image']['name'];
        $uploadFilePath = ROOT . '/uploads/images/' . $localPath . '/' . $fileName;
        
        $badExtensions = ['.php', '.phtml', '.php3', '.php4', '.html', '.htm'];
        foreach ($badExtensions as $extension) 
        {
            if (preg_match("/$extension$/", $_FILES['image']['name'])) exit('Ошибка. Некорректное расширение файла');
        }

        if (($_FILES['image']['error'] == 0) && ($_FILES['image']['size'] < 1024 * 1000 * 1000 * 10)) 
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath);
            return (string) $fileName;
        } 

        return false;
    }

    public static function deleteImages($localPath, $fileName)
    {   
        $pathToImage = ROOT . '/uploads/images/' . $localPath . '/' . (string) $fileName;
        @unlink($pathToImage);
    }

    public static function getImage($localPath, $fileName)
    {
        return '/uploads/images/' . $localPath . '/' . $fileName;
    }

    public static function deleteImageByID($id, $tableName, $localPath)
    {   
        $db = Db::getConnection();

        $sql = "SELECT image FROM $tableName WHERE id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fileName = $result->fetch();
        if (!empty($_FILES['image']['name'])) {
            FileImages::deleteImages($localPath, $fileName['image']);
        }
        
    }
    
}