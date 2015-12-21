<?php

namespace Pre\News\Model;

use Pre\News\Api\Data\FeedInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Feed extends \Magento\Framework\Model\AbstractModel implements FeedInterface, IdentityInterface
{

    /**#@+
     * Feed's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    /**#@-*/

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'news_feed';

    /**
     * @var string
     */
    protected $_cacheTag = 'news_feed';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'news_feed';

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $data
     */
    function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pre\News\Model\ResourceModel\Feed');
    }

    /**
     * Check if feed url key exists
     * return feed id if feed exists
     *
     * @param string $url_key
     * @return int
     */
    public function checkUrlKey($url_key)
    {
        return $this->_getResource()->checkUrlKey($url_key);
    }

    /**
     * Prepare feed's statuses.
     * Available event news_feed_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled')
        ];
    }
    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::Feed_ID);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return \Pre\News\Api\Data\FeedInterface
     */
    public function setId($id)
    {
        return $this->setData(self::FEED_ID, $id);
    }

    /**
     * Get URL Key
     *
     * @return string
     */
    public function getUrlKey()
    {
        return $this->getData(self::URL_KEY);
    }

    /**
     * Set URL Key
     *
     * @param string $url_key
     * @return \Pre\News\Api\Data\FeedInterface
     */
    public function setUrlKey($url_key)
    {
        return $this->setData(self::URL_KEY, $url_key);
    }


    /**
     * Return the desired URL of a feed
     *  eg: /news/view/index/id/1/
     * @TODO Move to a PostUrl model, and make use of the
     * @TODO rewrite system, using url_key to build url.
     * @TODO desired url: /news/my-latest-blog-post-title
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->_urlBuilder->getUrl('news/' . $this->getUrlKey());
    }



    /**
     * Get feed name
     *
     * @return string|null
     */
    public function getFeedName()
    {
        return $this->getData(self::FEED_NAME);
    }

    /**
     * Set feed name
     *
     * @param string $feedName
     * @return \Pre\News\Api\Data\FeedInterface
     */
    public function setFeedName($feedName)
    {
        return $this->setData(self::FEED_NAME, $feedName);
    }

    /**
     * Get feed url
     *
     * @return string|null
     */
    public function getFeedUrl()
    {
        return $this->getData(self::FEED_URL);
    }

    /**
     * Set feed url
     *
     * @param string $feedUrl
     * @return \Pre\News\Api\Data\FeedInterface
     */
    public function setFeedUrl($feedUrl)
    {
        return $this->setData(self::FEED_URL, $feedUrl);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Set creation time
     *
     * @param string $creation_time
     * @return \Pre\News\Api\Data\FeedInterface
     */
    public function setCreationTime($creation_time)
    {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Set update time
     *
     * @param string $update_time
     * @return \Pre\News\Api\Data\FeedInterface
     */
    public function setUpdateTime($update_time)
    {
        return $this->setData(self::UPDATE_TIME, $update_time);
    }

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive()
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set is active
     *
     * @param int|bool $is_active
     * @return \Pre\News\Api\Data\FeedInterface
     */
    public function setIsActive($is_active)
    {
        return $this->setData(self::IS_ACTIVE, $is_active);
    }

}
