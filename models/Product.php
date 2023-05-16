<?php

class Product
{
    const SHOW_BY_DEFAULT = 12;
    
    public static function getLatestProd($count=self::SHOW_BY_DEFAULT, $page=1)
    {
        $count = intval($count);
        $page= intval($page);
        $offset=($page-1)* self::SHOW_BY_DEFAULT;
        
        $db = Db::connect();
        $prodList = array();
        $result = $db->query('SELECT * FROM product '
                .'WHERE status=1 '
                .'ORDER BY id DESC ' 
                .'LIMIT '.$count
                .' OFFSET '.$offset);
        $i=0;
        while ($row=$result->fetch())
        {
            $prodList[$i]['id']=$row['id'];
            $prodList[$i]['name']=$row['name'];
            $prodList[$i]['image']=$row['image'];
            $prodList[$i]['price']=$row['price'];
            $prodList[$i]['code']=$row['code'];
            $prodList[$i]['isnew']=$row['isnew'];
            $i++;
        }
        return $prodList;
    }
    
     public static function getProdbyCat($category=false, $page=1)
    {      
         if ($category)
         {
             $page= intval($page);
             $offset=($page-1)* self::SHOW_BY_DEFAULT;
             
                $db = Db::connect();
                $prodList = array();
                $result = $db->query('SELECT * FROM product '
                        .'WHERE status=1 AND category_id="'.$category.'"'
                        .' ORDER BY id DESC ' 
                        .'LIMIT '.self::SHOW_BY_DEFAULT
                        .' OFFSET '.$offset);
                $i=0;
                while ($row=$result->fetch())
                {
                    $prodList[$i]['id']=$row['id'];
                    $prodList[$i]['name']=$row['name'];
                    $prodList[$i]['image']=$row['image'];
                    $prodList[$i]['price']=$row['price'];
                    $prodList[$i]['code']=$row['code'];
                    $prodList[$i]['isnew']=$row['isnew'];
                    $prodList[$i]['status']=$row['status'];
                    $i++;
                }
                return $prodList;
         }
    }
    
    public static function getProdbyID($id)
    {      
        $id= intval($id);
         if ($id)
         {
                $db = Db::connect();
                
                $result = $db->query('SELECT * FROM product WHERE id='.$id);
                $result->setFetchMode(PDO::FETCH_ASSOC);
                return $result->fetch();
         }
    }
    
     public static function getProdinCat($id)
    {      
         $db = Db::connect();
                
         $result = $db->query('SELECT count(id) AS cn FROM product WHERE status=1 AND category_id='.$id);
         $result->setFetchMode(PDO::FETCH_ASSOC);
         $row=$result->fetch();
         return $row['cn'];
         }
         
         public static function getTotalProd()
    {      
         $db = Db::connect();
                
         $result = $db->query('SELECT count(id) AS cn FROM product WHERE status=1');
         $result->setFetchMode(PDO::FETCH_ASSOC);
         $row=$result->fetch();
         return $row['cn'];
         }
         
    public static function getProdsInCart($idsArray)
    {
        $products = array();
        
        $db = Db::connect();
        
        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $prodList[$i]['code']=$row['code'];
            $i++;
        }

        return $products;
    }
    
    public static function getRecommendedProducts()
    {
        // Соединение с БД
        $db = Db::connect();
        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM product '
                . 'WHERE status = 1 AND isrec = 1 '
                . 'ORDER BY id DESC');
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['isnew'] = $row['isnew'];
            $productsList[$i]['status'] = $row['status'];
            $i++;
        }
        return $productsList;
    }
    
    public static function getProductsList()
    {
        // Соединение с БД
        $db = Db::connect();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM product ORDER BY id ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Удаляет товар с указанным id
     * @param integer $id <p>id товара</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteProductById($id)
    {
        // Соединение с БД
        $db = Db::connect();

        // Текст запроса к БД
        $sql = 'DELETE FROM product WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирует товар с заданным id
     * @param integer $id <p>id товара</p>
     * @param array $options <p>Массив с информацей о товаре</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateProductById($id, $options)
    {
        // Соединение с БД
        $db = Db::connect();

        // Текст запроса к БД
        $sql = "UPDATE product
            SET 
                name = :name, 
                price = :price,                
                category_id = :category_id, 
                brand = :brand, 
                availab = :availab, 
                decs = :decs, 
                isnew = :isnew, 
                isrec = :isrec, 
                status = :status,
                code = :code 
            WHERE id = :id";
        
                // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availab', $options['availab'], PDO::PARAM_INT);
        $result->bindParam(':decs', $options['decs'], PDO::PARAM_STR);
        $result->bindParam(':isnew', $options['isnew'], PDO::PARAM_INT);
        $result->bindParam(':isrec', $options['isrec'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        
        return $result->execute();
    }

    /**
     * Добавляет новый товар
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createProduct($options)
    {
        // Соединение с БД
        $db = Db::connect();

        // Текст запроса к БД
        $sql = 'INSERT INTO product '
                . '(name, price, category_id, brand, availab, '
                . 'decs, isnew, isrec, status, code) '
                . 'VALUES '
                . '(:name, :price, :category_id, :brand, :availab, '
                . ':decs, :isnew, :isrec, :status, :code)';

        foreach ($options as $op)
        {
            echo $op." ";
        }
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availab', $options['availab'], PDO::PARAM_INT);
        $result->bindParam(':decs', $options['decs'], PDO::PARAM_STR);
        $result->bindParam(':isnew', $options['isnew'], PDO::PARAM_INT);
        $result->bindParam(':isrec', $options['isrec'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    /**
     * Возвращает текстое пояснение наличия товара:<br/>
     * <i>0 - Под заказ, 1 - В наличии</i>
     * @param integer $availability <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */
    public static function getAvailabilityText($availability)
    {
        switch ($availability) {
            case '1':
                return 'В наличии';
                break;
            case '0':
                return 'Под заказ';
                break;
        }
    }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/products/';

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
    }
    
    


