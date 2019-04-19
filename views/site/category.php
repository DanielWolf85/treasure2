<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;

?>
<div class="container">
	<div class="row">
            <div class="side animate-box">
							<div class="col-md-8 col-md-offset-0 text-center">
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
						

						<!-- Статьи-->

						
						<?php

							echo LinkPager::widget([
							'pagination' => $pagination,
							]);

						?>
					
	</div>
</div>
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