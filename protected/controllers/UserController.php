<?php

class UserController extends Controller
{

    public $layout='//layouts/admin';
    public $menuActive = __CLASS__;// lay ten class luon cho menuactive
    public $action;
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionList()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        $user = new User();
        $list_model = $user->findAll(array('order'=>'user_id DESC'));
//        var_dump($list_model);die;
		$this->render('list_user',
            array('list_model' => $list_model)
        );
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionCreate(){
        $model = new user();
		$this->render('create');
	}

	public function actionSave(){
        ob_start() ;
        /*Upload Image*/
        $mode = Utils::uploadAvarta('avatar');
        /*End*/

		$model = new user();
		$model->display_name = $_POST['display_name'];
		$model->password = $_POST['password'];
		$model->email = $_POST['email'];
		$model->avatar = date('Ymd',time()).'/'.time().$_FILES['avatar']['name'];

		if($model->save()){
			$this->redirect(array('list'));
            $this->redirect(array('view','id'=>$model->id));
		}else{
			Yii::app()->user->setFlash('fail', Utils::setAllErrorsToArray($model->getErrors()));
			$this->redirect(array('create'));
		}
        ob_flush();
	}

    public function actionEdit($user_id){
        $model = User::model()->findByPk($user_id);
        $this->render('edit', array(
            'model'=>$model
        ));
    }

    public function actionUpdate($user_id){
        ob_start();
        $model = User::model()->findByPk($user_id);
        $model->display_name = $_POST['display_name'];
        $model->password = $_POST['password'];
        $model->email = $_POST['email'];
        $model->avatar = $_FILES['avatar']['name'];
        /*Upload Image*/
        $mode = Utils::uploadAvarta('avatar');
        /*End*/
        if($model->update()){
            $this->redirect(array('list'));
        }else{
            Yii::app()->user->setFlash('fail', Utils::setAllErrorsToArray($model->getErrors()));
            $this->redirect(array('create'));
        }
        ob_flush();
    }

    public function actionDelete($user_id){
        $model = User::model()->findByPk($user_id);
        if($model->delete()){
            Yii::app()->user->setFlash('del_success', "delete success!");
            $this->redirect(array('list'));
        }
    }

    public function actionPaging(){
        $model = new user();

    }

}