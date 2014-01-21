<?php

class SiteController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->render('/index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm'])) {
			$model->attributes=$_POST['ContactForm'];

			if($model->validate()) {
				$subject='Contato pelo site';
				$headers="From: $model->name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

                $message = "Nome: " . $model->name . "\n" .
                            "Email: " . $model->email . "\n" .
                            "Mensagem: " . $model->message;

				mail(Yii::app()->params['adminEmail'], $subject, $message, $headers);

				Yii::app()->user->setFlash('contact', 'Sua mensagem de contato foi enviada com sucesso! <br /> Em breve entraremos em contato, obrigado.');

            } else {
				Yii::app()->user->setFlash('contactError', 'Falha ao enviar sua mensagem de contato! <br /> Certifique-se que todos os campos foram preenchidos corretamente.');
            }
		}

        $this->redirect(Yii::app()->user->returnUrl . '#contato');
	}

}
