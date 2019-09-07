<?php require_once ROOT . '/views/layouts/header.php';?>
        
        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
				<div class="container">
					<div class="banner_content">
						<h2>About Us</h2>
						<div class="page_link">
							<a href="index.html">Home</a>
							<a href="about-us.html">About Us</a>
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
        			<a class="white_btn" href="#">Get Free Estimate</a>
        		</div>
        	</div>
        </section>
        <!--================End Project Details Area =================-->
        
<?php require_once ROOT . '/views/layouts/footer.php'; ?>        