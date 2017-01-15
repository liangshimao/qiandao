<?php
/**
 * Created by PhpStorm.
 * User: smile
 * Date: 16-9-27
 * Time: 下午3:58
 */

namespace frontend\controllers;


class JobController extends BaseController
{
    public function actionIndex()
    {
        if(self::isMobile()){
            return $this->renderPartial('mobile_index');
        }else{
            return $this->renderPartial('issue');
        }
    }
    
    public function actionFlow()
    {
        return $this->renderPartial('flow');
    }
    
    public function actionIssue()
    {
        return $this->renderPartial('issue');
    }
}