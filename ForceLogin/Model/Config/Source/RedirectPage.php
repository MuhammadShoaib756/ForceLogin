<?php

namespace PHPStudios\ForceLogin\Model\Config\Source;

/**
 * Class RedirectPage
 */
class RedirectPage implements \Magento\Framework\Data\OptionSourceInterface
{
    const DEFAULT_VALUE = 'customer/account/index';
    const HOME_PAGE = 'home';
    const CUSTOM_URL = 'customerurl';

    /**
     * Get Redirect Url
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'label' => __('Default'),
                'value' => self::DEFAULT_VALUE,
            ],
            [
                'label' => __('Home Page'),
                'value' => self::HOME_PAGE
            ],
            [
                'label' => __('Custom Url'),
                'value' => self::CUSTOM_URL
            ],
        ];
    }
}
