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

        $listNews = $model->findAll(array('order'=>'pub_time ASC'));
        $listAllCat = $modelCat->findAllBySql('SELECT * FROM category WHERE parent_id is NULL');

        $this->render('listNews',array('listNews'=>$listNews,'listAllCat'=>$listAllCat));
    }



    public function actionCreate(){
        $model = new News();
        $modelUser = new User();
        $modelCat = new Category();

        $listUser = $modelUser->findAll();
        $listCat = $modelCat->findAll();

        $this->render('create',array('listUser'=>$listUser,'listCat'=>$listCat));
    }

    public function actionSave(){
        ob_start();
        $dcm = new News();

        $dcm->title = $_POST['title'];
        $dcm->content = $_POST['content'];
        $dcm->user_id = $_POST['slUser'];
        $dcm->catid = $_POST['slParent'];
        $dcm->pub_time = $_POST['pubdate'];
        $dcm->thumb = $_FILES['thumbNews']['name'];

        /*Upload Image*/
        $dcm = Utils::uploadAvarta('thumbNews');
        /*End*/

        if($dcm->save()){
            $this->redirect(array('listNews'));
            Yii::app()->user->setFlash('success','Thêm mới thành công');
        }else{
            Yii::app()->user->setFlash('fail', Utils::setAllErrorsToArray($dcm->getErrors()));
            $this->redirect(array('create'));
        }
        ob_flush();
    }
    public function actionEdit(){

    }
    public function actionUpdate(){

    }
    public function actionDelete(){

    }

    public function actionFilterNews($catid){
        $model = new news();
        $user_info = User::getUsernameFromID($model->user_id);

        //$listNewsById = $model->findByPk($catid);
        $listNewsById = $model->findAllbySQl('SELECT * FROM news WHERE catid = "'. $catid .'"');
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
        foreach($listNewsById as $key => $value){
            $html .='</tbody>';
            $html .= '<tr>';
            $html .= '<td>'. $key .'</td>';
            $html .= '<td><img src="'.$value->thumb.'" width="50" alt="" /></td>';
            $html .= '<td>'. $value->title .'</td>';
            $html .= '<td> status </td>';
            $html .= '<td>'. $value->pub_time .'</td>';
            $html .= '<td> Người Tạo </td>';
            $html .= '<td> Action </td>';
            $html .= '</tr>';
            $html .='</tbody>';
        }
        $html .='</table>';
        echo $html;
        return $listNewsById;
        //var_dump($listNewsById[2]);die;
    }


}
