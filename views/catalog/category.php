<?php include ROOT.'/views/layouts/header.php';?>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="left-sidebar">
                            <h2>Каталог</h2>
                            <div class="panel-group category-products">
                                <?php foreach ($categories as $cItem): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="/category/<?php echo $cItem['id']; ?>"
                                               class="<?php if ($category==$cItem['id']) echo 'active'; ?>">
                                                
                                            <?php echo $cItem['name']; ?></a></h4>
                                    </div>
                                </div>
                               <?php endforeach;?>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-9 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Последние товары</h2>
                            
                            <?php foreach ($prods as $product): ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?php echo Product::getImage($product['id']); ?>" alt="" />
                                            <h2><?php echo $product['price'];?>р.</h2>
                                            <a href="/product/<?php echo $product['id'];?>"<p><?php echo $product['name'];?></p></a>
                                            <?php if($product['status']==1):?>
                                            <a href="#" data-id="<?php echo $product['id'];?>"
                                           class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>В корзину
                                        </a>
                                            <?php endif;?>
                                        </div>
                                        <?php if ($product['isnew']): ?>
                                        <img src="/template/images/home/new.png" class="new" slt=""/>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>

                            
                        </div><!--features_items-->

                       <?php echo $pagination->get();?> 
                    </div>
                </div>
            </div>
        </section>

<?php include ROOT.'/views/layouts/footer.php';?>