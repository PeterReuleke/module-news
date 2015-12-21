<?php

namespace Pre\News\Helper;

use Magento\Framework\App\Action\Action;

class Feed extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var \Pre\News\Model\Feed
     */
    protected $_feed;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Pre\News\Model\Feef $feed
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Pre\News\Model\Feed $feed,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        $this->_feed = $feed;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Return a news feed from given feed id.
     *
     * @param Action $action
     * @param null $feedId
     * @return \Magento\Framework\View\Result\Page|bool
     */
    public function prepareResultPost(Action $action, $feedId = null)
    {
        if ($feedId !== null && $feedId !== $this->_feed->getId()) {
            $delimiterPosition = strrpos($feedId, '|');
            if ($delimiterPosition) {
                $feedId = substr($feedId, 0, $delimiterPosition);
            }

            if (!$this->_feed->load($feedId)) {
                return false;
            }
        }

        if (!$this->_feed->getId()) {
            return false;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        // We can add our own custom page handles for layout easily.
        $resultPage->addHandle('news_feed_view');

        // This will generate a layout handle like: news_feed_view_id_1
        // giving us a unique handle to target specific news feeds if we wish to.
        $resultPage->addPageLayoutHandles(['id' => $this->_feed->getId()]);

        // Magento is event driven after all, lets remember to dispatch our own, to help people
        // who might want to add additional functionality, or filter the feeds somehow!
        $this->_eventManager->dispatch(
            'pre_news_feed_render',
            ['feed' => $this->_feed, 'controller_action' => $action]
        );

        return $resultPage;
    }

}
