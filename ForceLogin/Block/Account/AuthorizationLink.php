<?php

namespace PHPStudios\ForceLogin\Block\Account;

use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\Url;
use Magento\Framework\Data\Helper\PostHelper;
use PHPStudios\ForceLogin\Helper\Data as DataHelper;
use Magento\Framework\Escaper;

/**
 * Class AuthorizationLink
 */
class AuthorizationLink extends \Magento\Customer\Block\Account\AuthorizationLink
{
    /**
     * @var DataHelper
     */
    protected $dataHelper;

    /**
     * @var Escaper
     */
    protected $escaper;

    /**
     * AuthorizationLink constructor.
     * @param Context $context
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param Url $customerUrl
     * @param Escaper $escaper
     * @param PostHelper $postDataHelper
     * @param DataHelper $dataHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Magento\Framework\App\Http\Context $httpContext,
        Url $customerUrl,
        Escaper $escaper,
        PostHelper $postDataHelper,
        DataHelper $dataHelper,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $httpContext,
            $customerUrl,
            $postDataHelper,
            $data
        );
        $this->escaper = $escaper;
        $this->dataHelper = $dataHelper;
    }

    /**
     * Enable module
     * @return bool
     */
    public function isEnable()
    {
        return $this->dataHelper->isEnable();
    }

    /**
     * Enable customer registration
     * @return bool
     */
    public function isEnableRegister()
    {
        return $this->dataHelper->isEnableRegister();
    }

    /**
     * @return Escaper
     */
    public function getEscaper()
    {
        return $this->escaper;
    }
}
