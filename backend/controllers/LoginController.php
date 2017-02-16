<?php
/**
 * Created by PhpStorm.
 * User: smile
 * Date: 16-9-14
 * Time: 下午5:23
 */

namespace backend\controllers;

use common\components\ShowMessage;
use common\models\basic\BackUser;
use yii\web\Controller;
use Yii;
use yii\helpers\Url;
class LoginController extends Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }
    
    public function actionLogin()
    {
        if(Yii::$app->request->isPost){
            $username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('password');
            if (empty($username) || empty($password)){
                ShowMessage::info("用户名或密码不能为空", Url::toRoute('index'));
            }
            if($username !='admin' || $password != 'admin'){
                ShowMessage::info("用户名或密码错误", Url::toRoute('index'));
            }

            Yii::$app->getSession()->set("userid", 2);
            Yii::$app->getSession()->set("name", '管理员');
            Yii::$app->getSession()->set("realname", '管理员');
            $this->redirect('/');
        }
    }
    public function actionLogout()
    {
        Yii::$app->session->removeAll();
        return $this->redirect(Url::toRoute('/login/index'));
    }
}