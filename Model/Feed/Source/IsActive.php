<?php

namespace Pre\News\Model\Feed\Source;

class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Pre\News\Model\Feed
     */
    protected $_feed;

    /**
     * Constructor
     *
     * @param \Pre\News\Model\Feed $feed
     */
    public function __construct(\Pre\News\Model\Feed $feed)
    {
        $this->_feed = $feed;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->_feed->getAvailableStatuses();

        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }

}
