<?php

class LowonganController extends Controller {

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
        //untuk validasi admin yg boleh akses hanya yg sesuai departemennya
        $self = 'sopo';
        $id = Yii::app()->request->getParam('id');
        if ($id != null)
            $self = $this->getSelfAccess($id);
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('apply'),
                'expression' => '$user->isMember()',
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('admin', 'create'),
                'expression' => '$user->isAdmin()',
            ),
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('admin','create'),
                'expression' => '$user->isSuperAdmin()',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array( 'delete', 'update'),
                'users' => array($self),
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
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Lowongan;
        $rendertahap2 = false;
        // nyari semua tahap yang ada dalam database
        $tahaps = Tahap::model()->findAll();
        $sss = null; //untuk file
        if (isset($_POST['LowonganTahap'])) {
            $lowonganTahapsMasuk = array();
            $valid = true;
            //nyari LowonganTahap satu satu
            foreach ($_POST['LowonganTahap'] as $j => $modelp) {
                if (isset($_POST['LowonganTahap'][$j])) {
                    //inisialisasi
                    $lowonganTahapsMasuk[$j] = LowonganTahap::model();
                    $lowonganTahapsMasuk[$j] = new LowonganTahap; // if you had static model only
                    $lowonganTahapsMasuk[$j]->attributes = $modelp;
                  if (strlen(trim(CUploadedFile::getInstance($lowonganTahapsMasuk[$j], "[$j]file_tugas"))) > 0) {
                        $sss = CUploadedFile::getInstance($lowonganTahapsMasuk[$j], "[$j]file_tugas");
                        $lowonganTahapsMasuk[$j]->file_tugas = $lowonganTahapsMasuk[$j]->id_lowongan . '-' . $lowonganTahapsMasuk[$j]->id_tahap . '.pdf';
                    }
                    $fileValidasi = false;
                    if (isset($_FILES['LowonganTahap'])) {
                        if($_FILES['LowonganTahap']['name'][$j]!=null)
                        $extension = end(explode(".", $_FILES['LowonganTahap']['name'][$j]['file_tugas']));
                        if ($extension == "pdf" || $_FILES['LowonganTahap']['type'][$j]['file_tugas'] == null) {
                            $fileValidasi = true;
                        }
                    }
                    $valid = $lowonganTahapsMasuk[$j]->validate() && $valid && $fileValidasi;
                }
            }

            if ($valid) {
                $i = 0;
                $oke=false;
                while (isset($lowonganTahapsMasuk[$i])) {
                    $lowonganTahapsMasuk[$i]->save(false); // models have already been validated    
                    if (strlen(trim($lowonganTahapsMasuk[$i]->file_tugas)) > 0) {
                        $sss->saveAs(Yii::app()->basePath . '/../file_tugas/' . $lowonganTahapsMasuk[$i]->file_tugas);
                    }
                    $i++;
                    $oke = true;
                }
                if($oke)
                Yii::app()->user->setFlash('alert-info', 'Lowongan berhasil di buat !');
            } else {
                Yii::app()->user->setFlash('alert-danger', 'Lowongan gagal di simpan. Pastikan sesuai format !');
                $rendertahap2 = true;
                $this->render('createLowonganTahap', array(
                    'idLowongan' => $model->id, 'tahaps' => $lowonganTahapsMasuk,
                ));
            }
        }
        if (isset($_POST['Lowongan'], $_POST['Tahap'])) {
            $model->attributes = $_POST['Lowongan'];
            //$model->new = 1;
            $nol = 0;
            $tahapValid = true;
            //nyari tahap apa aja yang di pilih
            foreach ($_POST['Tahap'] as $j => $modelp)
            //kalo tahap ada
                if (isset($_POST['Tahap'][$j]))
                //kalo check bok yang dikosongi
                    if ($modelp['nama'] == 0)
                        $nol++;
            //berarti ga ada yg dicek
            if ($nol == 5) {
                $tahapValid = false;
                Yii::app()->user->setFlash('alert-danger', 'Silahkan pilih tahap minimal 1');
            }
            if ($tahapValid && $model->save()) {
                $lowonganTahaps = array();
                $valid = true;
                //nyari tahap apa aja yang di pilih
                foreach ($_POST['Tahap'] as $j => $modelp) {
                //kalo tahap ada 
                    if (isset($_POST['Tahap'][$j])) {
                        //kalo check bok yang dicentang aja yang dibuat objek
                        if ($modelp['nama'] == 1) {
                            $lowonganTahaps[$j] = lowonganTahap::model();
                            $lowonganTahaps[$j] = new lowonganTahap; // if you had static model only
                            $lowonganTahaps[$j]->attributes = $modelp;
                            $lowonganTahaps[$j]->id_lowongan = $model->id;
                            $lowonganTahaps[$j]->id_tahap = $modelp['id'];
                        }
                    }
                }
                $this->render('createLowonganTahap', array(
                    'idLowongan' => $model->id, 'tahaps' => $lowonganTahaps,
                ));
                $rendertahap2 = true;
            }
        }
        //load tahaps
        //kalo ngga load rander tahap2
        if (!$rendertahap2) {
            $this->render('create', array(
                'model' => $model, 'tahaps' => $tahaps,
            ));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Lowongan'])) {
            $model->attributes = $_POST['Lowongan'];
            if ($model->save()) {
                Yii::app()->user->setFlash('notification', "Sukses update Lowongan " . $model->nama);
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $this->loadModel($id)->delete();
        if (!isset($_GET['ajax']))
            Yii::app()->user->setFlash('success', 'Lowongan ' . $model->nama . ' berhasil di delete');
        else
            echo "<div class='alert alert-info'>Lowongan " . $model->nama . " berhasil di delete</div>";
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Lowongan');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Lowongan('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Lowongan']))
            $model->attributes = $_GET['Lowongan'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * apply 
     */
    public function actionApply($id) {
    //cek udah isi data diri belum
    //jika belum lempar ke isi data diri
        $userID = Yii::app()->user->id;
        $pelamar = Pelamar::model()->findByPk($userID);
        if ($pelamar == null) {
            Yii::app()->user->setFlash('notification', 'Silahkan isi data diri dahulu sebelum apply lowongan');
            $this->redirect(array('pelamar/create'));
        } else {
            $apply = new Lamaran();
            $apply->id_pelamar = $userID;
            $apply->id_lowongan = $id;
            $apply->insert();
            Yii::app()->user->setFlash('notification', 'Selamat anda sudah berhasil apply lowongan');
            $this->redirect(array('lowongan/view', 'id' => $id));
        }
        //jika udah maka simpan ke dalam lamaran    
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Lowongan the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Lowongan::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Lowongan $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'lowongan-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function getSelfAccess($id) {
        $allow;

        if (!Yii::app()->user->isGuest) { //if it is user, check if it is self
            //belum di
            $idUser = Yii::app()->user->id;
            $modelUser = User::model()->findByPk($idUser);

            if ($modelUser->level_id == 2) {
                $allow = Yii::app()->user->getName();
            } elseif ($modelUser->level_id == 1) {
                //jika dia admin maka periksa di departemennya cocok ga
                //cari departemen
                $modelAdmin = Admin::model()->findByAttributes(array('id_user' => $idUser));
                $modelLowongan = $this->loadModel($id);
                if ($modelAdmin->departemen == $modelLowongan->departemen) {
                    $allow = Yii::app()->user->getName();
                }
            }
        }
        if (!empty($allow)) {
            return $allow;
        } else {
            return false;
        }
    }

}
