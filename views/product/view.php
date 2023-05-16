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
                                        <h4 class="panel-title"><a href="/category/<?php echo $cItem['id']; ?>">
                                            <?php echo $cItem['name']; ?></a></h4>
                                    </div>
                                </div>
                               <?php endforeach;?>
                            </div>

                        </div>
                    </div>
               
                 

                    <div class="col-sm-9 padding-right">
                        <div class="product-details"><!--product-details-->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="view-product">
                                        <img src="<?php echo Product::getImage($product['id']); ?>" alt="" />
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="product-information"><!--/product-information-->
                                        <img src="/template/images/product-details/new.jpg" class="newarrival" alt="" />
                                        <h2><?php echo $prod['name'];?></h2>
                                        <span>
                                            <span><?php echo $prod['price'];?>Р.</span>                                        
                                            
                                        <?php if($prod['status']==1):?>
                                            <a href="#" data-id="<?php echo $prod['id'];?>"
                                           class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>В корзину
                                        </a>
                                            </span><p><b>Наличие:</b> На складе</p>';
                                            <?php else:?>
                                        
                                       <p><b>Наличие:</b> Нет в наличии</p>
                                       <?php endif; ?>
                                       
                                        <p><b>Производитель: </b><?php echo $prod['brand'];?></p>
                                    </div><!--/product-information-->
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-sm-12">
                                    <h5>Описание</h5>
                                    <?php echo $prod['decs'];?>
                                </div>
                            </div>
                        </div><!--/product-details-->

                    </div>
                </div>
            </div>
        </section>
        

        <br/>
        <br/>
        
<?php include ROOT.'/views/layouts/footer.php';?>