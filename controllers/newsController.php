<?php


class newsController
{
    public function actionIndex()
    {
        $newsList = array();
        $newsList = News::getNewsList();
        require_once(ROOT.'/views/news/index.php');
        return true;
    }
    
    public function actionView($id)
    {
        if ($id)
        {
            $newsItem= News::getNewsById($id);
            require_once(ROOT.'/views/news/view.php');
        }
        return true;
    }
    
    
}

