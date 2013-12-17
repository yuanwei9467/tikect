<?php
/**
 * Created by yuanwei.
 * User: yuanwei
 * Date: 13-12-17
 * Time: 下午4:12
 */
namespace Admin\Controller;

use Zend\Mvc\COntroller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController{
    /**
     * 默认方法
     */
    public function indexAction(){
        return new ViewModel();
    }
}