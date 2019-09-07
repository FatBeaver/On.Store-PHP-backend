<?php require_once ROOT . '/views/layouts/header.php';?>
        
        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
				<div class="container">
					<div class="banner_content">
						<h2>Projects</h2>
						<div class="page_link">
							<a href="index.html">Home</a>
							<a href="portfolio.html">Projects</a>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Project Area =================-->
        <section class="project_area">

        	<div class="row m0">
			<?php foreach($portfolioPosts as $post): ?>
        		<div class="col-lg-4 col-md-6 p0">
        			<div class="project_item">
        				<img src="<?= FileImages::getImage('portfolio', $post['image']) ?>" height="300vh" alt="p_img">
        				<div class="hover_text">
        					<h4><?= $post['title'] ?></h4>
        					<div class="cat">
        					<?php foreach($post['categories'] as $category): ?>
								<a href="#"><?= $category ?></a>
							<?php endforeach; ?>
        					</div>
        					<a class="main_btn" href="/portfoliopost/view/<?= $post['id'] ?>/">Посмотреть подробнее</a>
        				</div>
        			</div>
				</div>
			<?php endforeach; ?>
        	</div>
        </section>
        <!--================End Project Area =================-->
        
        <?php require_once ROOT . '/views/layouts/footer.php'; ?>     