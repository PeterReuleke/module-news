<?php

namespace Pre\News\Controller\Adminhtml\Feed;

use Pre\News\Controller\Adminhtml\AbstractMassStatus;

/**
 * Class MassDisable
 */
class MassDisable extends AbstractMassStatus
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
     * Page model
     *
     * @var string
     */
    protected $model = 'Pre\News\Model\Feed';

    /**
     * Page disable status
     *
     * @var boolean
     */
    protected $status = false;

}
