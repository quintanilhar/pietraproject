<?php

class AdminModule extends CWebModule
{
    private $_assetsUrl;

	public function init()
    {
        parent::init();

        $config = include dirname(__FILE__) . '/config/admin.php';

        Yii::app()->getThemeManager()->setBasePath(
            $config['components']['themeManager']['basePath']
        );

        Yii::app()->theme = $config['components']['themeManager']['name'];

        Yii::app()->messages->basePath = dirname(__FILE__) . '/messages';

		$this->setImport($config['import']);
	}

	public function beforeControllerAction($controller, $action)
	{
        if (Yii::app()->user->isGuest
            && $controller->getRoute() !== 'admin/admin'
        ) {
            $controller->redirect('/admin');
        }

        return true; 
	}

    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('admin.assets')
            );
        }
        return $this->_assetsUrl;
    }
}
