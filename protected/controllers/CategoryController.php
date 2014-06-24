<?php

class CategoryController extends Controller
{
    public $layout='//layouts/admin';
    public $menuActive = __CLASS__;// lay ten class luon cho menuactive
    public $action;
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/


    public function actionListCat(){
        //Khởi tạo đối tượng
        $modelCat = new Category();
        $modelUser = new User();
        //Truy vấn
        $listCat = $modelCat->findAll();

        //var_dump($listSubCat[0]);die;
        $listUser = $modelUser->findAll();
        //Show ra view
        $this->render('list_category',
            array('listCat'=>$listCat,'listUser' => $listUser,'listSubCat'=>$listSubCat)
        );
    }

    public function actionCreateCat(){
        $modelCat = new Category();
        $model_user = user::model();

        $list_user = $model_user->findAll();
        //$listCat = $modelCat->findAll();
        $listCat = $modelCat->findAllBySql('SELECT * FROM category WHERE parent_id IS NULL ');

        $this->render('create',
            array('list_user'=>$list_user,'listCat'=>$listCat)
        );
    }

    public function actionEditCat($id){
        $model = new Category();
        $modelCat = $model->findByPk($id);
        $modelUser = user::model();

        $listCat = $modelCat->findAll();
        $listUser = $modelUser->findAll();

        $editCat = $modelCat->findByPk($id);
        $editUser = $modelUser->findByPk($id);

        //var_dump($modelUser);die;
        $this->render('edit',array(
            'modelCat'=>$modelCat,
            'editCat'=>$editCat,
            'editUser'=>$editUser,
            'listCat'=>$listCat,
            'listUser'=>$listUser
        ));
    }
    public function actionSaveCat(){
        $model = new Category();
        $model->title_cat = $_POST['title_cat'];
        $model->Des_cat = $_POST['des_cat'];
        $model->user_id = $_POST['slUser'];
        $model->parent_id = $_POST['slParent'];

        $cookieTitle = $_POST['title_cat'];

        if($model->save()){
            session_start();
            setcookie("title","$cookieTitle",time() +3600);
            //session_register($cookieTitle);
            $_SESSION["title"] = $cookieTitle;
            $this->redirect(array('listCat'));
            Yii::app()->user->setFlash('success','Thêm mới thành công');
        }else{
            Yii::app()->user->setFlash('fail', Utils::setAllErrorsToArray($model->getErrors()));
            $this->redirect(array('createCat'));
        }
    }
    public function actionSearchCat(){

    }
    public function actionUpdateCat($id){
        $model = new Category();

        $updateCat = $model->findByPk($id);
//        var_dump($updateCat);die;
        $updateCat->title_cat = $_POST['title_cat'];
        $updateCat->Des_cat = $_POST['Des_cat'];
        $updateCat->user_id = $_POST['slUser'];
        $updateCat->parent_id = $_POST['slParrent'];

        if($updateCat->update()){
            $this->redirect(array('listCat'));
        }else{
            Yii::app()->user->setFlash('fail', Utils::setAllErrorsToArray($model->getErrors()));
            $this->redirect(array('create'));
        }
    }
    public function actionDeleteCat($id){
        $model = new Category();
        $deleteCat = $model->findByPk($id);

        if($deleteCat->delete()){
            Yii::app()->user->setFlash('del_success', "delete success!");
            $this->redirect(array('listCat'));
        }
    }
}