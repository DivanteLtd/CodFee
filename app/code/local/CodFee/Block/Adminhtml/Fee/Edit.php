<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marek
 * Date: 22.04.13
 * Time: 11:27
 * To change this template use File | Settings | File Templates.
 */

class Divante_CodFee_Block_Adminhtml_Fee_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'carrier';
        $this->_blockGroup = 'divante_codfee';
        $this->_controller = 'adminhtml_fee';

        $this->_updateButton('save', 'label', Mage::helper('adminhtml')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('adminhtml')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        return ' ';
    }
}