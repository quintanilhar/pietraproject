<?php

class MediaController extends AController
{
    public $activeMenu = 'media';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $this->layout = null;

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' media.
	 */
	public function actionCreate()
	{
		$model = new Media('create');

		if (isset($_POST['Media'])) {
			$model->attributes=$_POST['Media'];
            $model->file = CUploadedFile::getInstance($model,'file');

			if ($model->save()) {

                Yii::app()->user->setFlash(
                    'success',
                    Yii::t(
                        'admin',
                        'The media {title} has been created!',
                        array('{title}' => $model->title)
                    )
                );

                $this->redirect(array('index'));
            }
		}

		$this->render('create',array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' media.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if (isset($_POST['Media'])) {
			$model->attributes = $_POST['Media'];
            $model->file = CUploadedFile::getInstance($model,'file');

            if ($model->save()) {

                Yii::app()->user->setFlash(
                    'success',
                    Yii::t(
                        'admin',
                        'The media {title} has been updated!',
                        array('{title}' => $model->title)
                    )
                );

                $this->redirect(array('index'));
            }
		}

		$this->render('update', array(
            'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' media.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model = $this->loadModel($id);
        $model->delete();

        Yii::app()->user->setFlash(
            'success',
            Yii::t(
                'admin',
                'The media {title} has been deleted!',
                array('{title}' => $model->title)
            )
        );
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Media('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Media']))
			$model->attributes=$_GET['Media'];

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
		$model=Media::model()->findByPk($id);

        if ($model === null) {
            $this->redirect(array('index'));
        }

        $model->setScenario('update');
		if($model===null)
			throw new CHttpException(404,'The requested media does not exist.');
		return $model;
	}
}
