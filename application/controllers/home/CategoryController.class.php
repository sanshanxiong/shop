<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2017/2/6
 * Time: 16:16
 */
class CategoryController extends  Controller
{
    //partial view
    public function  categories()
    {
        $model = $this->getModel();
        $categories=$model->query();
        $this->assign('categories',$categories);
        $this->renderPartial('categories');
    }

}