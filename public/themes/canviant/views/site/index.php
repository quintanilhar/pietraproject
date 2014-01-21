<?php 

$consultoria = Category::model()->findByPk(1); 
$servicos = Category::model()->findByPk(2); 

$cs = Yii::app()->getClientScript();

$cs->registerScriptFile(
    Yii::app()->theme->baseUrl . '/js/jquery.cycle.lite.js',
    CClientScript::POS_END
);

$cs->registerScriptFile(
    Yii::app()->theme->baseUrl . '/js/slide2.js',
    CClientScript::POS_END
);

?>

<div class="banner">
    <div class="container">
        <ul id="banner">
            <?php
                foreach (Banner::model()->findAll(array('order' => '`order`')) as $banner) {
                    $image = CHtml::image(
                        $banner->media->getUrl(),
                        $banner->media->title
                    );

                    echo '<li>';
                    if (!empty($banner->link)) {
                        echo CHtml::link($image, $banner->link);
                    } else {
                        echo $image;
                    }
                    echo '</li>';
                }
            ?>
        </ul>

        <div id="prev" class="bannerPrev"></div>
        <div id="next" class="bannerNext"></div>
    </div>
</div>

<div class="boxConsultoria">
    <div class="container clearfix">
        <div class="line line-yellow">
            <h3>A CONSULTORIA</h3>
        </div>
                            
        <div class="line-subtitle">Conheça um pouco mais sobre a Canviant</div>

        <ul class="items-container clearfix">
            <li>
                <span class="icon-inline iconQuemSomos"></span>

                <?php $pageLoader = $this->widget('pietra.widgets.PageLoader'); ?>

                <?php $page = $pageLoader->getById(1); ?>

                <div class="title"><?php echo mb_strtoupper($page->title, 'UTF-8'); ?></div>
                <div class="content"><?php echo $page->small_description; ?></div>

                <a href="<?php echo $consultoria->url->getFullUrl() ?>#<?php echo $page->url->url ?>" class="bt bt-orange">LEIA MAIS</a>
            </li>
            <li>
                <span class="icon-inline iconPropostaValor"></span>

                <?php $page = $pageLoader->getById(2); ?>

                <div class="title"><?php echo mb_strtoupper($page->title, 'UTF-8'); ?></div>
                <div class="content"><?php echo $page->small_description; ?></div>

                <a href="<?php echo $consultoria->url->getFullUrl() ?>#<?php echo $page->url->url ?>" class="bt bt-orange">LEIA MAIS</a>
            </li>
            <li>
                <span class="icon-inline iconFoco"></span>

                <?php $page = $pageLoader->getById(3); ?>

                <div class="title"><?php echo mb_strtoupper($page->title, 'UTF-8'); ?></div>
                <div class="content"><?php echo $page->small_description; ?></div>

                <a href="<?php echo $consultoria->url->getFullUrl() ?>#<?php echo $page->url->url ?>" class="bt bt-orange">LEIA MAIS</a>
            </li>
            <li>
                <span class="icon-inline iconDiferencial"></span>

                <?php $page = $pageLoader->getById(4); ?>

                <div class="title"><?php echo mb_strtoupper($page->title, 'UTF-8'); ?></div>
                <div class="content"><?php echo $page->small_description; ?></div>

                <a href="<?php echo $consultoria->url->getFullUrl() ?>#<?php echo $page->url->url ?>" class="bt bt-orange">LEIA MAIS</a>
            </li>
        </ul>
    </div>
</div>

<div class="boxServicos">
    <div class="container clearfix">
        <div class="line line-white">
            <h3>SERVIÇOS</h3>
        </div>
                            
        <div class="line-subtitle">Conheça um pouco mais sobre os serviços</div>

        <ul class="items-container clearfix">
            <li class="border-radius estrategiaBg">
                <span class="icon-inline iconEstrategia"></span>

                <?php $page = $pageLoader->getById(5); ?>

                <div class="title"><?php echo mb_strtoupper($page->title, 'UTF-8'); ?></div>
                <div class="content"><?php echo $page->small_description; ?></div>

                <a href="<?php echo $servicos->url->getFullUrl() ?>#<?php echo $page->url->url ?>" class="bt bt-blue">LEIA MAIS</a>
            </li>
            <li class="border-radius gestaoBg">
                <span class="icon-inline iconGestao"></span>

                <?php $page = $pageLoader->getById(7); ?>

                <div class="title"><?php echo mb_strtoupper($page->title, 'UTF-8'); ?></div>
                <div class="content"><?php echo $page->small_description; ?></div>

                <a href="<?php echo $servicos->url->getFullUrl() ?>#<?php echo $page->url->url ?>" class="bt bt-blue">LEIA MAIS</a>
            </li>
            <li class="border-radius excelenciaBg">
                <span class="icon-inline iconExcelencia"></span>

                <?php $page = $pageLoader->getById(8); ?>

                <div class="title"><?php echo mb_strtoupper($page->title, 'UTF-8'); ?></div>
                <div class="content"><?php echo $page->small_description; ?></div>

                <a href="<?php echo $servicos->url->getFullUrl() ?>#<?php echo $page->url->url ?>" class="bt bt-blue">LEIA MAIS</a>
            </li>
            <li class="border-radius desenvolvimentoPessoasBg">
                <span class="icon-inline iconDesenvolvimentoPessoas"></span>

                <?php $page = $pageLoader->getById(9); ?>

                <div class="title"><?php echo mb_strtoupper($page->title, 'UTF-8'); ?></div>
                <div class="content"><?php echo $page->small_description; ?></div>

                <a href="<?php echo $servicos->url->getFullUrl() ?>#<?php echo $page->url->url ?>" class="bt bt-blue">LEIA MAIS</a>
            </li>
        </ul>
    </div>
</div>

<div class="boxBlog">
    <div class="container clearfix">
        <div class="line line-red">
            <h3>FIQUE POR DENTRO</h3>
        </div>
                            
        <div class="line-subtitle">Leia sobre artigos, recomendações e atualidades</div>

        <ul class="items-container clearfix">
            <?php $posts = Page::model()->blog()->findAll(array('limit' => 3)); ?>

            <?php foreach ($posts as $post): ?>
            <li>
                <div class="date border-radius">							
                    <p class="day"><?php echo $post->getCreatedDate()->format('d') ?></p>
                    <p class="month"><?php echo Yii::t('site', $post->getCreatedDate()->format('M')) ?></p>
                    <p class="year"><?php echo $post->getCreatedDate()->format('Y') ?></p>
                </div>

                <div class="title"><a href="<?php echo $post->url->getFullUrl() ?>"><?php echo $post->title ?></a></div>
                <?php

                    $image = $post->getFirstMedia();

                    if ($image !== false) {
                        echo CHtml::image(
                            $image->getUrl(),
                            $image->title,
                            array(
                                'class' => 'thumb',
                                'width' => 250,
                                'height' => 165
                            )
                        );
                    }
                ?>

                <div class="content"><?php echo $post->small_description ?></div>
            </li>
            <li>
            <?php endforeach ?>
        </ul>

        <div class="footerBox">
            <a href="<?php echo BlogConfig::getFullHomeUrl() ?>" class="bt bt-large bt-red">LEIA MAIS</a>
        </div>
    </div>
</div>


