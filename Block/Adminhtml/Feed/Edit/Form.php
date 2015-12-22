<?php

namespace Pre\News\Block\Adminhtml\Feed\Edit;

/**
 * Adminhtml news feed edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('feed_form');
        $this->setTitle(__('Feed Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Pre\News\Model\Feed $model */
        $model = $this->_coreRegistry->registry('news_feed');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form',
                'action' => $this->getData('action'),
                'method' => 'post']
            ]
        );

        $form->setHtmlIdPrefix('feed_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getFeedId()) {
            $fieldset->addField('feed_id', 'hidden', ['name' => 'feed_id']);
        }

        $fieldset->addField(
            'feed_name',
            'text',
            [
                'name' => 'feed_name',
                'label' => __('Feed Name'),
                'title' => __('Feed Name'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'url_key',
            'text',
            [
                'name' => 'url_key',
                'label' => __('URL Key'),
                'title' => __('URL Key'),
                'required' => true,
                'class' => 'validate-xml-identifier'
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
            ]
        );

        if (!$model->getId()) {
            $model->setData('is_active', '1');
        }

        $fieldset->addField(
            'feed_url',
            'text',
            [
                'name'      => 'feed_url',
                'label'     => __('Feed Url'),
                'title'     => __('Feed Url'),
                'required'  => true
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}