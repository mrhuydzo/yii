<?php
/**
 * Created by JetBrains PhpStorm.
 * User: long
 * Date: 5/14/14
 * Time: 8:41 PM
 * To change this template use File | Settings | File Templates.
 */
class User extends CActiveRecord{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('display_name, email', 'length', 'max'=>30),
            array('password', 'length', 'min'=>6),
            array('display_name', 'required',"message"=>"Trường User name không được để chống !"),
            array('password', 'required',"message"=>"Trường Password không được để chống !"),
            array('email', 'required',"message"=>"Trường Email không được để chống !"),
            array('avatar', 'file', 'types'=>'jpg, gif, png','allowEmpty' => true,),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            //array('id, type_name', 'safe', 'on'=>'search'),
        );
    }

    public static function search_sql(){

    }

    public static function getUsernameFromID($id) {
        $user = new User();
        $user_info = $user->findAllBySql('SELECT * FROM user WHERE user_id="' . $id . '"');
        return $user_info;
    }
}