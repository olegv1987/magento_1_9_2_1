<?php

class Mozi_Review_Model_Resource_Review_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    /**
     * Constructor
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('mozi_review/review');
    }

}