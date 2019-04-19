<?php

/* @var $this yii\web\View */
use yii\widgets\LinkPager;
use yii\helpers\Url;


$this->title = 'PaperBlog';
?>

<!--<aside id="fh5co-hero">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="flexslider animate-box">
						<ul class="slides">
					   	<li style="background-image: url(/public/images/img_bg_1.jpg);">
					   		<div class="overlay-gradient"></div>
					   		<div class="container-fluid">
					   			<div class="row">
						   			<div class="col-md-10 col-md-offset-1 slider-text">
						   				<div class="slider-text-inner">
						   					<h1>Not Every Project Needs To Be Perfect</h1>
												<h2>Free html5 templates Made by <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2>
												<p class="ct"><a href="#">Learn More <i class="icon-arrow-right"></i></a></p>
						   				</div>
						   			</div>
						   		</div>
					   		</div>
					   	</li>
					   	<li style="background-image: url(/public/images/img_bg_2.jpg);">
					   		<div class="overlay-gradient"></div>
					   		<div class="container-fluid">
					   			<div class="row">
						   			<div class="col-md-10 col-md-offset-1 slider-text">
						   				<div class="slider-text-inner">
						   					<h1>Minimal &amp; Clean Blog WordPress</h1>
												<h2>Free html5 templates Made by <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2>
												<p class="ct"><a href="#">Learn More <i class="icon-arrow-right"></i></a></p>
						   				</div>
						   			</div>
						   		</div>
					   		</div>
					   	</li>
					   	<li style="background-image: url(/public/images/img_bg_3.jpg);">
					   		<div class="overlay-gradient"></div>
					   		<div class="container-fluid">
					   			<div class="row">
						   			<div class="col-md-10 col-md-offset-1 slider-text">
						   				<div class="slider-text-inner">
						   					<h1>What Would You Like To Learn?</h1>
												<h2>Free html5 templates Made by <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2>
												<p class="ct"><a href="#">Learn More <i class="icon-arrow-right"></i></a></p>
						   				</div>
						   			</div>
						   		</div>
					   		</div>
					   	</li>		   	
					  	</ul>
				  	</div>
				</div>
				<div class="col-md-4">
					<a href="#" class="featured text-center animate-box" style="background-image: url(/public/images/img_bg_3.jpg);">
						<div class="desc">
							<span class="date">Dec 25, 2016</span>
							<h3>Every Start has an End</h3>
							<span class="category">Inspirational</span>
						</div>
					</a>
					<a href="#" class="featured text-center animate-box" style="background-image: url(/public/images/img_bg_2.jpg);">
						<div class="desc">
							<span class="date">Dec 25, 2016</span>
							<h3>Most Beautiful Website in 2016</h3>
							<span class="category">Inspirational</span>
						</div>
					</a>
				</div>
			</div>
		</div>
	</aside>-->

	
	<div id="fh5co-content">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-padded-right">
					<div class="row">
						<div class="col-md-12">
							<div class="fh5co-blog animate-box">

							<!-- Статьи-->

						
							
								<?php

										echo LinkPager::widget([
    									'pagination' => $pagination,
										]);
									
								?>
							

							<?php

							foreach($articles as $article) : ?>
								<div class="title title-pin text-center">
									<span class="posted-on"> <?= $article->getDate(); ?> </span>
									<h3><a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]); ?>"> <?= $article->title ?> </a></h3>
									<a href="<?= Url::toRoute(['site/category', 'id' => $article->category->id]) ?>"><span class="category"> <?= $article->category->title; ?> </span></a>
								</div>
								<a href=" <?= Url::toRoute(['site/view', 'id'=>$article->id]); ?> "><img class="img-responsive" src=" <?= $article->getImage(); ?> " alt=""></a>
								<div class="blog-text text-center">
									<p> <?= $article->description ?> </p>
									<p>Просмотров:  <?= (int) $article->viewed ?></p>
							<?php endforeach; ?>

								
									
								

									<ul class="fh5co-social-icons">
										<li>Share:</li>
										<li><a href="#"><i class="icon-twitter-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-facebook-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-linkedin-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-dribbble-with-circle"></i></a></li>
									</ul>
								</div> 
							</div>
						</div>

		<!-- Популярные статьи -->

	<div id="fh5co-blog-popular">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-12 col-md-offset-0 text-center fh5co-heading">
					
					<h2><span>Popular Posts</span></h2>

		<?php foreach($popular as $article):?>
		<div class="popular">
			<div class="row">
				<div class="col-md-3">
					<div class="fh5co-blog animate-box">
						<a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]); ?>"><img class="img-responsive" src=" <?= $article->getImage(); ?> " alt=""></a>
						<div class="blog-text">
							<h3><a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]); ?>"> <?= $article->title ?> </a></h3>
							<p>Дата: <?= $article->getDate(); ?> </p>
							<p>Просмотров: <?= (int) $article->viewed ?> </p>
						</div> 
					</div>
				</div>
			</div>
		</div>

		<?php endforeach; ?>


					<h2><span>Recent Posts</span></h2>

		<?php foreach($recent as $article):?>

		<div class="recent">
			<div class="row">
				<div class="col-md-3">
					<div class="fh5co-blog animate-box">
						<a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]); ?>#"><img class="img-responsive" src=" <?= $article->getImage(); ?> " alt=""></a>
						<div class="blog-text">
							<h3><a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]); ?>"> <?= $article->title ?> </a></h3>
							<p>Дата: <?= $article->getDate(); ?> </p>
							<p>Просмотров: <?= (int) $article->viewed ?> </p>
						</div> 
					</div>
				</div>
			</div>
		</div>

		<?php endforeach; ?>

				<!-- Категории -->
				<div class="widget border pos-padding">
					<h2 class="widget-title text-uppercase text-center"><span>Categories</span></h2>
					
					<ul>
						<?php foreach ($categories as $category): ?>
						  <li>
								<a href="#"> <?= $category->title ?> </a>
								<span class="post-count pull-right"> ( <?= $category->getArticlesCount(); ?> )</span>
							</li>
				  	<?php endforeach; ?>
					</ul>

				</div>
			</div>
		</div>
	</div>
