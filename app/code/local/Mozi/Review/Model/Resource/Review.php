<?php

class Mozi_Review_Model_Resource_Review extends Mage_Core_Model_Mysql4_Abstract
{

    /**
     * Constructor
     */
    public function _construct()
    {
        $this->_init('mozi_review/table_mozi_review', 'entity_id');
    }

}