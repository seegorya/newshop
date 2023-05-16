<?php
class News
{
    //выводит одну новость по айди
    public static function getNewsById($id)
    {
        $id= intval($id);
        
        if ($id)
        {
             $host='localhost';
        $dbname='stpr';
        $user='root';
        $password='';
        $db=new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        
        $result=$db->query('SELECT * FROM news WHERE id='.$id);
        
        $newsItem=$result->fetch();
        return $newsItem;            
        }
    }
    //выводит список новостей
    public static function getNewsList()
    {
        $host='localhost';
        $dbname='stpr';
        $user='root';
        $password='';
        $db=new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $newsList=array();
        
        $result = $db->query('SELECT id, title, date, preview '
                .'FROM news '
                .'ORDER BY date DESC '
                .'LIMIT 10');

        $i=0;
        while ($row=$result->fetch())
        {
            $newsList[$i]['id']=$row['id'];
            $newsList[$i]['title']=$row['title'];
            $newsList[$i]['date']=$row['date'];
            $newsList[$i]['preview']=$row['preview'];
            $i++;
        }
        return $newsList;
    }
}

