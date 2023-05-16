<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/news">Управление новостями</a></li>
                    <li class="active">Опубликовать новость</li>
                </ol>
            </div>


            <h4>Опубликовать новость</h4>

            <br/>            
            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Заголовок</p>
                        <input type="text" name="title" placeholder="" value="">

                        <p>Короткий текст</p>
                        <input type="text" name="preview" placeholder="" value="">

                        <p>Текст новости</p>
                        <input type="text" name="content" placeholder="" value="">

                        <p>Изображение</p>
                        <input type="file" name="image" placeholder="" value="">                     
                        <br/><br/>
                        <input type="submit" name="submit" class="btn btn-default" value="Опубликовать">
                        
                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

