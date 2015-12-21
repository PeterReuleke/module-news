<?php

namespace Pre\News\Block\Adminhtml;

class Feed extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Construct
     */
    protected function _construct()
    {
        $this->_controller = 'pre_feed';
        $this->_blockGroup = 'Pre_News';
        $this->_headerText = __('Manage News Feeds');

        parent::_construct();

        if ($this->_isAllowedAction('Pre_News::save')) {
            $this->buttonList->update('add', 'label', __('Add New News Feed'));
        } else {
            $this->buttonList->remove('add');
        }
    }

    /**
     * Check if action is allowed
     *
     * @param $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

}
