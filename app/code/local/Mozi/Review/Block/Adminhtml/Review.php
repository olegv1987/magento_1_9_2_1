<?php

class Mozi_Review_Block_Adminhtml_Review extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    /**
     * Constructor
     */
    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('mozi_review');
        $this->_blockGroup = 'mozi_review';
        $this->_controller = 'adminhtml_review';

        $this->_headerText = $helper->__('Review Management');
    }

    /**
     * Prepare layout
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->_removeButton('add');
    }

}