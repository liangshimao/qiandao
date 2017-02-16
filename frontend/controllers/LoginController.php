<?php
/**
 * Created by PhpStorm.
 * User: smile
 * Date: 17-2-16
 * Time: 下午4:28
 */

namespace frontend\controllers;

use common\components\OutPut;
use common\models\basic\FrontUser;
use Yii;
use yii\web\Controller;

class LoginController extends Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

    public function actionLogin_ajax()
    {
        if(!Yii::$app->request->isAjax){
            OutPut::returnJson('非法请求',201);
        }
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        if (empty($username) || empty($password)){
            OutPut::returnJson('用户名或密码不能为空',200,['status' => 0]);
        }
        $mInfo = FrontUser::find()->where('name=:name',[':name'=> trim($username)])->one();
        if (empty($mInfo)){
            OutPut::returnJson('用户名不存在',200,['status' => 0]);
        }

        if (FrontUser::hashPwd($password) != $mInfo['password']) {
            OutPut::returnJson('密码错误',200,['status' => 0]);
        }

        Yii::$app->getSession()->set("userid", $mInfo->id);
        OutPut::returnJson('登陆成功',200,['status' => 1]);
    }
}