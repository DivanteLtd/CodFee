<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marek
 * Date: 22.04.13
 * Time: 11:16
 * To change this template use File | Settings | File Templates.
 */

class Divante_CodFee_Block_Adminhtml_Fee extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_fee';
        $this->_blockGroup = 'divante_codfee';
        $this->_headerText = $this->__('Płatność przy odbiorze - stawki');
        $this->_addButtonLabel = $this->__('Dodaj stawkę');
        parent::__construct();
    }
}