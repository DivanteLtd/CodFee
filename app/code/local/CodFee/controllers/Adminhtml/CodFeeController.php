<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marek
 * Date: 22.04.13
 * Time: 10:24
 * To change this template use File | Settings | File Templates.
 */

class Divante_CodFee_Adminhtml_CodFeeController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout();
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('divante_codfee/adminhtml_fee'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('divante_codfee/adminhtml_fee_grid')->toHtml()
        );
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $carrier = $this->getRequest()->getParam('carrier');
        /** @var Divante_CodFee_Model_Fee $codFeeModel */
        $codFeeModel = Mage::getModel('divante_codfee/fee')->load($carrier);

        if ($codFeeModel->getCarrier() || empty($carrier)) {
            Mage::register('fee_data', $codFeeModel);
            $this->loadLayout();
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('divante_codfee/adminhtml_fee_edit'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        if ($this->getRequest()->getPost()) {
            try {
                $postData = $this->getRequest()->getPost();
                /** @var Divante_CodFee_Model_Fee $codFeeModel */
                $codFeeModel = Mage::getModel('divante_codfee/fee');

                $codFeeModel->setData($postData)->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setCodFeeData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('carrier' => $codFeeModel->getCarrier(), '_current' => true));
                    return;
                }

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setCodFeeData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('carrier' => $this->getRequest()->getParam('carrier')));
                return;
            }
        }

        $this->_redirect('*/*/');
    }
}