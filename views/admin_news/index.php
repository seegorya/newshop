<?php include ROOT . '/views/layouts/header_admin.php'; ?>

        <section>
            <div class="container">
                <div class="row">
                   
                    <div class="col-sm-9 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Новости</h2>
                            <a href="/admin/news/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить новость</a>
                            <div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<?php foreach ($newsList as $newsItem):?>
					<div class="post">
						<h2 class="title"><a href='/news/<?php echo $newsItem['id'] ;?>'><?php echo $newsItem['title'];?></a></h2>
					<p><?php echo $newsItem['preview'];?><br></p>
                                                <p><a href='/admin/news/edit/<?php echo $newsItem['id'] ;?>'>Редактировать</a></p>
                                                <p><a href='/admin/news/delete/<?php echo $newsItem['id'] ;?>'>Удалить</a></p>
						<div class="entry">
                                                    
						</div>
					</div>
				<?php endforeach;?>
					<div style="clear: both;">&nbsp;</div>
				</div>

                    </div>
                </div>
            </div>
                        </div></div>
        </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>