</div>



						<div class="col-md-6">
							<div class="fh5co-blog animate-box">
								<div class="title text-center">
									<span class="posted-on">Nov. 15th 2016</span>
									<h3><a href="#">Modeling &amp; Stylist in USA</a></h3>
									<span class="category">Lifestyle</span>
								</div>
								<a href="#"><img class="img-responsive" src="/public/images/blog-2.jpg" alt=""></a>
								<div class="blog-text text-center">
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
									<ul class="fh5co-social-icons">
										<li>Share:</li>
										<li><a href="#"><i class="icon-twitter-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-facebook-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-linkedin-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-dribbble-with-circle"></i></a></li>
									</ul>
								</div> 
							</div>
						</div>
					  <div class="col-md-6">
							<div class="fh5co-blog animate-box">
								<div class="title text-center">
									<span class="posted-on">Nov. 15th 2016</span>
									<h3><a href="#">Modeling &amp; Stylist in USA</a></h3>
									<span class="category">Lifestyle</span>
								</div>
								<a href="#"><img class="img-responsive" src="/public/images/blog-1.jpg" alt=""></a>
								<div class="blog-text text-center">
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
									<ul class="fh5co-social-icons">
										<li>Share:</li>
										<li><a href="#"><i class="icon-twitter-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-facebook-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-linkedin-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-dribbble-with-circle"></i></a></li>
									</ul>
								</div> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="fh5co-blog animate-box">
								<div class="title text-center">
									<span class="posted-on">Nov. 15th 2016</span>
									<h3><a href="#">Modeling &amp; Stylist in USA</a></h3>
									<span class="category">Lifestyle</span>
								</div>
								<a href="#"><img class="img-responsive" src="/public/images/blog-2.jpg" alt=""></a>
								<div class="blog-text text-center">
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
									<ul class="fh5co-social-icons">
										<li>Share:</li>
										<li><a href="#"><i class="icon-twitter-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-facebook-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-linkedin-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-dribbble-with-circle"></i></a></li>
									</ul>
								</div> 
							</div>
						</div>
						<div class="col-md-6">
							<div class="fh5co-blog animate-box">
								<div class="title text-center">
									<span class="posted-on">Nov. 15th 2016</span>
									<h3><a href="#">Modeling &amp; Stylist in USA</a></h3>
									<span class="category">Lifestyle</span>
								</div>
								<a href="#"><img class="img-responsive" src="/public/images/blog-1.jpg" alt=""></a>
								<div class="blog-text text-center">
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
									<ul class="fh5co-social-icons">
										<li>Share:</li>
										<li><a href="#"><i class="icon-twitter-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-facebook-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-linkedin-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-dribbble-with-circle"></i></a></li>
									</ul>
								</div> 
							</div>
						</div>
					</div>
				</div>
				<!--
				<aside id="sidebar">
					<div class="col-md-3">
						<div class="side animate-box">
							<div class="col-md-12 col-md-offset-0 text-center fh5co-heading fh5co-heading-sidebar">
								<h2><span>About Me</span></h2>
							</div>
							<div class="fh5co-staff">
								<img src="/public/images/user-2.jpg" alt="Free HTML5 Templates by FreeHTML5.co">
								<h3>Jean Smith</h3>
								<strong class="role">CEO, Founder</strong>
								<p>Quos quia provident conse culpa facere ratione maxime commodi voluptates id repellat velit eaque aspernatur expedita.</p>
								<ul class="fh5co-social-icons">
									<li><a href="#"><i class="icon-facebook"></i></a></li>
									<li><a href="#"><i class="icon-twitter"></i></a></li>
									<li><a href="#"><i class="icon-dribbble"></i></a></li>
									<li><a href="#"><i class="icon-github"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="side animate-box">
							<div class="col-md-12 col-md-offset-0 text-center fh5co-heading fh5co-heading-sidebar">
								<h2><span>Latest Posts</span></h2>
							</div>
							<div class="blog-entry">
								<a href="#">
									<img src="/public/images/blog-1.jpg" class="img-responsive" alt="">
									<div class="desc">
										<span class="date">Dec. 25, 2016</span>
										<h3>Most Beautiful Site in 2016</h3>
									</div>
								</a>
							</div>
							<div class="blog-entry">
								<a href="#">
									<img src="/public/images/blog-2.jpg" class="img-responsive" alt="">
									<div class="desc">
										<span class="date">Dec. 25, 2016</span>
										<h3>Most Beautiful Site in 2016</h3>
									</div>
								</a>
							</div>
							<div class="blog-entry">
								<a href="#">
									<img src="/public/images/blog-1.jpg" class="img-responsive" alt="">
									<div class="desc">
										<span class="date">Dec. 25, 2016</span>
										<h3>Most Beautiful Site in 2016</h3>
									</div>
								</a>
							</div>
						</div>
						<div class="side animate-box">
							<div class="col-md-12 col-md-offset-0 text-center fh5co-heading fh5co-heading-sidebar">
								<h2><span>Category</span></h2>
							</div>
							<ul class="category">
								<li><a href="#"><i class="icon-check"></i>Lifestyle</a></li>
								<li><a href="#"><i class="icon-check"></i>Web Development</a></li>
								<li><a href="#"><i class="icon-check"></i>Web Design</a></li>
								<li><a href="#"><i class="icon-check"></i>Nature</a></li>
								<li><a href="#"><i class="icon-check"></i>Life</a></li>
								<li><a href="#"><i class="icon-check"></i>Entertainment</a></li>
							</ul>
						</div>
						<div class="side animate-box">
							<div class="col-md-12 col-md-offset-0 text-center fh5co-heading fh5co-heading-sidebar">
								<h2><span>Intagram</span></h2>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="insta" style="background-image: url(/public/images/insta-1.jpg);">
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</aside>-->

			</div>
		</div>
	</div>

	<div id="fh5co-instagram">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-12 col-md-offset-0 text-center fh5co-heading">
					<h2><span>Instagram Posts</span></h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 nopadding animate-box" data-animate-effect="fadeIn">
				<div class="insta" style="background-image: url(/public/images/insta-1.jpg);"></div>
			</div>
			<div class="col-md-3 nopadding animate-box" data-animate-effect="fadeIn">
				<div class="insta" style="background-image: url(/public/images/insta-2.jpg);"></div>
			</div>
			<div class="col-md-3 nopadding animate-box" data-animate-effect="fadeIn">
				<div class="insta" style="background-image: url(/public/images/insta-3.jpg);"></div>
			</div>
			<div class="col-md-3 nopadding animate-box" data-animate-effect="fadeIn">
				<div class="insta" style="background-image: url(/public/images/insta-4.jpg);"></div>
			</div>
		</div>
	</div>

	