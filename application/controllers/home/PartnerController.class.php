<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2017/2/6
 * Time: 18:01
 */
class PartnerController extends Controller
{
    //partial view
    public function  partners()
    {
        $model = $this->getModel();
        $partners=$model->query();
        $this->assign('partners',$partners);
        $this->renderPartial('partners');
    }
}