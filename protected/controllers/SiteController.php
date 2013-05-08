<?php

class SiteController extends Controller
{
	public $layout='column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
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

	public function actionIndex(){
		$this->render('index');
	}
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;

		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				//mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);				
				//Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				if(Yii::app()->request->isAjaxRequest){
					echo CJSON::encode(array('status'=>"success"));
				}else{
					$this->refresh();
				}
				$model->unsetAttributes();
				return;
			}

		}
			if(Yii::app()->request->isAjaxRequest){

				echo CJSON::encode(array('content'=>$this->renderPartial('contact',array('model'=>$model),true)));
			}else{
				$this->render('contact',array('model'=>$model));
			}
		
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid

			if($model->validate() && $model->login()){

			   	if(Yii::app()->request->isAjaxRequest){
			   		// pass the returnUrl
					echo CJSON::encode(array('url'=>Yii::app()->user->returnUrl,'status'=>'success' ));
					return;
				}
				$this->redirect(Yii::app()->user->returnUrl);	
			}
		}
	   	if(Yii::app()->request->isAjaxRequest){
	   		$this->renderPartial('login',array('model'=>$model));
	   		return;
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

	public function actionajaxContact(){
		$model=new ContactForm;
		echo CJSON::encode($this->renderPartial('contact',array('model'=>$model),false,true));
	}
	public function actionajaxAbout(){
		echo $this->renderPartial("/site/pages/about",array(),true,false);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
	   
		if(Yii::app()->request->isPostRequest)
		{
		    $id=$_POST["id"];

			// we only allow deletion via POST request
			$model=$_POST['modelClass']::model()->findByPk($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset(Yii::app()->request->isAjaxRequest))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			else
			   echo json_encode(array('modelClass'=>$_POST['modelClass']));
		}
		else{
		    if(!isset($_GET['ajax']))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		    else
			   echo "false"; 	
	    }	
	}
}