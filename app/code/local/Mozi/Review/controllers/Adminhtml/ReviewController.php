<?php

class Mozi_Review_Adminhtml_ReviewController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('mozi_review');
        $this->_addContent($this->getLayout()->createBlock('mozi_review/adminhtml_review'));
        $this->renderLayout();
    }

    /**
     * Edit action
     */
    public function editAction()
    {
        $id = (int)$this->getRequest()->getParam('id');
        Mage::register('current_review', Mage::getModel('mozi_review/review')->load($id));

        $this->loadLayout()->_setActiveMenu('mozi_review');
        $this->_addContent($this->getLayout()->createBlock('mozi_review/adminhtml_review_edit'));
        $this->renderLayout();
    }

    /**
     * Save action
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('mozi_review/review');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                if (!$model->getCreated()) {
                    $model->setCreated(now());
                }
                if (!$model->getCustomerId()) {
                    $model->setCustomerId(1);
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Review was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(FALSE);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }

            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    /**
     * Delete action
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('mozi_review/review')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Review was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * Bulk delete action
     */
    public function massDeleteAction()
    {
        $review = $this->getRequest()->getParam('review', null);

        if (is_array($review) && sizeof($review) > 0) {
            try {
                foreach ($review as $id) {
                    Mage::getModel('mozi_review/review')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d reviews have been deleted', sizeof($review)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select review'));
        }
        $this->_redirect('*/*');
    }
}