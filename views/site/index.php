<?php require_once ROOT . '/views/layouts/header.php';?>
        
        <!--================Home Banner Area =================-->
        <section class="home_banner_area">
            <div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide"><img src="/template/img/slider/slider-1.jpg" alt="">
						<div class="slider_text_inner">
							<div class="container">
								<div class="row">
									<div class="col-lg-7">
										<div class="slider_text">
											<h2>We Combine <br />Business with Finance</h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
											<a class="banner_btn" href="#">Explore Us</a>
											<a class="banner_btn2" href="#">Get Free Quote</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="swiper-slide"><img src="/template/img/slider/slider-1.jpg" alt="">
						<div class="slider_text_inner">
							<div class="container">
								<div class="row">
									<div class="col-lg-7">
										<div class="slider_text">
											<h2>We Combine <br />Business with Finance</h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
											<a class="banner_btn" href="/template/#">Explore Us</a>
											<a class="banner_btn2" href="/template/#">Get Free Quote</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="swiper-slide"><img src="/template/img/slider/slider-1.jpg" alt="">
						<div class="slider_text_inner">
							<div class="container">
								<div class="row">
									<div class="col-lg-7">
										<div class="slider_text">
											<h2>We Combine <br />Business with Finance</h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
											<a class="banner_btn" href="/template/#">Explore Us</a>
											<a class="banner_btn2" href="/template/#">Get Free Quote</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Mission Area =================-->
        <section class="mission_area">

			<div class="row m0">
				<div class="col-lg-6 p0">
					<div class="left_img"><img src="/template/img/mission-1.jpg" alt="mission_1"></div>
				</div>
				<div class="col-lg-6 p0">
					<div class="mission_slider owl-carousel">
						<?php foreach($mixService['AllService'] as $group_service) : ?>
						<div class="item">
							<?php foreach($group_service as $service): ?>
							<div class="mission_text">
								<h4><?= $service['title'] ?></h4>
								<p><?= $service['description'] ?></p>
							</div>
							<?php endforeach; ?>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			
        </section>
        <!--================End Mission Area =================-->
        
        <!--================Success Area =================-->
        <section class="success_area">
			
        	<div class="row m0">
        		<div class="col-lg-6 p0">
        			<div class="mission_text">
						<h4><?= $mixService['serviceList'][0]['title'] ?></h4>
						<p><?= $mixService['serviceList'][0]['description'] ?></p>
					</div>
        		</div>
        		<div class="col-lg-6 p0">
        			<div class="success_img">
        				<img src="/template/img/success-1.jpg" alt="">
        			</div>
        		</div>
			</div>
			
        	<div class="row m0 right_dir">
        		<div class="col-lg-6 p0">
        			<div class="success_img">
        				<img src="/template/img/success-2.jpg" alt="">
        			</div>
        		</div>
        		<div class="col-lg-6 p0">
        			<div class="mission_text">
						<h4><?= $mixService['serviceList'][1]['title'] ?></h4>
						<p><?= $mixService['serviceList'][1]['description'] ?></p>
					</div>
        		</div>
			</div>
			
        </section>
        <!--================End Success Area =================-->
        
        <!--================Project Area =================-->
        <section class="project_area">

        	<div class="row m0">
			<?php foreach ($portfolioPosts as $post): ?>	
        		<div class="col-lg-4 col-md-6 p0">
        			<div class="project_item">
        				<img src="<?= FileImages::getImage('portfolio', $post['image'])?>" height="320vh" alt="post_portfolio">
        				<div class="hover_text">
        					<h4><?= $post['title'] ?></h4>
        					<div class="cat">
							<?php foreach ($post['categories'] as $category): ?>
        						<a href="/template/#"><?= ' ' . $category ?></a>
							<?php endforeach;?>	
        					</div>
        					<a class="main_btn" href="/template/#">Посмотреть подробнее</a>
        				</div>
        			</div>
        		</div>
			<?php endforeach; ?>	
			</div>
			
        </section>
        <!--================End Project Area =================-->
        
        <!--================Team Area =================-->
        <section class="team_area">

        	<div class="team_slider owl-carousel">
			<?php foreach ($workers as $work_user): ?>	
        		<div class="item">
        			<div class="team_item">
        				<img src="<?= FileImages::getImage('user',$work_user['image']); ?>" alt="user_img">
        				<div class="hover_text">
							<a href="/template/#">
								<h4>
								<?= $work_user['first_name'] . ' ' . $work_user['last_name']?> 
								</h4>
							</a>
        					<p><?= $work_user['work_position'] ?></p>
        					<ul class="list">
        						<li><a href="/template/#"><i class="fa fa-facebook"></i></a></li>
        						<li><a href="/template/#"><i class="fa fa-twitter"></i></a></li>
        						<li><a href="/template/#"><i class="fa fa-dribbble"></i></a></li>
        						<li><a href="/template/#"><i class="fa fa-behance"></i></a></li>
        					</ul>
        				</div>
        			</div>
        		</div>
			<?php endforeach; ?>		
			</div>
			
        </section>
        <!--================End Team Area =================-->
        
        <!--================Project Details Area =================-->
        <section class="project_know_area p_120">
        	<div class="container">
        		<div class="project_know_inner text-center">
        			<h3>Get to Know Project Estimate?</h3>
        			<p>There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think about setting up your own viewing station whether that is on the deck</p>
        			<a class="white_btn" href="/template/#">Get Free Estimate</a>
        		</div>
        	</div>
        </section>
        <!--================End Project Details Area =================-->
        
        <!--================Home Blog Area =================-->
        <section class="home_blog_area">

        	<div class="row m0">
			<?php $i = 0; foreach($blogPosts as $post): ?>
				
				<?php if($i >= 2): ?>

				<div class="col-lg-3 p0">
        			<div class="h_blog_text">
						<a class="cat" href="/template/#">
						<?= $post['date'] ?>  |  By <?= $post['first_name'] . ' ' . $post['last_name'] ?>
						</a>
        				<a href="/template/#"><h4><?= $post['title'] ?></h4></a>
        				<p><?= $post['description'] ?></p>
        			</div>
				</div>
				<div class="col-lg-3 p0">
        			<div class="h_blog_img">
        				<img src="<?= FileImages::getImage('blog', $post['image'])?>" alt="blog_img">
        			</div>
				</div>
				
				<?php else: ?>

				<div class="col-lg-3 p0">
        			<div class="h_blog_img">
        				<img src="<?= FileImages::getImage('blog', $post['image'])?>" alt="blog_img">
        			</div>
        		</div>
        		<div class="col-lg-3 p0">
        			<div class="h_blog_text">
						<a class="cat" href="/template/#">
						<?= $post['date'] ?>  |  By <?= $post['first_name'] . ' ' . $post['last_name'] ?>
						</a>
        				<a href="/template/#"><h4><?= $post['title'] ?></h4></a>
        				<p><?= $post['description'] ?></p>
        			</div>
				</div>

				<?php endif; ?>
			<?php $i++; endforeach; ?>			
			</div>
			
        </section>
        <!--================End Home Blog Area =================-->

<?php require_once ROOT . '/views/layouts/footer.php'; ?>