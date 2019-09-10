<?php require_once ROOT . '/views/layouts/header.php';?>
        
        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
				<div class="container">
					<div class="banner_content">
						<h2>Blog Details</h2>
						<div class="page_link">
							<a href="index.html">Home</a>
							<a href="single-blog.html">Blog Details</a>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Blog Area =================-->
        <section class="blog_area single-post-area p_120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 posts-list">
                        <div class="single-post row">
                            <div class="col-lg-12">
                                <div class="feature-img">
                                    <img class="img-fluid" src="<?= FileImages::getImage('blog', $post['post']['image'])?>" alt="">
                                </div>									
                            </div>
                            <div class="col-lg-3  col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <?php foreach($post['categories'] as $category): ?>
                                        <a href="#">- <?= $category ?> <br/></a>
                                        <?php endforeach; ?>
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#"><?= $post['post']['name']['first_name'] . ' ' . $post['post']['name']['last_name'] ?><i class="lnr lnr-user"></i></a></li>
                                        <li><a href="#"><?= $post['post']['date'] ?><i class="lnr lnr-calendar-full"></i></a></li>
                                        <li><a href="#"><?= $post['post']['viewed'] ?><i class="lnr lnr-eye"></i></a></li>
                                        <li><a href="#"><?= $countComments ?> Comments<i class="lnr lnr-bubble"></i></a></li>
                                    </ul>
                                    <ul class="social-links">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-github"></i></a></li>
                                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 blog_details">
                                <h2><?= $post['post']['title'] ?></h2>
                                <p class="excert">
                                <?= $post['post']['content'] ?>
                                </p>
                            </div>
                        
                        </div>
                        <div class="navigation-area">
                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    <div class="thumb">
                                        <a href="#"><img class="img-fluid" src="img/blog/prev.jpg" alt=""></a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#"><span class="lnr text-white lnr-arrow-left"></span></a>
                                    </div>
                                    <div class="detials">
                                        <p>Prev Post</p>
                                        <a href="/blogpost/views/<?= $navPost[0]['id'] ?>/"><h4><?= $navPost[0]['title'] ?></h4></a>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    <div class="detials">
                                        <p>Next Post</p>
                                        <a href="/blogpost/views/<?= $navPost[1]['id'] ?>/"><h4><?= $navPost[1]['title'] ?></h4></a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#"><span class="lnr text-white lnr-arrow-right"></span></a>
                                    </div>
                                    <div class="thumb">
                                        <a href="#"><img class="img-fluid" src="img/blog/next.jpg" alt=""></a>
                                    </div>										
                                </div>

                            </div>
                        </div>
                        <div class="comments-area">
                            <h4><?= $countComments ?> Comments</h4>
                            <?php if (is_array($comments)) foreach($comments as $comment): ?>
                            <div class="comment-list">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img src="/template/img/blog/c1.jpg" alt="blog_user">
                                        </div>
                                        <div class="desc">
                                            <h5><a href="#"><?= ucfirst($comment['first_name']) . ' ' .  ucfirst($comment['last_name']) ?></a></h5>
                                            <p class="date"><?= date('d-M-Y H:i', strtotime($comment['date'])) ?></p>
                                            <p class="comment">
                                                <?= $comment['text'] ?>
                                            </p>
                                        </div>
                                    </div>
                                   <!-- <div class="reply-btn">
                                           <a href="" class="btn-reply text-uppercase">reply</a> 
                                    </div> -->
                                </div>
                            </div>	
                            <?php  endforeach; ?>
                           <!-- <div class="comment-list left-padding">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img src="img/blog/c2.jpg" alt="">
                                        </div>
                                        <div class="desc">
                                            <h5><a href="#">Elsie Cunningham</a></h5>
                                            <p class="date">December 4, 2017 at 3:12 pm </p>
                                            <p class="comment">
                                                Never say goodbye till the end comes!
                                            </p>
                                        </div>
                                    </div>
                                    <div class="reply-btn">
                                           <a href="" class="btn-reply text-uppercase">reply</a> 
                                    </div>
                                </div>
                            </div>	-->
                                                          				
                        </div>
                        <?php $id = $post['post']['id']; if (!Auth::isGuest()): ?>
                        <div class="comment-form">
                            <h4>Оставьте свой комментарий</h4>
                            <form action="/blogpost/addcomment/<?= $id ?>/" method="POST" name="comment" id="comment">
                                <div class="form-group form-inline">										
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control mb-10 blog_textarea" form="comment" id="comment" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                                </div>
                                <input type="submit" name="submit" class="primary-btn submit_btn" value="Оставить комментарий">
                            </form>
                        </div>
                        <?endif;?>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget search_widget">
                                <form action="/blogpost/search/" method="POST" id=" search_form">
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
                                <a href="#"><img class="img-fluid" src="img/blog/add.jpg" alt=""></a>
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
       