<?php 

class Services 
{
    public static function getServices()
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM service ORDER BY id DESC LIMIT 2";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        for ($i = 0; $row = $result->fetch(); $i++)
        {
            $serviceList[$i]['id'] = $row['id'];
            $serviceList[$i]['title'] = $row['title'];
            $serviceList[$i]['description'] = $row['description'];
        }

        $sql = "SELECT * FROM service ORDER BY id DESC";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        for ($i = 0; $row = $result->fetch(); $i++)
        {
            $AllService[$i]['id'] = $row['id'];
            $AllService[$i]['title'] = $row['title']; 
            $AllService[$i]['description'] = $row['description']; 
        }
        
        $MixService = [
            'serviceList' => $serviceList,
            'AllService' => $AllService,
        ];

        return $MixService;
    }
}