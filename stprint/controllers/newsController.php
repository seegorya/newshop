<?php

include_once ROOT.'/models/News.php';

class newsController
{
    public function actionIndex()
    {
        $newsList = array();
        $newsList = News::getNewsList();
        echo '<pre>';
        print_r($newsList);
        echo '</pre>';
    }
    
    public function actionView($id)
    {
        if ($id)
        {
            $newsItem= News::getNewsById($id);
            echo "<pre>";
            print_r($newsItem);
            echo "</pre>";
        }
        return true;
    }
}

