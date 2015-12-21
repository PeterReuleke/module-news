<?php

namespace Pre\News\Controller\Adminhtml\Feed;

use Pre\News\Controller\Adminhtml\AbstractMassStatus;

/**
 * Class MassEnable
 */
class MassEnable extends AbstractMassStatus
{
    /**
     * Field id
     */
    const ID_FIELD = 'feed_id';

    /**
     * Resource collection
     *
     * @var string
     */
    protected $collection = 'Pre\News\Model\ResourceModel\Feed\Collection';

    /**
     * Feed model
     *
     * @var string
     */
    protected $model = 'Pre\News\Model\Feed';

    /**
     * Feed enable status
     *
     * @var boolean
     */
    protected $status = true;

}
