<?php

class LamaranController extends Controller {

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
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('pengumuman'),
                'expression' => '$user->isMember()',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('seleksiDokumen', 'seleksiLanjut'),
                'expression' => '$user->isSuperAdmin()',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('seleksiDokumen', 'seleksiLanjut'),
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
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Lamaran;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Lamaran'])) {
            $model->attributes = $_POST['Lamaran'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
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

        if (isset($_POST['Lamaran'])) {
            $model->attributes = $_POST['Lamaran'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Lamaran');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Lamaran('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Lamaran']))
            $model->attributes = $_GET['Lamaran'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionPengumuman() {
        //kalo belum lamar
        $pelamars = Lamaran::model()->findAllByAttributes(
                array('id_pelamar' => Yii::app()->user->id)
        );

        if (isset($_POST['Lamaran']['hasil_tugas'])) {

            $model = $this->loadModel($_POST['Lamaran']['id']);
            //buat cek kalo udah ada tugas sebelumnya hapus aja
            $tugasLama = $model->hasil_tugas;

            //ambil semua attribut yang di post
            $model->attributes = $_POST['Lamaran'];
            //ambil file
            $file = CUploadedFile::getInstance($model, 'hasil_tugas');
            $random = rand(0, 9999); //random angka untuk lebih secure dan ubah nama databasenya  
            if($file !=null)    
            $model->hasil_tugas = $model->id_pelamar . $random . "." . $file->extensionName;
            else
                Yii::app()->user->setFlash('notification', 'Tugas gagal di simpan. Pastikan file hasil tugas dalam format .pdf');
            $model->scenario = 'tugas';
            if ($model->save()) { //save model
                //hapus tugas yang lama
                if ($tugasLama != null) {
                    unlink(Yii::app()->basePath . '/../hasil_tugas/' . $tugasLama);
                }
                //save file tugas 
                $file->saveAs(Yii::app()->basePath . '/../hasil_tugas/' . $model->hasil_tugas);
                Yii::app()->user->setFlash('notification', 'Tugas anda berhasil di submit. Lihat di ' . CHtml::link('sini', array('lamaran/pengumuman')));
            } else {
                Yii::app()->user->setFlash('notification', 'Tugas gagal di simpan. Pastikan file hasil tugas dalam format .pdf');
            }
        }

        if (isset($_POST['Lamaran']['hasil_tugas2'])) {

            $model = $this->loadModel($_POST['Lamaran']['id']);
            //buat cek kalo udah ada tugas sebelumnya hapus aja
            $tugasLama = $model->hasil_tugas2;
            //ambil semua attribut yang di post
            $model->attributes = $_POST['Lamaran'];
            //ambil file
            $file = CUploadedFile::getInstance($model, 'hasil_tugas2');
            $random = rand(0, 9999); //random angka untuk lebih secure dan ubah nama databasenya      
            $model->hasil_tugas2 = $model->id_pelamar . $random . "." . $file->extensionName;
            $model->scenario = 'tugas2';
            if ($model->save()) { //save model
                //hapus tugas yang lama
                if ($tugasLama != null) {
                    unlink(Yii::app()->basePath . '/../hasil_tugas/' . $tugasLama);
                }
                //save file tugas 
                $file->saveAs(Yii::app()->basePath . '/../hasil_tugas/' . $model->hasil_tugas2);
                Yii::app()->user->setFlash('notification', 'Tugas 2 anda berhasil di submit. Lihat di ' . CHtml::link('sini', array('lamaran/pengumuman')));
            } else {
                Yii::app()->user->setFlash('notification', 'Tugas 2 gagal di simpan. Pastikan file hasil tugas dalam format .pdf');
            }
        }
        $this->render('pengumuman', array(
            'model' => $pelamars,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Lamaran the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Lamaran::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Lamaran $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'lamaran-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /*
     * untuk seleksi administrasi
     */

    public function actionSeleksiDokumen() {
        //ngeload semua pelamar yang masih dalam proses seleksi ( tahap masih null )
        //search list of lamaran where tahap is null
        //cek jika dia admin dan filter berdasarkan departemenennya
        $modelsL;
        //update filter yang null aja yang tampil
        if (Yii::app()->user->isAdmin()) {
            //cari departemen dan filter by departemen kalo dia admin
            $id = Yii::app()->user->id;
            $modelAdmin = Admin::model()->findByAttributes(array('id_user' => $id));
            $criteria = new CDbCriteria;
            $criteria->with = array('lowongan', 'pelamar');
            $criteria->condition = "id_lowongan_tahap is  null AND lowongan.departemen=:low";
            $criteria->params = array(':low' => $modelAdmin->departemen);

            $count = Lamaran::model()->count($criteria);
            $pages = new CPagination($count);
            // elements per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            // sorting
            $sort = new CSort('Lamaran');
            $sort->multiSort = true;
            $sort->attributes = array(
                'pelamarNama' => array(
                    'asc' => 'pelamar.nama',
                    'desc' => 'pelamar.nama DESC',
                    'label' => 'Nama',
                    'default' => 'desc',
                ),
                'pelamarSex' => array(
                    'asc' => 'pelamar.jenis_kelamin',
                    'desc' => 'pelamar.jenis_kelamin DESC',
                    'label' => 'Gender',
                    'default' => 'desc',
                ),
                'pelamarEdu' => array(
                    'asc' => 'pelamar.pendidikan',
                    'desc' => 'pelamar.pendidikan DESC',
                    'label' => 'Pendidikan',
                    'default' => 'desc',
                ),
                'pelamarUmur' => array(
                    'asc' => 'pelamar.umur',
                    'desc' => 'pelamar.umur DESC',
                    'label' => 'Umur',
                    'default' => 'desc',
                ),
                'pelamarStatus' => array(
                    'asc' => 'pelamar.status',
                    'desc' => 'pelamar.status DESC',
                    'label' => 'Status',
                ),
                'pelamarKota' => array(
                    'asc' => 'pelamar.kota',
                    'desc' => 'pelamar.kota DESC',
                    'label' => 'Kota',
                ),
                'pelamarGaji' => array(
                    'asc' => 'pelamar.gaji',
                    'desc' => 'pelamar.gaji DESC',
                    'label' => 'gaji',
                ),
                'lowonganNama' => array(
                    'asc' => 'lowongan.nama',
                    'desc' => 'lowongan.nama DESC',
                    'label' => 'Lowongan',
                    'default' => 'desc',
                ),
            );
            $sort->applyOrder($criteria);
            $modelsL = Lamaran::model()->with('lowongan')->findAll($criteria);
        } else {
            $criteria = new CDbCriteria;
            $criteria->condition = 'id_lowongan_tahap is  null';
            $criteria->with = array('lowongan', 'pelamar');

            $count = Lamaran::model()->count($criteria);
            $pages = new CPagination($count);
            // elements per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            // sorting
            $sort = new CSort('Lamaran');
            $sort->multiSort = true;
            $sort->attributes = array(
                'pelamarNama' => array(
                    'asc' => 'pelamar.nama',
                    'desc' => 'pelamar.nama DESC',
                    'label' => 'Nama',
                    'default' => 'desc',
                ),
                'pelamarSex' => array(
                    'asc' => 'pelamar.jenis_kelamin',
                    'desc' => 'pelamar.jenis_kelamin DESC',
                    'label' => 'Gender',
                    'default' => 'desc',
                ),
                'pelamarEdu' => array(
                    'asc' => 'pelamar.pendidikan',
                    'desc' => 'pelamar.pendidikan DESC',
                    'label' => 'Pendidikan',
                    'default' => 'desc',
                ),
                'pelamarUmur' => array(
                    'asc' => 'pelamar.umur',
                    'desc' => 'pelamar.umur DESC',
                    'label' => 'Umur',
                    'default' => 'desc',
                ),
                'pelamarStatus' => array(
                    'asc' => 'pelamar.status',
                    'desc' => 'pelamar.status DESC',
                    'label' => 'Status',
                ),
                'pelamarKota' => array(
                    'asc' => 'pelamar.kota',
                    'desc' => 'pelamar.kota DESC',
                    'label' => 'Kota',
                ),
                'pelamarGaji' => array(
                    'asc' => 'pelamar.gaji',
                    'desc' => 'pelamar.gaji DESC',
                    'label' => 'gaji',
                ),
                'lowonganNama' => array(
                    'asc' => 'lowongan.nama',
                    'desc' => 'lowongan.nama DESC',
                    'label' => 'Lowongan',
                    'default' => 'desc',
                ),
            );
            $sort->applyOrder($criteria);
            $modelsL = Lamaran::model()->findAll($criteria);
        }

        //kalo ada post maka simpan update nya
        if (isset($_POST['Lamaran'])) {
            $valid = true;
            foreach ($_POST['Lamaran'] as $j => $modelp) {
                //kalo pengalaman kerja oke
                if (isset($_POST['Lamaran'][$j])) {
                    $modelsL[$j]->attributes = $modelp;
                    //$valid = $modelsL[$j]->validate() && $valid;
                }
            }
            if ($valid) {
                $i = 0;
                while (isset($modelsL[$i])) {
                    if ($modelsL[$i]->id_lowongan_tahap != 0)
                        $modelsL[$i]->save(false); // models have already been validated
                    $i++;
                }
            }
        }
        //update filter yang null aja yang tampil
        if (Yii::app()->user->isAdmin()) {
            //cari departemen dan filter by departemen kalo dia admin
            $id = Yii::app()->user->id;
            $modelAdmin = Admin::model()->findByAttributes(array('id_user' => $id));
            $criteria = new CDbCriteria;
            $criteria->with = array('lowongan', 'pelamar');
            $criteria->condition = "id_lowongan_tahap is  null AND lowongan.departemen=:low";
            $criteria->params = array(':low' => $modelAdmin->departemen);

            $count = Lamaran::model()->count($criteria);
            $pages = new CPagination($count);
            // elements per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            // sorting
            $sort = new CSort('Lamaran');
            $sort->multiSort = true;
            $sort->attributes = array(
                'pelamarNama' => array(
                    'asc' => 'pelamar.nama',
                    'desc' => 'pelamar.nama DESC',
                    'label' => 'Nama',
                    'default' => 'desc',
                ),
                'pelamarSex' => array(
                    'asc' => 'pelamar.jenis_kelamin',
                    'desc' => 'pelamar.jenis_kelamin DESC',
                    'label' => 'Gender',
                    'default' => 'desc',
                ),
                'pelamarEdu' => array(
                    'asc' => 'pelamar.pendidikan',
                    'desc' => 'pelamar.pendidikan DESC',
                    'label' => 'Pendidikan',
                    'default' => 'desc',
                ),
                'pelamarUmur' => array(
                    'asc' => 'pelamar.umur',
                    'desc' => 'pelamar.umur DESC',
                    'label' => 'Umur',
                    'default' => 'desc',
                ),
                'pelamarStatus' => array(
                    'asc' => 'pelamar.status',
                    'desc' => 'pelamar.status DESC',
                    'label' => 'Status',
                ),
                'pelamarKota' => array(
                    'asc' => 'pelamar.kota',
                    'desc' => 'pelamar.kota DESC',
                    'label' => 'Kota',
                ),
                'pelamarGaji' => array(
                    'asc' => 'pelamar.gaji',
                    'desc' => 'pelamar.gaji DESC',
                    'label' => 'gaji',
                ),
                'lowonganNama' => array(
                    'asc' => 'lowongan.nama',
                    'desc' => 'lowongan.nama DESC',
                    'label' => 'Lowongan',
                    'default' => 'desc',
                ),
            );
            $sort->applyOrder($criteria);
            $modelsL = Lamaran::model()->with('lowongan')->findAll($criteria);
        } else {
            $criteria = new CDbCriteria;
            $criteria->condition = 'id_lowongan_tahap is  null';
            $criteria->with = array('lowongan', 'pelamar');

            $count = Lamaran::model()->count($criteria);
            $pages = new CPagination($count);
            // elements per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            // sorting
            $sort = new CSort('Lamaran');
            $sort->multiSort = true;
            $sort->attributes = array(
                'pelamarNama' => array(
                    'asc' => 'pelamar.nama',
                    'desc' => 'pelamar.nama DESC',
                    'label' => 'Nama',
                    'default' => 'desc',
                ),
                'pelamarSex' => array(
                    'asc' => 'pelamar.jenis_kelamin',
                    'desc' => 'pelamar.jenis_kelamin DESC',
                    'label' => 'Gender',
                    'default' => 'desc',
                ),
                'pelamarEdu' => array(
                    'asc' => 'pelamar.pendidikan',
                    'desc' => 'pelamar.pendidikan DESC',
                    'label' => 'Pendidikan',
                    'default' => 'desc',
                ),
                'pelamarUmur' => array(
                    'asc' => 'pelamar.umur',
                    'desc' => 'pelamar.umur DESC',
                    'label' => 'Umur',
                    'default' => 'desc',
                ),
                'pelamarStatus' => array(
                    'asc' => 'pelamar.status',
                    'desc' => 'pelamar.status DESC',
                    'label' => 'Status',
                ),
                'pelamarKota' => array(
                    'asc' => 'pelamar.kota',
                    'desc' => 'pelamar.kota DESC',
                    'label' => 'Kota',
                ),
                'pelamarGaji' => array(
                    'asc' => 'pelamar.gaji',
                    'desc' => 'pelamar.gaji DESC',
                    'label' => 'gaji',
                ),
                'lowonganNama' => array(
                    'asc' => 'lowongan.nama',
                    'desc' => 'lowongan.nama DESC',
                    'label' => 'Lowongan',
                    'default' => 'desc',
                ),
            );
            $sort->applyOrder($criteria);
            $modelsL = Lamaran::model()->findAll($criteria);
        }
        $this->render('seleksi1', array(
            'modelsL' => $modelsL, 'pages' => $pages, 'sort' => $sort, // 'modelsP' => $modelsP,
        ));
    }

    public function actionSeleksiLanjut() {
        //ngeload semua pelamar yang masih dalam proses seleksi ( tahap masih null )
        //search list of lamaran where tahap is null
        //untuk pagination
        $pages;
        //ngeload semua pelamar yang masih dalam proses seleksi ( tahap masih null )
        //search list of lamaran where tahap is null
        if (Yii::app()->user->isAdmin()) {
            //cari departemen dan filter by departemen kalo dia admin
            $id = Yii::app()->user->id;
            $modelAdmin = Admin::model()->findByAttributes(array('id_user' => $id));
            $criteria = new CDbCriteria;
            $criteria->with = array('lowongan', 'pelamar');
            $criteria->condition = "id_lowongan_tahap is not null AND lowongan.departemen=:low";
            $criteria->params = array(':low' => $modelAdmin->departemen);

            $count = Lamaran::model()->count($criteria);
            $pages = new CPagination($count);
            // elements per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            // sorting
            $sort = new CSort('Lamaran');
            $sort->multiSort = true;
            $sort->attributes = array(
                'pelamarNama' => array(
                    'asc' => 'pelamar.nama',
                    'desc' => 'pelamar.nama DESC',
                    'label' => 'Nama',
                    'default' => 'desc',
                ),
                'lowonganNama' => array(
                    'asc' => 'lowongan.nama',
                    'desc' => 'lowongan.nama DESC',
                    'label' => 'Lowongan',
                    'default' => 'desc',
                ),
            );
            $sort->applyOrder($criteria);
            $modelsL = Lamaran::model()->with('lowongan')->findAll($criteria);
        } else {
            $criteria = new CDbCriteria;
            $criteria->condition = 'id_lowongan_tahap is not null';
            $criteria->with = array('lowongan', 'pelamar');

            $count = Lamaran::model()->count($criteria);
            $pages = new CPagination($count);
            // elements per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            // sorting
            $sort = new CSort('Lamaran');
            $sort->multiSort = true;
            $sort->attributes = array(
                'pelamarNama' => array(
                    'asc' => 'pelamar.nama',
                    'desc' => 'pelamar.nama DESC',
                    'label' => 'Nama',
                    'default' => 'desc',
                ),
                'lowonganNama' => array(
                    'asc' => 'lowongan.nama',
                    'desc' => 'lowongan.nama DESC',
                    'label' => 'Lowongan',
                    'default' => 'desc',
                ),
            );
            $sort->applyOrder($criteria);
            $modelsL = Lamaran::model()->findAll($criteria);
        }
        //cari semua tahap untuk membuat header
        $modelsT = Tahap::model()->findAll();

        //kalo ada post maka simpan update nya
        if (isset($_POST['Lamaran'])) {
            $valid = true;
            foreach ($_POST['Lamaran'] as $j => $modelp) {
                //kalo ada lamaran index j
                if (isset($_POST['Lamaran'][$j])) {
                    //ambil id_lowongan_tahap array dari checklist
                    $id_low_taps = $_POST['Lamaran'][$j]['id_lowongan_tahap'];
                    $tahapClicked = 0;
                    //cari lowongan_tahap yang dicek paling akhir
                    foreach ($id_low_taps as $low_tahap) {
                        if ($low_tahap != 0) {
                            $tahapClicked = $low_tahap;
                        }
                    }
                    //set attribut dengan yang baru
                    $modelsL[$j]->attributes = $modelp;
                    $modelsL[$j]->id_lowongan_tahap = $tahapClicked;
                    //$valid = $modelsL[$j]->validate() && $valid;
                }
            }
            //save lamaran 
            if ($valid) {
                $i = 0;
                while (isset($modelsL[$i])) {
                    if ($modelsL[$i]->id_lowongan_tahap != 0)
                        $modelsL[$i]->save(false); // models have already been validated
                    $i++;
                }
            }
        }
        //untuk pagination
        $pages;
        //ngeload semua pelamar yang masih dalam proses seleksi ( tahap masih null )
        //search list of lamaran where tahap is null
        if (Yii::app()->user->isAdmin()) {
            //cari departemen dan filter by departemen kalo dia admin
            $id = Yii::app()->user->id;
            $modelAdmin = Admin::model()->findByAttributes(array('id_user' => $id));
            $criteria = new CDbCriteria;
            $criteria->with = array('lowongan', 'pelamar');
            $criteria->condition = "id_lowongan_tahap is not null AND lowongan.departemen=:low";
            $criteria->params = array(':low' => $modelAdmin->departemen);

            $count = Lamaran::model()->count($criteria);
            $pages = new CPagination($count);
            // elements per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            // sorting
            $sort = new CSort('Lamaran');
            $sort->multiSort = true;
            $sort->attributes = array(
                'pelamarNama' => array(
                    'asc' => 'pelamar.nama',
                    'desc' => 'pelamar.nama DESC',
                    'label' => 'Nama',
                    'default' => 'desc',
                ),
                'lowonganNama' => array(
                    'asc' => 'lowongan.nama',
                    'desc' => 'lowongan.nama DESC',
                    'label' => 'Lowongan',
                    'default' => 'desc',
                ),
            );
            $sort->applyOrder($criteria);
            $modelsL = Lamaran::model()->with('lowongan')->findAll($criteria);
        } else {
            $criteria = new CDbCriteria;
            $criteria->condition = 'id_lowongan_tahap is not null';
            $criteria->with = array('lowongan', 'pelamar');

            $count = Lamaran::model()->count($criteria);
            $pages = new CPagination($count);
            // elements per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            // sorting
            $sort = new CSort('Lamaran');
            $sort->multiSort = true;
            $sort->attributes = array(
                'pelamarNama' => array(
                    'asc' => 'pelamar.nama',
                    'desc' => 'pelamar.nama DESC',
                    'label' => 'Nama',
                    'default' => 'desc',
                ),
                'lowonganNama' => array(
                    'asc' => 'lowongan.nama',
                    'desc' => 'lowongan.nama DESC',
                    'label' => 'Lowongan',
                    'default' => 'desc',
                ),
            );
            $sort->applyOrder($criteria);
            $modelsL = Lamaran::model()->findAll($criteria);
        }
        //temukan semua tahap untuk di jadikan header
        $modelsT = Tahap::model()->findAll();

        $this->render('seleksi2', array(
            'modelsL' => $modelsL, 'modelsT' => $modelsT, 'pages' => $pages, 'sort' => $sort,
        ));
    }

}
