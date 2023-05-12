<?php

namespace PHPStudios\ForceLogin\Model\Config\Source;

use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;

/**
 * Class CmsPage
 */
class CmsPage implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var array
     */
    public $options = [];

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * To option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        if (!count($this->options)) {
            $this->options = $this->collectionFactory->create()->toOptionIdArray();
        }
        return $this->options;
    }
}
