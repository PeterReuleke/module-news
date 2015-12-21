<?php

namespace Pre\News\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('pre_news_feed'))
            ->addColumn(
                'feed_id',
                Table::TYPE_SMALLINT,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true
                ],
                'Feed ID'
            )
            ->addColumn(
                'url_key',
                Table::TYPE_TEXT,
                100,
                [
                    'nullable' => true,
                    'default' => null
                ]
            )
            ->addColumn(
                'feed_name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Feed Name'
            )
            ->addColumn(
                'feed_url',
                Table::TYPE_TEXT,
                255,
                [],
                'Feed Url'
            )
            ->addColumn(
                'is_active',
                Table::TYPE_SMALLINT,
                null,
                [
                    'nullable' => false,
                    'default' => '1'
                ],
                'Is Feed Active?'
            )
            ->addColumn(
                'creation_time',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => false],
                'Creation Time'
            )
            ->addColumn(
                'update_time',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => false],
                'Update Time'
            )
            ->addIndex($installer->getIdxName('news_feed', ['url_key']), ['url_key']);

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }

}
