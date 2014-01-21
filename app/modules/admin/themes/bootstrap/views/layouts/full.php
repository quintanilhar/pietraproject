<?php $this->beginContent('//layouts/main'); ?>
<!-- Static navbar -->
<div id="wrap">
    <header class="navbar navbar-default navbar-static-top nav-layout" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/admin">Pietra Project</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span>
                        <?php echo Yii::app()->user->first_name ?>
                        <small>(<?php echo Yii::app()->user->email ?>)</small>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Minha conta</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo Yii::app()->createUrl('admin/admin/logout') ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
      </div>
    </header>

    <?php if(isset($this->breadcrumbs)): ?>
        <div class="row container-fluid">
            <div class="col-md-12">
            <?php $this->widget('admin.widgets.AdminBreadCrumb', array(
                    'links'=>$this->breadcrumbs,
                ));
            ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row container-fluid" style="margin-bottom: 40px;">
        <div class="col-md-2">
            <div class="panel panel-warning">
                <div class="panel-heading">Site</div>
            
                <div class="list-group">
                    <?php 
                        foreach ($this->menu as $label => $url) { 
                            $class = '';

                            if (isset($url['submenu'])) {
                                echo '<p class="list-group-item" style="background-color: #f5f5f5">' . Yii::t('admin', $label) . '</p>';

                                foreach ($url['submenu'] as $subLabel => $subUrl) {
                                    $class = '';
                                    if (isset($this->activeMenu) && strstr($subUrl[0], $this->activeMenu)) {
                                        $class = 'active';
                                    }

                                    echo CHtml::link(
                                        Yii::t('admin', $subLabel),
                                        Yii::app()->createUrl($subUrl[0]),
                                        array(
                                            'class' => 'list-group-item ' . $class
                                        )
                                    );
                                } 

                                continue;
                            }

                            if (isset($this->activeMenu) && strstr($url[0], $this->activeMenu)) {
                                $class = 'active';
                            }

                            echo CHtml::link(
                                Yii::t('admin', $label),
                                Yii::app()->createUrl($url[0]),
                                array(
                                    'class' => 'list-group-item ' . $class
                                )
                            );
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <?php echo $content; ?>
        </div>
    </div>
</div>

<div id="footer">
    <p class="text-muted"><?php echo Pietra::powered() ?></p>
</div>

<?php $this->endContent(); ?>
