<?php
/**
 * Created by PhpStorm.
 * User: Marek Kidon
 * Date: 2014-10-19
 * Time: 11:22
 */ 
class Divante_CodFee_Model_Resource_Fee_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('divante_codfee/fee');
    }

}