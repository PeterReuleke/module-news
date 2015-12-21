<?php

namespace Pre\News\Block;

use Pre\News\Api\Data\FeedInterface;
use Pre\News\Model\ResourceModel\Feed\Collection as FeedCollection;

class FeedList extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Pre\News\Model\ResourceModel\Feed\CollectionFactory $feedCollectionFactory,
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Pre\News\Model\ResourceModel\Feed\CollectionFactory $feedCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_feedCollectionFactory = $feedCollectionFactory;
    }

    /**
     * @return \Pre\News\Model\ResourceModel\Feed\Collection
     */
    public function getFeeds()
    {
        if (!$this->hasData('feeds')) {
            $feeds = $this->_feedCollectionFactory
                ->create()
                ->addOrder(
                    FeedInterface::CREATION_TIME,
                    FeedCollection::SORT_ORDER_DESC
                );
            $this->setData('feeds', $feeds);
        }
        return $this->getData('feeds');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Pre\News\Model\Feed::CACHE_TAG . '_' . 'list'];
    }

}
