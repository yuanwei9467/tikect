<?php
/**
 * Created by yuanwei.
 * User: yuanwei
 * Date: 13-12-17
 * Time: 下午4:49
 */

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class OrganizationTable extends TableGateway{

    protected $tableGateway;
    public function __construct(TableGateway $tableGateway){
        $this->tableGetway = $tableGateway;
    }

    /**
     * 查找所有
     */
    public function getOrganization(){
        return $this->tableGetway->select();
    }
}