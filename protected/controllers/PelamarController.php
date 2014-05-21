<?php

class PelamarController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        //untuk validasi hanya user yang berkah mengakses data dirinya
        $id = Yii::app()->request->getParam('id');
        $self = $this->getSelfAccess($id);
        return array(
            array('allow', // allow authenticated user to perform update and view actions
                'actions' => array('update', 'view'),
                'users' => array($self),
            ),
            array('allow', // allow authenticated user to perform 'create'  actions
                'actions' => array('create'),
                'users' => array('@'),
            ),
            array('allow', // allow super admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'index', 'delete', 'view', 'update'),
                'expression' => '$user->isSuperAdmin()',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'index', 'delete', 'view', 'update'),
                'expression' => '$user->isAdmin()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $pengalamans = $this->loadModelPengalaman($id);
        $this->render('view', array(
            'model' => $this->loadModel($id), 'pengalamans' => $pengalamans
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Pelamar;
        //objek pengalaman kerja
        $pengalamans = array();


        if (isset($_POST['Pelamar'])) {
            $model->attributes = $_POST['Pelamar'];
            $sss;

            //nyari dimana gambar  
            if (strlen(trim(CUploadedFile::getInstance($model, 'cv'))) > 0) {
                $sss = CUploadedFile::getInstance($model, 'cv');
                $model->id = Yii::app()->user->id;
                $model->cv = $model->id . '.' . $sss->extensionName;
            }
            if ($model->validate()) {
                //save gambar
                if (strlen(trim($model->cv)) > 0)
                    $sss->saveAs(Yii::app()->basePath . '/../cv/' . $model->cv);

                //nyimpan array  pengalaman kerja
                $valid = true;
                //nyari pengalaman kerja satu satu
                if(isset($_POST['PengalamanKerja'])) {
                    foreach ($_POST['PengalamanKerja'] as $j => $modelp) {
                        //kalo pengalaman kerja oke
                        if (isset($_POST['PengalamanKerja'][$j])) {
                            //inisialisasi
                            $pengalamans[$j] = new PengalamanKerja(); // if you had static model only
                            $pengalamans[$j]->attributes = $modelp;
                            $pengalamans[$j]->id_pelamar = $model->id;
                            $valid = $pengalamans[$j]->validate() && $valid;
                        }
                    }
                }
                if ($valid) {
                    $model->save();
                    $i = 0;
                    while (isset($pengalamans[$i])) {
                        $pengalamans[$i++]->save(false); // models have already been validated
                    }
                    // belum di cek
                    Yii::app()->user->setFlash('success', 'Pelamar '.$model->nama.' berhasil di buat');
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model, 'pengalamans' => $pengalamans,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $pengalamans = $this->loadModelPengalaman($id);
        $temptcv = $model->cv;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Pelamar'])) {

            $model->attributes = $_POST['Pelamar'];
            //biar lolos falidasi
            $noDelete = false;
            if ($_FILES['Pelamar']['name']['cv'] == "") {
                $noDelete = true;
                $_FILES['Pelamar']['error']['cv'] = 0;
                $_FILES['Pelamar']['type']['cv'] = "pdf";
                $_FILES['Pelamar']['name']['cv'] = $temptcv;
            }
            $sss = CUploadedFile::getInstance($model, 'cv');
            //$model->cv = $model->id . '.' . $sss->extensionName;
            if (!empty($sss)) {
                if (!$noDelete) {
                    unlink(Yii::app()->basePath . '/../cv/' . $model->cv);
                }
                $model->cv = $model->id . '.' . $sss->extensionName;
            }
            if ($model->validate()) {
                if (!$noDelete)
                    $sss->saveAs(Yii::app()->basePath . '/../cv/' . $model->cv);
                //nyimpan array  pengalaman kerja
                $valid = true;
                //nyari pengalaman kerja satu satu
                if (isset($_POST['PengalamanKerja'])) {
                    foreach ($_POST['PengalamanKerja'] as $j => $modelp) {
                        //kalo pengalaman kerja oke
                        if (isset($_POST['PengalamanKerja'][$j])) {
                            if (empty($pengalamans[$j]))
                                $pengalamans[$j] = new PengalamanKerja();
                            //inisialisasi
                            //$pengalamans[$j]=new PengalamanKerja; // if you had static model only
                            // $pengalamans[$j]->attributes = $modelp;
                            $pengalamans[$j]->nama_perusahaan = $_POST['PengalamanKerja'][$j]['nama_perusahaan'];
                            $pengalamans[$j]->gaji_terkahir = $_POST['PengalamanKerja'][$j]['gaji_terkahir'];
                            $pengalamans[$j]->tanggal_mulai = $_POST['PengalamanKerja'][$j]['tanggal_mulai'];
                            $pengalamans[$j]->tanggal_akhir = $_POST['PengalamanKerja'][$j]['tanggal_akhir'];
                            $pengalamans[$j]->posisi = $_POST['PengalamanKerja'][$j]['posisi'];
                            $pengalamans[$j]->jenis = $_POST['PengalamanKerja'][$j]['jenis'];
                            $pengalamans[$j]->alasan_berhenti = $_POST['PengalamanKerja'][$j]['alasan_berhenti'];
                            $pengalamans[$j]->id_pelamar = $model->id;
                            $valid = $pengalamans[$j]->validate() && $valid;
                        }
                    }
                }
                //kalo semua valid baru di simpan
                if ($valid) {
                    $model->save();
                    $i = 0;
                    while (isset($pengalamans[$i])) {
                        $pengalamans[$i++]->save(false); // models have already been validated
                    }
                    Yii::app()->user->setFlash('success', 'Pelamar '.$model->nama.' berhasil di edit');
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('update', array(
            'model' => $model, 'pengalamans' => $pengalamans,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        unlink(Yii::app()->basePath . '/../cv/' . $model->cv);
        $this->loadModel($id)->delete();
        if (!isset($_GET['ajax']))
            Yii::app()->user->setFlash('success', 'Pelamar '.$model->nama.' berhasil di delete');
        else
            echo "<div class='alert alert-info'>Pelamar ".$model->nama. " berhasil di delete</div>";
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Pelamar');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Pelamar('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Pelamar']))
            $model->attributes = $_GET['Pelamar'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Pelamar the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Pelamar::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelPengalaman($id) {
        $model = PengalamanKerja::model()->findAllByAttributes(array('id_pelamar' => $id));
        if ($model === null)
            throw new CHttpException(404, 'The requested Pengalaman does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Pelamar $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pelamar-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function getSelfAccess($id) {
        $allow;

        if (!Yii::app()->user->isGuest) { //if it is user, check if it is self
            if ($id == Yii::app()->user->id)
            //return true;
                $allow = Yii::app()->user->getName();
        }
        if (!empty($allow)) {
            return $allow;
        } else {
            return false;
        }
    }

}
