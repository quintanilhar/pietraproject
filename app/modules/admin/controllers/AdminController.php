<?php

class AdminController extends AController
{
    public function actionIndex()
    {
        if (!Yii::app()->user->isGuest) {
            $this->render('index');
        } else {
            $this->actionLogin();
        }
    }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        $this->layout = '//layouts/main';

		$model = new LoginForm;

		if (isset($_POST['LoginForm'])) {

			$model->attributes = $_POST['LoginForm'];

			if ($model->validate() && $model->login()) {
				$this->refresh();
            }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
