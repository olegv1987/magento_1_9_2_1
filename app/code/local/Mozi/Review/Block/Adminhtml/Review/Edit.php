<?php

class Mozi_Review_Block_Adminhtml_Review_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_blockGroup = 'mozi_review';
        $this->_controller = 'adminhtml_review';
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        $helper = Mage::helper('mozi_review');
        $model  = Mage::registry('current_review');

        if ($model->getId()) {
            return $helper->__("Edit Review item '%s'", $this->escapeHtml($model->getTitle()));
        } else {
            return $helper->__("Add Review item");
        }
    }

}