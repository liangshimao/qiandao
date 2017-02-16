<?php

/**
 * Created by PhpStorm.
 * User: smile
 * Date: 16-12-6
 * Time: 下午5:22
 */
namespace backend\modules\basic\controllers;
use backend\controllers\BaseController;
use common\components\ShowMessage;
use common\components\OutPut;
use common\models\basic\FrontUser;
use yii\helpers\Url;
use Yii;
class UserController extends BaseController
{
    public function actionIndex()
    {
        $name = $this->request->get('name');
        $pageSize = $this->request->get('per-page', PAGESIZE);
        $info = FrontUser::getAll($name,$pageSize);
        return $this->render('index', [
            'info' => $info['data'],
            'name' => $name,
            'pages' => $info['pages']
        ]);
    }
    
    public function actionAdd()
    {
        if($this->request->isPost){
            $user = $this->request->post('user');
            $model = new FrontUser();
            $model->setAttributes([
                'name' => $user['name'],
                'password' => FrontUser::hashPwd($user['password']),
                'edit_time' => $this->datetime,
            ],false);
            $model->save();
            ShowMessage::info('添加成功','',Url::toRoute(['index']),'edit');
        }
        return $this->render('add');
    }
    
    public function actionEdit($id)
    {
        $model = FrontUser::findOne($id);
        if($this->request->isPost){
            $user = $this->request->post('user');
            $model->setAttributes([
                'password' => FrontUser::hashPwd($user['password']),
                'edit_time' => $this->datetime,
            ],false);
            $model->save();
            ShowMessage::info('修改成功','',Url::toRoute(['index']),'edit');
        }
        return $this->render('edit',[
            'model' => $model,
        ]);
    }
    
    public function actionDelete($id)
    {
        FrontUser::deleteAll(['id' => $id]);
        ShowMessage::info('删除成功','',Url::toRoute(['index']),'edit');
    }

    public function actionCheckname_ajax() {
        if ($this->request->isAjax) {
            $username = $this->request->get('User-username');
            $userInfo = FrontUser::find()->where(['name' => $username])->one();
            if (!empty($userInfo)) {
                echo 200;die;  //返回该用户名已经注册
            } else {
                echo 201;die;
            }
        } else {
            echo 201;die;
        }
    }
    
}