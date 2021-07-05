<?php
namespace Paydunya\PaydunyaMagento\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class Recurring implements InstallSchemaInterface 
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // Get module table
        $tableName = $setup->getTable('sales_order');

        // Check if the table already exists
        if ($setup->getConnection()->isTableExists($tableName) == true) {
            // Declare data
            $columns = [
                'paydunya_invoice_token' => [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    100,
                    'nullable' => true,
                    'comment' => 'PayDunya Invoice Token',
                ],
            ];

            $connection = $setup->getConnection();
            foreach ($columns as $name => $definition) {
                $connection->addColumn($tableName, $name, $definition);
            }
        }

        $setup->endSetup();
    }
}
