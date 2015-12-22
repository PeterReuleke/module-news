<?php

namespace Pre\News\Block;

use Pre\News\Api\Data\FeedInterface;
use Pre\News\Model\ResourceModel\Feed\Collection as FeedCollection;

class FeedList extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{
    /**
     * @var array
     */
    protected $_feedItems = array();

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

    /**
     * Loads rss data for a specific feed
     *
     * @param string $feedUrl
     * @return array|null
     */
    public function getRssContent($feedUrl)
    {
        if (!empty($feedUrl)) {
            $contents = file_get_contents($feedUrl);

            if ($contents) {
                $rssArray = explode('<item>', $contents);
                $i = 0;

                foreach ($rssArray as $rssData) {
                    if ($i < 21) {

                        if ($i >= 1) {
                            $title = $this->parseRss('title>', $rssData);
                            $link  = $this->parseRss('link>', $rssData);

                            $titleData = explode(':', $title);

                            if (!isset($titleData[1])) {
                                $titleData[1] = '';
                            }

                            if (mb_detect_encoding($contents) == false) {
                                $title0 = utf8_encode($titleData[0]);
                                $title1 = utf8_encode($titleData[1]);
                            } else {
                                $title0 = $titleData[0];
                                $title1 = $titleData[1];
                            }

                            $this->_feedItems[] = [
                                'href'   => $link,
                                'title0' => $title0,
                                'title1' => $title1
                            ];
                        }
                    }

                    $i++;
                }

                $feedData = $this->_feedItems;
                $this->_feedItems = array();

                return $feedData;
            }
            else {
                return null;
            }
        }
        else {
            return null;
        }
    }

    /**
     * Retrieves the rss content for a given tag name
     *
     * @param $tag
     * @param $feed
     * @return string|null
     */
    protected function parseRss($tag, $feed)
    {
        $data = explode($tag, $feed);
        $count = count($data);

        if ($count == 3) {
            $data = substr($data[1], 0, -2);
        }
        elseif ($count == 2) {
            $data = substr($data[0], 0, -2);
        }
        else {
            $data = null;
        }

        return $data;
    }

}
