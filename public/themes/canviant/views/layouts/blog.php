<?php $this->beginContent('//layouts/main'); ?>

<?php
    Yii::app()->getClientScript()->registerCssFile(
        Yii::app()->theme->baseUrl . '/css/blog.css'
    );
?>

<div class="container clearfix">
    <div class="boxTitulo">
        <?php echo mb_strtoupper(Config::model()->getConfig('blogName'), 'UTF-8'); ?></p>
    </div>

    <div class="content">
        <?php echo $content; ?>
    </div>

    <div class="sidebar">
        <div class="container">
            <p class="titulo">categorias</p>

            <ul class="categorias">
                <?php foreach (Category::model()->blog()->findAll() as $category): ?>
                <li><a href="<?php echo $category->url->getFullUrl() ?>" class="border-radius">
                    <span class="iconSeta"></span> 
                    <?php echo $category->title ?>
                </a></li>
                <?php endforeach ?>
            </ul>
        </div>

        <div class="container">
            <p class="titulo">postagens recentes</p>

            <ul class="postsRecentes">
                <?php foreach (Page::model()->blog()->findAll(array('limit' => 5)) as $post): ?>
                <li><a href="<?php echo $post->url->getFullUrl() ?>" class="border-radius"><span class="iconCircle"></span> <?php echo $post->title ?></a></li>
                <?php endforeach ?>
            </ul>
        </div>

        <div class="container">
            <p class="titulo">palavras chave</p>

            <?php $this->widget('blog.widgets.TagCloud'); ?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>
