<?php
/**
 * Created by PhpStorm.
 * User: Marek Kidon
 * Date: 2014-10-19
 * Time: 11:22
 */ 
class Divante_CodFee_Model_Resource_Fee extends Mage_Core_Model_Resource_Db_Abstract
{
    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('divante_codfee/fee', 'carrier');
    }

}