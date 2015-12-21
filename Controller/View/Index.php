<?php

namespace Pre\News\Controller\View;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
    )
    {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * News Index, shows a list of news feeds.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $feed_id = $this->getRequest()->getParam('feed_id', $this->getRequest()->getParam('id', false));
        /** @var \Pre\News\Helper\Feed $helper */
        $helper = $this->_objectManager->get('Pre\News\Helper\Feed');
        $result_page = $helper->prepareResultFeed($this, $feed_id);

        if (!$result_page) {
            $resultForward = $this->resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }
        return $result_page;
    }

}
