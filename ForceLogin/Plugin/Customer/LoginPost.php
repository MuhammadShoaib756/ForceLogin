<?php

namespace PHPStudios\ForceLogin\Plugin\Customer;

use PHPStudios\ForceLogin\Helper\Data;
use Magento\Framework\App\Action\Context;
use PHPStudios\ForceLogin\Model\Config\Source\RedirectPage;

/**
 * Class LoginPost
 */
class LoginPost
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * LoginPost constructor.
     * @param Context $context
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        Data $helperData
    ) {
        $this->helperData = $helperData;
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
    }

    /**
     * @param \Magento\Customer\Controller\Account\LoginPost $subject
     * @param $resultRedirect
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function afterExecute(\Magento\Customer\Controller\Account\LoginPost $subject, $resultRedirect)
    {
        $enable = $this->helperData->isEnable();
        if ($enable) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $configRedirectUrl = $this->getLoginRedirectUrl();
            return $resultRedirect->setPath($configRedirectUrl);
        } else {
            return $resultRedirect;
        }
    }

    /**
     * @return string
     */
    public function getLoginRedirectUrl()
    {
        $configRedirectUrl = $this->helperData->getRedirectUrl();
        if ($configRedirectUrl == RedirectPage::CUSTOM_URL) {
            return $this->helperData->getCustomUrl();
        } elseif ($configRedirectUrl == RedirectPage::DEFAULT_VALUE) {
            return $configRedirectUrl;
        }

        return "";
    }
}
