<?php

class Mozi_Review_Block_Review extends Mage_Core_Block_Template
{

    public function __construct()
    {
        parent::__construct();

        $collection = Mage::getModel('mozi_review/review')->getCollection()->setOrder('created', 'DESC');
        $this->setCollection($collection);
    }

    public function getFormAction()
    {
        return $this->getUrl('testimonials/index/post');
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();

        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getCollection()
    {
        $limit     = 10;
        $curr_page = 1;

        if (Mage::app()->getRequest()->getParam('p')) {
            $curr_page = Mage::app()->getRequest()->getParam('p');
        }

        //Calculate Offset
        $offset = ($curr_page - 1) * $limit;

        $collection = Mage::getModel('mozi_review/review')->getCollection()->setOrder('created', 'DESC');

        $collection->getSelect()->limit($limit, $offset);

        return $collection;
    }

}