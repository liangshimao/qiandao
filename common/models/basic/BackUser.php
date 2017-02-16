<?php

/**
 * Created by PhpStorm.
 * User: smile
 * Date: 16-12-6
 * Time: 下午5:33
 */
namespace common\models\basic;
use yii\db\ActiveRecord;
use yii\data\Pagination;
class BackUser extends ActiveRecord
{
    public static function tableName()
    {
        return 'back_user';
    }

    public static function tableDesc(){
        return '后台用户表';
    }

    public static function hashPwd($pwd) 
    {
        return md5(md5(strtolower($pwd)));
    }
    
    public static function getAll($name = '',$pageSize)
    {
        $query = self::find()->where(['del_flag' => DEL_FLAG_FALSE]);
        if(!empty($name)){
            $query->andFilterWhere(['like','name',$name]);
        }
        $query->orderBy(['edit_time'=> SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $pageSize]);
        $info['data'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        $info['pages'] = $pages;
        return $info;
    }
    
    
    
}