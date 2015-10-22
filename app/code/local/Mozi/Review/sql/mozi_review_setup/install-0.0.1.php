<?php

$installer = $this;
$table = $installer->getTable('mozi_review/table_mozi_review');

$installer->startSetup();

$installer->getConnection()->dropTable($table);
$table = $installer->getConnection()
    ->newTable($table)
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
        ))
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
    ), 'Customer Id')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ))
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ))
    ->addColumn('created', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
    ))
    ->addIndex($installer->getIdxName('mozi_review/table_mozi_review', array('customer_id')),
        array('customer_id'))
    ->addForeignKey($installer->getFkName('mozi_review/table_mozi_review', 'customer_id', 'customer/entity', 'entity_id'),
        'customer_id', $installer->getTable('customer/entity'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_SET_NULL, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Review detail information');

$installer->getConnection()->createTable($table);

$installer->endSetup();