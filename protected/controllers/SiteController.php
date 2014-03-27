<?php

class SiteController extends Controller
{
	public $layout='main';

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

	public function actionContact(){
		$model = new ContactForm;
		$this->performAjaxValidation( $model );
		if ( isset ( $_POST['ContactForm'] ) )
		{
			$model->attributes = $_POST['ContactForm'];
			if ( $model->validate() )
			{
				$model->email ="idrini@gmail.com";
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render( 'contact',array( 'model'=>$model ) );
		//$model=new ContactForm;
		//echo $this->render('contact',array('model'=>$model),false,true);
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

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==="comment-form")
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionUpload()
	{
	    header('Vary: Accept');
	    if (isset($_SERVER['HTTP_ACCEPT']) && 
	        (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false))
	    {
	        header('Content-type: application/json');
	    } else {
	        header('Content-type: text/plain');
	    }
	    $data = array();
	 
	    $model = new Post('upload');
	    $model->picture = CUploadedFile::getInstance($model, 'picture');
	    $path = realpath(dirname(__FILE__).'/../../images/portfolio'); 
	    if ($model->picture !== null  && $model->validate(array('picture')))
	    {
	    	$foo = Yii::app()->file->set($path,true);
	        $model->picture->saveAs($path."/".$model->picture->name);
	        $image = new EasyImage($path."/".$model->picture->name);
			$image->resize(100, 100);
			$image->save($path.'/thumbnails/'.$model->picture->name);
	            // return data to the fileuploader
	            	$basePath = str_replace('\\','\\\\',Yii::app()->basePath);
	           		$data[] = array(
	                'name' => $model->picture->name,
	                'type' => $model->picture->type,
	                'size' => $model->picture->size,
	                'fileFolder'=>$path,
	                'location'=>$path."/".$model->picture->name,
	                'publicUrl'=>"/images/portfolio/".$model->picture->name,
	                'delete_url' => $this->createUrl('post/delete', array('id' => $model->id, 'method' => 'uploader')),
	                'delete_type' => 'POST');

	    } else {
	        if ($model->hasErrors('picture'))
	        {
	            $data[] = array('error', $model->getErrors('picture'));
	        } else {
	            throw new CHttpException(500, "Could not upload file ".     CHtml::errorSummary($model));
	        }
	    }
	    // JQuery File Upload expects JSON data
	    echo json_encode($data);
	}
	
}