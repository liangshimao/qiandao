<?php
/**
 * Created by PhpStorm.
 * User: smile
 * Date: 17-2-16
 * Time: 下午4:24
 */

namespace common\models\basic;


use yii\data\Pagination;
use yii\db\ActiveRecord;

class FrontUser extends ActiveRecord
{
    public static function tableName()
    {
        return 'front_user';
    }

    public static function tableDesc(){
        return '前端用户表';
    }

    public static function hashPwd($pwd)
    {
        return md5(md5(strtolower($pwd)));
    }

    public static function getAll($name = '',$pageSize)
    {
        $query = self::find();
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