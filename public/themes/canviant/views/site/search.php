<div class="container">
    <h1 class="tituloSearch">Buscar</h1>

    <div class="boxResultadoBusca">
        <h2>Buscando por: "<span class="txt-yellow"><?php echo $keyword ?></span>"</h2>

        <?php $data = $pages->getData(); ?> 

        <?php if (count($data) > 0): ?>
            <?php foreach ($data as $page): ?> 
            <?php

                $url = null;

                if ($page->scope_id == Scope::DEFAULT_SCOPE) {
                    
                    if (count($page->categories) > 0) {
                        $category = $page->categories[0];
                        $url = $category->url->getFullUrl() . '#' . $page->url->url;
                    }
                } 
                    
                if ($url === null) {
                    $url = $page->url->getFullUrl();
                }

            ?>
            <div class="item">
                <h3><a href="<?php echo $url ?>"><?php echo $page->title ?></a></h3>
                <p><?php echo $page->small_description ?></p>
                <a href="<?php echo $url ?>" class="bt bt-orange">LEIA MAIS</a>
            </div>
            <?php endforeach ?>

        <?php else: ?>

            <h3>Nenhum resultado encontrado.</h3>

        <?php endif; ?>
    </div>
</div>
