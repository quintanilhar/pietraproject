<?php

class BlogConfigController extends AController
{
    public $activeMenu = 'blogConfig';

    public function actionIndex()
    {
        $model = new BlogConfigForm;

        if (isset($_POST['BlogConfigForm'])) {

            $model->attributes = $_POST['BlogConfigForm'];

            if ($model->validate()) {
                foreach ($_POST['BlogConfigForm'] as $config => $value) { 
                    Config::model()->setConfig($config, $value);
                }

                Yii::app()->user->setFlash(
                    'success',
                    Yii::t('admin', 'Configuration saved successfully!')
                );

                $this->redirect(array('index'));
            }
        } else {
            $blogConfig = Config::model()->blog()->findAll();

            foreach ($blogConfig as $config) {
                $model->extractFromConfig($config);
            }
        }

        $this->render('index',array(
            'model'=>$model,
        ));
    }
}
