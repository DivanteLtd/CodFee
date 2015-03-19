<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marek
 * Date: 22.04.13
 * Time: 11:50
 * To change this template use File | Settings | File Templates.
 */

class Divante_CodFee_Block_Adminhtml_Fee_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('carrier' => $this->getRequest()->getParam('carrier'))),
            'method' => 'post',
        ));

        $form->setUseContainer(true);

        $this->setForm($form);


        $fieldset = $form->addFieldset('codfee_form', array(
            'legend' => $this->__('Podstawowe informacje')
        ));

        $fieldset->addField('carrier', 'select', array(
            'label'     => Mage::helper('adminhtml')->__('Dostawa'),
            'name'      => 'carrier',
            'class'     => 'required-entry',
            'value'     => '',
            'values'    => Mage::getModel('divante_codfee/source_methods')->toOptionArray(),
            'required'  => true,
        ));

        $fieldset->addField('fee', 'text', array(
            'label'     => Mage::helper('adminhtml')->__('Stawka'),
            'name'      => 'fee',
            'class'     => 'required-entry validate-number',
            'required'  => true,
        ));

        if ( Mage::getSingleton('adminhtml/session')->getCodFeeData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getCodFeeData());
            Mage::getSingleton('adminhtml/session')->setCodFeeData(null);
        } elseif ( Mage::registry('fee_data') ) {
            $form->setValues(Mage::registry('fee_data')->getData());
        }

        return parent::_prepareForm();
    }
}