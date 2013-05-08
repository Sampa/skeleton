<?php

class UserController extends CController
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
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
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	       
	}

	public function actionRegister()
	{
		$model = new User('register');
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation( $model , 'user-form' );
	
		if ( isset ( $_POST['User'] ) )
		{
			$model->attributes = $_POST['User'];

		//User::beforeSave() to see what is done with the values from the form
			if ( $model->validate() )
				{ if ( $model->save() )
					{
						$dir = User::USER_DIR . $model->id; 
						
						mkdir($dir,0777,true); 
						if ( Yii::app()->request->isAjaxRequest )
							{
								echo CJSON::encode( array(
									'status'=>'success', 
									'div'=>'Sign up successfull, you can login now if you want',
									'title'=>'',
									));
								exit;             
							}
						else{
							  $this->redirect( array( 'view','id' => $model->id ) );
							}
					}
				}
		}

	if ( Yii::app()->request->isAjaxRequest ){
			echo CJSON::encode( array (
				'status'=>'render', 
				'div'=>$this->renderPartial('modalReg',array('model'=>$model),true,true),
				'title'=>'',
				) );
			             
		}else {
			$this->render('Reg',array(
			'model'=>$model,
			));
		}
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{	
            $model=new User;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model,"user-create-form");
            if(Yii::app()->request->isAjaxRequest)
	       {
		    if(isset($_POST['User']))
		    {
			    $model->attributes=$_POST['User'];
			    if($model->save())
			    {
			      echo $model->id;
			    }
			    else
			    {
			      echo "false";
			    } 
			    return;
		    }
	       }
	       else
	       {
	           if(isset($_POST['User']))
		    {
			    $model->attributes=$_POST['User'];
			    if($model->save())
			     $this->redirect(array('view','id'=>$model->id));
			
		    }
               
		    $this->render('create',array(
			    'model'=>$model,
		    ));
	       }	
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
      
	    $id=isset($_REQUEST["id"])?$_REQUEST["id"]:$_REQUEST["User"]["id"];
	    $model=$this->loadModel($id);
			    
	    // Uncomment the following line if AJAX validation is needed
	      $this->performAjaxValidation($model,"user-update-form");
	    
	  if(Yii::app()->request->isAjaxRequest)
	    {
	    
		if(isset($_POST['User']))
		{
		  
			$model->attributes=$_POST['User'];
			if($model->save())
			{
			  echo $model->id;
			}
			else
			{
			  echo "false";
			}
			return;
		}
		    
		  $this->renderPartial('_ajax_update_form',array(
		    'model'=>$model,
		    ));
		  return; 
	    
	    }
	    

	    if(isset($_POST['User']))
	    {
		    $model->attributes=$_POST['User'];
		    if($model->save())
			    $this->redirect(array('view','id'=>$model->id));
	    }

	    $this->render('update',array(
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
	        $id=$_POST["id"];
	   
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset(Yii::app()->request->isAjaxRequest))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			else
			   echo "true";
		}
		else
		{
		    if(!isset($_GET['ajax']))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		    else
			   echo "false"; 	
	        }	
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $session=new CHttpSession;
        $session->open();		
        $criteria = new CDbCriteria();            

        $model=new User('search');
        $model->unsetAttributes();  // clear any default values

        if(isset($_GET['User'])){
           $model->attributes=$_GET['User'];
       	
           if (!empty($model->id)) $criteria->addCondition('id = "'.$model->id.'"');
         
        	
           if (!empty($model->username)) $criteria->addCondition('username = "'.$model->username.'"');
         
        	
           if (!empty($model->password)) $criteria->addCondition('password = "'.$model->password.'"');
         
        	
           if (!empty($model->email)) $criteria->addCondition('email = "'.$model->email.'"');
         
        	
           if (!empty($model->profile)) $criteria->addCondition('profile = "'.$model->profile.'"');
         
        	
           if (!empty($model->role)) $criteria->addCondition('role = "'.$model->role.'"');
                     
                    			
		}
           $session['User_records']=User::model()->findAll($criteria); 

           $this->render('index',array(
			'model'=>$model,
		));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
       
}
