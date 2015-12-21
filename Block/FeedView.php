<?php

namespace Pre\News\Block;

class FeedView extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Pre\News\Model\Feed $feed
     * @param \Pre\News\Model\FeedFactory $feedFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Pre\News\Model\Feed $feed,
        \Pre\News\Model\FeedFactory $feedFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_feed = $feed;
        $this->_feedFactory = $feedFactory;
    }

    /**
     * @return \Pre\News\Model\Feed
     */
    public function getFeed()
    {
        if (!$this->hasData('feed')) {
            if ($this->getFeedId()) {
                /** @var \Pre\News\Model\feed $page */
                $feed = $this->_feefFactory->create();
            } else {
                $feed = $this->_feed;
            }
            $this->setData('feed', $feed);
        }
        return $this->getData('feed');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Pre\News\Model\Feed::CACHE_TAG . '_' . $this->getFeed()->getId()];
    }

}
