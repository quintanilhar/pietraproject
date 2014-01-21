<?php foreach ($posts->getData() as $post): ?>
<div class="post">
    <div class="date border-radius">							
        <p class="day"><?php echo $post->getCreatedDate()->format('d') ?></p>
        <p class="month"><?php echo Yii::t('site', $post->getCreatedDate()->format('M')) ?></p>
        <p class="year"><?php echo $post->getCreatedDate()->format('Y') ?></p>
    </div>

    <h3><a href="<?php echo $post->url->url ?>"><?php echo $post->title ?></a></h3>

    <?php

        $image = $post->getFirstMedia();

        if ($image !== false) {
            echo CHtml::image(
                $image->getUrl(),
                $image->title
            );
        }
    ?>

    <?php echo nl2br($post->small_description) ?>

    <p class="mais"><a href="<?php echo $post->url->url ?>">Leia mais</a> &gt;</p>

    <ul class="details clearfix">
        <li class="author">Por <span class="txt-yellow"><?php echo $post->user->getFullName() ?></span></li>
        <li class="tags"><?php echo !empty($post->tags) ? 'Tags: ' . implode(', ', $post->getTagLinks()) : '&nbsp;' ?></li>
        <li class="network">
            Compartilhar: 
            <?php $widget = $this->beginWidget('blog.widgets.NetworkButton', array('title' => $post->title, 'url' => $post->url->url)); ?>
            <a href="<?php echo $widget->twitterUrl() ?>" target="_blank"><span class="iconTwitterBlog icon-inline"></a></span>
            <a href="<?php echo $widget->facebookUrl() ?>" target="_blank"><span class="iconFacebookBlog icon-inline"></a></span>
            <?php $this->endWidget(); ?>
        </li>
    </ul>
</div>
<?php endforeach ?>

<?php 

$this->widget('blog.widgets.BlogPager', array(
    'pages' => $posts->pagination,
    'route' => Yii::app()->request->pathInfo
)) 

?>
