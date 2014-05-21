<?php
//GA DIPAKE
class LowonganTahapController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
			
			// array('allow', // allow authenticated user to perform 'create' and 'update' actions
			// 	'actions'=>array('create','update'),
			// 	'users'=>array('@'),
			// ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'createBatch'),
				'expression'=>'$user->isSuperAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'createBatch'),
				'expression'=>'$user->isAdmin()',
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
		$model=new LowonganTahap;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LowonganTahap']))
		{
			$model->attributes=$_POST['LowonganTahap'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

		/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateBatch()
	{
		$jumlahTahap = count($tahaps);
		$model= array();
		$i=0;
		    while($i<$jumlahTahap) {
		        $model[$i]=LowonganTahap::model();
		        $i++;
		    }
		if(isset($_POST['LowonganTahap']))
		{
					//nyimpan array  LowonganTahap
		            $valid=true;
				        foreach ($_POST['LowonganTahap'] as $j=>$modelp) {
				        	//kalo LowonganTahap oke
				            if (isset($_POST['LowonganTahap'][$j])) {
				            	//inisialisasi
				                $monde[$j]=new LowonganTahap; // if you had static model only
				                $model[$j]->attributes=$modelp;
				                $model[$j]->id_lowongan = $idLowongan;
				                $valid=$model[$j]->validate() && $valid;
				            }
				        }
				        if ($valid) {
				            $i=0;
				            while (isset($model[$i])) {
				            	$model[$i++]->save(false);// models have already been validated
				            }
				           // trigger_error(" save pengalamans");
				                
				        }
				        $this->redirect(array('view','id'=>$model->id));	
		}
		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['LowonganTahap']))
		{
			$model->attributes=$_POST['LowonganTahap'];
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
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('LowonganTahap');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LowonganTahap('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LowonganTahap']))
			$model->attributes=$_GET['LowonganTahap'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return LowonganTahap the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=LowonganTahap::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param LowonganTahap $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='lowongan-tahap-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
