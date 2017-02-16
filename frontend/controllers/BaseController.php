<?php

/**
 * Created by PhpStorm.
 * User: smile
 * Date: 16-9-14
 * Time: 下午4:18
 */
namespace frontend\controllers;
use common\components\ShowMessage;
use yii\helpers\Url;
use yii\web\Controller;
use Yii;
class BaseController extends Controller
{

    public $request;
    public $session;
    public $userid;

    public function init()
    {
        parent::init();
        $this->request = Yii::$app->request;

        $this->session = Yii::$app->session;
        $this->userid = $this->session->get('userid');
        if(empty($this->userid)){
            $this->redirect('/login/index');
        }
    }
    
}