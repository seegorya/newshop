<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/news">Управление новостями</a></li>
                    <li class="active">Редактировать</li>
                </ol>
            </div>


            <h4>Редактировать новость #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Заголовок</p>
                        <input type="text" name="title" placeholder="" value="<?php echo $news['title']; ?>">

                        <p>Короткий текст</p>
                        <input type="text" name="preview" placeholder="" value="<?php echo $news['preview']; ?>">

                        <p>Текст новости</p>
                        <input type="text" name="content" placeholder="" value="<?php echo $news['content']; ?>">

                        <p>Изображение</p>
                        <img src="<?php echo News::getImage($newsItem['id']); ?>" width="200" alt="" />
                        <input type="file" name="image" placeholder="" value="<?php echo $news['moreprv']; ?>">                        
                        <br/><br/>
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        
                        <br/><br/>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

