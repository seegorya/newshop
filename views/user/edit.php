<?php include ROOT.'/views/layouts/header.php';?>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4 padding-right">
                        
                        <?php if ($result):?>
                        <p>Данные успешно обновлены!</p>
                        <?php else: ?>
                        <?php  if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $er): ?>
                            <li> - <?php echo $er; ?></li>
                            <?php endforeach;?>   
                        </ul>
                        <?php endif;?>
                        
                        <div class="signup-form">
                            <h2>Редактирование данных</h2>
                            <form action="#" method="post">
                                <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"/>
                                <input id="pass"  type="password" alt="" name="password" placeholder="Новый пароль"/>
                                <input id="pass"  type="password" alt="" name="password2" placeholder="Повторите пароль"/>
                                <button type="submit" name="submit" class="btn btn-default">Сохранить</button>   
                            </form>
                        </div> 
                        <?php endif;?>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </section>

<?php include ROOT.'/views/layouts/footer.php';?>