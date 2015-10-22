<?php

class Mozi_Review_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Post form action
     */
    public function postAction()
    {
        // check if user logged in
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customerData = Mage::getSingleton('customer/session')->getCustomer();
            $customerId   = $customerData->getId();
        }
        else{
            Mage::getSingleton('core/session')->addError('Tou are not logged in');
        }

        // prepare data and save review
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('mozi_review/review');
                $model->setData($data);
                $model->setCreated(now());
                $model->setCustomerId($customerId);
                $model->save();

                Mage::getSingleton('core/session')->addSuccess('Review was saved successfully');
            } catch (Exception $e) {
                Mage::getSingleton('core/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/');
    }
}