<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass."\n"; ?>
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','updateAttribute','jsonAttributes'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
	public function actionView($id)
	{
		if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('view',array(
				'model'=>$this->loadModel($id),
			),false,true);
			return;
	   	}
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
		if(isset($_POST['<?php echo $this->modelClass; ?>']['id']) && $_POST['<?php echo $this->modelClass; ?>']['id'] !=="" ){
        	$id = $_POST['<?php echo $this->modelClass; ?>']['id'];	
        }elseif(isset($_GET['<?php echo $this->modelClass; ?>']['id']) && $_GET['<?php echo $this->modelClass; ?>']['id'] !=="" ){
        	$id = $_GET['<?php echo $this->modelClass; ?>']['id'];
        }		$model=new <?php echo $this->modelClass; ?>;

        if(isset($id)){
        	$model = $this->loadModel($id);
			//comment the following line if AJAX validation isn't needed
			$this->performAjaxValidation($model, "<?php echo $this->class2id($this->modelClass);?>");
    	}else{
    		$model = new <?php echo $this->modelClass;?>;
    	}

    	//ajax requests
    	if(Yii::app()->request->isAjaxRequest){
		    if(isset($_POST['<?php echo $this->modelClass;?>'])){
			    $model->attributes=$_POST['<?php echo $this->modelClass;?>'];
			    if($model->save()){
			    	echo CJSON::encode(array(
					    'content'=> $this->renderPartial('view',array('model'=>$model,'comment'=>false),true,false),
					    'link'=>$model->getLink(),
					    'success'=>true,
			    	));
			    }
		    }else{
		    	echo $this->renderPartial('create',array(
			    	'model'=>$model,
		    	),false,true);
		    }
		    return;
	    }

    	//normal behaviour for non ajax requests
		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save())
				$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
		}

		$this->render('create',array(
			'model'=>$model,
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Comment the following line if AJAX validation isn't needed
		$this->performAjaxValidation($model,"<?php echo $this->class2id($this->modelClass);?>");

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save())
				$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
		updates a single attribute thrue x-editable column
	*/
	public function actionUpdateAttribute()
    {
	    $es = new EditableSaver('<?php echo $this->modelClass;?>'); 
	    $es->update();
    }
	

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('<?php echo $this->modelClass; ?>');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['<?php echo $this->modelClass; ?>']))
			$model->attributes=$_GET['<?php echo $this->modelClass; ?>'];

		$this->render('admin',array(
			'model'=>$model,
		));
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
      
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
	
}
