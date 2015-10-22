<?php

class Mozi_Review_Model_Review extends Mage_Core_Model_Abstract
{

    /**
     * Constructor
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('mozi_review/review');
    }

    /**
     * Get customer name
     * @return string
     */
    public function getCustomer(){
        $customer  = Mage::getModel('customer/customer')->load($this->getCustomerId());
        return "{$customer->getFirstname()} {$customer->getLastname()}";
    }

}