<?php

class PostController extends CController
{
    public $breadcrumbs;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{	
		$this->layout ="main";
		$id = isset($_POST['id']) ? $_POST['id'] : $_GET['id'];
		$model = new Comment;
		$this->performAjaxValidation($model,"comment-form");
		$model = $this->loadModel($id);
		
   	    $data = array(
   	    	'model' => $model,
   	    );
			

       if(Yii::app()->request->isAjaxRequest) {
   		   	$data['comment'] = false; 
        	$this->renderPartial('view',$data,false,true);        
       }
       else{
       		$data['comment'] = $this->newComment($model);
			$this->render('view',$data);
       }
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$this->layout ="main";

		$id = isset($_POST['id']) ? $_POST['id'] : $_GET['id'];
		$model=$this->loadModel($id);
		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
	   		'formSettings'=>$this->getFormSettings(),
		));
	}
	/**
	 * Creates a new comment.
	 * This method attempts to create a new comment based on the user input.
	 * If the comment is successfully created, the browser will be redirected
	 * to show the created comment.
	 * @param Post the post that the new comment belongs to
	 * @return Comment the comment instance
	 */
	protected function newComment($post)
	{
		$comment=new Comment;

		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($comment);
			$this->performAjaxValidation($comment,"comment-form");
			Yii::app()->end();
		}
		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			if($post->addComment($comment))
			{
				if($comment->status==Comment::STATUS_PENDING)
					Yii::app()->user->setFlash('commentSubmitted','Thank you for your comment. Your comment will be posted once it is approved.');
				$this->refresh();
			}
		}
		return $comment;
	}

	/**
	 * Creates a new model from create view or create/updates from admin view
	 * We use the same action for creating/updating in the admin view as we do for default create behaviour
	 * If creation is successful, the browser will be redirected to the 'view' page for non-ajax requests.
	 * Successfull Ajax form submit from admin view returns content and a link
	 * An ajax requests returns the form with a new model
	 */
	public function actionCreate()
	{	
		
		// update a model or create a new
		if(isset($_POST['Post']['id']) && $_POST['Post']['id'] !=="" ){
        	$id = $_POST['Post']['id'];	
        }elseif(isset($_GET['Post']['id']) && $_GET['Post']['id'] !=="" ){
        	$id = $_GET['Post']['id'];
        }

		if(isset($id)){       
        	$model = $this->loadModel($id);
		// Comment the following line if AJAX validation isn't needed
   			$this->performAjaxValidation($model,"post-form");
   		}else{
   			$model = new Post();	
   		}
   		// ajax request is handled here
        if(Yii::app()->request->isAjaxRequest){
		    if(isset($_POST['Post'])){
			    $model->attributes=$_POST['Post'];
			    if($model->save()){
			    	echo CJSON::encode(array(
					    'content'=> $this->renderPartial('view',array('model'=>$model,'comment'=>false),true,false),
					    'link'=>"",//$model->getLink(),
					    'success'=>true,
			    	));
			    }
		    }else{
		    	echo $this->renderPartial('create',array(
			    	'model'=>$model,
	   				'formSettings'=>$this->getFormSettings(),
		    	),false,true);
		    }
		    return;
	    }

	   	// normal behaviour without ajax 
       if(isset($_POST['Post'])){
		    $model->attributes=$_POST['Post'];
		    if($model->save()){
		    	 $this->redirect(array('view','id'=>$model->id));	
		     }	
		}
           
		$this->render('create',array(
		    'model'=>$model,
	   		'formSettings'=>$this->getFormSettings(),
		));	       	
	   	

	}

	/**
	 * Loads the data for a particular model and returns it in json format
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionJsonAttributes(){
		if (isset($_POST['id'])) { //askning for the form via ajax
			$model = $this->loadModel($_POST['id']);
			echo json_encode($model->attributes);
		}
	}

	/**
		updates a single attribute thrue x-editable column
	*/
	public function actionUpdateAttribute()
    {
	    $es = new EditableSaver('Post'); 
	    $es->update();
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
		    $id=$_GET["id"];

			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset(Yii::app()->request->isAjaxRequest))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			else
			   echo "true";
		}
		else{
		    if(!isset($_GET['ajax']))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		    else
			   echo "false"; 	
	    }	
	}
	
	public function actiondeleteAttachment()
    {
    	if(Yii::app()->request->isAjaxRequest)
    	{
	    	if(unlink($_POST['filePath']))
	    	{
	    		echo CJSON::encode(array('status'=>'success'));
	    	}
    	}

    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout = "main";
		$criteria=new CDbCriteria(array(
			'condition'=>'status='.Post::STATUS_PUBLISHED,
			'order'=>'update_time DESC',
			'with'=>'commentCount',
		));
		if(isset($_GET['tag']))
			$criteria->addSearchCondition('tags',$_GET['tag']);

		$dataProvider=new CActiveDataProvider('Post', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['postsPerPage'],
			),
			'criteria'=>$criteria,
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		    $session=new CHttpSession;
            $session->open();		
            $criteria=new CDbCriteria;                            
            $model=new Post('search');
            $model->unsetAttributes();  // clear any default values
              if(isset($_GET['Post'])){
               		$model->attributes=$_GET['Post'];
               }
		;     
		$this->render('admin',array(
			'model'=>$model,
			'formSettings'=>$this->getFormSettings(),
		));
	}

	/**
	 * Suggests tags based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestTags()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=Tag::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */


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
	    if ($model->picture !== null  && $model->validate(array('picture')))
	    {    
	    	$path = realpath("uploads"); 
	    	/*if($_POST["example"] == ""){
				$hash = md5(rand(1,67574));
	    	}else{
	    		$hash = $_POST['example']; 
	    	}*/
	    	$hash = md5(rand(1,67574));
	    		$fileFolder = $path."/".$hash;
		    	$foo = Yii::app()->file->set($fileFolder,true);
	    		$exists = $foo->getExists();
    	
    		if(!$exists){
		        $foo->createDir(0754,$fileFolder);			
    		}
	        $model->picture->saveAs($fileFolder."/".$model->picture->name);
	            // return data to the fileuploader
	            	$basePath = str_replace('\\','\\\\',Yii::app()->basePath);
	           		$data[] = array(
	                'name' => $model->picture->name,
	                'type' => $model->picture->type,
	                'size' => $model->picture->size,
	                'fileFolder'=>$hash,
	                'location'=>$fileFolder."/".$model->picture->name,
	                'publicUrl'=>"/uploads/".$hash."/".$model->picture->name,
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
	
	public function loadModel($id)
	{
		$model=Post::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	/*public function actionDelete()
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

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model,$form_id)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']===$form_id)
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
       
   protected function getFormSettings(){
   		return array(
			'id'=>"post-form",
			'action'=>'/post/create',			
			'enableAjaxValidation'=>true,
			'enableClientValidation'=>true,
			'clientOptions' => 
				 array(
					  'validateOnSubmit'=>true,
					  'validateOnChange'=>true,
					  'validateOnType'=>true,
					 ),
		        'method'=>'post',
				'type'=>'horizontal',
				'htmlOptions'=>array(
					'enctype'=>'multipart/form-data',
					'class'=>'form-horizontal',
					'style'=>'margin-top:2em;',
				)
		);
   }

	protected function getDataProvider(){
		$criteria=new CDbCriteria(array(
			'condition'=>'status='.Post::STATUS_PUBLISHED,
			'order'=>'update_time DESC',
			'with'=>'commentCount',
		));
		if(isset($_GET['tag']))
			$criteria->addSearchCondition('tags',$_GET['tag']);

		$dataProvider=new CActiveDataProvider('Post', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['postsPerPage'],
			),
			'criteria'=>$criteria,
		));
		return $dataProvider;
	}
}
