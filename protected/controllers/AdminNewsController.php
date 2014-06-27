<?php

class AdminNewsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/admin';
    public $menuActive = __CLASS__;// lay ten class luon cho menuactive
    public $action;


    public function actionIndex(){
        $this->render('index');
    }
    /**
     * Lists News in Category.
     */
    public function actionListNews(){
        $model = new news();
        $modelCat = new Category();

        $listNews = $model->findAll(array('order'=>'id DESC'));
        $listAllCat = $modelCat->findAllBySql('SELECT * FROM category WHERE parent_id is NULL');

        $this->render('listNews',array('listNews'=>$listNews,'listAllCat'=>$listAllCat));
    }



    public function actionCreate(){
        $model = new News();
        $modelUser = new User();
        $modelCat = new Category();

        $listUser = $modelUser->findAll();
        $listCat = $modelCat->findAll();

        $this->render('createNews',array('listUser'=>$listUser,'listCat'=>$listCat));
    }

    public function actionSave(){
        ob_start();
        $dcm = new News();

        $dcm->title = $_POST['title'];
        $dcm->content = $_POST['content'];
        $dcm->user_id = $_POST['slUser'];
        $dcm->catid = $_POST['slParent'];
        $dcm->pub_time = $_POST['pubdate'];
        $dcm->thumb = 'upload/'.date('Ymd',time()).'/'.time().$_FILES['thumbNews']['name'];

        /*Upload Image*/
        $uploadThumb = Utils::uploadAvarta('thumbNews');
        /*End*/

        if($dcm->save()){
            $this->redirect(array('listNews'));
            Yii::app()->user->setFlash('success','Thêm mới thành công');
        }else{
            Yii::app()->user->setFlash('fail', Utils::setAllErrorsToArray($dcm->getErrors()));
            $this->redirect(array('createNews'));
        }
        ob_flush();
    }
    public function actionEdit($id){
        $modelNews = new News;
        $modelCat = new Category;
        $modelUser = new User();

        $listUser = $modelUser->findAll();
        $listCat = $modelCat->findAll();

        $editUser = $modelUser->findByPk($id);
        $editNews = $modelNews->findByPk($id);

        $this->render('editNews',array('listUser'=>$listUser,'listCat'=>$listCat,'editUser'=>$editUser,'editNews'=>$editNews));
    }
    public function actionUpdate($id){
        ob_start();
        $modelNews = new News;
        $modelCat = new Category;
        $modelUser = new User();

        $updateNews = $modelNews->findByPk($id);
        $updateNews->title = $_POST['title'];
        $updateNews->content = $_POST['content'];
        $updateNews->user_id = $_POST['slUser'];
        $updateNews->catid = $_POST['slParent'];
        $updateNews->pub_time = $_POST['pubdate'];
        $updateNews->thumb = 'upload/'.date('Ymd',time()).'/'.time().$_FILES['thumbNews']['name'];

        $updateImg = Utils::uploadAvarta('thumbNews');

        if($updateNews->update()){
            $this->redirect(array('listNews'));
            Yii::app()->user->setFlash('success','Sửa thành công');
        }else{
            Yii::app()->user->setFlash('fail', Utils::setAllErrorsToArray($dcm->getErrors()));
            $this->redirect(array('createNews'));
        }
        ob_flush();
    }
    public function actionDelete($id){
        $model = News::model()->findByPk($id);
        if($model->delete()){
           /* echo '<pre>';
            var_dump($model);
            echo '</pre>';*/
            $this->redirect(array('listNews'));
            Yii::app()->user->setFlash('success','Xóa Thành công');
        };
    }

    public function actionFilterNews($catid){
        $model = new news();
        $modelCat = new Category();
        $user_info = User::getUsernameFromID($model->user_id);
        if($user_info){
            $user_info[0]->display_name;
        }

        //$listParentCatid = $modelCat->findAllbySQl('SELECT * FROM category WHERE parent_id = "'. $parent_id .'"');
        $listParentCatid = Category::getAllSubCat($catid);
        if($listParentCatid) {
        $sub = array();
        foreach($listParentCatid as $parent) {
            $sub[] = $parent->in;
/*            echo '<pre>';
                var_dump($sub);die;
            echo '</pre>';*/
        }
        $sub_string = implode(',',$sub);
            $listNewsById = $model->findAllbySQl('SELECT * FROM news WHERE catid IN ('.$catid.','.$sub_string.')');
        } else {
            $listNewsById = $model->findAllbySQl('SELECT * FROM news WHERE catid IN ('.$catid.')');
        }

        $html='';
        $html .='<table id="sample-table-2" class="table table-striped table-bordered table-hover">';
        $html .='</thead>';
        $html .='<th width="5%">STT</th>';
        $html .='<th width="10%">Thumbnail</th>';
        $html .='<th width="50%">Tiêu đề</th>';
        $html .='<th width="5%">Status</th>';
        $html .='<th width="10%">Ngày tạo</th>';
        $html .='<th width="10%">Người tạo</th>';
        $html .='<th width="10%">Action</th>';
        $html .='</thead>';
        $html .='<tbody>';
        foreach($listNewsById as $key => $value){
            $html .= '<tr>';
            $html .= '<td>'. $key .'</td>';
            $html .= '<td><img src="'.$value->thumb.'" width="50" alt="" /></td>';
            $html .= '<td>'. $value->title .'</td>';
            $html .= '<td> status </td>';
            $html .= '<td>'. $value->pub_time .'</td>';
            $html .= '<td>'. $user_info .'</td>';
            $html .= '<td> Action </td>';
            $html .= '</tr>';
        }
        $html .='</tbody>';
        $html .='</table>';
        echo $html;
        return $listNewsById;
        //var_dump($listNewsById[2]);die;
    }


}
