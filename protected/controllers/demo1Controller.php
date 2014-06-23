<?php
/**
 * Created by PhpStorm.
 * User: Mrhuydzo
 * Date: 5/17/14
 * Time: 10:02 AM
 */
class demo1Controller extends Controller{
    //Chọn layout hiển thị
    public $layout = '//layouts/main';

    public function  actionShowtext(){
        $showtext = 'Fuck China';
        //echo $showtext;
        $this->render('index',array('showtext' => $showtext));
    }
}