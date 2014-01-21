<?php

class BannerController extends AController
{
    public $activeMenu = 'banner';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Banner('create');
		$media = new Media('create');

		if (isset($_POST['Banner'])) {
			$model->attributes=$_POST['Banner'];

            $media->attributes = $_POST['Media'];
            $media->file = CUploadedFile::getInstance($media,'file');

            if ($media->save()) {
                $model->media_id = $media->media_id;

                if ($model->save()) {
                    Yii::app()->user->setFlash(
                        'success',
                        Yii::t('admin', 'The banner {title} has been created!', array('{title}' => $media->title))
                    );
                    $this->redirect(array('index'));
                }
            }
		}

		$this->render('create',array(
			'model'         => $model,
            'media'         => $media,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

        $media = $model->media;
        $media->setScenario('update');

		if (isset($_POST['Banner'])) {
			$model->attributes = $_POST['Banner'];

            $media->attributes = $_POST['Media'];
            $media->file = CUploadedFile::getInstance($media,'file');

            if ($media->save()) {

                $model->media_id = $media->media_id;

                if ($model->save()) {
                    Yii::app()->user->setFlash(
                        'success',
                        Yii::t('admin', 'The banner {title} has been updated!', array('{title}' => $media->title))
                    );
                    $this->redirect(array('index'));
                }
            }
		}

		$this->render('update', array(
            'model' => $model,
            'media' => $media,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model = $this->loadModel($id);
        $media = $model->media;
        $model->delete();

        Yii::app()->user->setFlash(
            'success',
            Yii::t('admin', 'The banner {title} has been deleted!', array('{title}' => $media->title))
        );

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/banner/index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Banner('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Banner']))
			$model->attributes=$_GET['Banner'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AdminUser the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Banner::model()->findByPk($id);
        $model->setScenario('update');
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
