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
					<div class="post">
						<h2 class="title"><a href='/news/<?php echo $newsItem['id'] ;?>'><?php echo $newsItem['title'];?></a></h2>
						<p class="meta">Posted by <a href="#"></a>Опубликовано <?php echo $newsItem['date'];?>
							&nbsp;&bull;&nbsp; <a href='/news/' class="permalink"> К другим новостямe</a></p>
							<h3><?php echo $newsItem['preview'];?></h3>
                                                        <pre><?php echo $newsItem['content'];?></pre>
                                                        <img src="<?php echo News::getImage($newsItem['id']); ?>" alt="" />
						</div>
					</div>
					<p><a href='/news/' class="permalink"> К другим новостям</a></p>
					<div style="clear: both;">&nbsp;</div>
				</div>

                    </div>
                </div>
            </div>
                        </div></div></div></div>
        </section>

<?php include ROOT.'/views/layouts/footer.php';?>