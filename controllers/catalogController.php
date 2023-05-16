<?php
        
class catalogController
{
    public function actionIndex($page=1)
    {
        $categories=array();
        $categories= Category::getCategoryList();
        
        $prods=array();
        $prods=Product::getLatestProd(12, $page);
        
         $total=Product::getTotalProd();
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        require_once(ROOT.'/views/catalog/index.php');
        return true;
    }
    
    public function actionCategory($category, $page=1)
    {
        $categories=array();
        $categories= Category::getCategoryList();
        
        $prods=array();
        $prods=Product::getProdbyCat($category, $page);
        
        $total=Product::getProdinCat($category);
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        require_once(ROOT.'/views/catalog/category.php');
        return true;
    }
}

