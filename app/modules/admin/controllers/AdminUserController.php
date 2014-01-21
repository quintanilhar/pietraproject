<?php

class AdminUserController extends AController
{
    public $activeMenu = 'adminUser';

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
        $model = new AdminUser('create');

		if (isset($_POST['AdminUser'])) {
			$model->attributes=$_POST['AdminUser'];

			if ($model->save()) {
                Yii::app()->user->setFlash(
                    'success',
                    Yii::t(
                        'admin',
                        'The user {name} has been created!',
                        array('{name}' => $model->first_name . ' ' . $model->last_name)
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
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['AdminUser'])) {

            if (empty($_POST['AdminUser']['password'])) {
                unset($_POST['AdminUser']['password']);
                $model->password = null;
            }

			$model->attributes=$_POST['AdminUser'];

			if ($model->save()) {
                Yii::app()->user->setFlash(
                    'success',
                    Yii::t(
                        'admin',
                        'The user {name} has been updated!',
                        array('{name}' => $model->first_name . ' ' . $model->last_name)
                    )
                );

                $this->redirect(array('index'));
            }
        } else {
            $model->password = null;
        }

		$this->render('update',array(
            'model' => $model
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new AdminUser('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AdminUser']))
			$model->attributes=$_GET['AdminUser'];

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
		$model=AdminUser::model()->findByPk($id);
        $model->setScenario('update');
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AdminUser $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='admin-user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
