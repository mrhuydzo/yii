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

        $listNews = $model->findAll(array('order'=>'pub_time DESC'));
        $listAllCat = $modelCat->findAllBySql('SELECT * FROM category WHERE parent_id is NULL');

        $this->render('listNews',array('listNews'=>$listNews,'listAllCat'=>$listAllCat));
    }



    public function actionCreate(){
        $model = new news();
        $modelUser = new User();
        $modelCat = new Category();

        $listUser = $modelUser->findAll();
        $listCat = $modelCat->findAll();

        $this->render('create',array('listUser'=>$listUser,'listCat'=>$listCat));
    }

    public function actionSave(){
        $model = new news();

    }
    public function actionEdit(){

    }
    public function actionUpdate(){

    }
    public function actionDelete(){

    }

    public function actionFilterNews($id){
        $model = new news();
        $listNewsById = $model->findByPk($id);

        foreach($listNewsById as $key => $value){
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
            $html .='</tbody>';

            $html .='</tbody>';
            $html .='</table>';
        }

        return $listNewsById;
        //var_dump($listNewsById[2]);die;
    }


}
