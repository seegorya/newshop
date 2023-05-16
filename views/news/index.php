<?php include ROOT.'/views/layouts/header.php';?>

        <section>
            <div class="container">
                <div class="row">
                   
                    <div class="col-sm-9 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Новости</h2>
                            <div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<?php foreach ($newsList as $newsItem):?>
					<div class="post">
						<h2 class="title"><a href='/news/<?php echo $newsItem['id'] ;?>'><?php echo $newsItem['title'];?></a></h2>
					<p><?php echo $newsItem['preview'];?><br></p>
                                        <img src="<?php echo News::getImage($newsItem['id']); ?>" height="200" alt="" />
                                                <p class="meta">Опубликовано <?php echo $newsItem['date'];?>
							&nbsp;&bull;&nbsp; <a href='/news/<?php echo $newsItem['id'] ;?>' class="permalink"> Читать далее</a></p>
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

<?php include ROOT.'/views/layouts/footer.php';?>