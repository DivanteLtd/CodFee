<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marek
 * Date: 22.04.13
 * Time: 11:31
 * To change this template use File | Settings | File Templates.
 */

class Divante_CodFee_Block_Adminhtml_Fee_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('divante_codfee_grid');
        $this->setDefaultSort('carrier');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('divante_codfee/fee')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('carrier', array(
            'header'    => Mage::helper('adminhtml')->__('Sposób dostawy'),
            'align'     =>'left',
            'index'     => 'carrier',
        ));

        $this->addColumn('fee', array(
            'header'    => Mage::helper('adminhtml')->__('Stawka'),
            'align'     =>'left',
            'index'     => 'fee',
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('carrier' => $row->getCarrier()));
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}