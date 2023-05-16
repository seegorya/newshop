<?php

class cartController
{
    public function actionAdd($id)
    {
        // Добавляем товар в корзину
        Cart::addProd($id);

        // Возвращаем пользователя на страницу
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");        
    }
    
    public function actionAddAjax($id)
    {
        echo '('.Cart::addProd($id).')';
        return true;
    }
    
    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoryList();

        // Получим данные из корзины
        $productsInCart = Cart::getProducts();

        if ($productsInCart) {
            // Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProdsInCart($productsIds);

            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once(ROOT . '/views/cart/index.php');

        return true;
    }
    
    public function actionDelete($id)
    {
        Cart::deleteProduct($id);
        header("Location: /cart/");
    }

    public function actionCheckout()
    {
       // Получием данные из корзины      
        $productsInCart = Cart::getProducts();
        // Если товаров нет, отправляем пользователи искать товары на главную
        if ($productsInCart == false) {
            header("Location: /");
        }
        // Список категорий для левого меню
        $categories = Category::getCategoryList();
        // Находим общую стоимость
        $productsIds = array_keys($productsInCart);
        $products = Product::getProdsInCart($productsIds);
        $totalPrice = Cart::getTotalPrice($products);
        // Количество товаров
        $totalQuantity = Cart::countItems();
        // Поля для формы
        $userName = false;
        $userPhone = false;
        $userComment = false;
        // Статус успешного оформления заказа
        $result = false;
        // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {
            // Если пользователь не гость
            // Получаем информацию о пользователе из БД
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['name'];
        } else {
            // Если гость, поля формы останутся пустыми
            $userId = false;
        }
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            // Флаг ошибок
            $errors = false;
            // Валидация полей
            if (!User::checkName($userName)) {
                $errors[] = 'Неправильное имя';
            }
            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Неправильный телефон';
            }
            if ($errors == false) {
                // Если ошибок нет
                // Сохраняем заказ в базе данных
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);
                if ($result) {
                    // Если заказ успешно сохранен
                    // Оповещаем администратора о новом заказе по почте                
                    $adminEmail = 'nearokosmo@gmail.com';
                    $message = 'Список заказов: https://smoothened-sleds.000webhostapp.com/admin/orders';
                    $subject = 'Новый заказ!';
                    mail($adminEmail, $subject, $message);
                    // Очищаем корзину
                    Cart::clear();
                } 
            } 
        }
        // Подключаем вид
        require_once(ROOT . '/views/cart/checkout.php');
        return true;
    }
}

