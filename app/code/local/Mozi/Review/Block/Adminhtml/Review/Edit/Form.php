<?php

class Mozi_Review_Block_Adminhtml_Review_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $helper = Mage::helper('mozi_review');
        $model = Mage::registry('current_review');

        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/save', array(
                'id' => $this->getRequest()->getParam('id')
            )),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $this->setForm($form);

        $fieldset = $form->addFieldset('review_form', array('legend' => $helper->__('Review Information')));

        $fieldset->addField('title', 'text', array(
            'label'    => $helper->__('Title'),
            'required' => true,
            'name'     => 'title',
        ));

        $fieldset->addField('content', 'editor', array(
            'label'    => $helper->__('Content'),
            'required' => true,
            'name'     => 'content',
        ));

        $fieldset->addField('created', 'date', array(
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'image'  => $this->getSkinUrl('images/grid-cal.gif'),
            'label'  => $helper->__('Created'),
            'name'   => 'created'
        ));

        $form->setUseContainer(true);

        if ($data = Mage::getSingleton('adminhtml/session')->getFormData()) {
            $form->setValues($data);
        } else {
            $form->setValues($model->getData());
        }

        return parent::_prepareForm();
    }

}