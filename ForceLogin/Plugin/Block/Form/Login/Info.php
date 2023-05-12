<?php

namespace PHPStudios\ForceLogin\Plugin\Block\Form\Login;

/**
 * Class Info
 */
class Info
{
    /**
     * Data
     * @var \PHPStudios\ForceLogin\Helper\Data
     */
    protected $dataHelper;

    /**
     * Info constructor.
     * @param \PHPStudios\ForceLogin\Helper\Data $dataHelper
     */
    public function __construct(
        \PHPStudios\ForceLogin\Helper\Data $dataHelper
    ) {
        $this->dataHelper = $dataHelper;
    }

    /**
     * @param \Magento\Customer\Block\Form\Login\Info $subject
     * @param $result
     * @return string
     */
    public function afterGetTemplate(\Magento\Customer\Block\Form\Login\Info $subject, $result)
    {
        if ($this->dataHelper->isEnableRegister() && $this->dataHelper->isEnable()) {
            $result = "";
        }

        return $result;
    }
}
