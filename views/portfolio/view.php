<?php require_once ROOT . '/views/layouts/header.php';?>
        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
				<div class="container">
					<div class="banner_content">
						<h2>Project Details</h2>
						<div class="page_link">
							<a href="index.html">Home</a>
							<a href="portfolio-details.html">Project Details</a>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Portfolio Details Area =================-->
        <section class="portfolio_details_area p_120">
        	<div class="container">
        		<div class="portfolio_details_inner">
					<div class="row">
						<div class="col-md-6">
							<div class="left_img">
                                <img class="img-fluid" src="<?= FileImages::getImage('portfolio',$post['post']['image'] )?>" 
                                alt="view_portfolio">
							</div>
						</div>
						<div class="col-md-6">
							<div class="portfolio_right_text">
								<h4><?= $post['post']['title']?></h4>
								<p><?= $post['post']['description'] ?></p>
								<ul class="list">
									<li><span>Client</span>:  <?= $post['post']['client'] ?></li>
									<li><span>Website</span>:  <?= $post['post']['website'] ?></li>
									<li><span>Completed</span>:  <?= $post['post']['date'] ?></li>
								</ul>
								<ul class="list social_details">
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-behance"></i></a></li>
									<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
       				
       				<p><?= $post['post']['content'] ?></p>
        		</div>
        	</div>
        </section>
        <!--================End Portfolio Details Area =================-->
        
<?php require_once ROOT . '/views/layouts/footer.php'; ?>  