<?php

/**
 * Контроллер AdminOrderController
 * Управление заказами в админпанели
 */
class adminNewsController extends AdminBase
{

    /**
     * Action для страницы "Управление заказами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список заказов
        $newsList = News::getNewsList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_news/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование заказа"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();
        $errors=false;
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['title'] = $_POST['title'];
            $options['preview'] =$_POST['preview'];
            $options['content'] = $_POST['content'];
            
            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['title']) || empty($options['title'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый товар
                $id= News::createNews($options);               

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/news/{$id}.jpg");
                    }
                    header("Location: /admin/news");
                };

                // Перенаправляем пользователя на страницу управлениями товарами
                
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_news/create.php');
        return true;
    }

    public function actionEdit($id)
    {
        // Проверка доступа
        self::checkAdmin();

        $news= News::getNewsById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
                        $options['title'] = $_POST['title'];
            $options['preview'] = $_POST['preview'];
            $options['content'] = $_POST['content'];

            // Сохраняем изменения
            if (News::updateNewsById($id, $options)) {
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                   move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/news/{$id}.jpg");
                }
                
                // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/news");
            }            
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_news/edit.php');
        return true;
    }

    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем товар
            News::deleteNewsById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/news");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_news/delete.php');
        return true;
    }

}
