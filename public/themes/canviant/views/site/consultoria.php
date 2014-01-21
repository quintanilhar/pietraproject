<h1 class="tituloConsultoria"><?php echo $category->title ?></h1>

<?php $box = $imagePosition = null; ?>

<?php foreach ($category->pages as $page): ?>

<?php

$box = ($box == 'boxWhiteYellow') ? 'boxYellow' : 'boxWhiteYellow';
$imagePosition = ($imagePosition == 'imageLeft') ? 'imageRight' : 'imageLeft';

?>
    <div class="<?php echo $box ?>">
        <div class="container">

            <div class="boxTitulo clearfix">
                <span class="<?php $this->widget('application.widgets.Icon', array('pageId' => $page->page_id)) ?> icon"></span>
                <h3 class="small" id="<?php echo $page->url->url ?>"><?php echo mb_strtoupper($page->title, 'UTF-8'); ?></h3>
            </div>

            <div class="content clearfix">
                <?php

                    $image = $page->getFirstMedia();

                    if ($image !== false) {
                        echo CHtml::image(
                            $image->getUrl(),
                            $image->title,
                            array(
                                'class' => $imagePosition
                            )
                        );
                    }
                ?>
            
                <?php echo $page->description ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
