<?php 

$consultoria = Category::model()->findByPk(1); 
$servicos = Category::model()->findByPk(2); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/style.css">
    <title><?php echo $this->pageTitle ?></title>

		<meta charset="UTF-8">
	</head>

	<body>
		
		<div id="header">
			<div class="container">
				<div class="logo"><a href="<?php echo Yii::app()->homeUrl ?>">HOME</a></div>

				<div class="boxBusca">
                    <form action="<?php echo Yii::app()->createUrl('search/index') ?>" method="get">
						<input name="keyword" placeholder="BUSCA" />
						<button></button>
					</form>
				</div>

				<ul class="menu">
                    <li class="gray"><a href="<?php echo Yii::app()->homeUrl ?>">HOME</a></li>
                    <li class="yellow">
                        <a href="<?php echo $consultoria->url->getFullUrl() ?>">
                            <?php echo mb_strtoupper($consultoria->title, 'UTF-8') ?>
                        </a>
                    </li>
                    <li class="blue">
                        <a href="<?php echo $servicos->url->getFullUrl() ?>">
                            <?php echo mb_strtoupper($servicos->title, 'UTF-8') ?>
                        </a>
                    <li class="red">
                        <a href="<?php echo BlogConfig::getFullHomeUrl() ?>">
                            <?php echo mb_strtoupper(BlogConfig::getName(), 'UTF-8') ?>
                        </a>
                    </li>
					<li class="cyan"><a href="#contato" class="scrollTo">CONTATO</a></li>
				</ul>
			</div>
		</div>

        <div class="wrapper clearfix">
            <?php echo $content; ?>
        </div>

		<div class="boxContato clearfix">
			<div class="container">
				<div class="line line-white">
					<h3 id="contato">CONTATO COM A <span class="txt-yellow">CANVIANT</span></h3>
				</div>

				<div class="left">
					<div class="info">
						<p class="title">Entre em contato conosco</p>
						<p>Use o formulário ao lado para entrar em <br /> contato com a Canviant</p>
					</div>

					<div class="contatos">
						<p>
							<span class="iconTelefone icon-inline icon"></span> +55 11 98945-5375
						</p>
						<p>
							<span class="iconEmail icon-inline icon"></span> contato@canviant.com.br
						</p>
						<p>
							<span class="iconWeb icon-inline icon"></span> www.canviant.com.br
						</p>
					</div>

					<div class="redesSocias">
						<p>Siga a Canviant nas redes sociais</p>

						<a href="http://www.facebook.com/canviant" target="_blank"><span class="iconFacebook icon-inline"></span></a>
						<a href="http://www.linkedin.com/company/canviant-consultoria-empresarial" target="_blank"><span class="iconIn icon-inline"></span></a>
					</div>
				</div>
				<div class="right">
                    <?php if(Yii::app()->user->hasFlash('contact')): ?>
                        <p class="contatoSucesso"><?php echo Yii::app()->user->getFlash('contact'); ?></p>
                    <?php endif; ?>

                    <?php if(Yii::app()->user->hasFlash('contactError')): ?>
                        <p class="contatoErro"><?php echo Yii::app()->user->getFlash('contactError'); ?></p>
                    <?php endif; ?>

                    <form class="form-contato" action="<?php echo Yii::app()->createUrl('contato') ?>" method="post">

						<input class="nome border-radius" placeholder="NOME" name="ContactForm[name]" />

						<input class="email border-radius" placeholder="E-MAIL" name="ContactForm[email]" />

						<textarea class="border-radius" name="ContactForm[message]" rows="8" placeholder="MENSAGEM"></textarea>

						<button class="bt bt-large bt-orange">ENVIAR</button>
					</form>
				</div>
			</div>
		</div>

		<div id="footer" class="clearfix">
			<div class="container">
				<p class="title txt-yellow">MAPA DO SITE</p>

				<ul>
                    <li class="title">
                        <a href="<?php echo $consultoria->url->getFullUrl() ?>">
                            <?php echo mb_strtoupper($consultoria->title, 'UTF-8') ?>
                        </a>
                    </li>
                    <?php foreach ($consultoria->pages as $page): ?>
                    <li><a href="<?php echo $consultoria->url->getFullUrl() ?>#<?php echo $page->url->url ?>"><?php echo mb_strtoupper($page->title, 'UTF-8'); ?></a></li>
                    <?php endforeach; ?>
				</ul>

				<ul>
                    <li class="title">
                        <a href="<?php echo $servicos->url->getFullUrl() ?>">
                            <?php echo mb_strtoupper($servicos->title, 'UTF-8') ?>
                        </a>
                    </li>
                    <?php foreach ($servicos->pages as $page): ?>
                    <li><a href="<?php echo $servicos->url->getFullUrl() ?>#<?php echo $page->url->url ?>"><?php echo mb_strtoupper($page->title, 'UTF-8'); ?></a></li>
                    <?php endforeach; ?>
				</ul>

				<ul>
                    <li class="title">
                        <a href="<?php echo BlogConfig::getFullHomeUrl() ?>">
                            <?php echo mb_strtoupper(BlogConfig::getName(), 'UTF-8') ?>
                        </a>
                    </li>
				</ul>

				<ul>
					<li class="title"><a href="#contato" class="scrollTo">CONTATO</a></li>
				</ul>
			</div>
		</div>
	</body>

</html>

<?php
    $cs = Yii::app()->getClientScript();

    $cs->registerScriptFile(
        Yii::app()->theme->baseUrl . '/js/jquery.js',
        CClientScript::POS_HEAD
    );

    $cs->registerScriptFile(
        Yii::app()->theme->baseUrl . '/js/global.js',
        CClientScript::POS_END
    );
?>

