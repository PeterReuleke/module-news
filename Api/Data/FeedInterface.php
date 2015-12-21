<?php

namespace Pre\News\Api\Data;

interface FeedInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const FEED_ID       = 'feed_id';
    const URL_KEY       = 'url_key';
    const FEED_NAME     = 'feed_name';
    const FEED_URL      = 'feed_url';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    const IS_ACTIVE     = 'is_active';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     *
     * @param int $id
     * @return \Pre\News\Api\Data\NewsInterface
     */
    public function setId($id);

    /**
     * Get URL Key
     *
     * @return string
     */
    public function getUrlKey();

    /**
     * Set URL Key
     *
     * @param string $url_key
     * @return \Pre\News\Api\Data\NewsInterface
     */
    public function setUrlKey($url_key);

    /**
     * Get feed name
     *
     * @return string|null
     */
    public function getFeedName();

    /**
     * Set feed name
     *
     * @param string $feedName
     * @return \Pre\News\Api\Data\NewsInterface
     */
    public function setFeedName($feedName);

    /**
     * Get feed url
     *
     * @return string|null
     */
    public function getFeedUrl();

    /**
     * Set feed url
     *
     * @param string $feedUrl
     * @return \Pre\News\Api\Data\NewsInterface
     */
    public function setFeedUrl($feedUrl);

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return \Pre\News\Api\Data\NewsInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \Pre\News\Api\Data\NewsInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * Set is active
     *
     * @param int|bool $isActive
     * @return \Pre\News\Api\Data\NewsInterface
     */
    public function setIsActive($isActive);

    /**
     * Return full URL including base url.
     *
     * @return string|null
     */
    public function getUrl();

}
