<?php include ROOT.'/views/layouts/header.php';?>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4 padding-right">
                        
                        
                        <?php  if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $er): ?>
                            <li> - <?php echo $er; ?></li>
                            <?php endforeach;?>   
                        </ul>
                        <?php endif;?>
                        
                        <div class="signup-form">
                            <h2>Вход в личный кабинет</h2>
                            <form action="#" method="post">
                                <input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>"/>
                                <input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/>
                                <button type="submit" name="submit" class="btn btn-default">Войти</button>   
                            </form>
                        </div> 
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </section>

<?php include ROOT.'/views/layouts/footer.php';?>