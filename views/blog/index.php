<?php require_once ROOT . '/views/layouts/header.php';?>
        
        <!--================Home Banner Area =================-->
        <section class="home_banner_area">
            <div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide"><img src="/template/img/slider/slider-2.jpg" alt="">
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
											<a class="banner_btn" href="#">Explore Us</a>
											<a class="banner_btn2" href="#">Get Free Quote</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="swiper-slide"><img src="/template/img/slider/slider-2.jpg" alt="">
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
				</div>
			</div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Blog Area =================-->
        <section class="blog_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog_left_sidebar">
                        <?php if (is_array($blogPosts)) foreach($blogPosts as $post): ?>
                            <article class="row blog_item">
                               <div class="col-md-3">
                                   <div class="blog_info text-right">
                                        <div class="post_tag">
                                        <?php foreach($post['category'] as $category): ?>
                                            <a href="#"><?= $category ?></a>
                                        <?php endforeach; ?>     
                                        </div>
                                        <ul class="blog_meta list">
                                            <li><a href="#"><?= $post['first_name'] . ' ' . $post['last_name'] ?><i class="lnr lnr-user"></i></a></li>
                                            <li><a href="#"><?= $post['date'] ?><i class="lnr lnr-calendar-full"></i></a></li>
                                            <li><a href="#"><?= $post['viewed'] ?><i class="lnr lnr-eye"></i></a></li>
                                            <li><a href="#"><?= $post['comments'] ?> Comments<i class="lnr lnr-bubble"></i></a></li>
                                        </ul>
                                    </div>
                               </div>
                                <div class="col-md-9">
                                    <div class="blog_post">
                                        <img src="<?= FileImages::getImage('blog', $post['image'])?>" alt="b_img">
                                        <div class="blog_details">
                                            <a href="single-blog.html"><h2><?= $post['title'] ?></h2></a>
                                            <p><?= $post['description'] ?></p>
                                            <a href="/blogpost/views/<?= $post['id'] ?>" class="blog_btn">Посмотреть подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>  
                            <nav class="blog-pagination justify-content-center d-flex">
		                        <ul class="pagination">
                                   
                                    <?= $pagination->getNavPageList(); ?>
                                    
		                        </ul>
                            </nav>
                            
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="blog_right_sidebar">

                            <aside class="single_sidebar_widget search_widget">
                                <form action="/blogpost/search/" method="POST" id="search_form">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Posts" name="query">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" name="search_form" type="submit"><i class="lnr lnr-magnifier"></i></button>
                                    </span>   
                                </div><!-- /input-group -->
                                </form>
                                <div class="br"></div>
                            </aside>

                            <aside class="single_sidebar_widget author_widget">
                                <img class="author_img rounded-circle" src="/template/img/blog/author.png" alt="">
                                <h4>Charlie Barber</h4>
                                <p>Senior blog writer</p>
                                <div class="social_icon">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-github"></i></a>
                                    <a href="#"><i class="fa fa-behance"></i></a>
                                </div>
                                <p>Boot camps have its supporters andit sdetractors. Some people do not understand why you should have to spend money on boot camp when you can get. Boot camps have itssuppor ters andits detractors.</p>
                                <div class="br"></div>
                            </aside>

                            <aside class="single_sidebar_widget popular_post_widget">

                                <h3 class="widget_title">Popular Posts</h3>
                                <?php foreach($popularPosts as $post): ?>
                                <div class="media post_item">
                                    <img src="<?= FileImages::getImage('blog', $post['image']) ?>" width="110px" alt="post">
                                    <div class="media-body">
                                        <a href="/blogpost/views/<?= $post['id'] ?>"><h3><?= $post['title'] ?></h3></a>
                                        <p><?= $post['date']  ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <div class="br"></div>
                            </aside>

                            <aside class="single_sidebar_widget ads_widget">
                                <a href="#"><img class="img-fluid" src="/template/img/blog/add.jpg" alt=""></a>
                                <div class="br"></div>
                            </aside>
                            <aside class="single_sidebar_widget post_category_widget">
                                <h4 class="widget_title">Post Catgories</h4>
                                <ul class="list cat-list">
                                <?php foreach($categoryCountPosts as $category): ?>    
                                    <li>
                                        <a href="/blogpost/category-<?= $category['id'] ?>" class="d-flex justify-content-between">
                                            <p><?= $category['title'] ?></p>
                                            <p> <?= $category['post_count']  ?> </p>
                                        </a>
                                    </li>
                                <?php endforeach; ?>      												
                                </ul>
                                <div class="br"></div>
                            </aside>
                            <aside class="single-sidebar-widget newsletter_widget">
                                <h4 class="widget_title">Newsletter</h4>
                                <p>
                                Here, I focus on a range of items and features that we use in life without
                                giving them a second thought.
                                </p>
                                <div class="form-group d-flex flex-row">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'">
                                    </div>
                                    <a href="#" class="bbtns">Subcribe</a>
                                </div>	
                                <p class="text-bottom">You can unsubscribe at any time</p>	
                                <div class="br"></div>							
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Blog Area =================-->
        
        <?php require_once ROOT . '/views/layouts/footer.php'; ?> 