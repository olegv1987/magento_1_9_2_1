<?php

class Mozi_Review_Block_Adminhtml_Review_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('mozi_review/review')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $helper = Mage::helper('mozi_review');

        $this->addColumn('entity_id', array(
            'header' => $helper->__('Review ID'),
            'index'  => 'entity_id'
        ));

        $this->addColumn('title', array(
            'header' => $helper->__('Title'),
            'index'  => 'title',
            'type'   => 'text',
        ));

        $this->addColumn('created', array(
            'header' => $helper->__('Created'),
            'index'  => 'created',
            'type'   => 'date',
        ));

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('review');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url'   => $this->getUrl('*/*/massDelete'),
        ));

        return $this;
    }

    /**
     * @param $model string
     * @return string
     */
    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $model->getId(),
        ));
    }

}