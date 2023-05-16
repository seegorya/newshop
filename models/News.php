<?php
class News
{
    //выводит одну новость по айди
    public static function getNewsById($id)
    {
        $id= intval($id);
        
        if ($id)
        {
        $db= Db::connect();
        $result=$db->query('SELECT * FROM news WHERE id='.$id);
        
        $newsItem=$result->fetch(PDO::FETCH_ASSOC);
        return $newsItem;            
        }
    }
    
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/news/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }
    
    //выводит список новостей
    public static function getNewsList()
    {
        $db= Db::connect();
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
    
    public static function createNews($options)
    {
        // Соединение с БД
        $db = Db::connect();

        // Текст запроса к БД
        $sql = 'INSERT INTO news '
                . '(title, preview, content) '
                . 'VALUES '
                . '(:title, :preview, :content)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':preview', $options['preview'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_STR);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }
    
    public static function updateNewsById($id, $options)
    {
        // Соединение с БД
        $db = Db::connect();

        // Текст запроса к БД
        $sql = "UPDATE news
            SET 
                title = :title, 
                preview = :preview,                
                content = :content
            WHERE id = :id";
        
                // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':preview', $options['preview'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_STR);
        
        return $result->execute();
    }
    
     public static function deleteNewsById($id)
    {
        // Соединение с БД
        $db = Db::connect();

        // Текст запроса к БД
        $sql = 'DELETE FROM news WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}

