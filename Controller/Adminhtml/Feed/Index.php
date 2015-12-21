<?php

namespace Pre\News\Controller\Adminhtml\Feed;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Pre_News::feed';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Pre_News::feed');
        $resultPage->addBreadcrumb(__('News Feeds'), __('News Feeds'));
        $resultPage->addBreadcrumb(__('Manage News Feeds'), __('Manage News Feeds'));
        $resultPage->getConfig()->getTitle()->prepend(__('News Feeds'));

        return $resultPage;
    }

}
