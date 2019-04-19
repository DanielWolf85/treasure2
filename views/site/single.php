<?php

use yii\helpers\Url;
use app\models\User;

?>


        <div class="container">
          <div class="row">
						<div class="col-md-12">
							<div class="fh5co-blog animate-box">
								<div class="title title-pin text-center">
									<span class="posted-on"> <?= $article->getDate(); ?> </span>
									<h3><a href="#"> <?= $article->title ?> </a></h3>
									<a href=" <?= Url::toRoute(['site/category', 'id' => $article->category->id]) ?> "><span class="category"> <?= $article->category->title ?> </span></a>
								</div>
								<a href="#"><img class="img-responsive" src=" <?= $article->getImage(); ?> " alt=""></a>
								<div class="blog-text text-center">
                  <p> <?= $article->content ?> </p>
                  <p>Дата: <?= $article->getDate(); ?> </p>
							    <p>Просмотров: <?= (int) $article->viewed ?> </p>
									<ul class="fh5co-social-icons">
										<li>Share:</li>
										<li><a href="#"><i class="icon-twitter-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-facebook-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-linkedin-with-circle"></i></a></li>
										<li><a href="#"><i class="icon-dribbble-with-circle"></i></a></li>
                  </ul>
                </div>
								
								


                <div class="leave-comment">
                  <h4>Leave a replay</h4>

<?php $form = \yii\widgets\ActiveForm::begin(['action' => ['site/comment', 'id' => $article->id],
			'options' => 
			[
				'class' => 'form-horisontal contact-form', 'role' => 'form'
			]]) ?>

                  <div class="form-group">


                      <div class="col-md-12">

<?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control' , 'placeholder' => 'Write Message'])->label(false) ?>

                      </div>

									</div>
                    <button type="submit" class="btn send-btn">Post Comment</button>
<?php \yii\widgets\ActiveForm::end(); ?>


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