<?php

class TypeController extends Controller {

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public $layout='//layouts/admin';
    public $menuActive = __CLASS__;// lay ten class luon cho menuactive
    public $action;
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
        //Utils::delSession("model");
//        $this->action = __FUNCTION__;
        $this->render('create', array(
        ));
    }

    public function actionSave() {
        
        $model = new Type();
        $model->userName = $_POST['type_name'];
        // Utils::autoSetValueToObject($model, $_POST); //gan cac post
        if ($model->save()) {
//            $this->redirect(array('view', 'id' => $model->id));
            $this->redirect(array('list'));
        } else {
            
            Utils::setSession("model", $model);
            Yii::app()->user->setFlash('fail', Utils::setAllErrorsToArray($model->getErrors()));
            $this->redirect(array('create'));
        }
    }

    /** Edit
     * @param $id
     */
    public function actionEdit($id) {
        $this->action = __FUNCTION__;
        $model = $this->loadModel($id);
        $this->render('edit', array(
            'model' => $model,
        ));
    }

    public function actionUpdate() {
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $model = $this->loadModel($id);
        Utils::autoSetValueToObject($model, $_POST);
        if ($model->save()) {
            $this->redirect(array('view', 'id' => $model->id));
        } else {
            Utils::setSession("model", $model);
            Yii::app()->user->setFlash('fail', Utils::setAllErrorsToArray($model->getErrors()));
            $this->redirect(array('edit', 'id' => $id));
        }
    }

    public function actionList() {
        $this->action = __FUNCTION__;
        $type = new Type();

        // Cách 1 :
//        $criteria = new CDbCriteria();
//        $criteria->select = 'id';
//        $criteria->condition = 'id=:id ';
//        $criteria->params = array(':id'=>3);
//        $list_model = Type::model()->find($criteria);
//        var_dump($list_model);die;

        // Cách 2
        $list_model = $type->findAll();//SELECT * FROM Type
//        var_dump($list_model);die;
//        id = $type->findAll('id > 4');//SELECT * FROM Type
//        $list_model = $type->find('');//SELECT * FROM Type
//        $list_model = Type::model()->findBySql();
        $this->render("list", compact("list_model"));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if($this->loadModel($id)->delete()){
         Yii::app()->user->setFlash('del_success', "delete success!");
         $this->redirect(array('list'));
//        header('Location: http://localhost/demo/index.php?r=type/list');
        }
//        $this->redirect(array('list'));
    }

    public function actionAdmin() {
        $this->action = __FUNCTION__;
        $model = new Type;
        Utils::autoSetValueToObject($model, $_POST);
        $total = (int) $model->count_sql($model);
        $page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
        $pagination = Utils::paginate($total, $page);
        $list_model = $model->search_sql($model, $pagination);
        Utils::setSession("model", $model);
        $this->render("admin", compact("list_model", "pagination", "model"));
    }

    public function actionAjaxSearch() {
        $model = new Type;
        Utils::autoSetValueToObject($model, $_POST);
        $total = (int) $model->count_sql($model);
        $page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
        $pagination = Utils::paginate($total, $page);
        $list_model = $model->search_sql($model, $pagination);
        $this->renderPartial("test", compact("list_model", "pagination", "model"));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Type the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Type::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
