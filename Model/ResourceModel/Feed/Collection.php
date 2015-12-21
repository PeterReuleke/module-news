<?php

namespace Pre\News\Model\ResourceModel\Feed;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pre\News\Model\Feed', 'Pre\News\Model\ResourceModel\Feed');
    }

}
