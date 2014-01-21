<!DOCTYPE html>
<html>
  <head>
    <title><?php echo CHtml::encode($this->pageTitle); echo !empty($this->pageTitle) ? ' - ' : null ?> Pietra admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

	<title></title>
  </head>
  <body class="clearfix">

	<?php echo $content; ?>

    <script src="https://code.jquery.com/jquery.js"></script>
  </body>
</html>

<?php
    $cs = Yii::app()->getClientScript();

    $cs->registerCssFile($this->module->assetsUrl . '/css/bootstrap.min.css');
    $cs->registerCssFile($this->module->assetsUrl . '/css/jquery-te-1.4.0.css');
    $cs->registerCssFile($this->module->assetsUrl . '/css/global.css');

    $cs->registerScriptFile(
        $this->module->assetsUrl . '/js/bootstrap.min.js',
        CClientScript::POS_END
    );

    $cs->registerScriptFile(
        $this->module->assetsUrl . '/js/jquery-te-1.4.0.min.js',
        CClientScript::POS_END
    );

    $cs->registerScriptFile(
        $this->module->assetsUrl . '/js/global.js',
        CClientScript::POS_END
    );

?>
