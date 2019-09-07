<?php require_once ROOT . '/views/layouts/header.php';?>
        
        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
				<div class="container">
					<div class="banner_content">
						<h2>Services</h2>
						<div class="page_link">
							<a href="index.html">Home</a>
							<a href="service.html">Services</a>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Success Area =================-->
        <section class="success_area">
		<?php $i = 1; foreach($services['AllService'] as $service): ?>

			<?php if ($i % 2 == 0):?>
        	<div class="row m0">
        		<div class="col-lg-6 p0">
        			<div class="mission_text">
						<h4><?= $service['title'] ?></h4>
						<p><?= $service['description'] ?></p>
					</div>
        		</div>
        		<div class="col-lg-6 p0">
        			<div class="success_img">
        				<img src="/template/img/success-1.jpg" alt="">
        			</div>
        		</div>
			</div>

			<?php else :?>

        	<div class="row m0 right_dir">
        		<div class="col-lg-6 p0">
        			<div class="success_img">
        				<img src="/template/img/success-2.jpg" alt="">
        			</div>
        		</div>
        		<div class="col-lg-6 p0">
        			<div class="mission_text">
						<h4><?= $service['title'] ?></h4>
						<p><?= $service['description'] ?></p>
					</div>
        		</div>
			</div>
			<?php endif;?>

		<?php $i++; endforeach;?>
        </section>
        <!--================End Success Area =================-->
        <?php require_once ROOT . '/views/layouts/footer.php'; ?>