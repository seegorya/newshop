<?php


class productController {
     public function actionView($productId)
    {
        $categories=array();
        $categories= Category::getCategoryList();
        
        $prod= Product::getProdbyID($productId);
        
        require_once(ROOT.'/views/product/view.php');
        return true;
    }
}
